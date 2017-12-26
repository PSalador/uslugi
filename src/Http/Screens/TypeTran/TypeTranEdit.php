<?php

namespace Salador\Uslugi\Http\Screens\TypeTran;


use Orchid\Platform\Facades\Alert;
use Orchid\Platform\Screen\Layouts;
use Orchid\Platform\Screen\Link;
use Orchid\Platform\Screen\Screen;

use Salador\Uslugi\Models\TypeTran;

use Salador\Uslugi\Http\Layouts\TypeTran\TypeTranEditLayout;



class TypeTranEdit extends Screen
{
    /**
     * Display header name
     *
     * @var string
     */
    public $name = 'TypeTran card';

    /**
     * Display header description
     *
     * @var string
     */
    public $description = 'There is a record of the TypeTran';

    /**
     * Query data
     *
     * @param TypeTran $typetran
     *
     * @return array
     */
    public function query($typetran = null) : array
    {
        //dump($typetran);
		$typetran = is_null($typetran) ? new TypeTran() : $typetran;
	
        return [
            'typetran'    => $typetran,
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
            Link::name('Save')->method('save'),
            Link::name('Remove')->method('remove'),
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
                'TypeTran' => [
                    TypeTranEditLayout::class
                ],
            ]),
        ];
    }

    /**
     * @param TypeTran $typetran
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save($request, TypeTran $typetran)
    {
		//dd($typetran);
        $typetran->fill($this->request->get('typetran'))->save();
        Alert::info('TypeTran was saved');

        return redirect()->route('dashboard.uslugi.typetran.list');
    }

    /**
     * @param TypeTran $typetran
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(TypeTran $typetran)
    {
        $typetran->delete();
        Alert::info('TypeTran was removed');

        return redirect()->route('dashboard.uslugi.typetran.list');
    }

}
