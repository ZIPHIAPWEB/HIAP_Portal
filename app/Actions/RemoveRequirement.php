<?php

namespace App\Actions;

use App\ClientInitial;

class RemoveRequirement
{
    private $temp;
    
    public function __destruct()
    {
        $this->temp = '';    
    }

    public function execute($data)
    {
        $removedInitial = ClientInitial::where(['id' => $data])->first();
        $this->temp = $removedInitial;
        $removedInitial->delete();

        return $this->temp;
    }
}