<?php

namespace App\Services;

use App\Actions\CreateInitialRequirement;
use App\Actions\RemoveInitialRequirement;
use App\Actions\UpdateInitialRequirement;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class InitialRequirementService
{
    private $createInitialRequirement;
    private $updateInitialRequirement;
    private $removeInitialRequirement;

    public function __construct(
        CreateInitialRequirement $createInitialRequirement,
        UpdateInitialRequirement $updateInitialRequirement,
        RemoveInitialRequirement $removeInitialRequirement
    )
    {
        $this->createInitialRequirement = $createInitialRequirement;
        $this->updateInitialRequirement = $updateInitialRequirement;    
        $this->removeInitialRequirement = $removeInitialRequirement;
    }

    public function addRequirement($data, $programId) : void
    {
        if ($data->hasFile('file')) {
            $filename = Str::snake($data->name) . '-' . time() . '.' . $data->file->extension();
            $data->file->move(public_path('initials'), $filename);
        }

        $this->createInitialRequirement->execute([
            'program_id'        =>  $programId,
            'name'              =>  $data->name,
            'description'       =>  $data->description,
            'file_path'         =>  $filename   
        ]);
    }

    public function updateRequirement($data)
    {
        if ($data->hasFile('file')) {
            $filename = Str::snake($data->name) . '-' . time() . '.' . $data->file->extension();
            $data->file->move(public_path('initials'), $filename);
        }

        $this->updateInitialRequirement->execute([
            'id'            =>  $data->id,
            'name'          =>  $data->name,
            'description'   =>  $data->description,
            'file_path'     =>  $data->hasFile('file') ? $filename: ''
        ]);
    }

    public function removeRequirement($data) : void
    {
        if(File::exists('initials/' . $data->first()->file_path)) {
            File::delete('initials/' . $data->first()->file_path);
        }

        $this->removeInitialRequirement->execute($data);
    }
}