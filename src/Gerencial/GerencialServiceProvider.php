<?php 

namespace Manzoli2122\Salao\Gerencial;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class GerencialServiceProvider extends ServiceProvider
{

 
    protected $defer = false;
    protected $namespace = 'Manzoli2122\Salao\Gerencial\Http\Controllers'  ;
    
    public function boot()
    {
        // Publish config files
        $this->publishes([
            __DIR__.'/../config/config.php' =>  config_path('gerencial.php'), 
        ], 'gerencial_config');
        $this->mapWebRoutes();     
        $this->loadViewsFrom(__DIR__.'/Views', 'gerencial');
    }


    private function mapWebRoutes()
    {                
        Route::middleware('web')
                ->namespace($this->namespace)
                ->group(__DIR__.'/Http/routes.php');
    }



    public function register()
    {
       
        $this->mergeConfig();
    }


   

    private function mergeConfig()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'gerencial'
        );
    }

   



   
}

