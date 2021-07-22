<?php

namespace App\Jobs\Post;

use App\Models\Post\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PostCreate implements ShouldQueue
{

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var array
     */
    protected $data;

    /**
     * Create a new job instance.
     *
     * @param array $data
     */
    public function __construct( array $data )
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return \App\Models\Post\Post
     */
    public function handle()
    {

        return factory(Post::class)->create($this->data);

    }

}
