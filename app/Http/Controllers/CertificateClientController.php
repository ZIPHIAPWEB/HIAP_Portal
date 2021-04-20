<?php

namespace App\Http\Controllers;

use App\CertificateClient;
use App\CertificateLayout;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use PDF;

class CertificateClientController extends Controller
{
    public function clientList()
    {
        return Inertia::render('Superadmin/Cert/ClientEntry', [
            'layouts'       =>  CertificateLayout::all(),
            'participants'  =>  CertificateClient::with('layout')->get()
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

        return $pdf->download('certificate.pdf');
    }

    public function saveBulkClients(Request $request)
    {
        $request->validate([
            'file'          =>  'required',
            'layout_id'     =>  'required'
        ]);

        $file = file($request->file->getRealPath());
        $data = array_slice($file, 1);
        foreach($data as $cert) {
            $arr = explode(';', $cert);

            if($arr[0] != '') {
                CertificateClient::create([
                    'cert_created_at'   =>  $arr[0],
                    'cert_layout_id'    =>  $request->layout_id,
                    'full_name'         =>  Str::upper($arr[1]),
                    'email'             =>  $arr[2],
                    'school'            =>  ($arr[3] == 'Other') ? Str::upper($arr[4]) : Str::upper($arr[3])
                ]);
            } 
        }

        return redirect()->back();
    }
}
