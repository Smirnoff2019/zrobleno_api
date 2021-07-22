<?php

namespace App\Jobs\PostType;

use App\Models\PostType\PostType;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PostTypeCreate implements ShouldQueue
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
     * @return \App\Models\PostType\PostType
     */
    public function handle()
    {

        return factory(PostType::class)->create($this->data);

    }

}
