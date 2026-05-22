<?php

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new users can register', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'Password123', // <-- Ubah menjadi password yang kuat
        'password_confirmation' => 'Password123', // <-- Samakan konfirmasinya
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect('/');
});