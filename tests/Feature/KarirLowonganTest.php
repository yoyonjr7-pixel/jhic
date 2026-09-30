<?php

namespace Tests\Feature;

use App\Models\Jurusan;
use App\Models\Lowongan;
use Database\Seeders\LowonganSeeder;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class KarirLowonganTest extends TestCase
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
            $table->string('nisn', 20)->nullable();
            $table->string('nama_siswa');
            $table->unsignedBigInteger('id_jurusan')->nullable();
        });
        Schema::create('alumni_track', function (Blueprint $table): void {
            $table->id('id_alumni');
            $table->unsignedBigInteger('id_siswa')->nullable();
            $table->unsignedBigInteger('id_jurusan')->nullable();
            $table->year('tahun_lulus')->nullable();
            $table->string('no_telp', 20)->nullable();
            $table->string('email', 150)->nullable();
            $table->string('status')->nullable();
            $table->text('keterangan')->nullable();
            $table->boolean('mentor')->default(false);
            $table->timestamps();
        });
        Schema::create('lowongan_kerja', function (Blueprint $table): void {
            $table->id('id_lowongan');
            $table->unsignedBigInteger('id_jurusan')->nullable();
            $table->string('nama_lowongan', 150);
            $table->text('deskripsi')->nullable();
            $table->unsignedInteger('jumlah')->default(0);
            $table->string('status', 30)->default('dibuka');
            $table->unsignedBigInteger('gaji_min')->nullable();
            $table->unsignedBigInteger('gaji_max')->nullable();
            $table->json('skills')->nullable();
            $table->timestamps();
        });
        Schema::create('mentoring_requests', function (Blueprint $table): void {
            $table->id('id_mentoring');
            $table->unsignedBigInteger('id_mentor')->nullable();
            $table->string('mentor_nama', 150);
            $table->string('nama_pemohon', 150);
            $table->string('no_telp', 30)->nullable();
            $table->string('status_pemohon', 100);
            $table->text('topik');
            $table->string('status_pengajuan', 30)->default('menunggu');
            $table->timestamps();
        });
    }

    protected function tearDown(): void
    {
        Schema::dropIfExists('mentoring_requests');
        Schema::dropIfExists('lowongan_kerja');
        Schema::dropIfExists('alumni_track');
        Schema::dropIfExists('siswa');
        Schema::dropIfExists('jurusan');

        parent::tearDown();
    }

    public function test_career_page_shows_jobs_and_legacy_mentors_using_student_major(): void
    {
        $jurusan = Jurusan::create([
            'nama_jurusan' => config('tefa.jurusan.tjkt.nama'),
        ]);
        $siswaId = DB::table('siswa')->insertGetId([
            'nisn' => '1234567890',
            'nama_siswa' => 'Alumni Mentor TJKT',
            'id_jurusan' => $jurusan->id_jurusan,
        ]);
        DB::table('alumni_track')->insert([
            'id_siswa' => $siswaId,
            'id_jurusan' => null,
            'tahun_lulus' => 2020,
            'status' => 'bekerja',
            'mentor' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $legacySiswaId = DB::table('siswa')->insertGetId([
            'nisn' => '1234567891',
            'nama_siswa' => 'Mentor Legacy Database',
            'id_jurusan' => $jurusan->id_jurusan,
        ]);
        DB::table('alumni_track')->insert([
            'id_siswa' => $legacySiswaId,
            'id_jurusan' => null,
            'tahun_lulus' => 2019,
            'status' => 'bekerja',
            'mentor' => 'Mentor lama',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Lowongan::create([
            'id_jurusan' => $jurusan->id_jurusan,
            'nama_lowongan' => 'IT Support dari Database',
            'status' => 'dibuka',
            'jumlah' => 1,
            'skills' => ['Troubleshooting'],
        ]);

        $this->get(route('karir.tjkt'))
            ->assertOk()
            ->assertSee('IT Support dari Database')
            ->assertSee('Alumni Mentor TJKT')
            ->assertSee('Mentor Legacy Database');
    }

    public function test_admin_can_save_lowongan_with_skills_for_a_jurusan(): void
    {
        $this->withoutMiddleware(\Illuminate\Auth\Middleware\Authenticate::class);
        $jurusan = Jurusan::create([
            'nama_jurusan' => config('tefa.jurusan.tjkt.nama'),
        ]);

        $response = $this->post(route('lowongan.store'), [
            'id_jurusan' => $jurusan->id_jurusan,
            'nama_lowongan' => 'Teknisi Jaringan',
            'deskripsi' => 'Instalasi jaringan kantor',
            'jumlah' => 2,
            'status' => 'dibuka',
            'gaji_min' => 4000000,
            'gaji_max' => 6000000,
            'skills' => "Instalasi LAN\nMikrotik",
        ]);

        $response->assertRedirect(route('lowongan.index'));
        $this->assertDatabaseHas('lowongan_kerja', [
            'id_jurusan' => $jurusan->id_jurusan,
            'nama_lowongan' => 'Teknisi Jaringan',
            'status' => 'dibuka',
        ]);
        $this->assertSame(
            ['Instalasi LAN', 'Mikrotik'],
            Lowongan::query()->firstOrFail()->skills
        );
        $this->get(route('lowongan.index'))
            ->assertOk()
            ->assertSee('Lowongan Pekerjaan')
            ->assertSee('Total Lowongan')
            ->assertSee('Lowongan Dibuka')
            ->assertSee('Posisi Tersedia')
            ->assertSee('Tambah Lowongan')
            ->assertSee('searchLowongan', false)
            ->assertSee('filterStatusLowongan', false)
            ->assertSee('Teknisi Jaringan');
    }

    public function test_lowongan_seeder_adds_jobs_for_all_majors_without_duplicates(): void
    {
        Jurusan::create([
            'nama_jurusan' => config('tefa.jurusan.tjkt.nama'),
        ]);

        $seeder = new LowonganSeeder();
        $seeder->run();
        $seeder->run();

        $this->assertDatabaseCount('jurusan', 4);
        $this->assertDatabaseCount('lowongan_kerja', 6);
        $this->assertDatabaseHas('lowongan_kerja', [
            'nama_lowongan' => 'Teknisi Mobil',
            'gaji_min' => 4000000,
            'gaji_max' => 6000000,
            'status' => 'dibuka',
        ]);
        $this->assertDatabaseHas('lowongan_kerja', [
            'nama_lowongan' => 'Kepala Teknisi Bengkel',
            'gaji_min' => 5000000,
            'gaji_max' => 7000000,
            'status' => 'dibuka',
        ]);
        $this->assertDatabaseHas('lowongan_kerja', [
            'nama_lowongan' => 'Operator Mesin Bubut',
            'gaji_min' => 4200000,
            'gaji_max' => 6200000,
            'status' => 'dibuka',
        ]);
        $this->assertSame(
            ['Membubut', 'Membaca gambar teknik'],
            Lowongan::where('nama_lowongan', 'Operator Mesin Bubut')->firstOrFail()->skills
        );
    }

    public function test_lowongan_seeder_closes_legacy_tp_jobs_not_in_the_reference_photos(): void
    {
        $jurusan = Jurusan::create([
            'nama_jurusan' => config('tefa.jurusan.tp.nama'),
        ]);
        Lowongan::create([
            'id_jurusan' => $jurusan->id_jurusan,
            'nama_lowongan' => 'Operator CNC',
            'status' => 'dibuka',
            'jumlah' => 1,
        ]);

        (new LowonganSeeder())->run();

        $this->assertDatabaseHas('lowongan_kerja', [
            'id_jurusan' => $jurusan->id_jurusan,
            'nama_lowongan' => 'Operator CNC',
            'status' => 'ditutup',
        ]);
        $this->assertDatabaseHas('lowongan_kerja', [
            'id_jurusan' => $jurusan->id_jurusan,
            'nama_lowongan' => 'Operator Mesin Bubut',
            'status' => 'dibuka',
        ]);
    }

    public function test_career_mentoring_request_is_saved_and_visible_in_admin(): void
    {
        $this->withoutMiddleware(\Illuminate\Auth\Middleware\Authenticate::class);
        $jurusan = Jurusan::create([
            'nama_jurusan' => config('tefa.jurusan.tjkt.nama'),
        ]);
        $siswaId = DB::table('siswa')->insertGetId([
            'nisn' => '1234567890',
            'nama_siswa' => 'Mentor Uji',
            'id_jurusan' => $jurusan->id_jurusan,
        ]);
        $mentorId = DB::table('alumni_track')->insertGetId([
            'id_siswa' => $siswaId,
            'id_jurusan' => $jurusan->id_jurusan,
            'tahun_lulus' => 2020,
            'status' => 'bekerja',
            'no_telp' => '081234567891',
            'mentor' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->post(route('mentoring.store'), [
            'id_mentor' => $mentorId,
            'nama' => 'Siswa Uji',
            'no_telp' => '081234567890',
            'status' => 'Siswa',
            'topik' => 'Persiapan kerja',
        ])->assertRedirect()
            ->assertSessionHas('mentoring_success', true)
            ->assertSessionMissing('request_code');

        $this->get(route('karir.tjkt'))
            ->assertOk()
            ->assertSee('name="no_telp"', false)
            ->assertSee('Jika permintaan anda telah sesuai, anda akan dihubungi oleh mentor.')
            ->assertDontSee('MTR-');

        $this->assertDatabaseHas('mentoring_requests', [
            'id_mentor' => $mentorId,
            'mentor_nama' => 'Mentor Uji',
            'nama_pemohon' => 'Siswa Uji',
            'no_telp' => '081234567890',
            'status_pengajuan' => 'menunggu',
        ]);

        $requestId = DB::table('mentoring_requests')->value('id_mentoring');
        $mentoringPage = $this->get(route('mentoring.index'));
        $mentoringPage
            ->assertOk()
            ->assertSee('Siswa Uji')
            ->assertSee('081234567890')
            ->assertSee('Mentor Uji')
            ->assertSee('wa.me/6281234567890', false)
            ->assertSee('WhatsApp Pemohon')
            ->assertDontSee('pengajuan mentoring ID #' . $requestId)
            ->assertSee('wa.me/6281234567891', false)
            ->assertSee('WhatsApp Mentor')
            ->assertSee('Tabel pengajuan mentoring, geser horizontal untuk melihat kolom lainnya', false)
            ->assertSee('searchMentoring', false)
            ->assertSee('filterStatusMentoring', false)
            ->assertSee('data-status="menunggu"', false)
            ->assertSee('Ditolak')
            ->assertSee('Selesai')
            ->assertSee('Pilih status')
            ->assertSee('min-width: 1500px', false)
            ->assertSee('width: 180px', false)
            ->assertDontSee('Tambah Pengajuan')
            ->assertDontSee('Simpan Pengajuan');
        $this->assertSame(1, substr_count($mentoringPage->getContent(), '<option value="menunggu">Menunggu</option>'));
        $this->assertSame(1, substr_count($mentoringPage->getContent(), '<option value="diproses">Dalam Proses</option>'));
        $this->get(route('mentoring.show', $requestId))
            ->assertOk()
            ->assertSee('Persiapan kerja')
            ->assertSee('081234567890');

        foreach ([
            'ditolak' => 'Ditolak',
            'selesai' => 'Selesai',
        ] as $status => $label) {
            $this->put(route('mentoring.update-status', $requestId), [
                'status_pengajuan' => $status,
            ])->assertRedirect(route('mentoring.index'));

            $this->assertDatabaseHas('mentoring_requests', [
                'id_mentoring' => $requestId,
                'status_pengajuan' => $status,
            ]);

            $this->get(route('mentoring.show', $requestId))
                ->assertOk()
                ->assertSee($label);
        }

        foreach (['menunggu', 'diproses'] as $status) {
            $this->put(route('mentoring.update-status', $requestId), [
                'status_pengajuan' => $status,
            ])->assertSessionHasErrors('status_pengajuan');
        }
    }
}
