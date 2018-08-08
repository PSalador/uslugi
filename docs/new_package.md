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
 
