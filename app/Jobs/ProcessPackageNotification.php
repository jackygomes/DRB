<?php

namespace App\Jobs;

use App\Mail\TrialPackageExpirationNotified;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ProcessPackageNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $to;
    public $packageName;

    /**
     * Create a new job instance.
     *
     * @param $to
     * @param $packageName
     */
    public function __construct($to, $packageName)
    {
        $this->to = $to;
        $this->packageName = $packageName;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->to)->send(new TrialPackageExpirationNotified($this->packageName));
    }
}
