<?php

namespace App\Jobs\Taxonomy;

use App\Models\Status\Common\ActiveStatus;
use App\Models\Status\Complaint\InProcessingStatus;
use App\Models\Taxonomy\Taxonomy;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TaxonomyCreate implements ShouldQueue
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
     * @return \App\Models\Taxonomy\Taxonomy
     */
    public function handle()
    {

        $data = optional((object) $this->data);

        $taxonomy = factory(Taxonomy::class)->create([
            Taxonomy::COLUMN_SLUG        => $data->slug,
            Taxonomy::COLUMN_NAME        => $data->name,
            Taxonomy::COLUMN_DESCRIPTION => $data->description,
        ]);

        $taxonomy->status()->associate(ActiveStatus::first());
        $taxonomy->push();

        return $taxonomy;

    }

}
