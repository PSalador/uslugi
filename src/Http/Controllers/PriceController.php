<?php
namespace Salador\Uslugi\Http\Controllers;

use Illuminate\Http\Request;

use Orchid\Platform\Core\Models\Taxonomy;
use Orchid\Platform\Facades\Alert;
use Orchid\Platform\Http\Controllers\Controller;

use Salador\Uslugi\Http\Forms\Prices\PricesFormGroup;
use Salador\Uslugi\Models\Price;

class PriceController extends Controller
{
    /**
     * @var
     */
    //public $form= Form::class;
    public $form;

    /**
     * RoleController constructor.
     */
    //public function __construct()
    public function __construct(PricesFormGroup $form)
    {
        //$this->form = new $this->form();
		$this->checkPermission('dashboard.uslugi.prices');
		$this->form = $form;

    }

    /**
     * @return string
     */
    public function index()
    {
        return $this->form->grid();
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return $this->form
            ->route('dashboard.uslugi.prices.update')
            ->method('POST')
            ->render();
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Price $price=null)
    {
        $this->form->save($request, $price);

		Alert::success(trans('dashboard::common.alert.success'));

		return redirect()->route('dashboard.uslugi.prices');

        //return redirect()->route('dashboard.uslugi.services.edit', $request->get('slug'));
    }

    /**
     * @param Request $request
     * @param Service    $service
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Price $price)
    {
        $this->form->save($request, $price);
		
		Alert::success(trans('dashboard::common.alert.success'));

		return back();
        //return redirect()->route('dashboard.uslugi.services.edit', $request->get('slug'));
    }

    /**
     * @param Service $service
     *
     * @return mixed
     */
    public function edit(Price $price)
    {
		//dd($service);
		//return $this->form->route('dashboard.uslugi.services.update')->slug($service->slug)->method('PUT')->render($service);
		return $this->form->route('dashboard.uslugi.prices.update')->slug($price->id)->method('PUT')->render($price);	
    }

    /**
     * @param Service $service
     *
     * @return mixed
     */
    public function destroy(Price $price)
    {
        $this->form->remove($price);

        return redirect()->route('dashboard.uslugi.prices');
    }
}