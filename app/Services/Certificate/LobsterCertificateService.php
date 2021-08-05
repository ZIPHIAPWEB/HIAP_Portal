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
            'course'            =>  $data['course'],
            'hours'             =>  $data['hours'],
            'lobster_layout_id' =>  $data['lobster_layout'],
            'cert_id_main'      =>  $data['cert_id']
        ];
    }
    public function uploadBulk($data): void
    {
        foreach((new FileSeparator)->separateFileToArray($data['file']) as $file) {
            CertLobsterClient::create([
                'cert_id'           =>  $file[0],
                'full_name'         =>  $file[1],
                'course'            =>  $file[2],
                'hours'             =>  $file[3],
                'lobster_layout_id' =>  $data['layout_id'],
                'cert_id_main'      =>  $file[4]
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