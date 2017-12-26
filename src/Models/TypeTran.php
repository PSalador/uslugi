<?php

namespace Salador\Uslugi\Models;

use Illuminate\Database\Eloquent\Model;


class TypeTran extends Model
{
    //
	protected $table = 'TypeTrans';  //Подключить таблицу к модели  по умолчению название класса+s (Services)
	
	
	
	protected $fillable = [
        'name',
        'plus',
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
	
	
	public function balance()
    {
        return $this->hasMany(Balance,'typetran_id');
    }
	
	public function leads()
    {
        return $this->hasMany(Lead,'typetran_id');
    }
	
	public function GetAll()
    {
		return $this::pluck('name','id')->all();
	}
	
}
