<?php
 
namespace Salador\Uslugi\Http\Layouts\Master;

use Orchid\Platform\Layouts\Table;

class MasterBalanceLayout extends Table
{

    /**
     * @var string
     */
    public $data = 'balance';

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
                'action' => function ($balance) {
					//dump($price->service()->first()->name);
                    return '<a href="' . route('dashboard.uslugi.master.balance',
                            $balance->id) . '">' . $balance->typetran()->first()->name . '</a>';
                },
            ],
            'money' 	=> 'Money',
            'desc'     	=> 'Desc',
        ];
    }
}