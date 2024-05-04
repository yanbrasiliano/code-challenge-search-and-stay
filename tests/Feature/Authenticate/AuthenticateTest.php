<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

it('authenticates user with correct credentials', function () {
    $user = User::factory()->create([
        'email' => 'test@example.com',
        'password' => bcrypt('password123'),
    ]);

    $response = $this->postJson('/api/v1/login', [
        'email' => 'test@example.com',
        'password' => 'password123',
    ]);

    $response->assertStatus(Response::HTTP_OK)
        ->assertJsonStructure([
            'message',
            'user',
            'token',
        ])
        ->assertJson([
            'message' => 'Authenticated successfully',
        ]);
});

it('returns unauthorized with incorrect credentials', function () {
    $response = $this->postJson('/api/v1/login', [
        'email' => 'invalid@example.com',
        'password' => 'invalidpassword',
    ]);

    $response->assertStatus(Response::HTTP_UNAUTHORIZED)
        ->assertJson([
            'message' => 'The provided credentials are incorrect.',
        ]);
});

  it('logs out a user', function () {
    $user = User::factory()->create([
        'email' => 'test@example.com',
        'password' => bcrypt('password123'),
    ]);
    $token = $user->createToken('test-token')->plainTextToken;
    $response = $this->withHeader('Authorization', "Bearer $token")
        ->postJson('/api/v1/logout');
    $response->assertStatus(200);
  })->group('auth');
