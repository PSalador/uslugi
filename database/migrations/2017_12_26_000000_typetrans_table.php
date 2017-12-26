<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class TypeTransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		//Таблица денежных операций
		Schema::dropIfExists('TypeTrans');
        Schema::create('TypeTrans', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->boolean('plus')->default(false);	//true начисление false с минусом	
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
	    Schema::dropIfExists('TypeTrans');
    }
}