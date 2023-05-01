<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Domain;
use App\Utils\SSLManager;
use App\Utils\DomainHelper;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class RenewSSL extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'renewssl:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command runs every day to check for SSL due for renewal';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $domains = Domain::where('ssl_renewal_date', Carbon::now()->format('Y-m-d'))->get();

        $domains->map(function ($domain) {
            $recordFound = (new DomainHelper())->verifyARecord($domain->domain);

            if ($recordFound) {
                $generated = (new SSLManager())->renewSSL($domain->domain);

                if ($generated) {
                    Domain::where('domain', $domain->domain)->update([
                        'status' => 'SSL_ENABLED',
                        'ssl_renewal_date' => Carbon::now()->addDays(60)->format('Y-m-d')
                    ]);
                } else Domain::where('domain', $domain->domain)->update(['status' => 'SSL_RENEWAL_FAILED']);
            }
        });

        return Command::SUCCESS;
    }
}
