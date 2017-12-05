<?php

namespace Salador\Uslugi\Http\Forms\Services;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Salador\Uslugi\Models\Service;
use Orchid\Platform\Forms\Form;

class ServiceBaseForm extends Form
{

    /**
     * Base Model.
     *
     * @var
     */
    protected $model = Service::class;

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
        $this->name = trans('salador/uslugi::uslugi.Service');
        $service = \Salador\Uslugi\Behaviors\ServiceBase::class;
		
        $this->behavior = (new $service);
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
            'measure' => 'required|max:30',
        ];
    }

    /**
     * Display Settings App.
     *
     * @param User|null $user
     *
     * @return \Illuminate\Contracts\View\Factory|View|\Illuminate\View\View
     */
    public function get(Service $service = null) : View
    {
        return view('salador/uslugi::services.info', [
            'service'     => $service ?: new $this->model(),
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
    public function persist(Request $request = null, Service $service = null)
    {
		//dd($request);
        $attributes = $request->all();
        if (is_null($service)) {
            $service = new Service();
        }
        $service->fill($attributes);
        $service->save();
    }

    /**
     * @param User $user
     */
    public function delete(Service $service)
    {
        $service->delete();
    }
}
