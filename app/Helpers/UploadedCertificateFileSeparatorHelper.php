<?php

namespace App\Helpers;

class UploadedCertificateFileSeparatorHelper
{
    public function separateFileToArray($file, string $separatorSymbol = ';')
    {
        $convertedFile = file($file->getRealPath());
        $data = array_splice($convertedFile, 1);
        $arrayOfData = collect();
        
        foreach($data as $value) {
            $arr = explode($separatorSymbol, $value);
            if ($arr[0] != '') {
                $arrayOfData->push($arr);
            }
        }
        return $arrayOfData;
    }
}