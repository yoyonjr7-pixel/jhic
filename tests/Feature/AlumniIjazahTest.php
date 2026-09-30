<?php

namespace Tests\Feature;

use App\Models\AlumniTrack;
use App\Models\BookJasah;
use App\Models\Jurusan;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class AlumniIjazahTest extends TestCase
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
            $table->string('nisn')->nullable();
            $table->string('nama_siswa');
            $table->unsignedBigInteger('id_jurusan')->nullable();
            $table->timestamps();
        });
        Schema::create('alumni_track', function (Blueprint $table): void {
            $table->id('id_alumni');
            $table->unsignedBigInteger('id_siswa')->nullable();
            $table->unsignedBigInteger('id_jurusan')->nullable();
            $table->unsignedSmallInteger('tahun_lulus')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
        Schema::create('book_jasah', function (Blueprint $table): void {
            $table->unsignedBigInteger('id_bookjasah')->primary();
            $table->unsignedBigInteger('id_alumni');
            $table->string('status_book')->default('pending');
            $table->timestamps();
        });

        $this->actingAs(new User(['name' => 'Admin Uji']));
    }

    protected function tearDown(): void
    {
        Schema::dropIfExists('book_jasah');
        Schema::dropIfExists('alumni_track');
        Schema::dropIfExists('siswa');
        Schema::dropIfExists('jurusan');

        parent::tearDown();
    }

    public function test_pickup_code_is_shown_inside_the_alumni_track_dashboard(): void
    {
        $jurusan = Jurusan::create(['nama_jurusan' => 'Teknik Uji']);
        $siswa = Siswa::create([
            'nama_siswa' => 'Alumni Pengujian',
            'nisn' => '1234567890',
            'id_jurusan' => $jurusan->id_jurusan,
        ]);
        $alumni = AlumniTrack::create([
            'id_siswa' => $siswa->id_siswa,
            'id_jurusan' => $jurusan->id_jurusan,
            'tahun_lulus' => 2024,
        ]);
        BookJasah::create([
            'id_bookjasah' => 123456789012,
            'id_alumni' => $alumni->id_alumni,
            'status_book' => 'pending',
        ]);

        $this->get('/alumni-track')
            ->assertOk()
            ->assertSee('123456789012')
            ->assertSee('Alumni Pengujian')
            ->assertSee('1234567890')
            ->assertSee('Teknik Uji')
            ->assertSee('2024')
            ->assertSee('Perusahaan / Usaha / Kampus')
            ->assertDontSee('Belum Diambil')
            ->assertDontSee('name="status_book"');
    }

    public function test_admin_can_mark_diploma_as_collected(): void
    {
        $jurusan = Jurusan::create(['nama_jurusan' => 'Teknik Uji']);
        $alumni = AlumniTrack::create([
            'id_jurusan' => $jurusan->id_jurusan,
            'tahun_lulus' => 2024,
        ]);
        $bookJasah = BookJasah::create([
            'id_bookjasah' => 123456789012,
            'id_alumni' => $alumni->id_alumni,
            'status_book' => 'pending',
        ]);

        $this->put(route('alumni-track.ijazah.update', $bookJasah->id_bookjasah), [
            'status_book' => 'selesai',
        ])
            ->assertRedirect('/alumni-track');

        $this->assertDatabaseHas('book_jasah', [
            'id_bookjasah' => 123456789012,
            'status_book' => 'selesai',
        ]);
    }

    public function test_admin_can_generate_missing_pickup_id_from_alumni_dashboard(): void
    {
        $jurusan = Jurusan::create(['nama_jurusan' => 'Teknik Uji']);
        $alumni = AlumniTrack::create(['id_jurusan' => $jurusan->id_jurusan]);

        $this->post(route('alumni-track.ijazah.generate', $alumni->id_alumni))
            ->assertRedirect('/alumni-track');

        $this->assertDatabaseHas('book_jasah', [
            'id_alumni' => $alumni->id_alumni,
            'status_book' => 'pending',
        ]);
        $this->assertSame(12, strlen((string) BookJasah::where('id_alumni', $alumni->id_alumni)->value('id_bookjasah')));
    }

    public function test_admin_cannot_set_an_unsupported_pickup_status(): void
    {
        $jurusan = Jurusan::create(['nama_jurusan' => 'Teknik Uji']);
        $alumni = AlumniTrack::create(['id_jurusan' => $jurusan->id_jurusan]);
        $bookJasah = BookJasah::create([
            'id_bookjasah' => 123456789012,
            'id_alumni' => $alumni->id_alumni,
            'status_book' => 'pending',
        ]);

        $this->from('/alumni-track')
            ->put(route('alumni-track.ijazah.update', $bookJasah->id_bookjasah), [
                'status_book' => 'invalid',
            ])
            ->assertRedirect('/alumni-track')
            ->assertSessionHasErrors('status_book');

        $this->assertDatabaseHas('book_jasah', [
            'id_bookjasah' => 123456789012,
            'status_book' => 'pending',
        ]);
    }
}
