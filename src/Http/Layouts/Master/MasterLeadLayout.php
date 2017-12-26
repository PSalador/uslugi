<?php
 
namespace Salador\Uslugi\Http\Layouts\Master;

use Orchid\Platform\Layouts\Table;

class MasterLeadLayout extends Table
{

    /**
     * @var string
     */
    public $data = 'leads';

    /**
     * @return array
     */
    public function fields() : array
    {
		
        return [
            //'service-name' => 'Service',
            //'service-name' => 'Service',
			'typetran-name'  => [
                'name'   => 'typetran',
                'action' => function ($leads) {
					//dump($price->service()->first()->name);
                    return '<a href="' . route('dashboard.uslugi.master.lead',
                            $leads->id) . '">' . $leads->typetran()->first()->name . '</a>';
                },
            ],
            'money' 	=> 'Money',
            'field'     => 'Field',
        ];
    }
}