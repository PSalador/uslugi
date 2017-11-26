<?php
namespace Salador\Uslugi;
use Orchid\Platform\Http\Controllers\Controller;
class UslugiController extends Controller
{
    /**
     * UslugiController constructor.
     */
    public function __construct()
    {
        $this->checkPermission('dashboard.systems.uslugi');
    }
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
		echo ('Hello');

    }
    /**
     * @return bool
     */
    private function shellExecEnabled(): bool
    {

    }
}