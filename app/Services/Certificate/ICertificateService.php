<?php

namespace App\Services\Certificate;

interface ICertificateService
{
    public function uploadBulk($data) : void;
    public function uploadSingle($data) : void;
    public function updateSingleCertificate($certId, $data);
    public function removeSingleCertificate($certId): void;
}