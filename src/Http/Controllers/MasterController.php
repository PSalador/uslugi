<?php
namespace Salador\Uslugi\Http\Controllers;

use Illuminate\Http\Request;

use Orchid\Platform\Core\Models\Taxonomy;
use Orchid\Platform\Facades\Alert;
use Orchid\Platform\Http\Controllers\Controller;

use Salador\Uslugi\Http\Forms\Masters\MastersFormGroup;
use Salador\Uslugi\Models\Master;

class MasterController extends Controller
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
    public function __construct(MastersFormGroup $form)
    {
        //$this->form = new $this->form();
		$this->checkPermission('dashboard.uslugi.masters');
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
            ->route('dashboard.uslugi.masters.update')
            ->method('POST')
            ->render();
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Master $master=null)
    {
        $this->form->save($request, $master);

		Alert::success(trans('dashboard::common.alert.success'));

		return redirect()->route('dashboard.uslugi.masters');

        //return redirect()->route('dashboard.uslugi.services.edit', $request->get('slug'));
    }

    /**
     * @param Request $request
     * @param Service    $service
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Master $master)
    {
        $this->form->save($request, $master);
		
		Alert::success(trans('dashboard::common.alert.success'));

		return back();
        //return redirect()->route('dashboard.uslugi.services.edit', $request->get('slug'));
    }

    /**
     * @param Service $service
     *
     * @return mixed
     */
    public function edit(Master $master)
    {
		//dd($service);
		//return $this->form->route('dashboard.uslugi.services.update')->slug($service->slug)->method('PUT')->render($service);
		return $this->form->route('dashboard.uslugi.masters.update')->slug($master->id)->method('PUT')->render($master);	
    }

    /**
     * @param Service $service
     *
     * @return mixed
     */
    public function destroy(Master $master)
    {
        $this->form->remove($master);

        return redirect()->route('dashboard.uslugi.masters');
    }
}