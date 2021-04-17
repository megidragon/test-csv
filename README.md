Test :)

¿Como instalar proyecto?

tener <a href="https://www.docker.com/">docker</a> y <a href="https://docs.docker.com/compose/install/">docker compose</a> instalado

correr en el directorio del proyecto desde consola:  <br/>
`docker-compose up -d`
`docker-compose exec php composer install`

Copiar el archivo .env.example a .env <br/>
`cp .env.example .env`

Levantar la db correctamente: <br/>
`docker-compose exec php artisan migrate`