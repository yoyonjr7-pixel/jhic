<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private array $unusedColumns = [
        'nik',
        'nisn',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'no_hp',
        'tahun_lulus',
        'pilihan_jurusan',
        'nama_ayah',
        'nama_ibu',
        'no_hp_orang_tua',
        'hobi',
        'keahlian_khusus',
        'cita_cita',
        'kebutuhan_khusus',
        'informasi_kebutuhan_khusus',
        'telepon_siswa',
        'alamat_lengkap',
        'asal_smp',
        'alamat_smp',
        'jurusan_pilihan_1',
        'jurusan_pilihan_2',
        'pendidikan_ayah',
        'pendidikan_ibu',
        'pekerjaan_ayah',
        'pekerjaan_ibu',
        'alamat_orang_tua',
        'telp_ayah',
        'telp_ibu',
        'nama_wali',
        'agama_wali',
        'pekerjaan_wali',
        'alamat_wali',
        'telp_wali',
        'foto_siswa',
    ];

    public function up(): void
    {
        $columns = array_values(array_filter(
            $this->unusedColumns,
            static fn (string $column): bool => Schema::hasColumn('spmb_pendaftar', $column)
        ));

        if ($columns !== []) {
            Schema::table('spmb_pendaftar', function (Blueprint $table) use ($columns) {
                $table->dropColumn($columns);
            });
        }
    }

    public function down(): void
    {
        Schema::table('spmb_pendaftar', function (Blueprint $table) {
            $table->string('nik', 30)->nullable();
            $table->string('nisn', 30)->nullable();
            $table->string('tempat_lahir', 100)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('jenis_kelamin', 20)->nullable();
            $table->string('no_hp', 30)->nullable();
            $table->string('tahun_lulus', 10)->nullable();
            $table->string('pilihan_jurusan', 150)->nullable();
            $table->string('nama_ayah', 150)->nullable();
            $table->string('nama_ibu', 150)->nullable();
            $table->string('no_hp_orang_tua', 30)->nullable();
            $table->string('hobi', 150)->nullable();
            $table->string('keahlian_khusus', 200)->nullable();
            $table->string('cita_cita', 150)->nullable();
            $table->string('kebutuhan_khusus', 200)->nullable();
            $table->text('informasi_kebutuhan_khusus')->nullable();
            $table->string('telepon_siswa', 30)->nullable();
            $table->text('alamat_lengkap')->nullable();
            $table->string('asal_smp', 150)->nullable();
            $table->text('alamat_smp')->nullable();
            $table->string('jurusan_pilihan_1', 150)->nullable();
            $table->string('jurusan_pilihan_2', 150)->nullable();
            $table->string('pendidikan_ayah', 100)->nullable();
            $table->string('pendidikan_ibu', 100)->nullable();
            $table->string('pekerjaan_ayah', 150)->nullable();
            $table->string('pekerjaan_ibu', 150)->nullable();
            $table->text('alamat_orang_tua')->nullable();
            $table->string('telp_ayah', 30)->nullable();
            $table->string('telp_ibu', 30)->nullable();
            $table->string('nama_wali', 150)->nullable();
            $table->string('agama_wali', 50)->nullable();
            $table->string('pekerjaan_wali', 150)->nullable();
            $table->text('alamat_wali')->nullable();
            $table->string('telp_wali', 30)->nullable();
            $table->string('foto_siswa')->nullable();
        });
    }
};
