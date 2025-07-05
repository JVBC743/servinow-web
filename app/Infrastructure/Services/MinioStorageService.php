<?php

namespace App\Infrastructure\Services;

use App\Application\Interfaces\StorageServiceInterface;
use Illuminate\Support\Facades\Storage;

class MinioStorageService implements StorageServiceInterface
{
    public function getUrl(string $path): string
    {
        return Storage::disk('minio')->url($path);
    }
}
