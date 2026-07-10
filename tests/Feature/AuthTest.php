<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    private function makeUser(string $username = 'user@example.com', string $password = 'secret123'): User
    {
        $user = new User();
        $user->username = $username;
        $user->password = bcrypt($password);
        $user->save();

        return $user;
    }

    public function test_login_page_loads_for_guest(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertViewIs('login');
    }

    public function test_login_page_redirects_home_when_already_logged_in(): void
    {
        $user = $this->makeUser();

        $response = $this->withSession(['user' => ['id' => $user->id, 'username' => $user->username]])
            ->get('/login');

        $response->assertRedirect('/');
    }

    public function test_user_can_login_with_valid_credentials(): void
    {
        $user = $this->makeUser('user@example.com', 'secret123');

        $response = $this->post('/loginSubmit', [
            'text_username' => 'user@example.com',
            'text_password' => 'secret123',
        ]);

        $response->assertRedirect('/');
        $this->assertEquals($user->id, session('user.id'));
        $this->assertEquals('user@example.com', session('user.username'));
    }

    public function test_login_fails_with_wrong_password(): void
    {
        $this->makeUser('user@example.com', 'secret123');

        $response = $this->post('/loginSubmit', [
            'text_username' => 'user@example.com',
            'text_password' => 'wrongpass',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('loginError');
        $this->assertNull(session('user'));
    }

    public function test_login_fails_with_unknown_email(): void
    {
        $response = $this->post('/loginSubmit', [
            'text_username' => 'nobody@example.com',
            'text_password' => 'secret123',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('loginError');
        $this->assertNull(session('user'));
    }

    public function test_login_validation_requires_email_and_password(): void
    {
        $response = $this->post('/loginSubmit', [
            'text_username' => 'not-an-email',
            'text_password' => '123',
        ]);

        $response->assertSessionHasErrors(['text_username', 'text_password']);
    }

    public function test_guest_is_redirected_to_login_from_protected_routes(): void
    {
        $response = $this->get('/');

        $response->assertRedirect('/login');
    }

    public function test_logout_clears_session_and_redirects_to_login(): void
    {
        $user = $this->makeUser();

        $response = $this->withSession(['user' => ['id' => $user->id, 'username' => $user->username]])
            ->get('/logout');

        $response->assertRedirect('/login');
        $this->assertNull(session('user'));
    }
}
