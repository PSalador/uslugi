<?php
namespace Salador\Uslugi\Http\Layouts\AdvType;

use Orchid\Platform\Layouts\Table;

class AdvTypeListLayout extends Table
{

    /**
     * @var string
     */
    public $data = 'AdvType';

    /**
     * @return array
     */
    public function fields() : array
    {
        return [
            'name'  => [
                'name'   => 'Name',
                'action' => function ($advtype) {
                    return '<a href="' . route('dashboard.uslugi.advtype.edit',
                            $advtype->id) . '">' . $advtype->name . '</a>';
                },
            ],
            'class'       => 'Class',
            'desc' => 'Description',
        ];
    }
}
