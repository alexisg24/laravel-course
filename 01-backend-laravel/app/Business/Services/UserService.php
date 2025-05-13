<?php

namespace App\Business\Services;

use App\Models\User;

class UserService
{
    public function __construct(protected EncryptService $encryptService) {}

    public function encryptEmail(int $id): string
    {
        $user = User::find($id);
        return $this->encryptService->encrypt($user->email);
    }
}
