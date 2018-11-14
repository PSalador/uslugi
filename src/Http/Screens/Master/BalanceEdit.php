<?php
namespace Salador\Uslugi\Http\Screens\Master;

use Orchid\Platform\Facades\Alert;
use Orchid\Platform\Screen\Layouts;
use Orchid\Platform\Screen\Link;
use Orchid\Platform\Screen\Screen;

use Salador\Uslugi\Models\Master;
use Salador\Uslugi\Models\TypeTran;
use Salador\Uslugi\Models\Balance;


use Salador\Uslugi\Http\Requests\BalanceRequest;
use Salador\Uslugi\Http\Layouts\Master\EditBalanceLayout;



class BalanceEdit extends Screen
{
    /**
     * Display header name
     *
     * @var string
     */
    public $name = 'Balance edit';

    /**
     * Display header description
     *
     * @var string
     */
    public $description = 'There is a record of the balance\'s profile and balance';

    /**
     * Query data
     *
     * @param Balance $balance
     *
     * @return array
     */
    public function query($balance = null) : array
    {
        //dump($balance);
		$balance = is_null($balance) ? new Balance() : $balance;
		//dump($balance->typetran_id);
		$typetrans = new TypeTran;
		
		//$typetrans = $typetrans->GetAllDefault($balance->typetran_id);
		//dd($typetrans);
		//dd($service->GetServices());
		//$this->attributes['services_id'] =$services->GetAll();
		
		
        return [
            'balance'   => $balance,
			'typetrans'	=> $typetrans->GetAllDefault($balance->typetran_id),
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
		
		    Layouts::columns([
                'EditBalance' => [
                    EditBalanceLayout::class
                ],
            ]),
		
        ];
    }

    /**
     * @param Master $balance
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save($request, Balance $balance)
    {
		//dd($this->request->get('balance')['master_id']);
        $balance->fill($this->request->get('balance'));
		$balance->typetran_id = $this->request->typetrans;
		//dd($balance);
		$balance->save();
		
        Alert::info('Balance was saved');

        return redirect()->route('dashboard.uslugi.master.edit', $this->request->get('balance')['master_id']);
    }

    /**
     * @param Master $balance
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove($request, Balance $balance)
    {
        //dd($this->request);
		$balance->delete();
        Alert::info('Balance was removed');

        return redirect()->route('dashboard.uslugi.master.edit', $this->request->get('balance')['master_id']);
    }

}