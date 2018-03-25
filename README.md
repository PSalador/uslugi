# uslugi
Add DB masters and services for Orchid CMS

## Github форматирование текста (README.md)
[Форматирование github](https://help.github.com/articles/basic-writing-and-formatting-syntax/)

## Настрока git

[Установка git на centos](https://www.8host.com/blog/ustanovka-git-na-centos-7/)
В основном отсюда [Пошаговая инструкция по работе с git и github для студентов](https://github.com/andreiled/mipt-cs-4sem/wiki/%D0%9F%D0%BE%D1%88%D0%B0%D0%B3%D0%BE%D0%B2%D0%B0%D1%8F-%D0%B8%D0%BD%D1%81%D1%82%D1%80%D1%83%D0%BA%D1%86%D0%B8%D1%8F-%D0%BF%D0%BE-%D1%80%D0%B0%D0%B1%D0%BE%D1%82%D0%B5-%D1%81-git-%D0%B8-github-%D0%B4%D0%BB%D1%8F-%D1%81%D1%82%D1%83%D0%B4%D0%B5%D0%BD%D1%82%D0%BE%D0%B2)
Скопировать репозиторий в каталог. Запускать команду в нужном каталоге, в нем он создаст папку uslugi и там будут все файлы
`git clone https://github.com/PSalador/uslugi.git`

Просмотреть конфигурацию - эти команды делать 1 раз
`git config --list`
Настройка конфигураций
```
git config user.name ivan.ivanov
git config user.email ivanov@example.com
```
Узнать в правильном ли каталоге, и какие изменение есть
`git status`

Обновление репозитория на сервере с github
`git pull` если с ветки `git pull origin develop`


Загрузка с сервера в github
1) Изменяем файлы, только после того как все норм и работает переходим к следующему шагу - не нужно после каждого сохранения заливать в github, если новый проект то `git init`
2) Командой `git add %file_path%` отмечаем все измененные и добавленные файлы или папки, для добавления всех папок `git add .`
3) Командой `git commit` добавляем описание к изменению - это изменение добавится ко всем измененным файлам (Выход - нажимаем esc потом :q или :wq и Enter) также можно использовать команду `git commit -m "%commit_message%"`
4) Можно посмотреть историю изменений `git log`, но не нужно
5) Загрузка в репозиторий на github `git push origin master` далее вводим логин пароль. Загрузка в ветку `git push origin master:userscreen`


Загрузка на fork  репозитория
1) в каталоге репозитория выполнить `git remote add salador https://github.com/psalador/platform.git`
где salador любое имя
2) смотрим информацию `git remote show salador`
3) загружаем `git push salador master` [доп информация](https://git-scm.com/book/ru/v1/%D0%92%D0%B5%D1%82%D0%B2%D0%BB%D0%B5%D0%BD%D0%B8%D0%B5-%D0%B2-Git-%D0%9F%D0%B5%D1%80%D0%B5%D0%BC%D0%B5%D1%89%D0%B5%D0%BD%D0%B8%D0%B5)

Переписать с github
1) git fetch --all
2) git reset --hard origin/<branch_name>
[Отсюда](http://qaru.site/questions/92/how-do-i-force-git-pull-to-overwrite-local-files)

Удалить последний коммит
git reset HEAD^ --hard
переписать удаленный реп (-force) `git push origin master:userscreen -f`


## Создание пакета в laravel
Используется статья [Разработка пакета для Laravel 5. Пошаговая инструкция с картинками.](https://laravel-news.ru/blog/tutorials/develop-laravel5-package-step-by-step)
Также использовал расширение [Monitor](https://github.com/TheOrchid/Monitor) для Orchid CMS/


1) Ошибка была в том, что пакет создал в каталоге vendor, потом в корневом каталоге Laravel добавил папку Package, а уже в неё установил свой пакет.
2) В корневом файле composer.json установленного Laravel добавил строки чтобы искал пакет в каталоге package
```
	 "repositories": [
        {
			"packagist.org": false,
            "type": "path",
            "url": "./package/uslugi"
        }
	]
```
3) Подключил с помощью команды `composer require salador/uslugi:dev-master --prefer-source` правда в vendor он установил только ссылку.
4) Опубликовал провайдера с помощью команды `php artisan vendor:publish --provider="Salador\Uslugi\Providers\UslugiServiceProvider"`
5) Установить таблицы данных `php artisan migrate`, для того чтобы установить таблицы из одного каталога php artisan migrate --path=package/uslugi/database/migrations/
6) Зашел в админку, добавил разрешение - отобразилась иконка "Услуг"

## Команды Laravel

`dd();` //Просмотр отладочной информации как var_dump

## Orchid Platform

class FormGroup создает группы с табами. Таб можно добавлять через слушатели (Event, Lisener).

1) В папке src/Providers - провайдеры котрые запускаются когда устанавливается пакет.
2) В папке src/Http/Controllers - контроллеры на которые перекидывает файл routes/route.php (он обрабатывает все пути сайта)
3) В папке src/Http/Forms - классы форм 
4)  

## Orchid Platform порядок создания пакета.
1) Файл конфигурации в папке config, файлы миграций базы данных в database/migrations, файлы локализации в resources/lang
2) Создаем провайдера src/Providers/UslugiServiceProvider.php в нем указываются основные настройки, и подключение файлов из предыдущего пункта [Документация](https://laravel.ru/docs/v5/providers)
3) Создаем файл маршрутизации routes/route.php в нем указывается контроллеры обрабатывающий путь браузера [Документация](https://laravel.ru/docs/v5/routing)
4) Создаем файл контроллера src/Http/Controllers/ServiceController.php он обрабатывает запросы от routes/route.php и первеодит их в классы форм.
5) Создаем файл форм src/Http/Forms/Services/ServicesFormGroup.php он перводит запросы в шаблон 
6) В папке Behaviors - какие поля в формах и  их свойства.
7) В папке Events - события, Listeners - слушатели событий.
8) В папке Models - модели таблиц базы данных, что бы с таблицамми работать как с объектами.


##Webpack компилирование js and scc
1) в папке vendor/orchid/platform запустить npm run dev или npm run production 
