<?php
namespace Salador\Uslugi\Http\Layouts\Filter;

use Orchid\Platform\Layouts\Table;

class FilterListLayout extends Table
{

    /**
     * @var string
     */
    public $data = 'Prices';

    /**
     * @return array
     */
    public function fields() : array
    {
        return [
		/*
            'name'  => [
                'name'   => 'Name',
                'action' => function ($typetran) {
                    return '<a href="' . route('dashboard.uslugi.typetran.edit',
                            $typetran->id) . '">' . $typetran->name . '</a>';
                },
            ],
		*/
            'name'       => [
                'name'   => 'Master',
                'action' => function ($pricem) {
                    return $pricem->Master->name;
                },
            ],
			'service'       => [
                'name'   => 'Service',
                'action' => function ($pricem) {
                    return $pricem->Service->name;
                },
            ],
            'volume'      => 'Volume',
            'price'       => 'Price',
        ];
    }
}
