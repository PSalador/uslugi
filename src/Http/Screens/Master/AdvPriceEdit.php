<?php
namespace Salador\Uslugi\Http\Screens\Master;

use Orchid\Platform\Facades\Alert;
use Orchid\Platform\Screen\Layouts;
use Orchid\Platform\Screen\Link;
use Orchid\Platform\Screen\Screen;

use Salador\Uslugi\Models\Master;
use Salador\Uslugi\Models\AdvType;
use Salador\Uslugi\Models\AdvPrice;


use Salador\Uslugi\Http\Requests\AdvPriceRequest;
use Salador\Uslugi\Http\Layouts\Master\EditAdvPriceLayout;



class AdvPriceEdit extends Screen
{
    /**
     * Display header name
     *
     * @var string
     */
    public $name = 'AdvPrice edit';

    /**
     * Display header description
     *
     * @var string
     */
    public $description = 'There is a record of the advprice';

    /**
     * Query data
     *
     * @param Balance $balance
     *
     * @return array
     */
    public function query($advprice = null) : array
    {
        //dump($balance);
		$advprice = is_null($advprice) ? new AdvPrice() : $advprice;
		$advtype = new AdvType;
		//dd($service->GetServices());
		//$this->attributes['services_id'] =$services->GetAll();
		
		
        return [
            'advprice'   => $advprice,
			'advtype'	=> $advtype->GetAllDefault($advprice->advtype_id),
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
                'EditAdvPrice' => [
                    EditAdvPriceLayout::class
                ],
            ]),
		
        ];
    }

    /**
     * @param Master $balance
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save($request, AdvPrice $advprice)
    {
        $advprice->fill($this->request->get('advprice'));
		$advprice->advtype_id = $this->request->advtype;
		//dd($balance);
		$advprice->save();
		
        Alert::info('AdvPrice was saved');

        return redirect()->route('dashboard.uslugi.master.edit', $this->request->get('advprice')['master_id']);
    }

    /**
     * @param Master $balance
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove($request, AdvPrice $advprice)
    {
        //dd($this->request);
		$advprice->delete();
        Alert::info('AdvPrice was removed');

        return redirect()->route('dashboard.uslugi.master.edit', $this->request->get('advprice')['master_id']);
    }

}