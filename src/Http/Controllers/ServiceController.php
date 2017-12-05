<?php
namespace Salador\Uslugi\Http\Controllers;

use Illuminate\Http\Request;
use Orchid\Platform\Core\Models\Taxonomy;
use Orchid\Platform\Facades\Alert;
use Orchid\Platform\Http\Controllers\Controller;
use Salador\Uslugi\Http\Forms\Services\ServicesFormGroup;
use Salador\Uslugi\Models\Service;

class ServiceController extends Controller
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
    public function __construct(ServicesFormGroup $form)
    {
        //$this->form = new $this->form();
		$this->form = $form;

    }

    /**
     * @return string
     */
    public function index()
    {
		//dd('Hello');
        return $this->form->grid();
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return $this->form
            ->route('dashboard.uslugi.services.update')
            ->method('POST')
            ->render();
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Service $service=null)
    {
        $this->form->save($request, $service);

		Alert::success(trans('dashboard::common.alert.success'));

		return redirect()->route('dashboard.uslugi.services');

        //return redirect()->route('dashboard.uslugi.services.edit', $request->get('slug'));
    }

    /**
     * @param Request $request
     * @param Service    $service
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Service $service)
    {
        $this->form->save($request, $service);
		
		Alert::success(trans('dashboard::common.alert.success'));

		return back();
        //return redirect()->route('dashboard.uslugi.services.edit', $request->get('slug'));
    }

    /**
     * @param Service $service
     *
     * @return mixed
     */
    public function edit(Service $service)
    {
		//dd($service);
		//return $this->form->route('dashboard.uslugi.services.update')->slug($service->slug)->method('PUT')->render($service);
		return $this->form->route('dashboard.uslugi.services.update')->slug($service->id)->method('PUT')->render($service);	
    }

    /**
     * @param Service $service
     *
     * @return mixed
     */
    public function destroy(Service $service)
    {
        $this->form->remove($service);

        return redirect()->route('dashboard.uslugi.services');
    }
}