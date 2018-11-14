<?php

namespace Salador\Uslugi\Models;

use Illuminate\Database\Eloquent\Model;
use Salador\Uslugi\Models\Master as Master;
use Salador\Uslugi\Models\AdvType as AdvType;

class AdvPrice extends Model
{
    //
	protected $table = 'AdvPrices';  //Подключить таблицу к модели  по умолчению название класса+s (Services)
	
	
	protected $fillable = [
        'master_id',
        'advtype_id',
        'price',
    ];							// Поля массово изменяемые
	
	protected $guarded = ['id'];
	
    public function getContent($key){
        return $this->getAttribute($key);
    }

	

	public function master()
    {
        return $this->belongsTo('Salador\Uslugi\Models\Master','master_id');   //Добавляем таблицу Мастеров
    }
	
	public function advtype()
    {
        return $this->belongsTo('Salador\Uslugi\Models\AdvType', 'advtype_id');
    }
		
}
