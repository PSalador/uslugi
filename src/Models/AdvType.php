<?php

namespace Salador\Uslugi\Models;

use Illuminate\Database\Eloquent\Model;


class AdvType extends Model
{
    //
	protected $table = 'AdvType';  //Подключить таблицу к модели  по умолчению название класса+s (Services)
	
	
	
	protected $fillable = [
        'name',
        'class',
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


	public function advprices()
    {
        return $this->hasMany(AdvPrices,'advtype_id');
    }
	
	public function leads()
    {
        return $this->hasMany(Lead,'typetran_id');
    }
	
	
	public function GetAll()
    {
		return $this::pluck('name','id')->all();
	}
	
	public function GetAllDefault($default)
    {
		return array_add($this::pluck('name','id')->all(), 'default', $default);
	}
	
}
