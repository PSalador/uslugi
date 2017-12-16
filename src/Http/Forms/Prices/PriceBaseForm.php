<?php

namespace Salador\Uslugi\Http\Forms\Prices;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;

use Orchid\Platform\Forms\Form;

use Salador\Uslugi\Models\Price;


class PriceBaseForm extends Form
{

    /**
     * Base Model.
     *
     * @var
     */
    protected $model = Price::class;

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
        $this->name = trans('salador/uslugi::uslugi.Price.Title');
        $price = \Salador\Uslugi\Behaviors\PriceBase::class;
		
        $this->behavior = (new $price);
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
    public function get(Price $price = null) : View
    {
		$price=$price ?: new $this->model();
		//$master::attributes['adress']=json_decode($master->attributes['adress']);
		$price->selectMasters()->selectServices();
		//dd($price);
		
        return view('salador/uslugi::prices.info', [
            'service'     => $price,
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
    public function persist(Request $request = null, Price $price = null)
    {
		//dd($request);
        $attributes = $request->all();
        if (is_null($price)) {
            $price = new Price();
        }
        $price->fill($attributes);
        $price->save();
    }

    /**
     * @param User $user
     */
    public function delete(Price $price)
    {
        $price->delete();
    }
}
