<?php

namespace App\Services\Certificate;

use App\CertLobsterClient;
use App\Helpers\UploadedCertificateFileSeparatorHelper as FileSeparator;

class LobsterCertificateService implements ICertificateService
{
    private function requestedData($data)
    {
        return [
            'cert_id'           =>  $data['cert_id'],
            'full_name'         =>  $data['full_name'],
            'school'            =>  $data['school'],
            'course'            =>  $data['course'],
            'hours'             =>  $data['hours'],
            'lobster_layout_id' =>  $data['lobster_layout_id'],
            'cert_id_main'      =>  $data['cert_id_main']
        ];
    }
    
    public function uploadBulk($data): void
    {
        foreach((new FileSeparator)->separateFileToArray($data['file']) as $file) {
            CertLobsterClient::create([
                'cert_id_main'      =>  $file[0],
                'cert_id'           =>  $file[1],
                'full_name'         =>  utf8_encode($file[2]),
                'course'            =>  utf8_encode($file[3]),
                'hours'             =>  $file[4],
                'lobster_layout_id' =>  $data['layout_id'],
                'school'            =>  $data['school']
            ]);
        }
    }

    public function uploadSingle($data): void
    {
        CertLobsterClient::create($this->requestedData($data));
    }

    public function updateSingleCertificate($certId, $data)
    {
        CertLobsterClient::where('id', $certId)->update($this->requestedData($data));
    }

    public function removeSingleCertificate($certId): void
    {
        CertLobsterClient::where('id', $certId)->delete();
    }
}