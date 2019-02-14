<?php

namespace OrlandoLibardi\FilesCms\app\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class FilesCmsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Rotas
        Route::namespace('OrlandoLibardi\FilesCms\app\Http\Controllers')
        ->middleware(['web', 'auth'])
        ->prefix('admin')
        ->group(__DIR__. '/../../routes/web.php');

        //registrar as views
        $this->loadViewsFrom( __DIR__.'/../../resources/views/admin/files/', 'viewFileCms');
        
        //publicar os arquivos
        $this->publishes([
            __DIR__.'/../../resources/views/admin/files/' => resource_path('views/admin/files'),
        ],'adminFiles');
        
        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
    }
}