<?php
namespace Salador\Uslugi\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Orchid\Platform\Filters\Filter;

use Salador\Uslugi\Models\Price;
use Salador\Uslugi\Models\Master as Master;
use Salador\Uslugi\Models\Service as Service;

class PriceFilter extends Filter
{

    /**
     *
     * @var array
     */
    public $parameters = [
        'price',
    ];

    /**
     * @var bool
     */
    public $display = true;

    /**
     * @var bool
     */
    public $dashboard = true;

    /**
     * @param Builder $builder
     *
     * @return Builder
     */
    public function run(Price $price) : Price
    {
        //return $builder->status($this->request->get('status'));
		return	$price->with(['Master','Service'])->where('content', 'LIKE', '%' . $this->request->get('search') . '%')->get();
		//dd($ArrPrices);
		/*
        return [
            'Prices' => $ArrPrices
        ];
		*/
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function display()
    {
        return view('dashboard::container.posts.filters.status', [
            'request'  => $this->request,
            'behavior' => $this->behavior,
        ]);
    }
}
