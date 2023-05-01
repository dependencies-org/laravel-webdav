<?php

namespace Pbmedia\FilesystemProviders;

use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Filesystem;
use League\Flysystem\WebDAV\WebDAVAdapter;
use Sabre\DAV\Client as WebDAVClient;

class WebDAVServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Storage::extend('webdav', function ($app, $config) {
            $pathPrefix = array_key_exists('pathPrefix', $config) ? $config['pathPrefix'] : '';

            $adapter = new WebDAVAdapter(
                new WebDAVClient($config)
            );

            return new FilesystemAdapter(
                new Filesystem($adapter, $config),
                $adapter,
                $config,
            );
        });
    }

    public function register()
    {

    }
}
