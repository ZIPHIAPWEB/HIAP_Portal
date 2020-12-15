<?php

namespace App\Services;

use App\Actions\CreatePayment;
use App\Actions\RemovePayment;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PaymentService
{
    private $createPayment;
    private $removePayment;

    public function __construct(
        CreatePayment $createPayment,
        RemovePayment $removePayment
    )
    {
        $this->createPayment = $createPayment;    
        $this->removePayment = $removePayment;
    }

    public function uploadDepositSlip($data)
    {
        $filename = time() . '.'. $data->file->extension();
        $data->file->move(public_path('slips'), $filename);

        $this->createPayment->execute([
            'user_id'       =>  $data->user()->id,
            'purpose'       =>  $data->purpose,
            'isVerified'    =>  false,
            'path'          =>  $filename
        ]);
    }

    public function deleteDepositSlip($data)
    {
        $deletedSlip = $this->removePayment->execute(['id' => $data]);

        if(File::exists(public_path('slips/' . $deletedSlip->path))){

            File::delete(public_path('slips/' . $deletedSlip->path));
        
          }else{
        
            dd('File does not exists.');
        
          }

    }
}