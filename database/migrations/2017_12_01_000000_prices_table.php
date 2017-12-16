<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class PricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		//Таблица цены мастер на услугу
		Schema::dropIfExists('Prices');
        Schema::create('Prices', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('master_id')->unsigned();
			$table->integer('services_id')->unsigned();
			$table->float('volume', 8, 4)->unsigned();
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
	    Schema::dropIfExists('Prices');
    }
}