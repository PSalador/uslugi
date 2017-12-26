<?php
namespace Salador\Uslugi\Http\Screens\Master;

use Orchid\Platform\Facades\Alert;
use Orchid\Platform\Screen\Layouts;
use Orchid\Platform\Screen\Link;
use Orchid\Platform\Screen\Screen;

use Salador\Uslugi\Models\Master;
use Salador\Uslugi\Models\TypeTran;
use Salador\Uslugi\Models\Lead;


use Salador\Uslugi\Http\Requests\LeadRequest;
use Salador\Uslugi\Http\Layouts\Master\EditLeadLayout;



class LeadEdit extends Screen
{
    /**
     * Display header name
     *
     * @var string
     */
    public $name = 'Lead edit';

    /**
     * Display header description
     *
     * @var string
     */
    public $description = 'There is a record of the lead';

    /**
     * Query data
     *
     * @param Balance $balance
     *
     * @return array
     */
    public function query($lead = null) : array
    {
        //dump($balance);
		$lead = is_null($lead) ? new Lead() : $lead;
		$typetrans = new TypeTran;
		//dd($service->GetServices());
		//$this->attributes['services_id'] =$services->GetAll();
		
		
        return [
            'lead'   => $lead,
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
                'EditLead' => [
                    EditLeadLayout::class
                ],
            ]),
		
        ];
    }

    /**
     * @param Master $balance
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save($request, Lead $lead)
    {
        $lead->fill($this->request->get('lead'));
		$lead->typetran_id = $this->request->typetrans;
		//dd($balance);
		$lead->save();
		
        Alert::info('Lead was saved');

        return redirect()->route('dashboard.uslugi.master.edit', $this->request->get('lead')['master_id']);
    }

    /**
     * @param Master $balance
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove($request, Lead $lead)
    {
        //dd($this->request);
		$lead->delete();
        Alert::info('Lead was removed');

        return redirect()->route('dashboard.uslugi.master.edit', $this->request->get('lead')['master_id']);
    }

}