<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

# Description

[This](https://github.com/jjuanrivvera99/laravel-nginx-mysql-docker) is a complete laravel environment using docker-compose with the following services: nginx, queue daemon, redis, mysql, scheduler and node js.

## How to run this project

To run this project you need to have docker and docker-compose installed in your machine.

Take the following steps:

- clone this repository by executing the following command: 'git clone https://github.com/jjuanrivvera99/laravel-nginx-mysql-docker'
- change directory: 'cd laravel-nginx-mysql-docker'
- run command: 'cp .env.example .env'
- run command: 'docker-compose up -d --build'
- run command: 'docker-compose exec php sh -c "composer update -d /var/www" '
- run command: 'docker-compose exec php sh -c "php /var/www/artisan key:generate" '
- run command: 'docker-compose exec php sh -c "chmod 775 -R /var/www/storage" '
- run command: 'docker-compose restart nginx'

If your user UID is different from 1000 make sure HOST_UID env var it's correctly setup.

## License

The Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).

Php laravel 框架（api、排程），前端搭配vue.js，資料庫使用mysql
（可上網找example套用，API、排程邏輯、ＤＢ資料表自己寫）
使用docker compose 開發

玩家維護功能
（新增、查詢，玩家帳號、名稱、幣別）

遊戲維護功能
（新增、修改、查詢，
遊戲繁簡英名稱、代號、遊戲類型）

注單查詢功能
（搜尋條件-可依日期[同一天不同時段]、依局號）
顯示欄位-注單編號、下注時間、遊戲名稱、會員帳號、幣別、投注額、派彩、局號[多筆注單對應到同一局號]

查看每日注單結算報表功能
（需使用排程每日結算，搜尋條件-日期）
顯示欄位-遊戲分類[slot、poker、fish]、總單量、總投注、總派彩

docker路径：cd /c/Users/Administrator/Downloads/new/laravel-nginx-mysql-docker
datatable用了這個:https://jamesdordoy.github.io/laravel-vue-datatable/?p=/laravel/controller-resource
npm i laravel-vue-datatable  
npm uninstall laravel-vue-datatable  
composer require jamesdordoy/laravelvuedatatable

php artisan migrate  建立
php artisan migrate:rollback 重置
php artisan db:seed --class=BetsSeeder 
php artisan make:model dailyBets --all 可以用这个一次全健好
<players-content :data="{{ $searchPlayerInfo }}"></players-content> 寫法
------排程----- 
* * * * * cd /laravel-nginx-mysql-docker && php artisan schedule:run >> /dev/null 2>&1
* * * * * php /laravel-nginx-mysql-docker/artisan schedule:run >> /dev/null 2>&1
* * * * * cd \Users\Administrator\Downloads\new\laravel-nginx-mysql-docker && php artisan schedule:run >> /dev/null 2>&1
* * * * * php artisan schedule:run >> /dev/null 2>&1
php artisan crontab -l 查看排程
apk add --update busybox-suid
php artisan crontab -e 編輯排程
php artisan schedule:list  列表
------排程----- 
laravelnginxmysqldocker_php_1
docker exec -it laravelnginxmysqldocker_php_1 bash
docker exec -it laravelnginxmysqldocker_scheduler_1 bash
docker logs -f slot-wagersinfo-client-6bc54dfc7f-qslsj

docker run --name=laravelnginxmysqldocker_scheduler_1 -d -it laravelnginxmysqldocker_scheduler_1 bash

php artisan migrate
php artisan db:seed
php artisan command:dailyBets