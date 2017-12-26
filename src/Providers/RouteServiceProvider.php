<?php

namespace Salador\Uslugi\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use Orchid\Platform\Http\Middleware\AccessMiddleware;
use Orchid\Platform\Widget\WidgetContractInterface;

use Salador\Uslugi\Models\Master;
use Salador\Uslugi\Models\TypeTran;
use Salador\Uslugi\Models\Balance;
use Salador\Uslugi\Models\Lead;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Salador\Uslugi\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @internal param Router $router
     */
    public function boot()
    {
        Route::middlewareGroup('dashboard', [
            //Firewall::class,
            // RedirectInstall::class,
            AccessMiddleware::class,
        ]);

        $this->binding();

        parent::boot();
    }

    /**
     * Route binding.
     */
    public function binding()
    {
        Route::bind('master', function ($value) {
            //return Master::where('slug', $value)->firstOrFail();
			return Master::firstOrNew(['id'=>$value]);
        });
		Route::bind('typetran', function ($value) {
			return TypeTran::firstOrNew(['id'=>$value]);
        });
		Route::bind('balance', function ($value) {
			return Balance::firstOrNew(['id'=>$value]);
        });
		Route::bind('lead', function ($value) {
			return Lead::firstOrNew(['id'=>$value]);
        });
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        if (config('platform.headless')) {
            return null;
        }
		
        //foreach (glob('/../../routes/*/*.php') as $file) {
        /*   $this->loadRoutesFrom($file);
        }
		*/
		$this->loadRoutesFrom(realpath(__DIR__.'/../../routes/route.php'));  //Файл роутинга
    }
}
