<?php
namespace Salador\Uslugi\Http\Layouts\TypeTran;

use Orchid\Platform\Layouts\Table;

class TypeTranListLayout extends Table
{

    /**
     * @var string
     */
    public $data = 'TypeTran';

    /**
     * @return array
     */
    public function fields() : array
    {
        return [
            'name'  => [
                'name'   => 'Name',
                'action' => function ($typetran) {
                    return '<a href="' . route('dashboard.uslugi.typetran.edit',
                            $typetran->id) . '">' . $typetran->name . '</a>';
                },
            ],
            'plus'       => 'Refill',
            'created_at' => 'Date of publication',
        ];
    }
}
