<?php

namespace Tests\Feature;

use App\Models\Berita;
use App\Models\Prestasi;
use App\Models\SpmbPendaftar;
use App\Models\UnduhInformasi;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminUserDatabaseIntegrationTest extends TestCase
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
            $table->string('status')->default('lulus');
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
        Schema::create('book_jasah', function (Blueprint $table): void {
            $table->unsignedBigInteger('id_bookjasah')->primary();
            $table->unsignedBigInteger('id_alumni');
            $table->string('status_book')->default('pending');
            $table->timestamps();
        });
        Schema::create('prestasi', function (Blueprint $table): void {
            $table->id('id_prestasi');
            $table->string('judul_prestasi');
            $table->string('nama_pemenang');
            $table->string('kelas', 50)->nullable();
            $table->unsignedBigInteger('id_jurusan')->nullable();
            $table->string('tingkat', 100)->nullable();
            $table->string('juara', 100)->nullable();
            $table->unsignedSmallInteger('tahun')->nullable();
            $table->string('foto')->nullable();
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
        Schema::create('berita', function (Blueprint $table): void {
            $table->id('id_berita');
            $table->string('judul');
            $table->string('slug')->unique();
            $table->string('kategori', 100)->nullable();
            $table->string('penulis')->nullable();
            $table->longText('isi');
            $table->string('foto')->nullable();
            $table->date('tanggal_publish')->nullable();
            $table->string('status', 20)->default('Draft');
            $table->timestamps();
        });
        Schema::create('unduh_informasi', function (Blueprint $table): void {
            $table->id('id_informasi');
            $table->string('judul');
            $table->string('slug')->unique();
            $table->string('kategori', 100)->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('nama_file');
            $table->string('file_path');
            $table->string('format_file', 20);
            $table->unsignedBigInteger('ukuran_file');
            $table->string('status', 20)->default('Draft');
            $table->date('tanggal_publish')->nullable();
            $table->timestamps();
        });
        Schema::create('spmb', function (Blueprint $table): void {
            $table->id('id_spmb');
            $table->string('nama', 150);
            $table->string('email', 150)->nullable();
            $table->string('whatsapp_siswa', 30)->nullable();
            $table->string('whatsapp_orang_tua', 30)->nullable();
            $table->text('alamat')->nullable();
            $table->string('asal_sekolah', 150)->nullable();
            $table->string('agama', 50)->nullable();
            $table->string('jurusan', 150)->nullable();
            $table->string('sumber_informasi', 100)->nullable();
            $table->string('status', 30)->default('Baru');
            $table->timestamps();
        });
    }

    protected function tearDown(): void
    {
        Schema::dropIfExists('mentoring_requests');
        Schema::dropIfExists('book_jasah');
        Schema::dropIfExists('alumni_track');
        Schema::dropIfExists('siswa');
        Schema::dropIfExists('spmb');
        Schema::dropIfExists('unduh_informasi');
        Schema::dropIfExists('berita');
        Schema::dropIfExists('prestasi');
        Schema::dropIfExists('jurusan');

        parent::tearDown();
    }

    public function test_published_achievements_news_and_documents_are_publicly_rendered(): void
    {
        Prestasi::create([
            'judul_prestasi' => 'Juara Uji Database',
            'nama_pemenang' => 'Pemenang Uji',
            'tingkat' => 'Kabupaten',
            'tahun' => 2026,
        ]);
        Berita::create([
            'judul' => 'Berita Uji Database',
            'slug' => 'berita-uji-database',
            'isi' => 'Isi berita yang dipublikasikan.',
            'status' => 'Terbit',
            'tanggal_publish' => now()->toDateString(),
        ]);
        UnduhInformasi::create([
            'judul' => 'Dokumen Uji Database',
            'slug' => 'dokumen-uji-database',
            'kategori' => 'Unduh File',
            'nama_file' => 'dokumen.pdf',
            'file_path' => 'unduh-informasi/dokumen.pdf',
            'format_file' => 'pdf',
            'ukuran_file' => 100,
            'status' => 'Terbit',
            'tanggal_publish' => now()->toDateString(),
        ]);

        $this->get(route('prestasi'))
            ->assertOk()
            ->assertSee('Juara Uji Database')
            ->assertSee('Pemenang Uji');
        $this->get(route('berita.public'))
            ->assertOk()
            ->assertSee('Berita Uji Database');
        $this->get(route('download-information'))
            ->assertOk()
            ->assertSee('Dokumen Uji Database');
    }

    public function test_public_download_page_uses_reference_section_and_achievement_order(): void
    {
        foreach ([
            [
                'judul' => 'Juara 1 Lomba Fotografi',
                'kategori' => 'Prestasi Terbaru :',
                'tanggal_publish' => '2026-08-01',
                'deskripsi' => 'Catatan internal yang tidak ditampilkan.',
            ],
            [
                'judul' => 'Sertifikat Akreditasi',
                'kategori' => 'Sertifikat Akreditasi " A " Smk Darma Siswa 1 Sidoarjo :',
                'tanggal_publish' => '2025-05-02',
            ],
            [
                'judul' => 'Browser SPMB Smk Darma Siswa 1 Sidoarjo',
                'kategori' => 'Unduh File :',
                'tanggal_publish' => '2026-04-12',
            ],
            [
                'judul' => 'Juara 2 Lomba Dance',
                'kategori' => 'Prestasi Terbaru :',
                'tanggal_publish' => '2026-02-28',
            ],
            [
                'judul' => 'Juara 1 Lomba Futsal',
                'kategori' => 'Prestasi Terbaru :',
                'tanggal_publish' => '2025-01-13',
            ],
        ] as $index => $data) {
            UnduhInformasi::create(array_merge([
                'slug' => 'dokumen-urutan-' . $index,
                'nama_file' => 'dokumen-' . $index . '.pdf',
                'file_path' => 'unduh-informasi/dokumen-' . $index . '.pdf',
                'format_file' => 'pdf',
                'ukuran_file' => 100,
                'status' => 'Terbit',
            ], $data));
        }

        $this->get(route('download-information'))
            ->assertOk()
            ->assertSeeInOrder([
                'Unduh File :',
                'Browser SPMB Smk Darma Siswa 1 Sidoarjo',
                'Sertifikat Akreditasi " A " Smk Darma Siswa 1 Sidoarjo :',
                'Sertifikat Akreditasi',
                'Prestasi Terbaru :',
                'Juara 1 Lomba Futsal',
                'Juara 1 Lomba Fotografi',
                'Juara 2 Lomba Dance',
            ])
            ->assertSee('12 April 2026')
            ->assertSee('02 Mei 2025')
            ->assertSee('13 Januari 2025')
            ->assertDontSee('Catatan internal yang tidak ditampilkan.');
    }

    public function test_prestasi_seeder_populates_homepage_and_is_safe_to_rerun(): void
    {
        $this->seed(\Database\Seeders\PrestasiSeeder::class);
        $this->seed(\Database\Seeders\PrestasiSeeder::class);

        $this->assertDatabaseCount('prestasi', 6);
        $this->assertDatabaseHas('prestasi', [
            'judul_prestasi' => 'Lomba Poster SEFEST',
            'foto' => 'prestasiimages/lombapostersefest.jpg',
            'tahun' => null,
        ]);

        $this->get('/')
            ->assertOk()
            ->assertSee('JUARA 2 LOMBA POSTER SEFEST')
            ->assertSee('prestasiimages/lombapostersefest.jpg');

        $this->get(route('prestasi'))
            ->assertOk()
            ->assertSee('Lomba Poster SEFEST')
            ->assertSee('prestasiimages/lombapostersefest.jpg');
    }

    public function test_alumni_track_page_counts_college_status_from_database(): void
    {
        $this->withoutMiddleware(\Illuminate\Auth\Middleware\Authenticate::class);

        $jurusanId = DB::table('jurusan')->insertGetId([
            'nama_jurusan' => 'Teknik Pengujian',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        foreach ([1, 2] as $id) {
            DB::table('alumni_track')->insert([
                'id_jurusan' => $jurusanId,
                'tahun_lulus' => 2025,
                'status' => 'kuliah',
                'keterangan' => 'Universitas Uji',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->get('/alumni-track')
            ->assertOk()
            ->assertSee('Semua Status')
            ->assertSee('Melanjutkan Kuliah')
            ->assertSee('Universitas Uji')
            ->assertViewHas('statusCounts', fn ($counts): bool => (int) ($counts['kuliah'] ?? 0) === 2);
    }

    public function test_spmb_registration_is_saved_and_visible_in_admin(): void
    {
        $this->withoutMiddleware(\Illuminate\Auth\Middleware\Authenticate::class);
        $this->withSession([
            'spmb.registration' => [
                'nama_lengkap' => 'Pendaftar Uji',
                'email' => 'pendaftar@example.com',
                'whatsapp_siswa' => '081234567890',
                'whatsapp_orang_tua' => '081234567891',
                'alamat' => 'Sidoarjo',
                'asal_sekolah' => 'SMP Uji',
                'agama' => 'Islam',
                'jurusan' => config('tefa.jurusan.tjkt.nama'),
                'sumber_informasi' => 'Website',
            ],
        ]);

        $this->post(route('spmb.store'), ['pernyataan' => '1'])
            ->assertRedirect(route('spmb.success'));

        $this->assertDatabaseHas('spmb', [
            'nama' => 'Pendaftar Uji',
            'email' => 'pendaftar@example.com',
            'status' => 'Baru',
        ]);

        $this->get(route('spmb-pendaftar.index'))
            ->assertOk()
            ->assertSee('Pendaftar Uji')
            ->assertSee('SMP Uji');

        $id = SpmbPendaftar::query()->value('id_spmb');
        $this->put(route('spmb-pendaftar.update-status', $id), ['status' => 'Diproses'])
            ->assertRedirect(route('spmb-pendaftar.index'));

        $this->assertDatabaseHas('spmb', ['id_spmb' => $id, 'status' => 'Diproses']);
    }

    public function test_public_download_route_only_serves_published_documents(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('unduh-informasi/panduan.pdf', 'PDF test content');

        $document = UnduhInformasi::create([
            'judul' => 'Panduan Uji',
            'slug' => 'panduan-uji',
            'nama_file' => 'panduan.pdf',
            'file_path' => 'unduh-informasi/panduan.pdf',
            'format_file' => 'pdf',
            'ukuran_file' => 16,
            'status' => 'Terbit',
        ]);

        $this->get(route('download-information.file', $document->id_informasi))
            ->assertDownload('panduan.pdf');

        DB::table('unduh_informasi')->where('id_informasi', $document->id_informasi)->update(['status' => 'Draft']);
        $this->get(route('download-information.file', $document->id_informasi))
            ->assertNotFound();
    }

    public function test_download_information_accepts_png_jpeg_and_pdf_uploads(): void
    {
        $this->withoutMiddleware(\Illuminate\Auth\Middleware\Authenticate::class);
        Storage::fake('public');

        $files = [
            ['gambar.png', "\x89PNG\r\n\x1a\n" . str_repeat("\0", 32)],
            ['gambar.jpg', "\xFF\xD8\xFF\xE0" . str_repeat("\0", 32) . "\xFF\xD9"],
            ['gambar.jpeg', "\xFF\xD8\xFF\xE0" . str_repeat("\0", 32) . "\xFF\xD9"],
            ['panduan.pdf', "%PDF-1.4\nDokumen uji"],
        ];

        foreach ($files as [$name, $content]) {
            $this->post(route('unduh-informasi.store'), [
                'judul' => 'Dokumen ' . pathinfo($name, PATHINFO_FILENAME),
                'kategori' => 'Panduan',
                'status' => 'Draft',
                'file' => UploadedFile::fake()->createWithContent($name, $content),
            ])->assertRedirect(route('unduh-informasi.index'))
                ->assertSessionHasNoErrors();
        }

        $this->assertDatabaseCount('unduh_informasi', 4);
        foreach (['png', 'jpg', 'jpeg', 'pdf'] as $format) {
            $this->assertDatabaseHas('unduh_informasi', ['format_file' => $format]);
        }
    }

    public function test_spmb_schema_migration_adds_fields_without_deleting_existing_registrations(): void
    {
        Schema::dropIfExists('spmb');
        Schema::create('spmb', function (Blueprint $table): void {
            $table->id('id_spmb');
            $table->string('nama', 150);
            $table->timestamps();
        });
        DB::table('spmb')->insert([
            'nama' => 'Pendaftar Lama',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $migration = require database_path('migrations/2026_09_29_000006_add_registration_fields_to_spmb_table.php');
        $migration->up();

        $this->assertTrue(Schema::hasColumn('spmb', 'email'));
        $this->assertTrue(Schema::hasColumn('spmb', 'status'));
        $this->assertDatabaseHas('spmb', ['nama' => 'Pendaftar Lama']);
    }

    public function test_mentoring_migration_creates_request_storage_with_alumni_relation(): void
    {
        $migration = require database_path('migrations/2026_09_29_000005_create_mentoring_requests_table.php');
        $migration->up();

        $this->assertTrue(Schema::hasTable('mentoring_requests'));
        $this->assertTrue(Schema::hasColumn('mentoring_requests', 'id_mentor'));
        $this->assertTrue(Schema::hasColumn('mentoring_requests', 'status_pengajuan'));

        $phoneMigration = require database_path('migrations/2026_09_29_000008_add_no_telp_to_mentoring_requests_table.php');
        $phoneMigration->up();

        $this->assertTrue(Schema::hasColumn('mentoring_requests', 'no_telp'));
    }

    public function test_tambahan_tefa_migration_creates_booking_details_storage(): void
    {
        Schema::create('booking_tefa', function (Blueprint $table): void {
            $table->unsignedBigInteger('id_book')->primary();
            $table->timestamps();
        });

        $migration = require database_path('migrations/2026_09_29_000007_create_tambahan_tefa_table.php');
        $migration->up();

        $this->assertTrue(Schema::hasTable('tambahan_tefa'));
        $this->assertTrue(Schema::hasColumn('tambahan_tefa', 'id_book'));
        $this->assertTrue(Schema::hasColumn('tambahan_tefa', 'nama_tambahan'));
        $this->assertTrue(Schema::hasColumn('tambahan_tefa', 'harga'));
    }
}
