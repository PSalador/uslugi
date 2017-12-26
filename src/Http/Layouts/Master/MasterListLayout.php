<?php

namespace Salador\Uslugi\Http\Layouts\Master;

use Orchid\Platform\Layouts\Table;

class MasterListLayout extends Table
{

    /**
     * @var string
     */
    public $data = 'masters';

    /**
     * @return array
     */
    public function fields() : array
    {
        return [
            'name'  => [
                'name'   => 'Name',
                'action' => function ($master) {
                    return '<a href="' . route('dashboard.uslugi.master.edit',
                            $master->id) . '">' . $master->name . '</a>';
                },
            ],
            'phone'      => 'Phone',
            'email'      => 'Email',
            'created_at' => 'Date of publication',
        ];
    }
}
