<?php

namespace App\Http\Controllers;

use App\CertificateLayout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;
use PDF;
class CertificateEditorController extends Controller
{
    public function certList()
    {
        return Inertia::render('Superadmin/CertEditor', [
            'layouts'     =>  CertificateLayout::all()
        ]);
    }

    public function viewEditor($layoutId)
    {
        return Inertia::render('Superadmin/Cert/CertView', [
            'layout'    =>  CertificateLayout::find($layoutId)->first()
        ]);
    }

    public function viewActual($layoutId)
    {
        return view('export.certificate')->with('data', CertificateLayout::find($layoutId)->first());
    }

    public function saveChanges(Request $request)
    {

        if(!$request->hasFile('bg_img')) {
            CertificateLayout::updateOrCreate(['id' => $request->id], [
                'name'          =>  $request->name,
                'f_style'       =>  Str::replaceArray('?', $request->f_style, "font-family:?; font-size:?; color:?; top:?; bottom:?;"),
            ]);
        } else {
            $path = $request->file('bg_img')->store('public/cert_layout');

            CertificateLayout::updateOrCreate(['id' => $request->id], [
                'name'          =>  $request->name,
                'f_style'       =>  Str::replaceArray('?', $request->f_style, "font-family:?; font-size:?; color:?; top:?; bottom:?;"),
                'img_path'      =>  Storage::url($path)
            ]);
        }

        return redirect()->back();
    }
}
