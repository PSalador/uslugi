<?php
namespace Salador\Uslugi\Http\Forms\Services;


use Illuminate\Contracts\View\View;
use Orchid\Platform\Forms\FormGroup;
use Orchid\Platform\Forms\Form;

use Salador\Uslugi\Events\ServiceEvent;
use Salador\Uslugi\Models\Service;



class ServicesFormGroup extends FormGroup
{
	
	public $event = ServiceEvent::class;
    /**
     * @var string
     */
    //public $name = 'Service';
	//public $name = 'Service';

    /**
     * Base Model.
     *
     * @var
     */
    //protected $model = Service::class;
	//protected $model;

	
    /**
     * Description Attributes for group.
     *
     * @return array
     */
    public function attributes() : array
    {
        return [
            'name'        => 'services',
            'description' => 'Any Services',
        ];
    }
    /**
     * @return \Illuminate\Contracts\View\Factory|View|\Illuminate\View\View
     */

    public function main() : View
    {
		
		$service = \Salador\Uslugi\Behaviors\ServiceBase::class;
        $service = (new $service);
		//dd(Service::paginate());
		return view('salador/uslugi::services.grid', [
            'services' => Service::paginate(),
            'grid'  => $service->grid(),
        ]);
    }
}