<?php

namespace Salador\Uslugi\Models;

use Illuminate\Database\Eloquent\Model;

use Salador\Uslugi\Models\Price as Price;

class Service extends Model
{
    //
	protected $table = 'Services';  //Подключить таблицу к модели  по умолчению название класса+s (Services)
	
	
	
	protected $fillable = [
        'name',
        'measure',
    ];							// Поля массово изменяемые
	
	
	public function prices()
    {
        return $this->hasMany(Price,'services_id');
    }
	
	public function GetAll()
    {
		return $this::pluck('name','id')->all();
	}
	
}
