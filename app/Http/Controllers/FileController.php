<?php

namespace App\Http\Controllers;

use App\Manager\FileManager;
use App\Models\File;
use App\Repositories\FileRepository;

class FileController extends Controller
{
    protected $fileManager;
    protected $fileRepository;

    public function __construct(FileManager $fileManager,
                                FileRepository $fileRepository)
    {
        $this->fileManager = $fileManager;
        $this->fileRepository = $fileRepository;
    }

    public function download($id)
    {
        $downloadFile = $this->fileRepository->findById($id);
        $file = sprintf('%s/%s', File::PATH, $downloadFile->name);

        return response()->download(storage_path($file), $downloadFile->original_name);
    }

    public function destroy($id)
    {
        $file = $this->fileRepository->findById($id);
        $this->fileManager->destroy($file->name);
        $file->forceDelete();

        return back()->with('msg', 'File deleted');
    }
}
