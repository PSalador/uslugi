<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class BalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		//Таблица баланса мастера 
		Schema::dropIfExists('Balances');
        Schema::create('Balances', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('master_id')->unsigned();
			$table->integer('typetran_id')->unsigned();			
			$table->decimal('money', 15, 2)->unsigned();			
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
	    Schema::dropIfExists('Balances');
    }
}