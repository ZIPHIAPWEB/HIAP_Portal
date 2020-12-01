<?php

namespace App\Services;

use App\Actions\CreateClientInitial;
use App\Actions\CreateLog;
use App\Actions\RemoveRequirement;
use Illuminate\Support\Facades\File;

class InitialClientRequirementService 
{
    private $createClientInitial;
    private $createLog;
    private $removeRequirement;
    
    public function __construct(
        CreateClientInitial $createClientInitial,
        RemoveRequirement $removeRequirement,
        CreateLog $createLog
    )
    {
        $this->createClientInitial = $createClientInitial;  
        $this->removeRequirement = $removeRequirement;
        $this->createLog = $createLog;      
    }

    public function uploadRequirement($data) : object
    {
        $filename = time() . '.' . $data->file->extension();
        $data->file->move(public_path('uploads'), $filename);

        $newRequirement = $this->createClientInitial->execute([
            'user_id'       =>  $data->user()->id,
            'initial_id'    =>  $data->initial_id,
            'status'        =>  true,
            'file_path'     =>  $filename
        ]);

        $this->createLog->execute([
            'user_id'       =>  $data->user()->id,
            'action'        =>  $filename . ' has been uploaded.'
        ]);

        return $newRequirement;
    }

    public function removeUploadedRequirement($data) : void
    {
        $deletedRequirement = $this->removeRequirement->execute($data);
        
        if (File::exists('uploads/' . $deletedRequirement->first()->file_path)) {
            File::delete('uploads/' . $deletedRequirement->first()->file_path);
        }

        $this->createLog->execute([
            'user_id'       =>  $deletedRequirement->first()->user_id,
            'action'        =>  $deletedRequirement->first()->file_path . ' has been deleted.'
        ]);
    }
}