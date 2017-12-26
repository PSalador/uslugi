<?php
namespace Salador\Uslugi\Http\Layouts\Demo;

use Orchid\Platform\Layouts\Rows;
class TestRows extends Rows
{
    /**
     * @return array
     */
    public function fields() : array
    {
        return [
            'first_name' => [
                'tag'      => 'input',
                'type'     => 'text',
                'name'     => 'user.name',
                'max'      => 255,
                'required' => true,
                'title'    => 'First name',
            ],
            'last_name'  => [
                'tag'      => 'input',
                'type'     => 'text',
                'name'     => 'patient.last_name',
                'max'      => 255,
                'required' => true,
                'title'    => 'Last name',
            ],
            'phone'      => [
                'tag'      => 'input',
                'type'     => 'text',
                'name'     => 'patient.phone',
                'max'      => 12,
                'required' => true,
                'title'    => 'Phone',
            ],
        ];
    }
}