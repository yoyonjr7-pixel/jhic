<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Schema::create('users', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->nullable()->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    protected function tearDown(): void
    {
        Schema::dropIfExists('users');

        parent::tearDown();
    }

    public function test_admin_can_log_in_using_username_and_password(): void
    {
        User::factory()->create([
            'username' => 'smkmawa1',
            'email' => null,
            'password' => 'test-password',
        ]);

        $response = $this->post('/login', [
            'username' => 'smkmawa1',
            'password' => 'test-password',
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticated();
    }

    public function test_login_does_not_authenticate_with_an_email_address(): void
    {
        User::factory()->create([
            'username' => 'smkmawa1',
            'email' => null,
            'password' => 'test-password',
        ]);

        $this->post('/login', [
            'username' => 'former@gmail.com',
            'password' => 'test-password',
        ])->assertSessionHasErrors('username');

        $this->assertGuest();
    }

    public function test_login_form_uses_username_instead_of_email(): void
    {
        $this->get('/login')
            ->assertOk()
            ->assertSee('Username')
            ->assertSee('name="username"', false)
            ->assertDontSee('name="email"', false);
    }
}
