<?php

namespace App\Helpers;

class UploadedCertificateFileSeparatorHelper
{
    public function separateFileToArray($file, string $separatorSymbol = ';') : array
    {
        $convertedFile = file($file->getRealPath());
        $data = array_splice($convertedFile, 1);
        $arrayOfData = [];

        foreach($data as $value) {
            $arr = explode($separatorSymbol, $value);
            array_push($arrayOfData, $arr);
        }

        return $arrayOfData;
    }
}