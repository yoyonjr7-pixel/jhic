<?php
// Skrip sementara: uji dashboard admin/berita lewat HTTP kernel dengan login asli.
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Ambil user mana pun untuk login (tanpa perlu password).
$user = App\Models\User::first();
if (! $user) {
    echo "TIDAK ADA USER untuk uji login.\n";
    exit;
}

Illuminate\Support\Facades\Auth::login($user);

$request = Illuminate\Http\Request::create('/berita', 'GET');
$response = $kernel->handle($request);

echo "STATUS: " . $response->getStatusCode() . "\n";
$content = $response->getContent();
echo "Modal tambah: " . (str_contains($content, 'modalTambahBerita') ? 'ADA' : 'HILANG') . "\n";
echo "Baris berita: " . substr_count($content, 'berita-row') . "\n";
echo "Error marker: " . (preg_match('/ErrorException|Undefined variable|Whoops|Internal Server Error/i', $content) ? 'FOUND' : 'BERSIH') . "\n";
