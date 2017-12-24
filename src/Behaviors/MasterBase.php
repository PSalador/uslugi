<?php

namespace Salador\Uslugi\Behaviors;



class MasterBase
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

			
		//dd($selusers);
		
        return [
		
		    'user'     => [
                'tag'         => 'select',
                'type'        => 'text',
                'name'        => 'user_id',
                'max'         => 255,
                'required'    => true,
                'title'       => trans('salador/uslugi::uslugi.Master.user'),
                'placeholder' => trans('salador/uslugi::uslugi.Master.user'),
				'novalue'	  => trans('salador/uslugi::uslugi.Select.novalue'),
            ],
			
            'name'     => [
                'tag'         => 'input',
                'type'        => 'text',
                'name'        => 'name',
                'max'         => 255,
                'required'    => true,
                'title'       => trans('salador/uslugi::uslugi.Master.Title'),
                'placeholder' => trans('salador/uslugi::uslugi.Master.Title'),
            ],
            'adress'    => [
                'tag'         => 'place',
                'type'        => 'json',
                'name'        => 'adress',
				'max'         => 255,
                'required'    => true,
                'title'       => trans('salador/uslugi::uslugi.Master.adress'),
                'placeholder' => trans('salador/uslugi::uslugi.Master.adress'),
            ],
			'phone'    => [
                'tag'         => 'input',
                'type'        => 'text',
                'name'        => 'phone',
				'max'         => 255,
                'required'    => true,
                'title'       => trans('salador/uslugi::uslugi.Master.phone'),
                'placeholder' => trans('salador/uslugi::uslugi.Master.phone'),
            ],
			'email'    => [
                'tag'         => 'input',
                'type'        => 'email',
                'name'        => 'email',
                'required'    => true,
                'title'       => trans('salador/uslugi::uslugi.Master.email'),
                'placeholder' => trans('salador/uslugi::uslugi.Master.email'),
            ],
			/*
			'location'    => [
                'tag'         	=> 'place',
                'type'        	=> 'text',
                'name'        	=> 'location',
                //'prefix'       	=> 'locadress',
                'title'       	=> trans('salador/uslugi::uslugi.Master.location'),
                'placeholder' 	=> trans('salador/uslugi::uslugi.Master.location'),
            ],
			*/
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
