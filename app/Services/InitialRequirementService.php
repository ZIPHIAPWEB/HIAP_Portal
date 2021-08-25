<?php

namespace App\Services;

use App\Actions\CreateInitialRequirement;
use App\Actions\RemoveInitialRequirement;
use App\Actions\UpdateInitialRequirement;
use App\Initial;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class InitialRequirementService
{
    private $directory = 'downloadables';

    public function addRequirement($data, $program_id)
    {
        if ($data['file'] <> null) {
            $path = Storage::putFile('public/' . $this->directory, $data['file']);

            Initial::create([
                'program_id'    =>  $program_id,
                'name'          =>  $data['name'],
                'description'   =>  $data['description'],
                'file_path'     =>  $path
            ]);
        } else {
            Initial::create([
                'program_id'    =>  $program_id,
                'name'          =>  $data['name'],
                'description'   =>  $data['description'],
                'file_path'     =>  ''
            ]);
        }
    }

    public function updateRequirement($data)
    {
        if ($data['file'] <> null) {
            $file = Initial::where('id', $data['id'])->first()->file_path;

            if($file <> '' || $file <> null) {
                if(Storage::delete($file)) {
                    $path = Storage::putFile('public/'. $this->directory, $data['file']);

                    Initial::where('id', $data['id'])
                        ->update([
                            'program_id'    =>  1,
                            'name'          =>  $data['name'],
                            'description'   =>  $data['description'],
                            'file_path'     =>  $path
                        ]);
                }
            } else {
                $path = Storage::putFile('public/'. $this->directory, $data['file']);

                Initial::where('id', $data['id'])
                    ->update([
                        'program_id'    =>  1,
                        'name'          =>  $data['name'],
                        'description'   =>  $data['description'],
                        'file_path'     =>  $path
                    ]);
            }

        }
    }

    public function removeRequirement($requirementId)
    {
        $selectedRequirement = Initial::where('id', $requirementId)->first();

        if ($selectedRequirement->file_path <> '' || $selectedRequirement->file_path <> null) {
            Storage::delete($selectedRequirement->file_path);

            Initial::where('id', $requirementId)->delete();
        } else {
            Initial::where('id', $requirementId)->delete();
        }
    }
}