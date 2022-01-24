<?php

namespace App\Services;

use App\ClientInitial;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class InitialClientRequirementService 
{
    private $directory = 'cinitials';

    public function uploadRequirement($request)
    {
        if($request->hasFile('file')) {
            $path = Storage::putFile('public/'. $this->directory, $request->file);
        }

        if(!$request->hasFile('file')) {
            $path = $request->file;
        }

        ClientInitial::create([
            'user_id'   =>  $request->user()->id,
            'initial_id'=>  $request->initial_id,
            'status'    =>  true,
            'file_path' =>  $path
        ]);
    }

    public function removeUploadedRequirement($id) : void
    {
        $selectedInitial = ClientInitial::where('id', $id)->first();
        
        Storage::delete($selectedInitial->file_path);

        ClientInitial::where('id', $id)->delete();
    }
}