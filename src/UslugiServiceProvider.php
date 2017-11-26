<?php
namespace Salador\Uslugi;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Orchid\Platform\Kernel\Dashboard;

class UslugiServiceProvider extends ServiceProvider
{
    protected $defer = false;
    /**
     * Boot the service provider.
     */
    public function boot()
    {
        //$this->loadViewsFrom(realpath(__DIR__.'/../resources/views'), 'salador/uslugi');
        $this->loadTranslationsFrom(realpath(__DIR__.'/../resources/lang'), 'salador/uslugi');  //Расположение языкового файла присваивается переменной 'salador/uslugi'
        $this->loadRoutesFrom(realpath(__DIR__.'/../routes/route.php'));
        $dashboard = $this->app->make(Dashboard::class);
        $dashboard->permission->registerPermissions([
            'Systems' => [[
                'slug'        => 'dashboard.systems.uslugi',
                'description' => trans('salador/uslugi::uslugi.Uslugi'),	//Перевод в каталоге расположения языкового файла::Название файла.Переменная
            ]],
        ]);
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