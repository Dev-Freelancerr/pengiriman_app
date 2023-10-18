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
        $currentDateTime = Carbon::now();

        $expiredTokens = TokenAccess::where('expired_at', '<=', $currentDateTime)->get();

        foreach ($expiredTokens as $token) {
             $response = Http::get('http://127.0.0.1:8000/api/ninja/auth/token');
        }
        $this->info('Expired token processing completed.');
    }
}
