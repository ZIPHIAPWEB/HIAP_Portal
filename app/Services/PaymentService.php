<?php

namespace App\Services;

use App\Actions\CreateLog;
use App\Actions\CreatePayment;
use App\Actions\RemovePayment;
use App\Actions\SendMailNotification;
use App\Actions\UpdatePayment;
use App\Client;
use App\Mail\PaymentUploaded;
use App\Notifications\NewPaymentUploaded;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Notification;

class PaymentService
{
    private $createPayment;
    private $createLog;
    private $updatePayment;
    private $removePayment;
    private $mail;

    public function __construct(
        CreatePayment $createPayment,
        CreateLog $createLog,
        UpdatePayment $updatePayment,
        RemovePayment $removePayment,
        SendMailNotification $sendMailNotification
    )
    {
        $this->createPayment = $createPayment;   
        $this->createLog = $createLog;
        $this->updatePayment = $updatePayment; 
        $this->removePayment = $removePayment;
        $this->mail = $sendMailNotification;
    }

    public function uploadDepositSlip($data)
    {
        $filename = time() . '.'. $data->file('file')->getClientOriginalExtension();
        $data->file->move(public_path('slips'), $filename);

        $this->createPayment->execute([
            'user_id'       =>  $data->user()->id,
            'purpose'       =>  $data->purpose,
            'isVerified'    =>  false,
            'path'          =>  $filename
        ]);

        $this->createLog->execute([
            'user_id'   =>  $data->user()->id,
            'action'    =>  'Upload a new proof of payment.'
        ]);


        Notification::route('mail', 'accounting@hospitalityinstituteofamerica.com.ph')
            ->notify((new NewPaymentUploaded(
                Client::where('user_id', $data->user()->id)
                ->with('school')
                ->with('onlineProgram')
                ->first()
            ))->delay(now()->addSeconds((3))));
    }

    public function payBySchool($data)
    {
        $this->createPayment->execute([
            'user_id'   =>  $data->user()->id,
            'purpose'   =>  'Paid by School',
            'isVerified'=>  false,
            'path'      =>  ''
        ]);

        $this->createLog->execute([
            'user_id'   =>  $data->user()->id,
            'action'    =>  'Choose paid by school.'
        ]);

        Notification::route('mail', 'accounting@hospitalityinstituteofamerica.com.ph')
            ->notify((new NewPaymentUploaded(
                Client::where('user_id', $data->user()->id)
                ->with('school')
                ->with('onlineProgram')
                ->first()
            ))->delay(now()->addSeconds(3)));
        // $this->mail->execute('accounting@hospitalityinstituteofamerica.com.ph', new PaymentUploaded(
        //     Client::where('user_id', $data->user()->id)
        //         ->with('school')
        //         ->with('onlineProgram')
        //         ->first()
        // ));
    }
    
    public function deleteDepositSlip($data, $slipId)
    {
        $deletedSlip = $this->removePayment->execute(['id' => $slipId]);
        
        switch($data->user()->role) {
            case 'client':
                $this->createLog->execute([
                    'user_id'   =>  $data->user()->id,
                    'action'    =>  'Proof of payment deleted.'
                ]);
            break;

            case 'superadministrator':
                $this->createLog->execute([
                    'user_id'   =>  $data->user()->id,
                    'action'    =>  'Proof of payment #' . $slipId . ' has been deleted.'
                ]);
            break;
        }

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