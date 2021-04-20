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
            'cert_no'       =>  'required',
            'name'          =>  'required',
            'school'        =>  'required',
            'program'       =>  'required',
            'gold_medal'    =>  'required',
            'silver_medal'  =>  'required',
            'bronze_medal'  =>  'required',
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

    public function updateCertificate(Request $request)
    {
        $this->certificate->updateCert($request->validate([
            'id'            =>  '',
            'cert_no'       =>  'required',
            'name'          =>  'required',
            'school'        =>  'required',
            'program'       =>  'required',
            'gold_medal'    =>  'required',
            'silver_medal'  =>  'required',
            'bronze_medal'  =>  'required',
            'total_medal'   =>  'required',
            'total_grade'   =>  'required'
        ]));

        return redirect()->back();
    }

    public function deleteCert($id)
    {
        $this->certificate->remove($id);

        return redirect()->back();
    }
}
