<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CloudStorageService
{
    protected $disk;

    public function __construct()
    {
        // Load driver from .env
        //$this->disk = Storage::disk(config('filesystems.default', env('STORAGE_DRIVER', 's3')));

    }

    /**
     * Upload file
     */
    public function upload($path, $file)
    {
        return $this->disk->put($path, $file);
    }

    /**
     * Upload a single file and return details
     */
    public function uploadWithDetails($folder, $file)
    {
        $extension = $file->getClientOriginalExtension();
        $filename = md5($file->getClientOriginalName() . time() . Str::random(10)) . '.' . $extension;
        $path = $folder . '/' . $filename;

        // $this->disk->putFileAs($folder, $file, $filename);
        Storage::disk('azure')->putFileAs($folder, $file, $filename);

        // Get file contents to read image details
        $tempPath = $file->getRealPath();
        return [
            'file_name' => $filename,
            'folder_path' => $path,
            'full_url' => $this->getUrl($path),
            'size_bytes' => $file->getSize(),
            'mime_type' => $file->getMimeType(),
        ];
    }

    /**
     * Upload and keep original filename
     */
    public function uploadWithOriginalName($folder, $file)
    {
        $filename = $file->getClientOriginalName();
        $path = $folder . '/' . $filename;

        $this->disk->putFileAs($folder, $file, $filename);

        return $path;
    }


    public function uploadMultipleWithOriginalNames($folder, $files)
    {
        $paths = [];

        foreach ($files as $file) {
            $filename = $file->getClientOriginalName();
            $path = $folder . '/' . $filename;

            $this->disk->putFileAs($folder, $file, $filename);

            $paths[] = $path;
        }

        return $paths;
    }

    public function uploadEncrypted($folder, $file)
    {
        // Get original extension
        $extension = $file->getClientOriginalExtension();
        // Generate encrypted/hashed filename
        $filename = md5($file->getClientOriginalName() . time()) . '.' . $extension;
        // Full path with folder (folder auto-created by Azure)
        $path = $folder . '/' . $filename;

        // Upload with new encrypted filename
        $this->disk->putFileAs($folder, $file, $filename);

        return $path;
    }

    public function uploadMultipleEncrypted($folder, $files)
    {
        $paths = [];
        foreach ($files as $file) {
            // Storage::disk('azure')->putFileAs($folder, $file, $filename);
            $paths[] = $this->uploadWithDetails($folder, $file);
        }
        // $paths now contains full URLs for all uploaded files
        return $paths;
    }

    /**
     * Generate full public URL for a file in Azure Blob Storage.
     *
     * @param string $path  // e.g., 'images_gallery/file.jpg'
     * @return string
     */
    public function getUrl(string $path): string
    {
        $disk = config('filesystems.disks.azure');
        $accountName = $disk['name'];
        $container = $disk['container'];

        return "https://{$accountName}.blob.core.windows.net/{$container}/{$path}";
    }

    /**
     * Get file URL (public containers/buckets)
     */
    public function url($path)
    {
        return $this->disk->url($path);
    }

    /**
     * Delete a file
     */
    public function delete($path)
    {
        return $this->disk->delete($path);
    }

    /**
     * Generate temporary signed URL (works with S3 and Azure if supported)
     */
    public function temporaryUrl($path, $expiryMinutes = 10)
    {
        if (method_exists($this->disk, 'temporaryUrl')) {
            return $this->disk->temporaryUrl($path, now()->addMinutes($expiryMinutes));
        }

        // Fallback: just return normal URL
        return $this->url($path);
    }
}
