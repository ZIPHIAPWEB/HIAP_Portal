<?php

namespace App\Services\Generator;

use App\CertLobsterLayout;
use Illuminate\Support\Facades\Storage;

class LobsterLayoutGeneratorService implements IGeneratorService
{
    private $directory = 'webinar_layout';

    public function addNewLayout($settings): void
    {
        if($settings['file']) {
            $path = Storage::putFile('public/' . $this->directory, $settings['file']);
            CertLobsterLayout::create([
                'name'      =>  $settings['name'],
                'f_style'   =>  '',
                'img_path'  =>  $path
            ]);
        }
    }

    public function updateLayout($settings, $layoutId): void
    {
        if($settings['img_path']) {
            $cert = CertLobsterLayout::where('id', $layoutId);
            Storage::delete($cert->first()->img_path);
            $path = Storage::putFile('public/' . $this->directory, $settings['img_path']);
            $cert->update([
                'name'      =>  $settings['name'],
                'f_style'   =>  '',
                'img_path'  =>  $path
            ]);
        }
    }

    public function removeLayout($layoutId): void
    {
        $cert = CertLobsterLayout::where('id', $layoutId);
        
        if($cert->first()->img_path) {
            Storage::delete($cert->first()->img_path);
            $cert->delete();
        } 

        $cert->delete();    
    }
}