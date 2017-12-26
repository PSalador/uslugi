<?php

namespace Salador\Uslugi\Models;

use Illuminate\Database\Eloquent\Model;


class Balance extends Model
{
    //
	protected $table = 'Balances';  //Подключить таблицу к модели  по умолчению название класса+s (Services)
	
	
	
	protected $fillable = [
        'master_id',
        'typetran_id',
        'money',
        'desc',
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
	
	public function typetran()
    {
        return $this->belongsTo('Salador\Uslugi\Models\TypeTran', 'typetran_id');
		//return $this->hasOne(Service::class, 'services_id');
    }
	
}
