<?php

namespace Salador\Uslugi\Http\Layouts\Master;

use Orchid\Platform\Layouts\Rows;

class MasterProfileLayout extends Rows
{
    /**
     * @return array
     */
    public function fields() : array
    {
        return [
 		    'user'     => [
                'tag'         => 'select',
                'type'        => 'text',
                'name'        => 'master.user_id',
                'max'         => 255,
                'required'    => true,
                'title'       => trans('salador/uslugi::uslugi.Master.user'),
                'placeholder' => trans('salador/uslugi::uslugi.Master.user'),
				'novalue'	  => trans('salador/uslugi::uslugi.Select.novalue'),
            ],
			
            'name'     => [
                'tag'         => 'input',
                'type'        => 'text',
                'name'        => 'master.name',
                'max'         => 255,
                'required'    => true,
                'title'       => trans('salador/uslugi::uslugi.Master.Title'),
                'placeholder' => trans('salador/uslugi::uslugi.Master.Title'),
            ],
            'adress'    => [
                'tag'         => 'place',
                'type'        => 'array',
                'name'        => 'master.adress',
				'max'         => 255,
                'required'    => true,
                'title'       => trans('salador/uslugi::uslugi.Master.adress'),
                'placeholder' => trans('salador/uslugi::uslugi.Master.adress'),
            ],
			'phone'    => [
                'tag'         => 'input',
                'type'        => 'text',
                'name'        => 'master.phone',
				'max'         => 255,
                'required'    => true,
                'title'       => trans('salador/uslugi::uslugi.Master.phone'),
                'placeholder' => trans('salador/uslugi::uslugi.Master.phone'),
            ],
			'email'    => [
                'tag'         => 'input',
                'type'        => 'email',
                'name'        => 'master.email',
                'required'    => true,
                'title'       => trans('salador/uslugi::uslugi.Master.email'),
                'placeholder' => trans('salador/uslugi::uslugi.Master.email'),
            ],
        ];
    }

}

