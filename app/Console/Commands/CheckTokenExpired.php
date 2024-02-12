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
<<<<<<< HEAD
        $response = Http::get('/api/ninja/auth/token/job');
        if ($response->successful()) {
            $this->info('API call successful');
        } else {
            $this->error('API call failed');
=======
        $currentDateTime = Carbon::now();

        $expiredTokens = TokenAccess::where('expired_at', '<=', $currentDateTime)->get();
        
        foreach ($expiredTokens as $token) {
             $response = Http::get('http://127.0.0.1:8000/api/ninja/auth/token');
>>>>>>> f2e41ab98c3895f01508978fdc1f21cb943d4c95
        }
    }
}
