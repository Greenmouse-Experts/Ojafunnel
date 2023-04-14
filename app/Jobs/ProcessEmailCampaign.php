<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessEmailCampaign implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // queue setting 
    public $tries = 5;

    public $configuration;
    public $to;
    public $mailable;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($configuration, $to, $mailable)
    {
        $this->configuration = $configuration;
        $this->to = $to;
        $this->mailable = $mailable;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            //code...
            $mailer = app()->makeWith('user.mailer', $this->configuration);
            $mailer->to($this->to)->send($this->mailable);
        } catch (\Throwable $th) {
            //throw $th;
            if ($this->attempts() > 5) {
                // hard fail after 5 attempts
                throw $th;
            }

            // re-queue this job to be executes
            // in 3 minutes (180 seconds) from now
            $this->release(180);

            return;
        }
    }
}
