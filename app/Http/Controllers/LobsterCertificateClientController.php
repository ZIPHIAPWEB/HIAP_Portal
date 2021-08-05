<?php

namespace App\Http\Controllers;

use App\CertLobsterClient;
use App\CertLobsterLayout;
use App\Http\Requests\Lobster\UploadBulkLobsterRequest;
use App\Http\Requests\Lobster\UploadSingleLobsterRequest;
use App\Services\Certificate\LobsterCertificateService;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class LobsterCertificateClientController extends Controller
{
    public function showLobsterClientCertificates()
    {
        return Inertia::render('Superadmin/Cert/CertLobsEntry', [
            'layouts'           =>  CertLobsterLayout::orderBy('name')->get(),
            'lobster_clients'   =>  CertLobsterClient::orderBy('created_at')
                ->with('layout')
                ->paginate(18)
        ]);
    }

    public function downloadClientLobsterCertificate($userId)
    {
        $data = CertLobsterClient::with(['layout'])->where('id', $userId)->first();
        $formattedData = [
            'id'        =>  $data->id,
            'layout'    =>  [
                'id'        => $data->layout->id,
                'img_path'  => $data->layout->img_path,
                'styles'    => $data->layout->certStyles->map(function($style) {
                    $string = implode(';', (array) json_decode($style->style, true));
                    return [
                        'id'        =>  $style->id,
                        'cert_id'   =>  $style->cert_id,
                        'class_name'=>  $style->class_name,
                        'styles'    =>  $string,
                    ];
                })
            ],
            'client'    =>  [
                'full_name'     =>  strtoupper($data->full_name),
                'cert_id'       =>  (!$data->cert_id) ? null : $data->cert_id,
                'hours'         =>  (!$data->hours) ? null : 'Academic Credit: '.$data->hours. ' hours',
                'date_issued'   =>  'Issued on ' . $data->created_at->format('F d, Y'),
                'course'        =>  (!$data->course) ? null : strtoupper($data->course),
            ],
        ];

        // return view('export.lobs ter_cert_export', ['data' => $formattedData]);
        $pdf = PDF::loadView('export.lobster_cert_export', ['data' => $formattedData])->setPaper('a4', 'portrait');
        $pdf->setEncryption('p@ssw0rd', ['print']);
        return $pdf->download('COC_HIAP.pdf');
    }

    public function uploadLobsterClients(UploadBulkLobsterRequest $request)
    {
        (new LobsterCertificateService)->uploadBulk($request->validated());

        return redirect()->back();
    }

    public function uploadLobsterClient(UploadSingleLobsterRequest $request)
    {
        (new LobsterCertificateService)->uploadSingle($request->validated());

        return redirect()->back();
    }

    public function updateLobsterClient(Request $request)
    {
        (new LobsterCertificateService)->updateSingleCertificate($request->id, $request);

        return redirect()->back();
    }

    public function removeLobsterClient($certId)
    {
        (new LobsterCertificateService)->removeSingleCertificate($certId);

        return redirect()->back();
    }
}
