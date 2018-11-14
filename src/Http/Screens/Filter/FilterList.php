<?php
namespace Salador\Uslugi\Http\Screens\Filter;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Notifications\Notification;
use Orchid\Platform\Core\Models\User;
use Orchid\Platform\Facades\Alert;
use Orchid\Platform\Notifications\DashboardNotification;

use Orchid\Platform\Screen\Screen;
use Orchid\Platform\Screen\Layouts;
use Orchid\Platform\Screen\Link;

use Salador\Uslugi\Models\TypeTran;

use Salador\Uslugi\Models\Price;
use Salador\Uslugi\Models\Master as Master;
use Salador\Uslugi\Models\Service as Service;

use Salador\Uslugi\Http\Layouts\Filter\FilterSearchLayout;
use Salador\Uslugi\Http\Layouts\Filter\FilterListLayout;

class FilterList extends Screen
{
    /**
     * Display header name
     *
     * @var string
     */
    public $name = 'Price Filter List';

    /**
     * Display header description
     *
     * @var string
     */
    public $description = 'List all price filter';

    /**
     * Query data
     *
     * @return array
     */
    public function query() : array
    {
		$search=$this->request->get('search');
		
		$filters=[
			'Master-name'	=>	[
                'name'     	=> 'name',
                'operator' 	=> 'like',
                'value'    	=> $search['text'],
				'table'		=> 'Master',
				],
			'price'	=>	[
                'name'     	=> 'price',
                'operator' 	=> '>=',
                'value'    	=> $search['price'],
				],	
			//'last_name'		=>	$search['last_name'],
		];
		/*
		if ($search['text']!=null) {
			$ArrPrices =Price::whereHas(
							'Master', function ($query) {
								$query->where('name', 'LIKE', '%' . $this->request->get('search')['text']. '%');
							}
						)
			->with(['Master','Service'])->paginate();
						

		} else {
			$ArrPrices =Price::with(['Master','Service'])->paginate();
		}*/
		
		$ArrPrices=(new Price)->FiltersApply($filters)->with(['Master','Service'])->paginate();
		//dump ($ArrPrices);
		$ArrSearch=[
			'text'	=>	$search['text'],
			'price'	=>	$search['price'],
			'submit'=>	'Send',
		];
		//dd($ArrPrices);
        return [
			'search' =>$ArrSearch,
            'Prices' => $ArrPrices,
			
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
            Link::name('Create a new record')->method('create'),
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
			FilterSearchLayout::class,
            FilterListLayout::class,
        ];
    }

    /**
     * @param Request $request
     *
     * @return null
     */
     public function create()
    {
        return redirect()->route('dashboard.uslugi.typetran.create');
    }
}