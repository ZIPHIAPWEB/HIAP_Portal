<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class CertificateController extends Controller
{
    public function showSearchCertificate()
    {
        return view('frontview.underconstruction');
    }

    public function showCertificateEntry()
    {
        return Inertia::render('Superadmin/CertificatesEntry');
    }
}
