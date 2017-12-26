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
	
	 protected $guarded = ['id'];
	
	/**
     * @param $key
     *
     * @return mixed
	 *  преобразовываение названий из layouta, если стоит . (точка) то данные соеденяются через пробел
	 * если стоит - (тире) то ищет в соедененной таблице {имя таблицы}-{атрибут}
     */
    public function getContent($key){
		//dump($key);
		//dump($this->getAttribute($key));
		if (strpos($key,'.')) {
			$arr_attribute=explode('.',$key);
			$attribute='';
			foreach ($arr_attribute as $key_attribute=>$name_attribute){
				//dump($this->getContentAttribute($name_attribute));
				$attribute.=($key_attribute>0)?' ':'';
				$attribute.=$this->getContentAttribute($name_attribute);
				//dump($name_attribute);
				//.' '.$this->getContentAttribute($arr_attribute[1]);
			}
		} else {
			$attribute=$this->getContentAttribute($key);
		}
		//dump($attribute);
        return $attribute;
    }
	
	private function getContentAttribute($key){
		if (strpos($key,'-')) {
			$arr_attribute=explode('-',$key);
			$attribute=$this->getAttribute($arr_attribute[0])[$arr_attribute[1]];
		} else {
			$attribute=$this->getAttribute($key);
		}
		//dump($attribute);
        return $attribute;
	}
	
	
	public function master()
    {
        return $this->belongsTo('Salador\Uslugi\Models\Master','master_id');   //Добавляем таблицу Мастеров
    }
	
	public function service()
    {
        return $this->belongsTo('Salador\Uslugi\Models\Service', 'services_id');
		//return $this->hasOne(Service::class, 'services_id');
    }
	
	public function servicename()
    {
        //return $this->belongsTo('Salador\Uslugi\Models\Service', 'services_id');
		//return $this->hasOne('Salador\Uslugi\Models\Service','id', 'services_id');
    }
	
	public function selectServices()
    {
		//dd(Service::pluck('name','id')->all());
		//dd($this->services_id);
		$default=$this->services_id;
		$services = new Service;
		//dd($service->GetServices());
		$this->attributes['services_id'] =$services->GetAll();
		$this->attributes['services_id']['default']=$default;
		//$this->attributes['adress'] = json_decode($this->attributes['adress'],true);  //преобразуем в json
		//['adress']=json_decode($master->attributes['adress']
		
		return $this;
    }
	
	public function selectMasters()
    {
		//dd(Master::pluck('name','id')->all());
		$default=$this->master_id;
		$masters = new Master;
		$this->attributes['master_id'] =$masters->GetAll();
		$this->attributes['master_id']['default']=$default;
		
		return $this;
    }
	
	
}
