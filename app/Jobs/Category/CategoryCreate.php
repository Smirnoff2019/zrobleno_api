<?php

namespace App\Jobs\Category;

use App\Models\Category\Category;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CategoryCreate implements ShouldQueue
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
     * @return \App\Models\Category\Category
     */
    public function handle()
    {

        return factory(Category::class)->create($this->data);

    }

}
