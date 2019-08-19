<?php

namespace App\Traits\Models;

use Illuminate\Contracts\Encryption\DecryptException;

trait EncryptIdTrait
{
    /**
     * Get the value of the model's route key.
     *
     * @return mixed
     */
    public function getRouteKey()
    {
        return encrypt($this->getAttribute($this->getRouteKeyName()));
    }

    /**
     * Retrieve the model for a bound value.
     *
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function resolveRouteBinding($value)
    {
        try {
            $decrypted = decrypt($value);
        } catch (DecryptException $e) {
            $decrypted = null;
        }

        return $this->where($this->getRouteKeyName(), $decrypted)->first();
    }
}
