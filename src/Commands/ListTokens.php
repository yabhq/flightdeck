<?php

namespace Yab\FlightDeck\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ListTokens extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'flightdeck:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all available API tokens';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $tokens = DB::table('api_tokens')->get();
        if ($tokens->count() === 0) {
            $this->info('There are no API keys');
            return;
        }

        $headers = ['Name', 'Token', 'Expires At'];
        $rows = $tokens->map(function ($token) {
            return [
                $token->name,
                $token->token,
                $token->expires_at,
            ];
        });
        $this->table($headers, $rows);
    }
}
