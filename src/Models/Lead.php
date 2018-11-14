<?php

namespace Salador\Uslugi\Models;

use Illuminate\Database\Eloquent\Model;


class Lead extends Model
{
    //
	protected $table = 'Leads';  //Подключить таблицу к модели  по умолчению название класса+s (Services)
	
	
	
	protected $fillable = [
        'master_id',
        'typetran_id',
        'money',
        'field',
    ];							// Поля массово изменяемые
	
	protected $guarded = ['id'];
	
	/**
     * @param $key
     *
     * @return mixed
     */
    public function getContent($key){
        return $this->getAttribute($key);
    }
	
	public function master()
    {
        return $this->belongsTo('Salador\Uslugi\Models\Master','master_id');   //Добавляем таблицу Мастеров
    }
	/*
	public function typetran()
    {
        return $this->belongsTo('Salador\Uslugi\Models\TypeTran', 'typetran_id');
		//return $this->hasOne(Service::class, 'services_id');
    }
	*/
	public function advtype()
    {
        return $this->belongsTo('Salador\Uslugi\Models\AdvType', 'typetran_id');
		//return $this->hasOne(Service::class, 'services_id');
    }
	
	public function GetAllDefault($default)
    {
		return array_add($this::pluck('name','id')->all(), 'default', $default);
	}
	
}
