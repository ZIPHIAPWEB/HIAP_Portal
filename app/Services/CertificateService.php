<?php

namespace App\Services;

use App\Actions\CreateCertificate;
use App\Actions\RemoveCertificate;

class CertificateService
{
    private $removeCertificate;
    private $createCertificate;

    public function __construct(
        CreateCertificate $createCertificate,
        RemoveCertificate $removeCertificate
    )
    {
        $this->createCertificate = $createCertificate;
        $this->removeCertificate = $removeCertificate;   
    }

    public function addCert($data)
    {
        foreach($data as $cert) {
            $arr = explode(',', $cert);
        
            if($arr[0] != '') {
                $this->createCertificate->execute([
                    'cert_no'       =>  $arr[0],
                    'name'          =>  $arr[1],
                    'school'        =>  $arr[5],
                    'program'       =>  $arr[6],
                    'total_grade'   =>  $arr[7],
                    'gold_medal'    =>  $arr[8],
                    'silver_medal'  =>  $arr[9],
                    'bronze_medal'  =>  $arr[10],
                    'total_medal'   =>  $arr[11]
                ]);
            } 
        }
    }

    public function remove($id)
    {
        $this->removeCertificate->execute($id);
    }
}