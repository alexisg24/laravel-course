<?php

namespace App\Business\Services;

use Illuminate\Support\Facades\Crypt;

class EncryptService
{
    private $key;

    public function __construct($key)
    {
        $this->key = $key;
    }

    public function encrypt(string $data): string
    {
        return base64_encode($this->key . ":" . Crypt::encryptString($data));
    }

    public function decrypt(string $data): string
    {
        $decoded_data = base64_decode($data);
        [$key, $encryptedData] = explode(":", $decoded_data, 2);
        if ($key !== $this->key) {
            throw new \Exception("Invalid key");
        }
        return Crypt::decryptString($encryptedData);
    }
}
