<?php

namespace Salador\Uslugi\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Platform\Core\Models\User;

//use Salador\Uslugi\Models\Price as Price;

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
	
	
	
	/**
     * @param $key
     *
     * @return mixed
     */
    public function getContent($key){
		//dump($this->getAttribute($key));
        return $this->getAttribute($key);
    }
	
	 /**
	 *  Преобразует данные к определенному формату
     * @var array
     */
    protected $casts = [
        'adress' => 'array',
    ];
	
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
        return $this->hasMany(Price::class);
    }
	
	public function balance()
    {
        return $this->hasMany(Balance::class);
    }
	
	public function leads()
    {
        return $this->hasMany(Lead::class);
    }

	public function advprice()
    {
        return $this->hasMany(AdvPrice::class);
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
