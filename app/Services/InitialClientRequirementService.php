<?php

namespace App\Services;

use App\ClientInitial;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class InitialClientRequirementService 
{
    private $directory = 'cinitials';

    public function uploadRequirement($data)
    {
        $path = Storage::putFile('public/'. $this->directory, $data['file']);

        ClientInitial::create([
            'user_id'   =>  request()->user()->id,
            'initial_id'=>  $data['initial_id'],
            'status'    =>  true,
            'file_path' =>  $path
        ]);
    }

    public function removeUploadedRequirement($data) : void
    {
        
    }
}