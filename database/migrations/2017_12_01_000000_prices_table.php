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
		
        Schema::create('Prices', function (Blueprint $table) {
			$table->integer('user_id')->unsigned();
			$table->integer('services_id')->unsigned();
			$table->float('volume', 8, 4)->unsigned();
			$table->decimal('price', 8, 2)->unsigned();
            $table->timestamps();
			$table->primary(['user_id', 'services_id','volume']);
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