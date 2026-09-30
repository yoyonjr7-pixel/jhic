<?php

namespace Tests\Feature;

use Tests\TestCase;

class SpmbSuccessPageTest extends TestCase
{
    public function test_success_page_lists_required_registration_documents(): void
    {
        $this->withSession(['spmb.registration_success' => true])
            ->get(route('spmb.success'))
            ->assertOk()
            ->assertSee('Dokumen yang harus dibawa')
            ->assertSee('Fotokopi ijazah atau surat keterangan lulus')
            ->assertSee('Fotokopi kartu keluarga (KK)')
            ->assertSee('Fotokopi akta kelahiran')
            ->assertSee('Pas foto terbaru')
            ->assertSee('Dokumen pendukung lainnya sesuai ketentuan sekolah')
            ->assertSee('href="' . route('spmb.form') . '"', false)
            ->assertDontSee('Pastikan membawa dokumen pendukung yang diperlukan untuk proses verifikasi pendaftaran.');
    }
}
