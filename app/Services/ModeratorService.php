<?php

namespace App\Services;

use App\Actions\CreateModerator;

class ModeratorService {

    private $createModerator;

    public function __construct(CreateModerator $createModerator)
    {
        $this->createModerator = $createModerator;    
    }

    public function registerNewModerator($request)
    {
        return $this->createModerator->execute($request);
    }
}