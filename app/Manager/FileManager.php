<?php


namespace App\Manager;


use App\Models\File;
use App\Repositories\FileRepository;
use Illuminate\Http\UploadedFile;

class FileManager
{
    protected $fileRepository;
    public function __construct(FileRepository $fileRepository)
    {
        $this->fileRepository = $fileRepository;
    }

    public function upload(UploadedFile $file, int $taskId)
    {
        $filename = sprintf("%s.%s", uniqid(), $file->clientExtension());
        $originalName = $file->getClientOriginalName();
        $file->move(storage_path(File::PATH), $filename);

        $this->fileRepository->newFile()
            ->create([
                'name' => $filename,
                'original_name' => $originalName,
                'task_id' => $taskId,
            ]);
    }

    public function destroy($fileName)
    {
        $file = sprintf('%s/%s', storage_path(File::PATH), $fileName);
        unlink($file);
    }

}
