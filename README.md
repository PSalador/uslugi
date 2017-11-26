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
`git pull`

Загрузка с сервера в github
1) Изменяем файлы, только после того как все норм и работает переходим к следующему шагу - не нужно после каждого сохранения заливать в github
2) Командой `git add %file_path%` отмечаем все измененные и добавленные файлы или папки
3) Командой `git commit` добавляем описание к изменению - это изменение добавится ко всем измененным файлам (Выход - нажимаем esc потом :q или :wq и Enter) также можно использовать команду `git commit -m "%commit_message%"`
4) Можно посмотреть историю изменений `git log`, но не нужно
5) Загрузка в репозиторий на github `git push origin master` далее вводим логин пароль.

## Создание пакета в laravel
Используется статья [Разработка пакета для Laravel 5. Пошаговая инструкция с картинками.](https://laravel-news.ru/blog/tutorials/develop-laravel5-package-step-by-step)
