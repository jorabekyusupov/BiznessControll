<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Str;

class RandomGenerationService
{
    public function string($count)
    {
        do {
            $token = Str::random($count);
        } while (User::where("verification_token", "=", $token)->first());

        return $token;
    }
}

