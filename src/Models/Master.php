<?php

namespace Salador\Uslugi\Models;

use Illuminate\Database\Eloquent\Model;

class Master extends Model
{
    //
	protected $table = 'Masters';  //Подключить таблицу к модели  по умолчению название класса+s (Services)
	
	
	protected $fillable = [
        'name',
        'adress',
        'phone',
        'email',
    ];							// Поля массово изменяемые
	
	
	
	
}
