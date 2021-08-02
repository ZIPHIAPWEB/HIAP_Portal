<?php

namespace App\Http\Controllers;

use App\CertificateClient;
use App\CertificateLayout;
use App\Services\Certificate\WebinarCertificateService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use PDF;

class CertificateClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')
                ->except([
                    'viewSearchToDownloadCert',
                    'getSearchedCertificate',
                    'downloadClientActualCert',
                    'viewCertDownloadingPage'
                ]);
    }

    public function clientList()
    {
        return Inertia::render('Superadmin/Cert/ClientEntry', [
            'layouts'       =>  CertificateLayout::all(),
            'participants'  =>  CertificateClient::with('layout')
                                    ->orderBy('created_at', 'desc')
                                    ->paginate(18)
        ]);
    }

    public function viewSearchToDownloadCert()
    {
        return Inertia::render('Certificate/SearchToDownloadCert');
    }

    public function getSearchedCertificate(Request $request)
    {
        return response()->json(CertificateClient::where('email', $request->search)->get());
    }

    public function viewClientActualCert($userId)
    {
        return view('export.certificate_client')->with('data', CertificateClient::where('id', $userId)->with('layout')->first());
    }

    public function downloadClientActualCert($userId)
    {
        $pdf = PDF::loadView('export.certificate_client', ['data' => CertificateClient::where('id', $userId)->first()])
            ->setPaper('a4', 'landscape');

        $pdf->setEncryption('p@ssw0rd', ['print']);

        return $pdf->download('certificate.pdf');
    }

    public function saveBulkClients(Request $request)
    {
        $request->validate([
            'file'          =>  'required',
            'layout_id'     =>  'required'
        ]);

        (new WebinarCertificateService)->uploadBulk($request);

        return redirect()->back();
    }

    public function saveSingleClient(Request $request)
    {
        (new WebinarCertificateService)->uploadSingle($request->validate([
            'full_name'         =>  'required',
            'email'             =>  'required',
            'school'            =>  'required',
            'cert_created_at'   =>  'required',
            'cert_layout_id'    =>  'required'
        ]));

        return redirect()->back();
    }

    public function updateClientCert(Request $request)
    {
        (new WebinarCertificateService)->updateSingleCertificate($request->id, $request->validate([
            'full_name'         =>  'required',
            'email'             =>  'required',
            'school'            =>  'required',
            'cert_created_at'   =>  'required',
            'cert_layout_id'    =>  'required'
        ]));

        return redirect()->back();
    }

    public function deleteClientCert($certId)
    {
        (new WebinarCertificateService)->removeSingleCertificate($certId);

        return redirect()->back();
    }

    public function searchCertificate(Request $request)
    {
        return CertificateClient::orderBy('created_at', 'desc')
                        ->with('layout')
                        ->where('email', 'like', '%'.$request->search.'%')
                        ->orWhere('full_name', 'like', '%'.$request->search.'%')
                        ->paginate(18);
    }

    public function viewCertDownloadingPage()
    {
        return Inertia::render('Certificate/CertDownloading');
    }
}
