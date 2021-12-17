laravel8初期状態のコンテナです。
phpmyadminを入れて、php.iniのファイルサイズ上限だけ上げています。

ポート番号8080
phpmyadmainは8081

インストール後に下記のコマンドが必要
docker compose exec app bash
composer install
cp .env.example .env
php artisan key:generate
php artisan storage:link
chmod -R 777 storage bootstrap/cache
php artisan migrate
exit