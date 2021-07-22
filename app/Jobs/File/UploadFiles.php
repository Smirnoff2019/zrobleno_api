<?php

namespace App\Jobs\File;

use App\Models\File\File;
use App\Models\User\User;
use App\Traits\Logs\Loger;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use App\Schemes\File\FileSchema;
use Illuminate\Http\UploadedFile;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Http\Requests\Api\File\CreateFileRequest;

class UploadFiles implements ShouldQueue, FileSchema
{

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Loger;

    /**
     * @var string
     */
    protected $storageDiskName = 'user_files';

    /**
     * @var string
     */
    protected $defaultDir = "storage/app/public/users";

    /**
     * @var string
     */
    protected $defaultUrl = "storage/users";

    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * @var \App\Models\User\User
     */
    protected $user;

    /**
     * Create a new job instance.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\UploadedFile $file
     * @param \App\Models\User\User $user
     */
    public function __construct(UploadedFile $file, array $data, User $user)
    {
        $this->data = $data;
        $this->file = $file;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return File
     */
    public function handle()
    {
        $defaultDir = $this->defaultDir;
        $defaultUrl = $this->defaultUrl;
        $uploadFile = $this->file;
        $data = (object) $this->data;
        $user = $this->user;

        $userDir = $user->id;
        $fileName = Str::random(10) . "_" . time() . '.' . $uploadFile->extension();
        $filePath = $uploadFile->storeAs(
            "$userDir",
            $fileName,
            $this->storageDiskName
        );

        $url = env('APP_URL')."/$defaultUrl/$filePath";
        $uri = "$defaultDir/$userDir/";
        $path = "$defaultDir/$filePath";

        return factory(File::class)->create([
            File::COLUMN_URL         => $url,
            File::COLUMN_URI         => $uri,
            File::COLUMN_PATH        => $path,
            File::COLUMN_NAME        => $fileName,
            File::COLUMN_TITLE       => $data->title ?? '',
            File::COLUMN_DESCRIPTION => $data->description ?? '',
            File::COLUMN_FORMAT      => $uploadFile->extension(),
            File::COLUMN_SIZE        => (string) $uploadFile->getSize() ?? '0',
            File::COLUMN_SORT        => $data->sort ?? '',
            File::COLUMN_USER_ID     => $user->id
        ]);
    }

}
