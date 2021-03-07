<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Crypt;

trait EncryptAttributes
{
    protected $encrypt = [];

    public function getAttribute($key)
    {
        // get default attribute value
        $value = $value = parent::getAttribute($key);

        // if attribute is encrypted attempt to decrypt
        if (in_array($key, $this->getEncrypt())) {
            // exception will be thrown if decryption fails
            $value = Str::before(
                Crypt::decryptString($value),
            ':');
        }

        return $value;
    }

    public function setAttribute($key, $value)
    {
        // encrypt the value if in the encrypt array
        if (in_array($key, $this->getEncrypt())) {
            $timestamp = Carbon::now()->getPreciseTimestamp(3);
            $value = Crypt::encryptString("{$value}:{$timestamp}");
        }

        return parent::setAttribute($key, $value);
    }

    protected function getEncrypt()
    {
        return $this->encrypt;
    }
}