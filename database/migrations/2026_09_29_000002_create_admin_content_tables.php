<?php
use Illuminate\Database\Migrations\Migration; use Illuminate\Database\Schema\Blueprint; use Illuminate\Support\Facades\Schema;
return new class extends Migration {
 public function up():void {
  if(!Schema::hasTable('prestasi')) Schema::create('prestasi',function(Blueprint $t){$t->id('id_prestasi');$t->string('judul_prestasi');$t->string('nama_pemenang');$t->string('kelas')->nullable();$t->string('tingkat')->nullable();$t->string('juara')->nullable();$t->year('tahun')->nullable();$t->text('deskripsi')->nullable();$t->timestamps();});
  if(!Schema::hasTable('berita')) Schema::create('berita',function(Blueprint $t){$t->id('id_berita');$t->string('judul');$t->string('slug')->unique();$t->text('isi');$t->string('status')->default('Draft');$t->timestamps();});
  if(!Schema::hasTable('unduh_informasi')) Schema::create('unduh_informasi',function(Blueprint $t){$t->id('id_informasi');$t->string('judul');$t->string('slug')->unique();$t->string('nama_file');$t->string('file_path');$t->timestamps();});
 }
 public function down():void {Schema::dropIfExists('unduh_informasi');Schema::dropIfExists('berita');Schema::dropIfExists('prestasi');}
};