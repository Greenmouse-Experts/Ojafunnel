<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Domain;
use App\Utils\SSLManager;
use App\Utils\DomainHelper;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class GenerateSSL extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generatessl:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command runs every 30 minutes to check for propagated domain and generate SSL';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $domains = Domain::where('status', 'pending')->get();

        $domains->map(function ($domain) {
            $recordFound = (new DomainHelper())->verifyARecord($domain->domain);

            if ($recordFound) {
                Domain::where('domain', $domain->domain)->update(['status', 'DOMAIN_PROPAGATED']);

                $user = User::where('id', $domain->user_id)->first();
                $generated = (new SSLManager())->generateSSL($domain->domain, $user->email);

                if ($generated) {
                    Domain::where('domain', $domain->domain)->update([
                        'status' => 'SSL_ENABLED',
                        'ssl_renewal_date' => Carbon::now()->addDays(60)->format('Y-m-d')
                    ]);
                } else Domain::where('domain', $domain->domain)->update(['status' => 'SSL_GENERATION_FAILED']);
            } else Domain::where('domain', $domain->domain)->update(['status' => 'DOMAIN_A_RECORD_NOT_FOUND']);
        });

        return Command::SUCCESS;
    }
}
