<?php

namespace App\Jobs;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessCommentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Data containing information for creating comment.
     * 
     * @var array
     */
    public $commentDto;

    /**
     * Create a new job instance.
     *
     * @param  array  $commentDto
     * @return void
     */
    public function __construct(
        array $commentDto
    ) {
        $this->commentDto = $commentDto;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Simulate long running process
        sleep(600);

        Comment::create($this->commentDto);
    }
}
