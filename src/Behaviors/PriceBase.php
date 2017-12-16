<?php

namespace Salador\Uslugi\Behaviors;

class PriceBase
{

    /**
     * Rules Validation.
     *
     * @return array
     */
    public function rules() : array
    {
        return [];
    }

    /**
     * @return array
     */
    public function fields() : array
    {
		
        return [
		
		    'master'     => [
                'tag'         => 'select',
                'type'        => 'text',
                'name'        => 'master_id',
                'max'         => 255,
                'required'    => true,
                'title'       => trans('salador/uslugi::uslugi.Master.Title'),
                'placeholder' => trans('salador/uslugi::uslugi.Master.Title'),
				'novalue'	  => trans('salador/uslugi::uslugi.Select.novalue'),
            ],
		    'service'     => [
                'tag'         => 'select',
                'type'        => 'text',
                'name'        => 'services_id',
                'max'         => 255,
                'required'    => true,
                'title'       => trans('salador/uslugi::uslugi.Service'),
                'placeholder' => trans('salador/uslugi::uslugi.Service'),
				'novalue'	  => trans('salador/uslugi::uslugi.Select.novalue'),
			],
			
            'volume'     => [
                'tag'         => 'input',
                'type'        => 'text',
                'name'        => 'volume',
                'max'         => 255,
                'required'    => true,
                'title'       => trans('salador/uslugi::uslugi.Price.volume'),
                'placeholder' => trans('salador/uslugi::uslugi.Price.volume'),
            ],
            'price'    => [
                'tag'         => 'input',
                'type'        => 'text',
                'name'        => 'price',
				'max'         => 50,
                'required'    => true,
                'title'       => trans('salador/uslugi::uslugi.Price.price'),
                'placeholder' => trans('salador/uslugi::uslugi.Price.price'),
            ],
		];	
    }

    /**
     * Grid View for post type.
     */
    public function grid() : array
    {
        return [];
    }
}
