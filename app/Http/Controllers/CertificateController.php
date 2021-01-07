<?php

namespace App\Http\Controllers;

use App\Certificate;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CertificateController extends Controller
{
    public function showSearchCertificate()
    {
        return Inertia::render('Certificate/Search');
    }

    public function showCertificate($certId)
    {
        $cert = Certificate::where('cert_no', $certId)->first();

        if ($cert) {
            return Inertia::render('Certificate/ViewCertificate', [
                'cert_details' => $cert
            ]);
        } else {
            abort(404);
        }
    }

    public function showCertificateEntry()
    {
        return Inertia::render('Superadmin/CertificatesEntry', [
            'certs' =>  Certificate::orderBy('created_at', 'desc')->get()
        ]);
    }

    public function uploadCertificate(Request $request)
    {
        $request->validate([
            'file'  =>  'required'
        ]);

        $file = file($request->file->getRealPath());
        $data = array_slice($file, 1);

        foreach($data as $cert) {
            $arr = explode(',', $cert);
        
            if($arr[0] != '') {
                Certificate::create([
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

        return redirect()->back();
    }
}
