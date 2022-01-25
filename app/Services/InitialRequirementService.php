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
        if(!empty($data['file'])) {
            $path = Storage::putFile('public/' . $this->directory, $data['file']);
        }

        Initial::create([
            'program_id'    =>  $program_id,
            'name'          =>  $data['name'],
            'description'   =>  $data['description'],
            'type'          =>  $data['type'],
            'file_path'     =>  (!empty($data['file'])) ? $path : null
        ]);
    }

    private function validateExistingRequirements($data) : array
    {
        $initial = Initial::where('id', $data['id'])->first();

        $isFileNullOrEmpty = !$data->hasFile('file');

        if ($isFileNullOrEmpty) {
            return [
                'program_id'    =>  $initial->program_id,
                'name'          =>  $data['name'],
                'description'   =>  $data['description'],
                'type'          =>  $data['type'],
                'file_path'     =>  ''
            ];
        }

        $hasFile = $initial->file_path != '';

        if($hasFile) {
            Storage::delete($initial->file_path);
        }

        $path = Storage::putFile('public/'. $this->directory, $data['file']);

        return [
            'program_id'    =>  $initial->program_id,
            'name'          =>  $data['name'],
            'description'   =>  $data['description'],
            'type'          =>  $data['type'],
            'file_path'     =>  $path
        ];
    }
    
    public function updateRequirement($data)
    {
        Initial::where('id', $data['id'])
            ->update($this->validateExistingRequirements($data));
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