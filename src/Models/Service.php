<?php

namespace Salador\Uslugi\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    //
	protected $table = 'Services';  //Подключить таблицу к модели  по умолчению название класса+s (Services)
	
	
	protected $fillable = [
        'name',
        'measure',
    ];							// Поля массово изменяемые
	
	
	
	
}
