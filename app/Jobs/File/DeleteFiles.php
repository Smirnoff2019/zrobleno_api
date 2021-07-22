<?php

namespace App\Jobs\File;

use App\Models\File\File;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class DeleteFiles implements ShouldQueue
{
    
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var string
     */
    protected $storageDiskName = 'user_files';

    /**
     * @var File $file
     */
    protected $file;

    /**
     * Create a new job instance.
     *
     * @param File $file
     */
    public function __construct(File $file)
    {
        $this->file = $file;
    }

    /**
     * Execute the job.
     *
     * @return bool
     */
    public function handle()
    {
        return Storage::disk($this->storageDiskName)
            ->delete(
                implode('/', [
                    $this->file->{File::COLUMN_USER_ID},
                    $this->file->{File::COLUMN_NAME}
                ])
            ) && $this->file->delete();
    }

}
