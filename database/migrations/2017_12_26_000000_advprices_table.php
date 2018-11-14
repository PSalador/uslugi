<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class AdvPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		//Таблица цены мастер на услугу
		Schema::dropIfExists('AdvPrices');
        Schema::create('AdvPrices', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('master_id')->unsigned();
			$table->integer('advtype_id')->unsigned();
			$table->decimal('price', 8, 2)->unsigned();
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
	    Schema::dropIfExists('AdvPrices');
    }
}