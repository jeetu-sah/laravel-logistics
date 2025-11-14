<?php

namespace App\Providers;

use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Filesystem;
use MicrosoftAzure\Storage\Blob\BlobRestProxy;

class AzureStorageServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        Storage::extend('azure-blob-storage', function ($app, $config) {
            $connectionString = "DefaultEndpointsProtocol=https;AccountName={$config['name']};AccountKey={$config['key']};EndpointSuffix=core.windows.net";
            $client = BlobRestProxy::createBlobService($connectionString);
            $adapter = new \League\Flysystem\AzureBlobStorage\AzureBlobStorageAdapter(
                $client,
                $config['container']
            );
            return new FilesystemAdapter(
                new Filesystem($adapter, $config),
                $adapter,
                $config
            );
        });
    }
}