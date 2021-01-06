<?php

namespace App\Http\Controllers;

use App\Certificate;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CertificateController extends Controller
{
    public function showSearchCertificate()
    {
        return view('frontview.underconstruction');
    }

    public function showCertificate($certId)
    {
        return Inertia::render('Certificate/ViewCertificate', [
            'cert_details' => Certificate::where('cert_no', $certId)->first()
        ]);
    }

    public function showCertificateEntry()
    {
        return Inertia::render('Superadmin/CertificatesEntry', [
            'certs' =>  Certificate::orderBy('created_at', 'desc')->get()
        ]);
    }
}
