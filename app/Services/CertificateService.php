<?php

namespace App\Services;

use App\Actions\CreateCertificate;
use App\Actions\RemoveCertificate;
use App\Actions\UpdateCertificate;

class CertificateService
{
    private $removeCertificate;
    private $createCertificate;
    private $updateCertificate;

    public function __construct(
        CreateCertificate $createCertificate,
        UpdateCertificate $updateCertificate,
        RemoveCertificate $removeCertificate
    )
    {
        $this->createCertificate = $createCertificate;
        $this->updateCertificate = $updateCertificate;
        $this->removeCertificate = $removeCertificate;   
    }

    public function addBulkCert($data)
    {
        foreach($data as $cert) {
            $arr = explode(';', $cert);

            if($arr[0] != '') {
                $this->createCertificate->execute([
                    'cert_no'       =>  $arr[0],
                    'name'          =>  $arr[1],
                    'school'        =>  $arr[2],
                    'program'       =>  $arr[3],
                    'total_grade'   =>  $arr[4],
                    'gold_medal'    => intval($arr[5]),
                    'silver_medal'  => intval($arr[6]),
                    'bronze_medal'  => intval($arr[7]),
                    'total_medal'   =>  $arr[8],
                    'proficiency'   =>  $arr[9]
                ]);
            } 
        }
    }

    public function addSingleCert($data)
    {
        $this->createCertificate->execute([
            'cert_no'       =>  $data->cert_no,
            'name'          =>  $data->name,
            'school'        =>  $data->school,
            'program'       =>  $data->program,
            'total_grade'   =>  $data->total_grade,
            'gold_medal'    =>  $data->gold_medal,
            'silver_medal'  =>  $data->silver_medal,
            'bronze_medal'  =>  $data->bronze_medal,
            'total_medal'   =>  $data->total_medal,
            'proficiency'   =>  $data->proficiency
        ]);
    }

    public function updateCert($data)
    {
        $this->updateCertificate->execute(['id' => $data['id']], [
            'cert_no'       =>  $data['cert_no'],
            'name'          =>  $data['name'],
            'school'        =>  $data['school'],
            'program'       =>  $data['program'],
            'total_grade'   =>  $data['total_grade'],
            'gold_medal'    =>  $data['gold_medal'],
            'silver_medal'  =>  $data['silver_medal'],
            'bronze_medal'  =>  $data['bronze_medal'],
            'total_medal'   =>  $data['total_medal'],
            'proficiency'   =>  $data['proficiency']
        ]);
    }

    public function remove($id)
    {
        $this->removeCertificate->execute($id);
    }
}