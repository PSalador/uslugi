<?php

namespace Salador\Uslugi\Http\Layouts\AdvType;

use Orchid\Platform\Layouts\Rows;

class AdvTypeEditLayout extends Rows
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
                'name'        => 'advtype.name',
                'max'         => 255,
                'required'    => true,
                'title'       => trans('salador/uslugi::uslugi.Transactions.Title'),
                'placeholder' => trans('salador/uslugi::uslugi.Transactions.Title'),
            ],
			
            'class'     => [
                'tag'         => 'input',
                'type'        => 'text',
                'name'        => 'advtype.class',
                'max'         => 255,
                'required'    => true,
                'title'       => trans('salador/uslugi::uslugi.Transactions.Title'),
                'placeholder' => trans('salador/uslugi::uslugi.Transactions.Title'),
            ],
            'desc' => [
                'tag'      => 'textarea',
                'name'     => 'advtype.desc',
                "rows"      => 5,
                'required' => true,
                'title'       => trans('salador/uslugi::uslugi.Transactions.Title'),
                'placeholder' => trans('salador/uslugi::uslugi.Transactions.Title'),
                'help'     => 'What did the patient complain about?',
            ],
        ];
    }

}

