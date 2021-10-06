<?php

namespace App\Http\Controllers;

use App\CertificateLayout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class CertificateEditorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');    
    }

    public function certList()
    {
        return Inertia::render('Superadmin/CertEditor', [
            'layouts'     =>  CertificateLayout::all()
        ]);
    }

    public function addCertTemplate(Request $request)
    {
        CertificateLayout::create($request->validate([
            'name'      =>  'required',
            'f_style'   =>  '',
            'img_path'  =>  ''
        ]));

        return redirect()->back();
    }

    public function viewEditor($layoutId)
    {
        return Inertia::render('Superadmin/Cert/CertView', [
            'layout'    =>  CertificateLayout::where('id', $layoutId)->first()
        ]);
    }

    public function viewActual($layoutId)
    {
        $data = CertificateLayout::where('id', $layoutId)->first();

        return view('export.certificate')->with('data', [
            'id'        =>  $data->id,
            'name'      =>  $data->name,
            'f_style'   =>  $data->f_style,
            'img_path'  =>  Storage::url($data->img_path),
        ]);
    }

    public function saveChanges(Request $request)
    {

        if(!$request->hasFile('bg_img')) {
            CertificateLayout::updateOrCreate(['id' => $request->id], [
                'name'          =>  $request->name,
                'f_style'       =>  Str::replaceArray('?', $request->f_style, "font-family:?; text-align:?; font-size:?; color:?; top:?; bottom:?; right:?; left:?;"),
            ]);
        } else {
            $path = Storage::putFile('public/cert_layout', $request->file('bg_img'));

            CertificateLayout::updateOrCreate(['id' => $request->id], [
                'name'          =>  $request->name,
                'f_style'       =>  Str::replaceArray('?', $request->f_style, "font-family:?; text-align:?; font-size:?; color:?; top:?; bottom:?; right:?; left:?;"),
                'img_path'      =>  $path
            ]);
        }

        return redirect()->back();
    }
}
