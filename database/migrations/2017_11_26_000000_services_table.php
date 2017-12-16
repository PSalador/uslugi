<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class ServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		// Таблица услуг
		Schema::dropIfExists('Services');
        Schema::create('Services', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
			$table->string('measure');
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
	    Schema::dropIfExists('Services');
    }
}
