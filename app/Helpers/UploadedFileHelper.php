<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class UploadedFileHelper 
{
    public function store($file, $directory)
    {
        $path = Storage::putFile('public/' .$directory, $file);

        return Storage::url($path);
    }

    public function getUploadedFiles($directory)
    {

    }

    public function remove($file)
    {
        Storage::delete($file);
    }
}