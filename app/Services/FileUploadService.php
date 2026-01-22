<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileUploadService
{
    public function upload(UploadedFile $file, string $folder, string $disk = 'public'): string 
    {
        $path = $file->store($folder, $disk);

        return Storage::disk($disk)->url($path);
    }

    public function delete( ?string $pathOrUrl, string $disk = 'public'): bool 
    {
        if (!$pathOrUrl) {
            return false;
        }

        // Nếu truyền vào là URL → convert về path
        $path = $this->getPathFromUrl($pathOrUrl, $disk);

        if (Storage::disk($disk)->exists($path)) {
            return Storage::disk($disk)->delete($path);
        }

        return false;
    }

    protected function getPathFromUrl(string $url, string $disk): string
    {
        $baseUrl = Storage::disk($disk)->url('');

        return str_replace($baseUrl, '', $url);
    }
}