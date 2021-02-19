<?php

namespace App\Http\Controllers;

use App\Certificate;
use App\Services\CertificateService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CertificateController extends Controller
{
    private $certificate;

    public function __construct(CertificateService $certificateService)
    {
        $this->certificate = $certificateService;       
    }

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

    public function addCertificate(Request $request)
    {
        $request->validate([
            'cert_id'       =>  'required',
            'full_name'     =>  'required',
            'school'        =>  'required',
            'program'       =>  'required',
            'gold_medals'   =>  'required',
            'silver_medals' =>  'required',
            'bronze_medals' =>  'required',
            'total_grade'   =>  'required'
        ]);

        $this->certificate->addSingleCert($request);

        return redirect()->back();
    }

    public function uploadCertificates(Request $request)
    {
        $request->validate([
            'file'  =>  'required'
        ]);

        $file = file($request->file->getRealPath());
        $data = array_slice($file, 1);

        $this->certificate->addBulkCert($data);

        return redirect()->back();
    }

    public function deleteCert($id)
    {
        $this->certificate->remove($id);

        return redirect()->back();
    }
}
