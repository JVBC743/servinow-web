<?php

namespace App\Application\Interfaces;

interface StorageServiceInterface
{
    public function getUrl(string $path): string;
}
