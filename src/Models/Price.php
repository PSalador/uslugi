<?php

namespace Salador\Uslugi\Models;

use Illuminate\Database\Eloquent\Model;
use Salador\Uslugi\Models\Master as Master;
use Salador\Uslugi\Models\Service as Service;

class Price extends Model
{
    //
	protected $table = 'Prices';  //Подключить таблицу к модели  по умолчению название класса+s (Services)
	
	
	protected $fillable = [
        'master_id',
        'services_id',
        'volume',
        'price',
    ];							// Поля массово изменяемые
	
	
	public function master()
    {
        return $this->belongsTo('Salador\Uslugi\Models\Master','master_id');   //Добавляем таблицу Мастеров
    }
	
	public function service()
    {
        return $this->belongsTo('Salador\Uslugi\Models\Service', 'services_id');
    }
	
	public function selectServices()
    {
		//dd(Service::pluck('name','id')->all());
		$services = new Service;
		//dd($service->GetServices());
		$this->attributes['services_id'] =$services->GetAll();
		//$this->attributes['adress'] = json_decode($this->attributes['adress'],true);  //преобразуем в json
		//['adress']=json_decode($master->attributes['adress']
		
		return $this;
    }
	
	public function selectMasters()
    {
		//dd(Master::pluck('name','id')->all());
		$masters = new Master;
		$this->attributes['master_id'] =$masters->GetAll();
		
		return $this;
    }
	
	
}
