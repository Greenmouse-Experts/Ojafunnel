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

class ProcessSSLGeneration implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $domain;
    public $host;
    public $email;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($domain, $host, $email)
    {
        $this->domain = $domain;
        $this->host = $host;
        $this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $generated = (new SSLManager())->generateSSL($this->domain, $this->host, $this->email);

        if ($generated) {
            Domain::where('domain', $this->domain)->update([
                'status' => 'SSL_ENABLED',
                'ssl_renewal_date' => Carbon::now()->addDays(60)->format('Y-m-d')
            ]);
        } else Domain::where('domain', $this->domain)->update(['status' => 'SSL_GENERATION_FAILED']);
    }
}
