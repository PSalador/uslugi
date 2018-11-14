<?php

namespace Salador\Uslugi\Http\Layouts\Filter;

//use Orchid\Platform\Layouts\Rows;
use  Salador\Uslugi\Layouts\Cols;

class FilterSearchLayout extends Cols
{
    /**
     * Views
     *
     * @return array
     */
    public function fields(): array
    {
        return [
		
            'search'     => [
                'tag'         => 'input',
                'type'        => 'text',
                'name'        => 'search.text',
                'max'         => 255,
                'required'    => true,
				'value'		  =>'Filter',
                'title'       => trans('salador/uslugi::uslugi.Price.volume'),
                'placeholder' => trans('salador/uslugi::uslugi.Price.volume'),
            ],
			'price'     => [
                'tag'         => 'input',
                'type'        => 'text',
                'name'        => 'search.price',
                'max'         => 255,
                'required'    => true,
                'title'       => trans('salador/uslugi::uslugi.Price.volume'),
                'placeholder' => trans('salador/uslugi::uslugi.Price.volume'),
            ],
			
			'submit'     => [
                'tag'         => 'input',
                'type'        => 'submit',
                'name'        => 'search.submit',
                'max'         => 255,
                'required'    => true,
				'value'		  =>'Filter',
                'title'       => trans('salador/uslugi::uslugi.Price.volume'),
                'placeholder' => trans('salador/uslugi::uslugi.Price.volume'),
            ],

        ];
    }
}
