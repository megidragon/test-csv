Test :)

¿Como instalar proyecto?

Requiere
* Tener <a href="https://www.docker.com/">docker</a> y <a href="https://docs.docker.com/compose/install/">docker compose</a> instalado
* Virtualizacion activa en su ordenador
* En caso de windows, hyper-v activado

<hr>

correr en el directorio del proyecto desde consola:  <br/>

* `docker-compose up -d`
* `docker-compose exec php chmod 777 /var/www/html/storage -R`
* `docker-compose exec php composer install`

Copiar el archivo .env.example a .env <br/>

* `cp .env.example .env`

Levantar la db correctamente: <br/>

* `docker-compose exec php artisan migrate`
* `docker-compose exec php artisan queue:work` O en su defecto si prefiere corrarlo una sola vez utilize `docker-compose exec php artisan queue:work --once`

Y listo, no cierre la consola con el worker corriendo, abrir localhost en el puerto normal 80 y ya tenes todo levantado :) <br/>
<a href="http://localhost">Localhost</a>

<hr>
Si desean abrirlo en otro puerto deben cambiarlo en el archivo nginx/defailt.conf donde dice 80 al inicio y luego en docker-compose.yml cambiar donde dice "80:80" a "TU_PUERTO:80"

<hr>

TODO:

* Setear un tiempo para eliminar los registros una vez procesados por el importador (no hecho por falta de tiempo)
* Definir limites de peso para importación (no hecho por falta de información)
* Live update en la pagina de detalles
