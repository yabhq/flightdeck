<?php

namespace Yab\FlightDeck;

use Illuminate\Support\Facades\DB;

class FlightDeck
{
    /**
     * Generate an authorization token
     *
     * @param string $expires_at
     * @param integer $length
     * @return string
     */
    public static function generate(string $expires_at = null, int $length = 60) : string
    {
        $token = str_random($length);
        DB::table('api_tokens')->insert([
            'token' => $token,
            'expires_at' => $expires_at ?? now()->addDays(config('flightdeck.tokens.expire_days')),
        ]);
        return $token;
    }

    /**
     * Check if the token is valid
     *
     * @param string $token
     * @return boolean
     */
    public static function checkToken(string $api_token = null) : bool
    {
        $token = DB::table('api_tokens')
                    ->where('token', $api_token)
                    ->where('expires_at', '>', now()->toDateTimeString())
                    ->first();
        if ($token) {
            return true;
        }
        return false;
    }
}
