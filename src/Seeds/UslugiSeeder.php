<?php
namespace Salador\Uslugi\Seeds;

use Illuminate\Database\Seeder;

class UslugiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
		$faker = \Faker\Factory::create('ru_RU'); // create a French faker
		
		//Random User
		/*
        for ($i = 0; $i < 10; $i++) {
             \Salador\Uslugi\Models\Master::create([
				'user_id' =>\App\User::inRandomOrder()->first()->id,
                'name' => $faker->name,
                'adress'     =>['name' => $faker->address,'lat'=>$faker->latitude($min = 50, $max = 60),'lng'=>$faker->latitude($min = 80, $max = 100) ],
                'phone'      => $faker->phoneNumber,
                'email'      => $faker->email
            ]);
		}	
		*/
		
		//Random Service	
/*		
		for ($i = 0; $i < 5; $i++) {
			
             \Salador\Uslugi\Models\Service::create([
				'name' =>$faker->randomElements(['Межевание ','Кадастровый план ','Кадастровый паспорт '])[0].$faker->randomElements($array = array ('гаража','дома','дома','земельного участка'))[0],
                'measure' => $faker->randomElements($array = array ('кв.м'))[0],
            ]);
		}
*/

/*
		//Random TypeTran		
		for ($i = 0; $i < 3; $i++) {
			
             \Salador\Uslugi\Models\TypeTran::create([
				'name' =>$faker->unique()->randomElements(['Внесение наличными','Пополнение Расчетный счет','Пополнение Yandex','Пополнение Paypal '])[0],
                'plus' => 1,
                'desc' => $faker->realText(100),
            ]);
		}	
		for ($i = 0; $i < 3; $i++) {
			
             \Salador\Uslugi\Models\TypeTran::create([
				'name' =>$faker->unique()->randomElements(['Снятие наличными','Снятие Расчетный счет','Снятие Yandex','Снятие Paypal '])[0],
                'plus' => 0,
                'desc' => $faker->realText(100),
            ]);
		}	

		//Random AdvType 			
		for ($i = 0; $i < 3; $i++) {
             \Salador\Uslugi\Models\AdvType::create([
				'name' =>$faker->unique()->randomElements(['Клик по номеру телефона','Обратный звонок','Реклама Yandex','Переход на сайт'])[0],
                'class' => $faker->word ,
                'desc' => $faker->realText(100),
            ]);
		}	
*/
/*
		//Random Prices 			
		for ($i = 0; $i < 100; $i++) {
             \Salador\Uslugi\Models\Price::create([
				'master_id' =>\Salador\Uslugi\Models\Master::inRandomOrder()->first()->id,
                'services_id' =>\Salador\Uslugi\Models\Service::inRandomOrder()->first()->id,
                'volume' => $faker->randomFloat(0, 10, 1000),
                'price' => $faker->randomFloat(2, 100, 10000),
            ]);
		}	
*/
		//Random Balance 			
		for ($i = 0; $i < 100; $i++) {
             \Salador\Uslugi\Models\Balance::create([
				'master_id' =>\Salador\Uslugi\Models\Master::inRandomOrder()->first()->id,
                'typetran_id' =>\Salador\Uslugi\Models\TypeTran::inRandomOrder()->first()->id,
                'money' => $faker->randomFloat(0, 100, 10000),
                'desc' => $faker->realText(100),
            ]);
		}	
		
		//Random Lead 
		for ($i = 0; $i < 100; $i++) {
             \Salador\Uslugi\Models\Lead::create([
				'master_id' =>\Salador\Uslugi\Models\Master::inRandomOrder()->first()->id,
                'typetran_id' =>\Salador\Uslugi\Models\AdvType::inRandomOrder()->first()->id,
                'money' => $faker->randomFloat(0, 100, 10000),
                'field' =>  $faker->word,
            ]);
		}	
		
		//Random AdvPrice 
		for ($i = 0; $i < 50; $i++) {
             \Salador\Uslugi\Models\AdvPrice::create([
				'master_id' =>\Salador\Uslugi\Models\Master::inRandomOrder()->first()->id,
                'advtype_id' =>\Salador\Uslugi\Models\AdvType::inRandomOrder()->first()->id,
                'price' => $faker->randomFloat(0, 100, 10000),
            ]);
		}	
		
		
    }
}
