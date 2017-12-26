<?php

namespace Salador\Uslugi\Http\Screens\Master;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Notifications\Notification;
use Orchid\Platform\Core\Models\User;
use Orchid\Platform\Facades\Alert;
use Orchid\Platform\Notifications\DashboardNotification;

use Orchid\Platform\Screen\Screen;
use Orchid\Platform\Screen\Layouts;
use Orchid\Platform\Screen\Link;

use Salador\Uslugi\Models\Master;
use Salador\Uslugi\Http\Layouts\Master\MasterListLayout;

class MasterList extends Screen
{
    /**
     * Display header name
     *
     * @var string
     */
    public $name = 'Master List';

    /**
     * Display header description
     *
     * @var string
     */
    public $description = 'List all masters';

    /**
     * Query data
     *
     * @return array
     */
    public function query() : array
    {
		//dd(PackagePath);
        return [
            'masters' => Master::paginate()
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
            MasterListLayout::class,
        ];
    }

    /**
     * @param Request $request
     *
     * @return null
     */
     public function create()
    {
        return redirect()->route('dashboard.uslugi.master.create');
    }
}