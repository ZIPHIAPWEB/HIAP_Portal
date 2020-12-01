<?php

namespace App\Actions;

use App\Initial;

class RemoveInitialRequirement
{
    private $temp;
    
    public function __destruct()
    {
        dd($this->temp);
        $this->temp = '';    
    }
    
    public function execute($data)
    {
        $selectedInitial = Initial::where(['id' => $data])->first();
        $this->temp = $selectedInitial;
        $selectedInitial->delete();

        return $this->temp;
    }
}