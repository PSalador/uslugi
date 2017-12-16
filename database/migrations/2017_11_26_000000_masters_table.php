<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class MastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		//Таблица мастаеров, каждый пользователь может добавить несколько мастеров.
		Schema::dropIfExists('Masters');
        Schema::create('Masters', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('user_id')->unsigned();
            $table->string('name');
            $table->json('adress');
			$table->string('phone');
			$table->string('email');
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
	    Schema::dropIfExists('Masters');
    }
}