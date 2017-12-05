<?php

namespace Salador\Uslugi\Models;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    //
	protected $table = 'Prices';  //Подключить таблицу к модели  по умолчению название класса+s (Services)
	
	
	protected $fillable = [
        'price',
    ];							// Поля массово изменяемые
	
	
	
	
}
