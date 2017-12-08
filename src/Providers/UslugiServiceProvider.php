<?php
namespace Salador\Uslugi\Providers;
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
		$this->loadMigrationsFrom(realpath(__DIR__.'/../../database/migrations'));     //Расположение файлов миграции базы данных
        $this->loadViewsFrom(realpath(__DIR__.'/../../resources/views'), 'salador/uslugi');  //Алиас к файлам фасада
        $this->loadTranslationsFrom(realpath(__DIR__.'/../../resources/lang'), 'salador/uslugi');  //Расположение языкового файла присваивается переменной 'salador/uslugi'
        $this->loadRoutesFrom(realpath(__DIR__.'/../../routes/route.php'));  //Файл роутинга
		$this->publishes([__DIR__.'/../../config/uslugi.php' => config_path('uslugi.php'),]); //Публикация конфигурационного файла
		$this->mergeConfigFrom(__DIR__.'/../../config/uslugi.php', 'uslugi');   //Конфигурация по умолчанию - не пойму что это?
		
        $dashboard = $this->app->make(Dashboard::class);
		
		//Регистрация провайдера слушателя
		$this->app->register(EventServiceProvider::class);
		
		// Регистрируем доступы к услугам. Их нужно бдет включить в ролях полязователя
        $dashboard->permission->registerPermissions([      
            'Main' => [[
                'slug'        => 'dashboard.uslugi',
                'description' => trans('salador/uslugi::uslugi.Uslugi'),	//Перевод в каталоге расположения языкового файла::Название файла.Переменная
            ]],
			'Uslugi' => [
                [
                    'slug'        => 'dashboard.uslugi.services',
                    'description' => trans('salador/uslugi::uslugi.Uslugi'), 
				],
				[
                    'slug'        => 'dashboard.uslugi.masters',
                    'description' => trans('salador/uslugi::uslugi.Master.Title'), 
				],
				[
                    'slug'        => 'dashboard.uslugi.prices',
                    'description' => trans('salador/uslugi::uslugi.Price.Title'), 
				],
			],
        ]);   
		
		
		//Добавление пунктов меню dasboard.
		
        View::composer('dashboard::layouts.dashboard', function () use ($dashboard) {
			$dashboard->menu->add('Main', [
				'slug'       => 'Uslugi',
				'icon'       => 'icon-folder-alt',
				'route'      => route('dashboard.uslugi.services'),
				'label'      => trans('salador/uslugi::uslugi.Uslugi'),
				'childs'     => true,
				'main'       => true,
				'active'     => 'dashboard.uslugi.*',			
				'permission' => 'dashboard.uslugi.services',
				'sort'       => 5,
			]);
            $dashboard->menu->add('Uslugi', [
                'slug'       => 'services',
                'icon'       => 'fa fa-television',
                'route'      => route('dashboard.uslugi.services'),
                'label'      => trans('salador/uslugi::uslugi.Uslugi'),
				'groupname'  => trans('dashboard::menu.general settings'),
				'divider'    => false,
                'permission' => 'dashboard.uslugi.services',
                'sort'       => 11,
            ]);
			$dashboard->menu->add('Uslugi', [
                'slug'       => 'masters',
                'icon'       => 'icon-user',
                'route'      => route('dashboard.uslugi.masters'),
                'label'      => trans('salador/uslugi::uslugi.Master.Titles'),
				'divider'    => false,
                'permission' => 'dashboard.uslugi.masters',
                'sort'       => 12,
            ]);
			$dashboard->menu->add('Uslugi', [
                'slug'       => 'prices',
                'icon'       => 'fa fa-money',
                'route'      => route('dashboard.uslugi.prices'),
                'label'      => trans('salador/uslugi::uslugi.Price.Titles'),
				'divider'    => false,
                'permission' => 'dashboard.uslugi.prices',
                'sort'       => 13,
            ]);
        });
    }
	
	
	
	
}