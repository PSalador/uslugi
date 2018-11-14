<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class AdvTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		//Таблица видов рекламы
		Schema::dropIfExists('AdvType');
        Schema::create('AdvType', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('class');  //класс или ид котрый будет обработан скриптом и сосчитан
			$table->string('desc');  
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::dropIfExists('AdvType');
    }
}