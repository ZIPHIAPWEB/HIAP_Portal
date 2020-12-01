<?php

namespace App\Actions;

use App\Initial;

class UpdateInitialRequirement
{
    public function execute($data)
    {
        Initial::where(['id' => $data['id']])->update($data);
    }
}