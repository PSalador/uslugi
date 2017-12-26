<?php

namespace Salador\Uslugi\Http\Layouts\TypeTran;

use Orchid\Platform\Layouts\Rows;

class TypeTranEditLayout extends Rows
{
    /**
     * @return array
     */
    public function fields() : array
    {
        return [
            'name'     => [
                'tag'         => 'input',
                'type'        => 'text',
                'name'        => 'typetran.name',
                'max'         => 255,
                'required'    => true,
                'title'       => trans('salador/uslugi::uslugi.Transactions.Title'),
                'placeholder' => trans('salador/uslugi::uslugi.Transactions.Title'),
            ],
			
            'plus'     => [
                'tag'         => 'checkbox',
                'name'        => 'typetran.plus',
                'max'         => 255,
                'required'    => true,
                'title'       => trans('salador/uslugi::uslugi.Transactions.Title'),
                'placeholder' => trans('salador/uslugi::uslugi.Transactions.Title'),
				'default' 	  => 0,
            ],
            'desc' => [
                'tag'      => 'textarea',
                'name'     => 'typetran.desc',
                "rows"      => 5,
                'required' => true,
                'title'       => trans('salador/uslugi::uslugi.Transactions.Title'),
                'placeholder' => trans('salador/uslugi::uslugi.Transactions.Title'),
                'help'     => 'What did the patient complain about?',
            ],
        ];
    }

}

