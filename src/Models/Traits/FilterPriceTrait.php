<?php

namespace Salador\Uslugi\Models\Traits;

trait FilterPriceTrait
{

    /**
     * @param array   $filters
     *	$filters=[
			'first_name'	=>	[
                'name'     	=> 'first_name',
                'operator' 	=> 'like',
                'value'    	=> $search['first_name'],
				'table'		=> 'Master',
				],
			'last_name'		=>	$search['last_name'],
		];
	 *
     * @return Builder
     */
	public function FiltersApply($filters = [])
    {
		$query = $this;
        foreach ($filters as $keyfilter=>$filter) {
			if (!is_array($filter)) {
				$query = $query->where($keyfilter, 'LIKE', '%' . $filter. '%');
            } elseif (isset($filter['value'])) {
				if ($filter['operator']=='like') $filter['value']='%' . $filter['value']. '%';
				if (isset($filter['table'])) {
					$query = $query->whereHas($filter['table'], function ($q) use ($filter) {
									$q->where($filter['name'], $filter['operator'], $filter['value']);
								}
							);
				} else {
					$query = $query->where($filter['name'], $filter['operator'], $filter['value']);
				}
			}
        }

        return $query;
    }
}
