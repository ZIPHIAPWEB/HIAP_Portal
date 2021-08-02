<?php

namespace App\Services\Generator;

interface IGeneratorService
{
    public function addNewLayout($settings): void;
    public function updateLayout($settings, $layoutId): void;
    public function removeLayout($layoutId): void;
}