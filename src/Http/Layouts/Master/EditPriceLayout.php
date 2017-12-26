<?php

namespace Salador\Uslugi\Http\Layouts\Master;

use Orchid\Platform\Layouts\Rows;

class EditPriceLayout extends Rows
{
    /**
     * Views
     *
     * @return array
     */
    public function fields(): array
    {
        return [
		    'service'     => [
                'tag'         => 'select',
                'type'        => 'text',
                'name'        => 'services',
                'max'         => 255,
                'required'    => true,
                'title'       => trans('salador/uslugi::uslugi.Service'),
                'placeholder' => trans('salador/uslugi::uslugi.Service'),
				'novalue'	  => trans('salador/uslugi::uslugi.Select.novalue'),
			],
			
            'volume'     => [
                'tag'         => 'input',
                'type'        => 'text',
                'name'        => 'price.volume',
                'max'         => 255,
                'required'    => true,
                'title'       => trans('salador/uslugi::uslugi.Price.volume'),
                'placeholder' => trans('salador/uslugi::uslugi.Price.volume'),
            ],
            'price'    => [
                'tag'         => 'input',
                'type'        => 'text',
                'name'        => 'price.price',
				'max'         => 50,
                'required'    => true,
                'title'       => trans('salador/uslugi::uslugi.Price.price'),
                'placeholder' => trans('salador/uslugi::uslugi.Price.price'),
            ],
        ];
    }
}
