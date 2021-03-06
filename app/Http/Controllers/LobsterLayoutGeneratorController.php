<?php

namespace App\Http\Controllers;

use App\CertLobsterLayout;
use App\CertStyle;
use App\Http\Requests\Lobster\AddNewLobsterLayoutRequest;
use App\Services\Generator\LobsterLayoutGeneratorService as LayoutGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class LobsterLayoutGeneratorController extends Controller
{
    public function showLobsterLayouts()
    {
        return Inertia::render('Superadmin/CertLobsEditor', [
            'styles'            =>  CertStyle::distinct()->select(['*'])->groupBy('name')->get(),
            'lobster_layout'    =>  CertLobsterLayout::orderBy('created_at')->paginate(15)
        ]);
    }

    public function viewSelectedLobsterLayout($layoutId)
    {
        return Inertia::render('Superadmin/Cert/CertLobsView', [
            'lobster_layout'    =>  CertLobsterLayout::where('id', $layoutId)
                ->with(['certStyles'])
                ->first()
        ]);
    }

    public function viewEditorLobsterLayout($layoutId)
    {
        $data = CertLobsterLayout::with(['certStyles'])->where('id', $layoutId)->first();

        return view('export.lobster_cert_view', ['data' =>  [
            'id'            =>  $data->id,
            'name'          =>  $data->name,
            'class_name'    =>  $data->class_name,
            'img_path'      =>  Storage::url($data->img_path),
            'cert_styles'   =>  $data->certStyles->map(function ($cert) {
                $string = implode(';', (array) json_decode($cert->style, true));
                return [
                    'id'        =>  $cert->id,
                    'cert_id'   =>  $cert->cert_id,
                    'class_name'=>  $cert->class_name,
                    'styles'    =>  $string
                ];
            })
        ]]);
    }

    public function addNewLobsterLayout(AddNewLobsterLayoutRequest $request)
    {
        (new LayoutGenerator)->addNewLayout($request->validated());

        return redirect()->back();
    }

    public function updateLobsterLayout(Request $request)
    {
        (new LayoutGenerator)->updateLayout($request, $request->id);

        return redirect()->back();
    }

    public function removeLobsterLayout($layoutId)
    {
        (new LayoutGenerator)->removeLayout($layoutId);

        return redirect()->back();
    }
}
