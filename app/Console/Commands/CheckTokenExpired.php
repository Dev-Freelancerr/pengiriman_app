<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\TokenAccess;
use Illuminate\Support\Facades\Http;

class CheckTokenExpired extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:check-token-expiration';

    protected $description = 'Check token expiration and perform actions';


    /**
     * The console command description.
     *
     * @var string
     */

    /**
     * Execute the console command.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $response = Http::get('/api/ninja/auth/token/job');
        if ($response->successful()) {
            $this->info('API call successful');
        } else {
            $this->error('API call failed');
        }
    }
}
