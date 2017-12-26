<?php

namespace Salador\Uslugi\Http\Layouts\Master;

use Orchid\Platform\Layouts\Rows;

class EditLeadLayout extends Rows
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
                'name'        => 'lead.master_id',
            ],
		    'typetrans'     => [
                'tag'         => 'select',
                'type'        => 'text',
                'name'        => 'typetrans',
                'max'         => 255,
                'required'    => true,
                'title'       => trans('salador/uslugi::uslugi.Service'),
                'placeholder' => trans('salador/uslugi::uslugi.Service'),
				'novalue'	  => trans('salador/uslugi::uslugi.Select.novalue'),
			],
			
            'money'     => [
                'tag'         => 'input',
                'type'        => 'text',
                'name'        => 'lead.money',
                'max'         => 255,
                'required'    => true,
                'title'       => trans('salador/uslugi::uslugi.Price.volume'),
                'placeholder' => trans('salador/uslugi::uslugi.Price.volume'),
            ],
            'field' => [
                'tag'         => 'input',
                'type'        => 'text',
                'name'     	  => 'lead.field',
                'required'    => true,
                'title'       => trans('salador/uslugi::uslugi.Transactions.Title'),
                'placeholder' => trans('salador/uslugi::uslugi.Transactions.Title'),
            ],
        ];
    }
}
