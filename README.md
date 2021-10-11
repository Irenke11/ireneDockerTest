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
（API、排程邏輯、ＤＢ資料表自己寫）
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

常用指令：
composer dump-autoload
php artisan migrate  建立
php artisan migrate:rollback 重置
php artisan db:seed --class=BetsSeeder 
php artisan make:factory timeTestFactory --model=timeTest
php artisan make:test playerTest --unit
php artisan db:seed

command指令測試：
php artisan command:dailyBets
php artisan test

排程：
php artisan crontab -l 查看排程
php artisan crontab -e 編輯排程
php artisan schedule:list  列表
php artisan schedule:run

test unit：

我们现在将使用七个基本的 PHPUnit 断言来为我们的 Box 类编写测试。这些断言是：
assertTrue() true 或 false 
assertFalse() true 或 false 
assertEquals()  用于比较变量实际值与预期值是否相等。
assertNull() 为空
assertContains() 断言传递进来的数组中包含指定值，
assertCount() 断言数组的项数为指定数量
assertEmpty() 断言传递进来的数组为空。
vendor/phpunit/phpunit/phpunit
