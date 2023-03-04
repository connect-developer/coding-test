<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    public function test_login_as_admin_success()
    {
        $this->artisan("migrate:refresh");
        $this->artisan("db:seed");

        $user = User::all()->first();

        $loginResponse = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ])->json('POST', route('action.login', ['path' => 'admin']), [
            'identity' => $user->email,
            'password' => 'password'
        ]);

        $loginResponse->assertOk()
            ->assertJsonStructure(['data' => ['access_token']]);
    }

    public function test_login_as_company_success()
    {
        $this->artisan("migrate:refresh");
        $this->artisan("db:seed");

        $user = User::all()->first();

        $loginResponse = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ])->json('POST', route('action.login', ['path' => 'company']), [
            'identity' => $user->email,
            'password' => 'password'
        ]);

        $loginResponse->assertOk()
            ->assertJsonStructure(['data' => ['access_token']]);
    }

    public function test_login_as_admin_invalid()
    {
        $this->artisan("migrate:refresh");
        $this->artisan("db:seed");

        $user = User::all()->first();

        $loginResponse = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ])->json('POST', route('action.login', ['path' => 'admin']), [
            'identity' => $user->email,
            'password' => '12345'
        ]);

        $loginResponse->assertStatus(401)
            ->assertJson(['meta' => ['type' => 'INFO']]);
    }

    public function test_login_as_company_invalid()
    {
        $this->artisan("migrate:refresh");
        $this->artisan("db:seed");

        $user = User::all()->first();

        $loginResponse = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ])->json('POST', route('action.login', ['path' => 'company']), [
            'identity' => $user->email,
            'password' => '12345'
        ]);

        $loginResponse->assertStatus(401)
            ->assertJson(['meta' => ['type' => 'INFO']]);
    }
}
