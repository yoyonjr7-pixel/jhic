<?php

namespace Tests\Feature;

use App\Models\AlumniTrack;
use App\Models\BookJasah;
use App\Models\Jurusan;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class AlumniControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Schema::create('jurusan', function (Blueprint $table): void { $table->id('id_jurusan'); $table->string('nama_jurusan'); $table->timestamps(); });
        Schema::create('siswa', function (Blueprint $table): void { $table->id('id_siswa'); $table->string('nisn', 20)->unique(); });
        Schema::create('alumni_track', function (Blueprint $table): void { $table->id('id_alumni'); $table->unsignedBigInteger('id_siswa')->nullable(); $table->unsignedBigInteger('id_jurusan')->nullable(); $table->year('tahun_lulus')->nullable(); $table->string('no_telp', 20)->nullable(); $table->string('email', 150)->nullable(); $table->string('status')->nullable(); $table->text('keterangan')->nullable(); $table->boolean('mentor')->default(false); $table->timestamps(); });
        Schema::create('book_jasah', function (Blueprint $table): void { $table->id('id_bookjasah'); $table->unsignedBigInteger('id_alumni'); $table->string('status_book')->nullable(); $table->timestamps(); });
    }

    protected function tearDown(): void
    {
        Schema::dropIfExists('book_jasah');
        Schema::dropIfExists('alumni_track');
        Schema::dropIfExists('siswa');
        Schema::dropIfExists('jurusan');
        parent::tearDown();
    }

    public function test_nonexistent_nisn_returns_validation_error_without_creating_records(): void
    {
        $jurusan = Jurusan::create(['nama_jurusan' => 'Teknik Pengujian']);
        $alumniBefore = AlumniTrack::count();
        $bookBefore = BookJasah::count();

        $response = $this->postJson(route('alumni.store'), [
            'nama_lengkap' => 'Alumni Uji',
            'nisn' => '9999999999999999',
            'id_jurusan' => $jurusan->id_jurusan,
            'tahun_lulus' => now()->year,
            'no_whatsapp' => '08123456789',
            'email' => 'alumni@gmail.com',
            'status' => 'Bekerja',
            'bersedia_mentor' => false,
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['nisn'])
            ->assertJsonPath('errors.nisn.0', 'NISN tidak ditemukan dalam data siswa.');

        $this->assertSame($alumniBefore, AlumniTrack::count());
        $this->assertSame($bookBefore, BookJasah::count());
    }

    public function test_existing_student_already_registered_as_alumni_returns_validation_error(): void
    {
        $jurusan = Jurusan::create(['nama_jurusan' => 'Teknik Pengujian']);
        $siswaId = \Illuminate\Support\Facades\DB::table('siswa')->insertGetId(['nisn' => '1234567890123456']);
        AlumniTrack::create(['id_siswa' => $siswaId]);
        $bookBefore = BookJasah::count();
        $response = $this->postJson(route('alumni.store'), ['nama_lengkap' => 'Alumni Uji', 'nisn' => '1234567890123456', 'id_jurusan' => $jurusan->id_jurusan, 'tahun_lulus' => now()->year, 'no_whatsapp' => '08123456789', 'email' => 'alumni@gmail.com', 'status' => 'Bekerja', 'bersedia_mentor' => false]);
        $response->assertStatus(422)->assertJsonValidationErrors(['nisn'])->assertJsonPath('errors.nisn.0', 'NISN ini sudah terdaftar sebagai alumni.');
        $this->assertSame($bookBefore, BookJasah::count());
    }

    public function test_invalid_profile_fields_return_clear_validation_errors(): void
    {
        $jurusan = Jurusan::create(['nama_jurusan' => 'Teknik Pengujian']);
        \Illuminate\Support\Facades\DB::table('siswa')->insert(['nisn' => '1234567890123456']);
        $base = ['nama_lengkap' => 'Alumni Uji', 'nisn' => '1234567890123456', 'id_jurusan' => $jurusan->id_jurusan, 'tahun_lulus' => now()->year, 'no_whatsapp' => '08123456789', 'email' => 'alumni@gmail.com', 'status' => 'Bekerja', 'bersedia_mentor' => false];

        foreach ([
            ['nama_lengkap' => 'Alumni 123', 'field' => 'nama_lengkap'],
            ['email' => 'alumni@example.com', 'field' => 'email'],
            ['tahun_lulus' => '20A0', 'field' => 'tahun_lulus'],
            ['no_whatsapp' => '08123abc', 'field' => 'no_whatsapp'],
        ] as $invalid) {
            $field = $invalid['field'];
            $response = $this->postJson(route('alumni.store'), array_merge($base, [$field => $invalid[$field]]));
            $response->assertStatus(422)->assertJsonValidationErrors([$field]);
        }
    }
    public function test_existing_student_without_alumni_can_submit(): void
    {
        $jurusan = Jurusan::create(['nama_jurusan' => 'Teknik Pengujian']);
        \Illuminate\Support\Facades\DB::table('siswa')->insert(['nisn' => '1234567890123456']);
        $response = $this->postJson(route('alumni.store'), ['nama_lengkap' => 'Alumni Uji', 'nisn' => '1234567890123456', 'id_jurusan' => $jurusan->id_jurusan, 'tahun_lulus' => now()->year, 'no_whatsapp' => '08123456789', 'email' => 'alumni@gmail.com', 'status' => 'Bekerja', 'bersedia_mentor' => false]);
        $response->assertOk();
        $this->assertSame(1, AlumniTrack::count());
        $this->assertSame(1, BookJasah::count());
    }

    public function test_masih_mencari_kerja_always_persists_mentor_as_false(): void
    {
        $jurusan = Jurusan::create(['nama_jurusan' => 'Teknik Pengujian']);
        \Illuminate\Support\Facades\DB::table('siswa')->insert(['nisn' => '1234567890123456']);

        $response = $this->postJson(route('alumni.store'), [
            'nama_lengkap' => 'Alumni Uji',
            'nisn' => '1234567890123456',
            'id_jurusan' => $jurusan->id_jurusan,
            'tahun_lulus' => now()->year,
            'no_whatsapp' => '08123456789',
            'email' => 'alumni@gmail.com',
            'status' => 'Masih Mencari Kerja',
            'bersedia_mentor' => true,
        ]);

        $response->assertOk();
        $this->assertFalse((bool) AlumniTrack::query()->firstOrFail()->mentor);
    }
}
