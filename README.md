<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Basic Project Template</h1>
    <br>
</p>

Yii 2 Basic Project Template is a skeleton [Yii 2](https://www.yiiframework.com/) application best for
rapidly creating small projects.

The template contains the basic features including user login/logout and a contact page.
It includes all commonly used configurations that would allow you to focus on adding new
features to your application.

[![Latest Stable Version](https://img.shields.io/packagist/v/yiisoft/yii2-app-basic.svg)](https://packagist.org/packages/yiisoft/yii2-app-basic)
[![Total Downloads](https://img.shields.io/packagist/dt/yiisoft/yii2-app-basic.svg)](https://packagist.org/packages/yiisoft/yii2-app-basic)
[![build](https://github.com/yiisoft/yii2-app-basic/workflows/build/badge.svg)](https://github.com/yiisoft/yii2-app-basic/actions?query=workflow%3Abuild)

Задание
-------------------

- Сервис коротких ссылок + QR

- Создать проект на использующий следующий стек: Yii2  MySQL/MariaDB  jQuery  Bootstrap     

- При переходе на главную страницу проекта мы видим форму Input, в которую подставляем любую ссылку. 

- Рядом кнопка "ОК", при нажатии на которую сервис должен проверить (отвалидировать): 

- Валидность URL ссылки (http:: https ну и далее все атрибуты)  

-Доступность данного ресурса (если не доступен выводим: Данный URL не доступен)  

-Если проверка валидности и доступности пройдена - сохраняем ссылку в базе и формируем короткую ссылку + QR кода  

-Пользователю после нажатия отдаем либо сообщение об ошибке, либо QR код и рядом с ним короткую ссылку (все это происходит через Ajax без перезагрузки страницы)  

- QR - при наведении камеры телефона на QR код: должна генерироваться ссылка и ее можно открыть (контроллер перехода по ссылки делаем отдельно)  

- При попытке перейти по короткой ссылке - происходит редирект на необходимый сайт (заложенный при генерации ссылки)  

- При переходе по ссылки в базе делаем запись, с какого внешнего IP перешел пользователь по этой ссылке (логи) + счетчик, который показывает сколько было переходов   



Установка
------------

 1. Склонировать репозиторий  

 2. Установить зависимости из composer  
~~~
composer install
~~~

3. Создать БД и сконифгурировать подключение в файле /config/db.php

5. Выполнить миграции  
~~~
php yii migrate
~~~

5. Запустить проект в тестовом режиме
~~~
php yii serve
~~~

6. Можно смотреть по адресу http://localhost:8080/  


### Тестирование  

Для запуска unit тестов выполнить:
~~~
vendor/bin/codecept run unit
~~~  
