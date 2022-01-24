<?php

namespace App\Http\Controllers;

use App\Certificate;
use App\Http\Requests\CertificateRequest;
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

    public function getSearchedLobsterInkCert(Request $request)
    {
        return response()->json(
            Certificate::where('name', 'like', '%'. $request->search . '%')
                ->OrWhere('cert_no', 'like', '%' . $request->search . '%')
                ->paginate(20)
        );
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
            abort(404, 'No Record Found');
        }
    }

    public function showCertificateEntry()
    {
        return Inertia::render('Superadmin/CertificatesEntry', [
            'certs' =>  Certificate::orderBy('created_at', 'desc')->paginate(14)
        ]);
    }

    public function addCertificate(CertificateRequest $request)
    {
        $request->validated();

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

    public function updateCertificate(CertificateRequest $request)
    {
        $request->validated();

        $this->certificate->updateCert($request->all());

        return redirect()->back();
    }

    public function deleteCert($id)
    {
        $this->certificate->remove($id);

        return redirect()->back();
    }
}
