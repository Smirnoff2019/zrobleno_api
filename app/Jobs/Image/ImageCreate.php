<?php

namespace App\Jobs\Image;

use App\Models\File\File;
use App\Models\Image\Image;
use Illuminate\Bus\Queueable;
use App\Schemes\Image\ImageSchema;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Status\Common\ActiveStatus;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ImageCreate implements ShouldQueue, ImageSchema
{

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var array
     */
    protected $data;

    /**
     * @var \App\Models\File\File
     */
    protected $file;

    /**
     * Create a new job instance.
     *
     * @param array $data
     * @param \App\Models\File\File $file
     */
    public function __construct(array $data, File $file)
    {
        $this->data = $data;
        $this->file = $file;
    }

    /**
     * Execute the job.
     *
     * @return Image
     */
    public function handle()
    {
        $request = (object) $this->data;

        return factory(Image::class)->create([
            Image::COLUMN_FILE_ID    => $this->file,
            Image::COLUMN_PARENT_ID  => $request->parent_id ?? null,
            Image::COLUMN_STATUS_ID  => $request->status_id ?? ActiveStatus::first(),
        ]);
    }

}
