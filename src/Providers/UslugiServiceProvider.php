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
	    //Регистрация провайдера слушателя
		
		$this->app->register(EventServiceProvider::class);
		$this->app->register(RouteServiceProvider::class);

		$this->loadMigrationsFrom(realpath(__DIR__.'/../../database/migrations'));     //Расположение файлов миграции базы данных
        $this->loadViewsFrom(realpath(__DIR__.'/../../resources/views'), 'salador/uslugi');  //Алиас к файлам фасада
        $this->loadTranslationsFrom(realpath(__DIR__.'/../../resources/lang'), 'salador/uslugi');  //Расположение языкового файла присваивается переменной 'salador/uslugi'
		$this->publishes([__DIR__.'/../../config/uslugi.php' => config_path('uslugi.php'),]); //Публикация конфигурационного файла
		$this->mergeConfigFrom(__DIR__.'/../../config/uslugi.php', 'uslugi');   //Конфигурация по умолчанию - не пойму что это?
		
        $dashboard = $this->app->make(Dashboard::class);
		

		
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
		View::composer('dashboard::layouts.dashboard', MenuComposer::class);
		/*
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
				'groupname'  => trans('salador/uslugi::uslugi.MasterMenuGroup'),
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
			$dashboard->menu->add('Uslugi', [
                'slug'       => 'balance',
                'icon'       => 'fa fa-television',
                'route'      => route('dashboard.uslugi.master.list'),
                'label'      => trans('salador/uslugi::uslugi.Balance.Title'),
				'groupname'  => trans('salador/uslugi::uslugi.AdminMenuGroup'),
				'divider'    => false,
                'permission' => 'dashboard.uslugi.services',
                'sort'       => 21,
            ]);
			
			
			
			
			
			
			
			
			        $dashboard->menu->add('Main', [
            'slug'       => 'Systems',
            'icon'       => 'icon-user-female',
            'route'      => '#',
            'label'      => trans('dashboard::menu.systems'),
            'childs'     => true,
            'main'       => true,
            'active'     => 'dashboard.systems.*',
            'permission' => 'dashboard.systems',
            'sort'       => 1000,
        ]);


        $dashboard->menu->add('Main', [
            'slug'   => 'Сustom',
            'icon'   => 'icon-drop',
            'route'  => '#',
            'label'  => 'Сustom',
            'childs' => true,
            'main'   => true,
            'sort'   => 6000,
        ]);

        $dashboard->menu->add('Сustom', [
            'slug'      => 'Element',
            'icon'      => 'icon-user-female',
            'route'     => '#',
            'label'     => 'Element 1',
            'groupname' => 'Сustom group',
            'divider'   => false,
            'childs'    => false,
            'sort'      => 1,
            'badge'     => [
                'class' => 'bg-dark',
                'data'  => function () {
                    return 9;
                },
            ],
        ]);


        $dashboard->menu->add('Сustom', [
            'slug'    => 'Element2',
            'icon'    => 'icon-location-pin',
            'route'   => '#',
            'label'   => 'Element 2',
            'divider' => false,
            'childs'  => false,
            'sort'    => 1,
            'badge'   => [
                'class' => 'bg-primary',
                'data'  => function () {
                    return 1;
                },
            ],
        ]);

        $dashboard->menu->add('Сustom', [
            'slug'    => 'Element3',
            'icon'    => 'icon-energy',
            'route'   => '#',
            'label'   => 'Element 3',
            'divider' => false,
            'badge'   => [
                'class' => 'bg-danger',
                'data'  => function () {
                    return 2;
                },
            ],
            'childs'  => false,
            'sort'    => 1,
        ]);

        $dashboard->menu->add('Сustom', [
            'slug'    => 'Element4',
            'icon'    => 'icon-playlist',
            'route'   => '#',
            'label'   => 'Element 4',
            'divider' => true,
            'childs'  => false,
            'sort'    => 1,
            'badge'   => [
                'class' => 'bg-info',
                'data'  => function () {
                    return 5;
                },
            ],
        ]);


        $dashboard->menu->add('Сustom', [
            'slug'      => 'Element5',
            'icon'      => 'icon-docs',
            'route'     => '#',
            'label'     => 'Element 5',
            'groupname' => 'Сustom group',
            'divider'   => true,
            'childs'    => true,
            'sort'      => 1,
        ]);

        $dashboard->menu->add('Сustom', [
            'slug'    => 'Element7',
            'icon'    => 'icon-playlist',
            'route'   => '#',
            'label'   => 'Element 7',
            'divider' => true,
            'childs'  => false,
            'sort'    => 1,
        ]);

        $dashboard->menu->add('Сustom', [
            'slug'    => 'Element8',
            'icon'    => 'icon-cup',
            'route'   => '#',
            'label'   => 'Element 8',
            'divider' => true,
            'childs'  => false,
            'sort'    => 1,
        ]);


        $dashboard->menu->add('Element5', [
            'slug'      => 'Element9.1',
            'icon'      => 'icon-user-female',
            'route'     => '#',
            'label'     => 'Element 9.1',
            'groupname' => 'Сustom group',
            'divider'   => true,
            'childs'    => false,
            'sort'      => 1,
        ]);

        for ($i = 2; $i < 15; $i++) {
            $dashboard->menu->add('Element5', [
                'slug'    => 'Element9.' . $i,
                'icon'    => 'icon-bulb',
                'route'   => '#',
                'label'   => 'Element 9.' . $i,
                'divider' => false,
                'childs'  => false,
                'sort'    => 1,
            ]);
        }

        $dashboard->menu->add('Main', [
            'slug'   => 'Screen',
            'icon'   => 'icon-organization',
            'active' => 'dashboard.screens.*',
            'route'  => '#',
            'label'  => 'Экраны',
            'childs' => true,
            'main'   => true,
            'sort'   => 6000,
            'badge'   => [
                'class' => 'bg-info',
                'data'  => function () {
                    return 5;
                },
            ],
        ]);

        $dashboard->menu->add('Screen', [
            'slug'      => 'test-screen',
            'icon'      => 'icon-user-female',
            'route'     => '#',
            'label'     => 'Тестовый экран',
            'groupname' => 'Экраны',
            'divider'   => true,
            'childs'    => false,
            'sort'      => 1,
        ]);

        $dashboard->menu->add('Screen', [
            'slug'      => 'news-screen',
            'icon'      => 'icon-event',
            'route'     => '#',
            'label'     => 'Новости',
            'groupname' => 'Экраны',
            'divider'   => true,
            'childs'    => false,
            'sort'      => 1,
        ]);

        $dashboard->menu->add('Main', [
            'slug'   => 'vision-clinic',
            'icon'   => 'icon-chemistry',
            'active' => 'dashboard.clinic.*',
            'route'  => '#',
            'label'  => 'Vision Clinic',
            'childs' => true,
            'main'   => true,
            'sort'   => 6000,
        ]);

        $dashboard->menu->add('vision-clinic', [
            'slug'   => 'vision-clinic-patient',
            'icon'   => 'icon-people',
            'active' => 'dashboard.clinic.*',
            'route'  => '#',
            'label'  => 'Patient List',
            'groupname' => 'Vision Clinic',

        ]);

        $dashboard->menu->add('vision-clinic', [
            'slug'   => 'vision-clinic-product',
            'icon'   => 'icon-bag',
            'active' => 'dashboard.clinic.*',
            'route'  => '#',
            'label'  => 'Product List',
        ]);

        $dashboard->menu->add('vision-clinic', [
            'slug'   => 'vision-clinic-invoice',
            'icon'   => 'icon-wallet',
            'active' => 'dashboard.clinic.*',
            'route'  => '#',
            'label'  => 'Invoice Screen',
        ]);
			
			
        });
		
		*/
    }
	
	
	
	
}