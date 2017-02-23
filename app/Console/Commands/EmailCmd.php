<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use \App\User;
use Symfony\Component\Console\Helper\ProgressBar;

class EmailCmd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email_cmd:send {user} {--time=5}';

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
     * @return mixed
     */
    public function handle()
    {
        //
        if($this->argument('user') && $user = User::find($this->argument('user'))){

            if ($this->confirm('sure to send?', true)){

                $count = $this->option('time');
                $progressBar = $this->output->createProgressBar($count);
                for($i=1; $i<$count; $i++){
                    $progressBar->advance();
                    sleep(1);
                }
                $this->info("Send Email to {$user->email} ");

                $progressBar->finish();

                echo "\n";
            } else {
                $this->line('you have already cancel send event');
            }
        } else {
            $this->error('User not exist!');
        }
    }
}
