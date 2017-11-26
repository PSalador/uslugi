<?php
Route::group([
    'middleware' => config('uslugi.middleware.private'),	//берем данные и config/uslugi.php
    'prefix'     => 'dashboard/systems',					//Префикс в урл который обрабатывать
    'namespace'  => 'Salador\Uslugi',					  	// Контроллеры будут в пространстве имён "App\Http\Controllers\Salador\Uslugi"
],
    function (\Illuminate\Routing\Router $router) {
        $router->get('uslugi', [							//скорее всего обрабатывать dashboard/systems/uslugi
            'as'   => 'dashboard.systems.uslugi',			//
            'uses' => 'UslugiController@index',				//Название контроллера src/UslugiController.php
        ]);
    });