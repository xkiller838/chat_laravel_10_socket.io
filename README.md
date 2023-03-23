<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Funcionamiento

Chat sencillo entre laravel y socket.io implementando como base de datos reddis y mysql, boostrap en su version 5 pocas validaciones el ejemplo se usa para ilustrar la manera de realizar un sistema de chat simple sin usar laravel websocket o pucher solo con las tecnologias antes mencionadas de forma gratuita codigo sencillo y simplista.

los datos se almacenan en base de datos pero se esta usando redis para guardar los datos y mostrarlos de forma temporal en la parte de javascrip se esta usando una libreri que permite el intercambio de estos datos desde esa base de datos.

El codigo puede mejorar de varias maneras este solo es un ejemplo de forma didactica de como podria funcionar

## Pasos para la ejecucion del programa 

- Se debe ejecutar como primera instancia en entorno local npm run dev para compilacion del javascript y css de boostrap 5.
- El servidor esta configurado en el puerto http://127.0.0.1:8000 por tanto se debe ejecutar en entorno local php artisan serve esto es personalizable.
- Para la ejecucion de eventos se debe mantener ejecutando php artisan queue:work.
- Por parte de javascript debe ejecutarse con node npm run server para la ejecuin del servidor.

##Comandos ejecutables 

- npm run serve

![ejecutar_npm](https://user-images.githubusercontent.com/33810066/227340609-fe5363bd-68e1-4ee6-af96-0ddb9f586c53.png)

-php artisan serve

![ejecutar_artisan](https://user-images.githubusercontent.com/33810066/227341684-8ac08516-1901-4882-8e66-58bfbbff77d9.png)

-php artisan queue:work

![ejecutar_las_colas](https://user-images.githubusercontent.com/33810066/227341816-a465257e-ca0f-4bbc-817c-9303b00a1147.png)

-npm run server

![ejecutar_servidor](https://user-images.githubusercontent.com/33810066/227342014-b6b74246-1846-4ed9-9487-5e65a7bea838.png) 





