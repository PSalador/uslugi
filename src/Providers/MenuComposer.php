<?php

namespace Salador\Uslugi\Providers;

use Orchid\Platform\Kernel\Dashboard;

use Salador\Uslugi\Models\Master;

class MenuComposer
{

    /**
     * MenuComposer constructor.
     *
     * @param Dashboard $dashboard
     */
    public function __construct(Dashboard $dashboard)
    {
        $this->menu = $dashboard->menu;
    }


    /**
     *
     */
    public function compose()
    {

			$this->menu->add('Main', [
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
            $this->menu->add('Uslugi', [
                'slug'       => 'services',
                'icon'       => 'fa fa-television',
                'route'      => route('dashboard.uslugi.services'),
                'label'      => trans('salador/uslugi::uslugi.Uslugi'),
				'groupname'  => trans('salador/uslugi::uslugi.MasterMenuGroup'),
				'divider'    => false,
                'permission' => 'dashboard.uslugi.services',
                'sort'       => 11,
            ]);
			$this->menu->add('Uslugi', [
                'slug'       => 'masters',
                'icon'       => 'icon-user',
                'route'      => route('dashboard.uslugi.masters'),
                'label'      => trans('salador/uslugi::uslugi.Master.Titles'),
				'divider'    => false,
                'permission' => 'dashboard.uslugi.masters',
                'sort'       => 12,
            ]);
			$this->menu->add('Uslugi', [
                'slug'       => 'prices',
                'icon'       => 'fa fa-money',
                'route'      => route('dashboard.uslugi.prices'),
                'label'      => trans('salador/uslugi::uslugi.Price.Titles'),
				'divider'    => true,
                'permission' => 'dashboard.uslugi.prices',
                'sort'       => 13,
            ]);
			$this->menu->add('Uslugi', [
                'slug'       => 'master',
                'icon'       => 'fa fa-television',
                'route'      => route('dashboard.uslugi.master.list'),
                'label'      => trans('salador/uslugi::uslugi.Master.Titles'),
				'groupname'  => trans('salador/uslugi::uslugi.AdminMenuGroup'),
				'divider'    => false,
                'permission' => 'dashboard.uslugi.services',
                'sort'       => 21,
				'badge'   => [
					'class'  => 'bg-dark',
					'data'	 => function () {
						return Master::count();
					},
				],
            ]);
			$this->menu->add('Uslugi', [
                'slug'       => 'typetran',
                'icon'       => 'fa fa-television',
                'route'      => route('dashboard.uslugi.typetran.list'),
                'label'      => trans('salador/uslugi::uslugi.Transactions.Title'),
				'divider'    => false,
                'permission' => 'dashboard.uslugi.services',
                'sort'       => 22,
            ]);		
			$this->menu->add('Uslugi', [
                'slug'       => 'advtype',
                'icon'       => 'fa fa-television',
                'route'      => route('dashboard.uslugi.advtype.list'),
                'label'      => trans('salador/uslugi::uslugi.Advert.TypeTitle'),
				'divider'    => false,
                'permission' => 'dashboard.uslugi.services',
                'sort'       => 23,
            ]);		
			$this->menu->add('Uslugi', [
                'slug'       => 'filter',
                'icon'       => 'fa fa-television',
                'route'      => route('dashboard.uslugi.filter.list'),
                'label'      => 'Filter',
				'groupname'  => 'Filter groupe',
				'divider'    => false,
                'permission' => 'dashboard.uslugi.services',
                'sort'       => 23,
            ]);		
			
	

	
			
			
			
			
			        $this->menu->add('Main', [
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


        $this->menu->add('Main', [
            'slug'   => 'Сustom',
            'icon'   => 'icon-drop',
            'route'  => '#',
            'label'  => 'Сustom',
            'childs' => true,
            'main'   => true,
            'sort'   => 6000,
        ]);

        $this->menu->add('Сustom', [
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


        $this->menu->add('Сustom', [
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

        $this->menu->add('Сustom', [
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

        $this->menu->add('Сustom', [
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


        $this->menu->add('Сustom', [
            'slug'      => 'Element5',
            'icon'      => 'icon-docs',
            'route'     => '#',
            'label'     => 'Element 5',
            'groupname' => 'Сustom group',
            'divider'   => true,
            'childs'    => true,
            'sort'      => 1,
        ]);

        $this->menu->add('Сustom', [
            'slug'    => 'Element7',
            'icon'    => 'icon-playlist',
            'route'   => '#',
            'label'   => 'Element 7',
            'divider' => true,
            'childs'  => false,
            'sort'    => 1,
        ]);

        $this->menu->add('Сustom', [
            'slug'    => 'Element8',
            'icon'    => 'icon-cup',
            'route'   => '#',
            'label'   => 'Element 8',
            'divider' => true,
            'childs'  => false,
            'sort'    => 1,
        ]);


        $this->menu->add('Element5', [
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
            $this->menu->add('Element5', [
                'slug'    => 'Element9.' . $i,
                'icon'    => 'icon-bulb',
                'route'   => '#',
                'label'   => 'Element 9.' . $i,
                'divider' => false,
                'childs'  => false,
                'sort'    => 1,
            ]);
        }

        $this->menu->add('Main', [
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

        $this->menu->add('Screen', [
            'slug'      => 'test-screen',
            'icon'      => 'icon-user-female',
            'route'     => '#',
            'label'     => 'Тестовый экран',
            'groupname' => 'Экраны',
            'divider'   => true,
            'childs'    => false,
            'sort'      => 1,
        ]);

        $this->menu->add('Screen', [
            'slug'      => 'news-screen',
            'icon'      => 'icon-event',
            'route'     => '#',
            'label'     => 'Новости',
            'groupname' => 'Экраны',
            'divider'   => true,
            'childs'    => false,
            'sort'      => 1,
        ]);

        $this->menu->add('Main', [
            'slug'   => 'vision-clinic',
            'icon'   => 'icon-chemistry',
            'active' => 'dashboard.clinic.*',
            'route'  => '#',
            'label'  => 'Vision Clinic',
            'childs' => true,
            'main'   => true,
            'sort'   => 6000,
        ]);

        $this->menu->add('vision-clinic', [
            'slug'   => 'vision-clinic-patient',
            'icon'   => 'icon-people',
            'active' => 'dashboard.clinic.*',
            'route'  => '#',
            'label'  => 'Patient List',
            'groupname' => 'Vision Clinic',

        ]);

        $this->menu->add('vision-clinic', [
            'slug'   => 'vision-clinic-product',
            'icon'   => 'icon-bag',
            'active' => 'dashboard.clinic.*',
            'route'  => '#',
            'label'  => 'Product List',
        ]);

        $this->menu->add('vision-clinic', [
            'slug'   => 'vision-clinic-invoice',
            'icon'   => 'icon-wallet',
            'active' => 'dashboard.clinic.*',
            'route'  => '#',
            'label'  => 'Invoice Screen',
        ]);
			

		
		
		
		
		
    }
}
