<?php

namespace App\Services;

use App\Actions\CreatePayment;
use App\Actions\RemovePayment;
use App\Actions\SendMailNotification;
use App\Actions\UpdatePayment;
use App\Client;
use App\Mail\PaymentUploaded;
use Illuminate\Support\Facades\File;

class PaymentService
{
    private $createPayment;
    private $updatePayment;
    private $removePayment;
    private $mail;

    public function __construct(
        CreatePayment $createPayment,
        UpdatePayment $updatePayment,
        RemovePayment $removePayment,
        SendMailNotification $sendMailNotification
    )
    {
        $this->createPayment = $createPayment;   
        $this->updatePayment = $updatePayment; 
        $this->removePayment = $removePayment;
        $this->mail = $sendMailNotification;
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

        $this->mail->execute('rmergenio@ziptravel.com.ph', new PaymentUploaded(
            Client::where('user_id', $data->user()->id)
                ->with('school')
                ->with('onlineProgram')
                ->first()
        ));
    }

    public function payBySchool($data)
    {
        $this->createPayment->execute([
            'user_id'   =>  $data->user()->id,
            'purpose'   =>  'Paid by School',
            'isVerified'=>  false,
            'path'      =>  ''
        ]);

        $this->mail->execute('rmergenio@ziptravel.com.ph', new PaymentUploaded(
            Client::where('user_id', $data->user()->id)
                ->with('school')
                ->with('onlineProgram')
                ->first()
        ));
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

    public function verify($paymentId)
    {
        $this->updatePayment->execute(['id' => $paymentId], [
            'isVerified'    =>  1
        ]);
    }
}