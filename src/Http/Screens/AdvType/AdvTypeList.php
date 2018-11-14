<?php

namespace Salador\Uslugi\Http\Screens\AdvType;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Notifications\Notification;
use Orchid\Platform\Core\Models\User;
use Orchid\Platform\Facades\Alert;
use Orchid\Platform\Notifications\DashboardNotification;

use Orchid\Platform\Screen\Screen;
use Orchid\Platform\Screen\Layouts;
use Orchid\Platform\Screen\Link;

use Salador\Uslugi\Models\AdvType;
use Salador\Uslugi\Http\Layouts\AdvType\AdvTypeListLayout;

class AdvTypeList extends Screen
{
    /**
     * Display header name
     *
     * @var string
     */
    public $name = 'AdvType List';

    /**
     * Display header description
     *
     * @var string
     */
    public $description = 'List all type Advertising';

    /**
     * Query data
     *
     * @return array
     */
    public function query() : array
    {
        return [
            'AdvType' => AdvType::paginate()
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
            Link::name('Create a new record')->method('create'),
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
            AdvTypeListLayout::class,
        ];
    }

    /**
     * @param Request $request
     *
     * @return null
     */
     public function create()
    {
        return redirect()->route('dashboard.uslugi.typetran.create');
    }
}