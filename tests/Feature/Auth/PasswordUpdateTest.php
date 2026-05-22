<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

test('password can be updated', function () {
    $user = User::factory()->create();

    $response = test()->actingAs($user)
        ->from('/profile')
        ->put('/password', [
            'current_password' => 'password',
            'password' => 'NewPassword123',
            'password_confirmation' => 'NewPassword123',
        ]);

    $response->assertSessionHasNoErrors();
    $response->assertRedirect('/profile');

    test()->assertTrue(Hash::check('NewPassword123', $user->refresh()->password));
});

test('correct password must be provided to update password', function () {
    $user = User::factory()->create();

    $response = test()->actingAs($user)
        ->from('/profile')
        ->put('/password', [
            'current_password' => 'wrong-password',
            'password' => 'NewPassword123',
            'password_confirmation' => 'NewPassword123',
        ]);

    // Baris di bawah ini yang diperbaiki (tambahkan 'In' dan 'updatePassword')
    $response->assertSessionHasErrorsIn('updatePassword', 'current_password');
    $response->assertRedirect('/profile');
});