<?php

namespace Salador\Uslugi\Http\Screens\Master;


use Orchid\Platform\Facades\Alert;
use Orchid\Platform\Screen\Layouts;
use Orchid\Platform\Screen\Link;
use Orchid\Platform\Screen\Screen;

use Salador\Uslugi\Models\Master;
use Salador\Uslugi\Models\Price;
use Salador\Uslugi\Models\Service;
use Salador\Uslugi\Models\TypeTran;
use Salador\Uslugi\Models\Balance;
use Salador\Uslugi\Models\Lead;

use Salador\Uslugi\Http\Requests\PriceRequest;
use Salador\Uslugi\Http\Requests\BalanceRequest;
use Salador\Uslugi\Http\Requests\LeadRequest;
use Salador\Uslugi\Http\Layouts\Master\MasterProfileLayout;
use Salador\Uslugi\Http\Layouts\Master\MasterPricesLayout;
use Salador\Uslugi\Http\Layouts\Master\MasterBalanceLayout;
use Salador\Uslugi\Http\Layouts\Master\MasterLeadLayout;
use Salador\Uslugi\Http\Layouts\Master\EditPriceLayout;
use Salador\Uslugi\Http\Layouts\Master\EditBalanceLayout;
use Salador\Uslugi\Http\Layouts\Master\EditLeadLayout;



class MasterEdit extends Screen
{
    /**
     * Display header name
     *
     * @var string
     */
    public $name = 'Master card';

    /**
     * Display header description
     *
     * @var string
     */
    public $description = 'There is a record of the master\'s profile and balance';

    /**
     * Query data
     *
     * @param Master $master
     *
     * @return array
     */
    public function query($master = null) : array
    {
        //dump($master);
		$master = is_null($master) ? new Master() : $master;
		$master->GetAllUsers();//->setAdressJson();
		//dd($master);
		$services = new Service;
		$typetrans = new TypeTran;
		//dd($service->GetServices());
		//$this->attributes['services_id'] =$services->GetAll();
		
		
        return [
            'master'    => $master,
            'prices' 	=> $master->prices()->orderByDesc('updated_at')->paginate(10),
			'services'	=> $services->GetAll(),
            'balance'   => $master->balance()->orderByDesc('updated_at')->paginate(10),
            'leads'   	=> $master->leads()->orderByDesc('updated_at')->paginate(10),
			'typetrans'	=> $typetrans->GetAll(),
        ];
    }

    /**
     * Button commands
     *
     * @return array
     */
    public function commandBar() : array
    {
        return [
            Link::name('AddPrice')
                ->modal('AddPrice')
                ->title('Add Price')
                ->method('createAddPrice'),
				
			Link::name('AddBalance')
                ->modal('AddBalance')
                ->title('Add Balance')
                ->method('createAddBalance'),
			Link::name('AddLead')
                ->modal('AddLead')
                ->title('Add Lead')
                ->method('createAddLead'),	
				
            Link::name('Save')->method('save'),
            Link::name('Remove')->method('remove'),
        ];
    }

    /**
     * Views
     *
     * @return array
     */
    public function layout() : array
    {
        return [
            Layouts::tabs([
                'Profile' => [
                    MasterProfileLayout::class
                ],
                'Prices' => [
                    MasterPricesLayout::class
                ],
				'Balance' => [
                    MasterBalanceLayout::class
                ],
				'Leads' => [
                    MasterLeadLayout::class
                ],
            ]),
            // Modals windows
			
            Layouts::modals([
                'AddPrice' => [
                    EditPriceLayout::class,
                ],
                'AddBalance' => [
                    EditBalanceLayout::class,
                ],
                'AddLead' => [
                    EditLeadLayout::class,
                ],
            ]),
			
        ];
    }

    /**
     * @param Master $master
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save($request, Master $master)
    {
        $master->fill($this->request->get('master'))->save();
        Alert::info('Master was saved');

        return redirect()->route('dashboard.uslugi.master.list');
    }

    /**
     * @param Master $master
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(Master $master)
    {
        $master->delete();
        Alert::info('Master was removed');

        return redirect()->route('dashboard.uslugi.master.list');
    }

    /**
     * @param Master            $master
     * @param AppointmentRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
	
    public function createAddPrice(Master $master, PriceRequest $request){
        $price = new \Salador\Uslugi\Models\Price;
        //$price->master_id = $request->master['user_id'];//$request->all();
        $price->services_id = $request->services;
        $price->volume = $request->price['volume'];
        $price->price = $request->price['price'];
		//dump($price);
        $master->prices()->save($price);
        Alert::info('Master price was added');
		return redirect()->back();
    }

    public function createAddBalance(Master $master, BalanceRequest $request){
        $balance = new \Salador\Uslugi\Models\Balance;
        //$price->master_id = $request->master['user_id'];//$request->all();
        $balance->typetran_id = $request->typetrans;
        $balance->money = $request->balance['money'];
        $balance->desc = $request->balance['desc'];
		//dump($price);
        $master->balance()->save($balance);
        Alert::info('Master balance was added');
		return redirect()->back();
    }
	
    public function createAddLead(Master $master, LeadRequest $request){
        $lead = new \Salador\Uslugi\Models\Lead;
        //$price->master_id = $request->master['user_id'];//$request->all();
        $lead->typetran_id = $request->typetrans;
        $lead->money = $request->lead['money'];
        $lead->field = $request->lead['field'];
		//dump($price);
        $master->leads()->save($lead);
        Alert::info('Master lead was added');
		return redirect()->back();
    }
}
