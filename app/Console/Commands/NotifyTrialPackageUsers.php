<?php

namespace App\Console\Commands;

use App\Service\PackageExpirationNotifyService;
use Illuminate\Console\Command;

class NotifyTrialPackageUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:trialUsers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @param PackageExpirationNotifyService $packageExpirationNotifyService
     * @return mixed
     */
    public function handle(PackageExpirationNotifyService $packageExpirationNotifyService)
    {
        $packageExpirationNotifyService->notifyTrialUsersAfterExpiration();
    }
}
