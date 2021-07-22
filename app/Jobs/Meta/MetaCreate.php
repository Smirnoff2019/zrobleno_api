<?php

namespace App\Jobs\Meta;

use App\Models\Meta\Meta;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class MetaCreate implements ShouldQueue
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
     * @return \App\Models\Meta\Meta
     */
    public function handle()
    {

        return factory(Meta::class)->create($this->data);

    }

}
