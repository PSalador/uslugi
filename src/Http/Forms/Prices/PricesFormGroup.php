<?php
namespace Salador\Uslugi\Http\Forms\Prices;


use Illuminate\Contracts\View\View;
use Orchid\Platform\Forms\FormGroup;
use Orchid\Platform\Forms\Form;

use Salador\Uslugi\Events\PriceEvent;
use Salador\Uslugi\Models\Price;

use Salador\Uslugi\Models\Master as Master;
use Salador\Uslugi\Models\Service as Service;


class PricesFormGroup extends FormGroup
{
	
	public $event = PriceEvent::class;
    /**
     * @var string
     */
    //public $name = 'Service';
	//public $name = 'Service';

    /**
     * Base Model.
     *
     * @var
     */
    //protected $model = Service::class;
	//protected $model;

	
    /**
     * Description Attributes for group.
     *
     * @return array
     */
    public function attributes() : array
    {
        return [
            'name'        => trans('salador/uslugi::uslugi.Price.Title'),
            'description' => trans('salador/uslugi::uslugi.Price.description'),
        ];
    }
    /**
     * @return \Illuminate\Contracts\View\Factory|View|\Illuminate\View\View
     */

    public function main() : View
    {
		
		$price = \Salador\Uslugi\Behaviors\PriceBase::class;
        $price = (new $price);
		$ArrPrices =Price::with(['Master','Service'])->paginate();
		//dd($ArrPrices);
		return view('salador/uslugi::prices.grid', [
            'services' => $ArrPrices,
            'grid'  => $price->grid(),
        ]);
    }
}