<?php

namespace Salador\Uslugi\Http\Screens\AdvType;


use Orchid\Platform\Facades\Alert;
use Orchid\Platform\Screen\Layouts;
use Orchid\Platform\Screen\Link;
use Orchid\Platform\Screen\Screen;

use Salador\Uslugi\Models\AdvType;

use Salador\Uslugi\Http\Layouts\AdvType\AdvTypeEditLayout;



class AdvTypeEdit extends Screen
{
    /**
     * Display header name
     *
     * @var string
     */
    public $name = 'AdvType card';

    /**
     * Display header description
     *
     * @var string
     */
    public $description = 'There is a record of the AdvType';

    /**
     * Query data
     *
     * @param AdvType $advtype
     *
     * @return array
     */
    public function query($advtype = null) : array
    {
        //dump($advtype);
		$advtype = is_null($advtype) ? new AdvType() : $advtype;
	
        return [
            'advtype'    => $advtype,
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
                'AdvType' => [
                    AdvTypeEditLayout::class
                ],
            ]),
        ];
    }

    /**
     * @param AdvType $advtype
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save($request, AdvType $advtype)
    {
		//dd($advtype);
        $advtype->fill($this->request->get('advtype'))->save();
        Alert::info('AdvType was saved');

        return redirect()->route('dashboard.uslugi.advtype.list');
    }

    /**
     * @param AdvType $advtype
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(AdvType $advtype)
    {
        $advtype->delete();
        Alert::info('AdvType was removed');

        return redirect()->route('dashboard.uslugi.advtype.list');
    }

}
