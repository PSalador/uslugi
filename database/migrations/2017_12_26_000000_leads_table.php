<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class LeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		//Таблица баланса мастера 
		Schema::dropIfExists('Leads');
        Schema::create('Leads', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('master_id')->unsigned();
			$table->integer('typetran_id')->unsigned();	//вид действия		
			$table->decimal('money', 15, 2)->unsigned();
			$table->string('field');  //идентификатор поля на котором выполнено действие
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
	    Schema::dropIfExists('Leads');
    }
}