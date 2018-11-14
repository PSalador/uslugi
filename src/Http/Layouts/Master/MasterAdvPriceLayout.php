<?php
 
namespace Salador\Uslugi\Http\Layouts\Master;

use Orchid\Platform\Layouts\Table;

class MasterAdvPriceLayout extends Table
{

    /**
     * @var string
     */
    public $data = 'advprices';

    /**
     * @return array
     */
    public function fields() : array
    {
		
        return [
            //'service-name' => 'Service',
            //'service-name' => 'Service',
			'advtype-name'  => [
                'name'   => 'advtype',
                'action' => function ($advprices) {
					//dump($price->service()->first()->name);
                    return '<a href="' . route('dashboard.uslugi.master.advprice',
                            $advprices->id) . '">' . $advprices->advtype()->first()->name . '</a>';
                },
            ],
            'price' 	=> 'Price',
        ];
    }
}