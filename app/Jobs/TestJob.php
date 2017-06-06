<?php

namespace App\Jobs;

use App\Models\Article;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class TestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        //
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $article = new Article();
        $article->fill([
            'title' => 'Test Job',
            'author' => 'tester',
            'user_id' => $this->user->id
        ]);
        if($article->save()){

            info ($this->user->email);
            echo ($this->user->email);
        } else {
            info('Test Job Failed');
            echo 'Test Job Failed';
        }
    }

    public function fail($exception = null)
    {
        \Log::info($exception);
    }


}
