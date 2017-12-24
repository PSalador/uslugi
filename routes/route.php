<?php
Route::group([
    'middleware' => config('uslugi.middleware.private'),	//берем данные и config/uslugi.php
    'prefix'     => 'dashboard/uslugi',					//Префикс в урл который обрабатывать
    'namespace'  => 'Salador\Uslugi\Http\Controllers',					  	// Контроллеры будут в пространстве имён "App\Http\Controllers\Salador\Uslugi"
],
    function (\Illuminate\Routing\Router $router) {
		$router->resource('services', 'ServiceController', [
            'names' => [
                'index'   => 'dashboard.uslugi.services',
                'create'  => 'dashboard.uslugi.services.create',
                'edit'    => 'dashboard.uslugi.services.edit',
                'update'  => 'dashboard.uslugi.services.update',
                'store'   => 'dashboard.uslugi.services.store',
                'destroy' => 'dashboard.uslugi.services.destroy',
            ],
        ]);
		$router->resource('masters', 'MasterController', [
            'names' => [
                'index'   => 'dashboard.uslugi.masters',
                'create'  => 'dashboard.uslugi.masters.create',
                'edit'    => 'dashboard.uslugi.masters.edit',
                'update'  => 'dashboard.uslugi.masters.update',
                'store'   => 'dashboard.uslugi.masters.store',
                'destroy' => 'dashboard.uslugi.masters.destroy',
            ],
        ]);
		$router->resource('prices', 'PriceController', [
            'names' => [
                'index'   => 'dashboard.uslugi.prices',
                'create'  => 'dashboard.uslugi.prices.create',
                'edit'    => 'dashboard.uslugi.prices.edit',
                'update'  => 'dashboard.uslugi.prices.update',
                'store'   => 'dashboard.uslugi.prices.store',
                'destroy' => 'dashboard.uslugi.prices.destroy',
            ],
        ]);
        $router->get('uslugi', [							//скорее всего обрабатывать dashboard/systems/uslugi
            'as'   => 'dashboard.uslugi',			//
            'uses' => 'UslugiController@index',				//Название контроллера src/UslugiController.php
        ]);
    });