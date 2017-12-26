<?php

namespace Salador\Uslugi\Http\Screens\Demo;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Notifications\Notification;
use Orchid\Platform\Core\Models\User;
use Orchid\Platform\Facades\Alert;
use Orchid\Platform\Notifications\DashboardNotification;

use Orchid\Platform\Screen\Screen;
use Orchid\Platform\Screen\Layouts;
use Orchid\Platform\Screen\Link;

use Salador\Uslugi\Http\Layouts\Demo\TestRows;

class Demo extends Screen
{
    /**
     * Display header name
     *
     * @var string
     */
    public $name = 'Demo Screen';

    /**
     * Display header description
     *
     * @var string
     */
    public $description = 'Testing Screen Capabilities';

    /**
     * Query data
     *
     * @return array
     */
    public function query() : array
    {
        return [
            'user'  => User::find(1),
            'users' => User::paginate(),
        ];
    }

    /**
     * Button commands
     *
     * @return array
     */
    public function commandBar() : array
    {
        return [
            Link::name('Сохранить')->method('save'),
            Link::name('Вывести на печать')->method('create'),
            Link::name('Новая функция 1')->icon('fa fa-trash')->method('create'),
            Link::name('Новая функция 2')->method('create'),
            Link::name('Новая функция 3')->method('create'),
			Link::name('Модальное окно')
			->modal('CreateUserModal')
			->title('Добавить пользователя')
			->method('create'),
        ];
    }

    /**
     * Views
     *
     * @return array
     */
    public function layout() : array
    {
        return [
            Layouts::columns([
                'Колонка 1'  => [
                    TestRows::class,
                ],
                'Колонка 2' => [
                    TestRows::class,
                ],
                'Колонка 3' => [
                    Layouts::tabs([
                        'tab-1' => [
                            TestRows::class,
                        ],
                        'tab-2' => [
                            TestRows::class,
                        ],
                    ]),
                ]
            ]),
			Layouts::columns([
                'Колонка 1'  => [
                    TestRows::class,
                ],
                'Колонка 2' => [
                    TestRows::class,
                ],
			]),
        ];
    }

    /**
     * @param Request $request
     *
     * @return null
     */
    public function create()
    {
		
		Alert::info('Message');
		
		$user = Auth::user();
		$user->notify(new \Orchid\Platform\Notifications\DashboardNotification([
			'title' => 'Hello Word',
			'message' => 'New post for you on table!',
			'action' => '#',
			'type' => 'error',
		]));
		
		/*
		$user = Auth::user();
		$faker = \Faker\Factory::create();
		$user->notify(new DashboardNotification([
			'title'   => $faker->text(20),
			'message' => $faker->text(100),
			'action'  => 'https://google.com',
			'type'    => array_random([
				'info',
				'success',
				'warning',
				'error',
			]),
		]));
		*/
		
		return redirect()->route('dashboard.screens.demo.list');
		
        //return response(200);
    }

    /**
     * @param Request $request
     */
    public function save(Request $request)
    {
		Alert::info('Message');
        return response(200);
    }

}