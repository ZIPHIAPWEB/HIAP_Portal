<?php

namespace App\Services\Generator;

use App\CertLobsterLayout;
use App\CertStyle;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LobsterLayoutGeneratorService implements IGeneratorService
{
    private $directory = 'webinar_layout';

    public function addNewLayout($settings): void
    {
        if($settings['file']) {
            $path = Storage::putFile('public/' . $this->directory, $settings['file']);
            DB::beginTransaction();
            
            try {
                $cert = CertLobsterLayout::create([
                    'name'      =>  $settings['name'],
                    'f_style'   =>  '',
                    'img_path'  =>  $path
                ]);
    
                if ($settings['styles']) {
                    foreach($settings['styles'] as $style) {
                        CertStyle::create([
                            'cert_id'   =>  $cert->id,
                            'name'      =>  $style['name'],
                            'class_name'=>  $style['class_name'],
                            'style'     =>  $style['style']
                        ]);
                    }
                }

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
            }
        }
    }

    public function updateLayout($settings, $layoutId): void
    {
        if($settings['file'] <> null || $settings['file'] <> '') {
            $cert = CertLobsterLayout::where('id', $layoutId);
            Storage::delete($cert->first()->img_path);
            $path = Storage::putFile('public/' . $this->directory, $settings['file']);
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
            CertStyle::where('cert_id', $layoutId)->delete();
        } 

        $cert->delete();    
    }
}