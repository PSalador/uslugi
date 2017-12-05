<?php
namespace Salador\Uslugi\Http\Controllers;
use Orchid\Platform\Http\Controllers\Controller;
class UslugiController extends Controller
{
    /**
     * UslugiController constructor.
     */
    public function __construct()
    {
		//dd (config('uslugi.middleware.private'));  // dd() функция просмотра отладки как var_dump или print_r
        $this->checkPermission('dashboard.systems.uslugi');
    }
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
		 return view('salador/uslugi::index', [
            'info'        => 'info',
            'hardware'    => 'hardware',
            'loadAverage' => 'loadAverage',
            'memory'      => 'memory',
            'network'     => 'network',
            'storage'     => 'storage',
        ]);
    }
    /**
     * @return bool
     */
    private function shellExecEnabled(): bool
    {

    }
}