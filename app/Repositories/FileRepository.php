<?php


namespace App\Repositories;


use App\Models\File;

class FileRepository
{
    public function newFile()
    {
        return new File();
    }

    public function findById($id)
    {
        return File::find($id);
    }
}
