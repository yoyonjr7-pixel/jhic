<?php

namespace Tests\Feature;

use App\Models\Jurusan;
use App\Models\Siswa;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class SiswaAdminTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Schema::create('jurusan', function (Blueprint $table): void {
            $table->id('id_jurusan');
            $table->string('nama_jurusan');
            $table->timestamps();
        });
        Schema::create('siswa', function (Blueprint $table): void {
            $table->id('id_siswa');
            $table->string('nisn', 20)->unique();
            $table->string('nama_siswa', 150);
            $table->string('kelas', 20);
            $table->unsignedBigInteger('id_jurusan');
            $table->string('status', 20)->default('aktif');
            $table->timestamps();
        });
        Schema::create('alumni_track', function (Blueprint $table): void {
            $table->id('id_alumni');
            $table->unsignedBigInteger('id_siswa')->nullable();
            $table->unsignedBigInteger('id_jurusan')->nullable();
            $table->unsignedSmallInteger('tahun_lulus')->nullable();
            $table->string('no_telp', 30)->nullable();
            $table->string('email')->nullable();
            $table->string('status')->nullable();
            $table->text('keterangan')->nullable();
            $table->boolean('mentor')->default(false);
            $table->timestamps();
        });
    }

    protected function tearDown(): void
    {
        Schema::dropIfExists('alumni_track');
        Schema::dropIfExists('siswa');
        Schema::dropIfExists('jurusan');

        parent::tearDown();
    }

    public function test_admin_can_create_and_update_student_records(): void
    {
        $this->withoutMiddleware(\Illuminate\Auth\Middleware\Authenticate::class);
        $jurusan = Jurusan::create(['nama_jurusan' => 'Teknik Pengujian']);

        $this->post(route('siswa.store'), [
            'nisn' => '1234567890',
            'nama_siswa' => 'Siswa Uji',
            'kelas' => 'XII TJKT 1',
            'id_jurusan' => $jurusan->id_jurusan,
            'status' => 'aktif',
        ])->assertRedirect(route('siswa.index'));

        $siswa = Siswa::query()->firstOrFail();
        $this->assertDatabaseHas('siswa', [
            'nisn' => '1234567890',
            'nama_siswa' => 'Siswa Uji',
            'status' => 'aktif',
        ]);

        $this->put(route('siswa.update', $siswa->id_siswa), [
            'nisn' => '1234567890',
            'nama_siswa' => 'Siswa Diperbarui',
            'kelas' => 'XII TJKT 2',
            'id_jurusan' => $jurusan->id_jurusan,
            'status' => 'lulus',
        ])->assertRedirect(route('siswa.index'));

        $this->get(route('siswa.index'))
            ->assertOk()
            ->assertSee('Siswa Diperbarui')
            ->assertSee('XII TJKT 2');
    }

    public function test_admin_can_link_an_existing_student_to_alumni_track_without_creating_a_duplicate(): void
    {
        $this->withoutMiddleware(\Illuminate\Auth\Middleware\Authenticate::class);
        $jurusan = Jurusan::create(['nama_jurusan' => 'Teknik Pengujian']);
        $siswa = Siswa::create([
            'nisn' => '1234567890',
            'nama_siswa' => 'Alumni Uji',
            'kelas' => 'XII TJKT 1',
            'id_jurusan' => $jurusan->id_jurusan,
            'status' => 'aktif',
        ]);

        $this->post(route('alumni-track.store'), [
            'id_siswa' => $siswa->id_siswa,
            'tahun_lulus' => 2026,
            'status' => 'mencari_kerja',
            'mentor' => '1',
        ])->assertRedirect('/alumni-track');

        $this->assertSame(1, Siswa::count());
        $this->assertDatabaseHas('alumni_track', [
            'id_siswa' => $siswa->id_siswa,
            'id_jurusan' => $jurusan->id_jurusan,
            'mentor' => 1,
        ]);
        $this->assertDatabaseHas('siswa', [
            'id_siswa' => $siswa->id_siswa,
            'status' => 'lulus',
        ]);
    }

    public function test_student_linked_to_alumni_cannot_be_deleted(): void
    {
        $this->withoutMiddleware(\Illuminate\Auth\Middleware\Authenticate::class);
        $jurusan = Jurusan::create(['nama_jurusan' => 'Teknik Pengujian']);
        $siswa = Siswa::create([
            'nisn' => '1234567890',
            'nama_siswa' => 'Alumni Uji',
            'kelas' => 'XII TJKT 1',
            'id_jurusan' => $jurusan->id_jurusan,
            'status' => 'lulus',
        ]);
        DB::table('alumni_track')->insert([
            'id_siswa' => $siswa->id_siswa,
            'id_jurusan' => $jurusan->id_jurusan,
            'tahun_lulus' => 2026,
            'status' => 'mencari_kerja',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->delete(route('siswa.destroy', $siswa->id_siswa))
            ->assertRedirect(route('siswa.index'))
            ->assertSessionHas('error');

        $this->assertDatabaseHas('siswa', ['id_siswa' => $siswa->id_siswa]);
    }
}
