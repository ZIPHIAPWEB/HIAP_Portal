<?php

namespace App\Http\Controllers;

use App\CertStyle;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LobsterStyleGeneratorController extends Controller
{
    public function addStyleToCertificate(Request $request)
    {
        CertStyle::updateOrCreate([
            'cert_id'      =>   $request->cert_id,
            'name'         =>   '',
            'class_name'   =>   '',
            'style'        =>   ''
        ]);

        return redirect()->back();
    }
}
