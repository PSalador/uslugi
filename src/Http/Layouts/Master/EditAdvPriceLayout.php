<?php

namespace Salador\Uslugi\Http\Layouts\Master;

use Orchid\Platform\Layouts\Rows;

class EditAdvPriceLayout extends Rows
{
    /**
     * Views
     *
     * @return array
     */
    public function fields(): array
    {
        return [
		
		    'master_id'     => [
                'tag'         => 'input',
                'type'        => 'hidden',
                'name'        => 'advprice.master_id',
            ],
		    'advtype'     => [
                'tag'         => 'select',
                'type'        => 'text',
                'name'        => 'advtype',
                'max'         => 255,
                'required'    => true,
                'title'       => trans('salador/uslugi::uslugi.Service'),
                'placeholder' => trans('salador/uslugi::uslugi.Service'),
				'novalue'	  => trans('salador/uslugi::uslugi.Select.novalue'),
			],
			
            'price'     => [
                'tag'         => 'input',
                'type'        => 'text',
                'name'        => 'advprice.price',
                'max'         => 255,
                'required'    => true,
                'title'       => trans('salador/uslugi::uslugi.Price.volume'),
                'placeholder' => trans('salador/uslugi::uslugi.Price.volume'),
            ],
        ];
    }
}
