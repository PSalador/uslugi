<?php

namespace Salador\Uslugi\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Platform\Core\Models\User;

use Salador\Uslugi\Models\Price as Price;

class Master extends Model
{
    //
	protected $table = 'Masters';  //Подключить таблицу к модели  по умолчению название класса+s (Services)
	
	
	protected $fillable = [
		'user_id',
        'name',
        'adress',
        'phone',
        'email',
		'location'
    ];							// Поля массово изменяемые
	
	
	/*
	function __construct($attributes = array())
    {
        parent::__construct($attributes);  //запускаем основной конструктор

		dd($attributes);
    }
	*/
	
	public function user()
    {
        return $this->belongsTo('App\User');
    }
	
	public function prices()
    {
        return $this->hasMany(Price);
    }
	
	public function setAdressJson()
    {
		if (isset($this->attributes['adress'])) {
			$this->attributes['adress'] = json_decode($this->attributes['adress'],true);  //преобразуем в json
		}
		return $this;
    }
	
	public function GetAll()
    {
		return $this::pluck('name','id')->all();
	}
	
	public function GetAllUsers()
    {
		$selusers = User::whereHas(
			'roles', function($q){
				$q->where('slug', 'admins');
			}
		)->get()->pluck('name','id')->all();
		
		$this->attributes['user_id'] =$selusers;
		
		return $this;
	}
	
}
