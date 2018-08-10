### Как сделать пакет (плагин) в Orchid шаг за шагом. 
 
В данном уроке научимся создавать плагины для Orchid, отличае плагинов от проекта, в том что его можно легко подключать в другие проекты.

Наш плагин будет отображать [настройки](https://orchid.software/ru/docs/settings) Orchid, а также создаст возможность их редактировать.

#### Директория и подключение плагина.
Для начала нужно создать директорию где будут содержаться наши проекты, по этим действиям также можно создать плагин не только под Orchid но и для любого проекта под Laravel.

1. В корневой директории проекта создаем директорию package.  

2. В директории package создадим папку нашего проекта. - Например XSetting. 

В файле composer.json добавим пути к нашему проекту  
```
    "repositories": [ 
    { 
        "packagist.org": false, 
        "type": "path", 
        "url": "/home/youproject/package/xsetting" 
    }, 
```
Всё теперь при команде `composer install "Orchids\XSetting"` composer будет искать проект также в нашей директории. 

#### Создание плагина.
Создадим структуру пакета 

```
database/ migrations/2018_08_07_000000_create_options_for_settings_table.php
routes/route.php
src/Models/XSetting.php
src/Providers/XSettingProvider.php 
src/Http/Screens/XSettingList.php 
src/Http/Screens/XSettingEdit.php 
src/Http/Layouts/XSettingListLayout.php 
src/Http/Layouts/XSettingEditLayout.php 
Composer.json 
```

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

5. Также нужно создать модель которая описывает связи с базой данных, создадим файл src/Models/XSetting.php
```
namespace Orchids\XSetting\Models;

use Illuminate\Support\Facades\Cache;
use Orchid\Setting\Setting;
use Orchid\Platform\Traits\MultiLanguage;

class XSetting extends Setting
{
	use MultiLanguage;

	protected $fillable = ['key','value','options' ];	

	protected $casts = [
		'key' =>'string',
		'value' => 'array',
		'options' => 'array',
	];	
}
```

Теперь в меню добавится пункт настроек который будет обрабатываться роутингом и запускать нужный экран.
Осталось добавить экраны (Screens) и макеты (Layouts)

6. Добавим экран списка всех настроек, для этого создадим файл src/Http/Screens/XSettingList.php 
```
namespace Orchids\XSetting\Http\Screens;

use Orchid\Screen\Screen;
use Orchid\Screen\Layouts;
use Orchid\Screen\Link;

use Orchids\XSetting\Models\XSetting;
use Orchids\XSetting\Http\Layouts\XSettingListLayout;

class XSettingList extends Screen
{
    public $name = 'Setting List';
    public $description = 'List all settings';

    public function query() : array
    {
        return [
            'settings' => XSetting::paginate(30)
        ];
    }

    public function commandBar() : array
    {
        return [
            Link::name('Create a new setting')->method('create'),
        ];
    }

    public function layout() : array
    {
        return [
            XSettingListLayout::class,
        ];
    }

     public function create()
    {
        return redirect()->route('platform.xsetting.create');
    }
}
```

7. Добавим макет вывода списка всех настроек, для этого создадим файл src/Http/Layouts/XSettingListLayout.php 

```
namespace Orchids\XSetting\Http\Layouts;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Fields\TD;

class XSettingListLayout extends Table
{
    public $data = 'settings';
    public function fields() : array
    {
      return  [
			TD::set('key','Key')
                ->column('key')
                ->setRender(function ($shortvar) {
                return '<a href="' . route('platform.blogcms.shortvar.edit',
                        $shortvar->key) . '">' . $shortvar->key . '</a>';
            }),
			TD::set('options.title', 'Name')
				->setRender(function ($shortvar) {
                return $shortvar->options['title'];
				}),
            TD::set('value','Value')
                ->setRender(function ($shortvar) {
                     if (is_array($shortvar->value)) {
                        return substr(htmlspecialchars(json_encode($shortvar->value)), 0, 50);
                     }
                     return substr(htmlspecialchars($shortvar->value), 0, 50);
				}),
        ];
    }
}
```

8. Создадим экран создания и редактирования настройки, для этого создадим файл src/Http/Screens/XSettingEdit.php

```

```

9. Всё осталось создать файл composer.json для Композера 
```
{
  "name": "orchids/xsetting",
  "description": "Extension setting package for Orchid Platform",
  "type": "library",
  "keywords": [
    "Orchid",
    "XSetting"
  ],
  "license": "MIT",
  "autoload": {
    "psr-4": {
      "Orchids\\XSetting\\": "src/"
    }
  },
  "extra": {
    "laravel": {
      "providers": [
        "Orchids\\XSetting\\Providers\\XSettingProvider"
      ]
    }
  },
  "minimum-stability": "stable",
  "prefer-stable": true
}
```
 
