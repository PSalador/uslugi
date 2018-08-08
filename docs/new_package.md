### Как сделать пакет(плагин) в Orchid шаг за шагом. 
 

В данном уроке научимся создавать проекты для  
Создадим расширение для Orchid, где создадим возможность редактировать [настройки](https://orchid.software/ru/docs/settings).
Для начала нужно создать директорию где будут содержаться наши проекты. 

1. В корневой директории проекта создаем директорию package.  

2. В директории package создадим директорию нашего проекта. - Например XSetting. 

В файле composer.json добавим пути к нашему проекту  
```
    "repositories": [ 
    { 
        "packagist.org": false, 
        "type": "path", 
        "url": "/home/youproject/package/blogcms" 
    }, 
```

Создадим структуру пакета 

Database / migrations / 2018_08_07_000000_create_options_for_settings_table.php 
Src / Providers / XSettingProvider.php 
Src / Http / Screens / XSettingList.php 
Src / Http / Screens / XSettingEdit.php 
Src / Http / Layouts / XSettingListLayout.php 
Src / Http / Layouts / XSettingEditLayout.php 
Composer.json 

Приступаем к разработке расширения.
1. Сначала создадим файл роутинга, который будет определять какой экран отвечает за определенный маршрут.
Создадим файл routes/route.php

```
Route::group([
    'middleware' => ['web', 'platform'],	
    'prefix'     => 'dashboard/blogcms',
    'namespace'  => 'Orchids\XSetting\Http\Screens',
],
	function (\Illuminate\Routing\Router $router, $path='platform.xsetting.') {
		$router->screen('xsetting/{xsetting}/edit', 'XSettingEdit',$path.'edit');
		$router->screen('xsetting/create', 'XSettingEdit',$path.'create');
		$router->screen('xsetting', 'XSettingList',$path.'list');
  });	
```
2. Добавим в базу данных столбец `options` содержащий дополнительные параметры данного ключа, для этого создаим файл миграции баз даныых 
database/migrations/2018_08_07_000000_create_options_for_settings_table.php содержащий 
```
public function up()
{
  Schema::table('settings', function (Blueprint $table) {
    $table->jsonb('options');
  });
}
public function down()
{
		Schema::dropIfExists('settings', function (Blueprint $table) {
				$table->dropColumn('options');
		});
}
```
3. Добавим в меню пункт настроек (например в меню "Система"), для этого создадим файл src/Providers/MenuComposer.php 
```
namespace Orchid\XSetting\Providers;
use Orchid\Platform\Dashboard;
class MenuComposer
{
    public function __construct(Dashboard $dashboard)
    {
        $this->dashboard = $dashboard;
    }

    public function compose()
    {
        $this->dashboard->menu
            ->add('Systems', [
                'slug'       => 'XSetting',
                'icon'       => 'icon-settings',
                'route'      => route('platform.xsetting.list'),
                'label'      => 'Setting configuration',
                'active'     => 'platform.systems.*',
                'permission' => 'platform.systems.xsetting',
                'sort'       => 100,
            ]);
    }
}
```

4. Теперь можно создать провайдера который добавит маршрутизацию и пункт в меню - создадим файл src/Providers/XSettingProvider.php
```
namespace Orchids\XSetting\Providers;
use Illuminate\Support\ServiceProvider;
use Orchid\Platform\Dashboard;

class XSettingProvider extends ServiceProvider
{
    public function boot()
    {
   		$this->loadRoutesFrom(realpath(__DIR__.'/../../routes/route.php'));
      View::composer('platform::layouts.dashboard', MenuComposer::class);
    }
}
```

 
