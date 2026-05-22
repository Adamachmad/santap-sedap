<?php

test('registration screen can be rendered', function () {
    $response = test()->get('/register');

    $response->assertStatus(200);
});

test('new users can register', function () {
    $response = test()->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'Password123',
        'password_confirmation' => 'Password123',
    ]);

    test()->assertAuthenticated();
    $response->assertRedirect('/');
});