## docker build process
docker-compose down
docker-compose build
docker-compose up -d
docker-compose exec app /bin/sh
/var/www/work # composer update
/var/www/work # php artisan migrate
/var/www/work # php artisan storage:link

--- ここまで
//Laravel セッティング
docker-compose exec app composer install
docker-compose exec app php artisan key:generate

docker-compose exec app php artisan migrate
// データ投入があれば行う
docker-compose exec app php artisan db:seed

//おまけ
docker-compose exec app php artisan tinker
Psy Shell v0.10.11 (PHP 8.0.9 — cli) by Justin Hileman
>>> App\Models\User::create(['name' => '管理者', 'email' => 'admin@gmail.com', 'password' => bcrypt('12345Ab')]);

>>> exit


