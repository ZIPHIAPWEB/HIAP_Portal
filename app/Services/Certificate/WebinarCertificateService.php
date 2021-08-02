<?php

namespace App\Services\Certificate;

use App\CertificateClient;
use App\Helpers\UploadedCertificateFileSeparatorHelper as FileSeparator;

class WebinarCertificateService implements ICertificateService
{
    private function requestedData($data) : array
    {
        return [
            'cert_created_at'            =>  $data['cert_created_at'],
            'cert_layout_id'             =>  $data['cert_layout_id'],
            'email'                      =>  $data['email'],
            'full_name'                  =>  $data['full_name'],
            'school'                     =>  $data['school']
        ];
    }

    public function uploadBulk($data): void
    {
        foreach((new FileSeparator)->separateFileToArray($data->file) as $file) {
            CertificateClient::create([
                'cert_created_at'       =>  $file[0],
                'cert_layout_id'        =>  $data->layout_id,
                'full_name'             =>  utf8_encode($file[1]),
                'email'                 =>  $file[2],
                'school'                =>  ($file[3] == 'Other') ? $file[4] : $file[3]
            ]);
        }
    }

    public function uploadSingle($data): void
    {
        CertificateClient::create($this->requestedData($data));
    }

    public function updateSingleCertificate($certId, $data)
    {
        CertificateClient::where('id', $certId)
            ->update($this->requestedData($data));
    }

    public function removeSingleCertificate($certId): void
    {
        CertificateClient::where('id', $certId)->delete();
    }
}