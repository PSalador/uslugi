<?php

namespace Salador\Uslugi\Http\Layouts\Master;

use Orchid\Platform\Layouts\Rows;

class EditBalanceLayout extends Rows
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
                'name'        => 'balance.master_id',
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
                'name'        => 'balance.money',
                'max'         => 255,
                'required'    => true,
                'title'       => trans('salador/uslugi::uslugi.Price.volume'),
                'placeholder' => trans('salador/uslugi::uslugi.Price.volume'),
            ],
            'desc' => [
                'tag'      => 'textarea',
                'name'     => 'balance.desc',
                "rows"      => 5,
                'required' => true,
                'title'       => trans('salador/uslugi::uslugi.Transactions.Title'),
                'placeholder' => trans('salador/uslugi::uslugi.Transactions.Title'),
                'help'     => 'What did the patient complain about?',
            ],
        ];
    }
}
