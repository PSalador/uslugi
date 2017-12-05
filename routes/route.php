<?php
Route::group([
    'middleware' => config('uslugi.middleware.private'),	//берем данные и config/uslugi.php
    'prefix'     => 'dashboard/systems',					//Префикс в урл который обрабатывать
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
        $router->get('uslugi', [							//скорее всего обрабатывать dashboard/systems/uslugi
            'as'   => 'dashboard.uslugi',			//
            'uses' => 'UslugiController@index',				//Название контроллера src/UslugiController.php
        ]);
    });