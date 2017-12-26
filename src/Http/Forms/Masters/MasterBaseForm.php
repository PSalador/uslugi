<?php

namespace Salador\Uslugi\Http\Forms\Masters;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;

use Orchid\Platform\Forms\Form;

use Salador\Uslugi\Models\Master;


class MasterBaseForm extends Form
{

    /**
     * Base Model.
     *
     * @var
     */
    protected $model = Master::class;

    /**
     * @var null
     */
    protected $behavior;

    /**
     * BaseUserForm constructor.
     *
     * @param null $request
     */
    public function __construct($request = null)
    {
        $this->name = trans('salador/uslugi::uslugi.Master.Title');
        $master = \Salador\Uslugi\Behaviors\MasterBase::class;
		
        $this->behavior = (new $master);
        parent::__construct($request);
		//dd($this);
    }

    /**
     * Validation Rules Request.
     *
     * @return array
     */
    public function rules() : array
    {
        return $this->behavior->rules();
        return [
            'name'  => 'required|max:255',
            'phone' => 'required|max:255',
        ];
    }

    /**
     * Display Settings App.
     *
     * @param User|null $user
     *
     * @return \Illuminate\Contracts\View\Factory|View|\Illuminate\View\View
     */
    public function get(Master $master = null) : View
    {
		
		$master=$master ?: new $this->model();
		//$master::attributes['adress']=json_decode($master->attributes['adress']);
		//dd($this);
		$master->GetAllUsers()->setAdressJson();
		//dd($master);
        return view('salador/uslugi::masters.info', [
            'service'     => $master,
            'language' => App::getLocale(),
            'locales'  => config('platform.locales'),
            'fields'   => $this->behavior->fields(),
        ]);
    }

    /**
     * Save Base Role.
     *
     * @param Request|null $request
     * @param User|null    $user
     *
     * @return mixed|void
     */
    public function persist(Request $request = null, Master $master = null)
    {
		//dd($request);
        $attributes = $request->all();
		//dd($attributes);
		//$attributes['location']= \DB::raw("GeomFromText('POINT(".$attributes['adress']['lat']." ".$attributes['adress']['lng'].")')");//"POINT(".$attributes['adress']['lat']." ".$attributes['adress']['lng'].")";
		//$attributes['adress']=$attributes['adress']['name'];
	
		//$attributes['adress']=json_encode($attributes['adress']);
	
		//dd($attributes);
        if (is_null($master)) {
            $master = new Master();
        }
        $master->fill($attributes);
        $master->save();
    }

    /**
     * @param User $user
     */
    public function delete(Master $master)
    {
        $master->delete();
    }
}
