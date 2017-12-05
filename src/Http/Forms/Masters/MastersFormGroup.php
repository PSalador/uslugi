<?php
namespace Salador\Uslugi\Http\Forms\Masters;


use Illuminate\Contracts\View\View;
use Orchid\Platform\Forms\FormGroup;
use Orchid\Platform\Forms\Form;

use Salador\Uslugi\Events\MasterEvent;
use Salador\Uslugi\Models\Master;



class MastersFormGroup extends FormGroup
{
	
	public $event = MasterEvent::class;
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
            'name'        => trans('salador/uslugi::uslugi.Master.Title'),
            'description' => trans('salador/uslugi::uslugi.Master.description'),
        ];
    }
    /**
     * @return \Illuminate\Contracts\View\Factory|View|\Illuminate\View\View
     */

    public function main() : View
    {
		
		$master = \Salador\Uslugi\Behaviors\MasterBase::class;
        $master = (new $master);
		//dd(Service::paginate());
		return view('salador/uslugi::masters.grid', [
            'services' => Master::paginate(),
            'grid'  => $master->grid(),
        ]);
    }
}