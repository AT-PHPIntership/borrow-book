<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\SendMailsJob;

class SendMailReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remind-borrow-expire:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send mail reminder of users';

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
     * @return mixed
     */
    public function handle()
    {
        SendMailsJob::dispatch();
        $this->info('Complete Send Mail');
    }
}
