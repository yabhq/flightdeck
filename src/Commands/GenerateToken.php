<?php

namespace Yab\FlightDeck\Commands;

use Yab\FlightDeck\FlightDeck;
use Illuminate\Console\Command;

class GenerateToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'flightdeck:generate {expires_at?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a fresh API token for authorization requests';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $token = FlightDeck::generate($this->option('expires_at'));
        $this->info($token);
    }
}
