<?php
namespace Salador\Uslugi;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Orchid\Platform\Kernel\Dashboard;

//При изменении выполнять команду - php artisan vendor:publish --provider="Salador\Uslugi\UslugiServiceProvider"

class UslugiServiceProvider extends ServiceProvider
{
    protected $defer = false;
    /**
     * Boot the service provider.
     */
    public function boot()
    {
        $this->loadViewsFrom(realpath(__DIR__.'/../resources/views'), 'salador/uslugi');  //Алиас к файлам фасада
        $this->loadTranslationsFrom(realpath(__DIR__.'/../resources/lang'), 'salador/uslugi');  //Расположение языкового файла присваивается переменной 'salador/uslugi'
        $this->loadRoutesFrom(realpath(__DIR__.'/../routes/route.php'));  //Файл роутинга
		$this->publishes([__DIR__.'/../config/uslugi.php' => config_path('uslugi.php'),]); //Публикация конфигурационного файла
		$this->mergeConfigFrom(__DIR__.'/../config/uslugi.php', 'uslugi');   //Конфигурация по умолчанию - не пойму что это?
		
        $dashboard = $this->app->make(Dashboard::class);
        $dashboard->permission->registerPermissions([      
            'Systems' => [[
                'slug'        => 'dashboard.systems.uslugi',
                'description' => trans('salador/uslugi::uslugi.Uslugi'),	//Перевод в каталоге расположения языкового файла::Название файла.Переменная
            ]],
        ]);   // Регистрируем доступ к услугам.
        View::composer('dashboard::layouts.dashboard', function () use ($dashboard) {
            $dashboard->menu->add('Systems', [
                'slug'       => 'uslugi',
                'icon'       => 'fa fa-television',
                'route'      => route('dashboard.systems.uslugi'),
                'label'      => trans('salador/uslugi::uslugi.Uslugi'),
                'permission' => 'dashboard.systems.uslugi',
                'sort'       => 502,
            ]);
        });
    }
}