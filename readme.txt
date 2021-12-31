cara manimpilkan foto yang hilang
->extract file foto.rar atau foto.zip
->pindahkan file tanpa meruba namanya
 ke folder majoo_test\storage\app\public\upload\foto

==maka foto yang hilang akan muncul===
sebelum memindahkan foto lakukan printah ini pada command promt:
->composer install
->rename file .env.example menjadi .env
->php artisan storage:link (untuk membuat folder foto)
