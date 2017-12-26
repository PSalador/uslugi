<?php
 
namespace Salador\Uslugi\Http\Layouts\Master;

use Orchid\Platform\Layouts\Table;

class MasterPricesLayout extends Table
{

    /**
     * @var string
     */
    public $data = 'prices';

    /**
     * @return array
     */
    public function fields() : array
    {
		
        return [
            //'service-name' => 'Service',
            //'service-name' => 'Service',
			'service-name'  => [
                'name'   => 'Service',
                'action' => function ($price) {
					//dump($price->service()->first()->name);
                    return '<a href="' . route('dashboard.uslugi.prices.edit',
                            $price->id) . '">' . $price->service()->first()->name . '</a>';
                },
            ],
            'volume.service-measure' => 'Volume',
            'price'     => 'Price',
        ];
    }
}