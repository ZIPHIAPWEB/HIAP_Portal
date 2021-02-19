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

    public function addBulkCert($data)
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
                    'gold_medals'    =>  $arr[8],
                    'silver_medals'  =>  $arr[9],
                    'bronze_medals'  =>  $arr[10],
                    'total_medal'   =>  $arr[11]
                ]);
            } 
        }
    }

    public function addSingleCert($data)
    {
        $this->createCertificate->execute([
            'cert_no'       =>  $data->cert_id,
            'name'          =>  $data->full_name,
            'school'        =>  $data->school,
            'program'       =>  $data->program,
            'total_grade'   =>  $data->total_grade,
            'gold_medal'   =>  $data->gold_medals,
            'silver_medal' =>  $data->silver_medals,
            'bronze_medal' =>  $data->bronze_medals,
            'total_medal'  =>  $data->total_medals   
        ]);
    }

    public function remove($id)
    {
        $this->removeCertificate->execute($id);
    }
}