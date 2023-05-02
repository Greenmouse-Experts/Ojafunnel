<?php

namespace App\Jobs;

use App\Models\Domain;
use App\Utils\SSLManager;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Carbon;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ProcessSSLRenewal implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $domain;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($domain)
    {
        $this->domain = $domain;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $generated = (new SSLManager())->renewSSL($this->domain);

        if ($generated) {
            Domain::where('domain', $this->domain)->update([
                'status' => 'SSL_ENABLED',
                'ssl_renewal_date' => Carbon::now()->addDays(60)->format('Y-m-d')
            ]);
        } else Domain::where('domain', $this->domain)->update(['status' => 'SSL_RENEWAL_FAILED']);
    }
}
