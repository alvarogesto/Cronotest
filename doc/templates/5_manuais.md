# Manuales

## Manual técnico:

- #### Información relativa a la instalación:
	Es necesario tener un dispositivo con conexión a internet. Para subir la web a internet es necesario tener un hosting e idealmente un sitio para almacenar las imágenes como s3. Pero para ver el proyecto se puede hacer todo en local sin mayor complicación.
	
	Tras clonar el proyecto es necesario hacer lo siguiente:
	- Entrar en el proyecto con `cd a21alvarogl/proyecto`
	- Introducir el comando `npm install`
	- Ejecutar el comando `composer install`
	- Luego es necesario configurar el archivo `.env`del proyecto. Para esto abrir el proyecto en Visual Studio Code,  crear un archivo `.env` y copiar dentro de el los datos del archivo `.env.example` (si lo prefieres puedes simplemente renombrar este archivo a `.env`)
	- Una vez tengamos el archivo `.env` creado es necesario rellenar dentro los datos de la base de datos (DB_DATABASE, DB_USERNAME, DB_PASSWORD). También es necesario rellenar la variable APP_KEY, para generar la llave es necesario ir a la consola y poner el comando `php artisan key:generate` y ya con eso debería aparecer rellenada en `.env` 
	- Finalmente ejecutar `php artisan storage:link` para enlazar la carpeta de `storage` (donde se guardan las imágenes que se suben al servidor) con la carpeta `public` 
	
- #### Carga inicial de datos en la base de datos.
	Dentro del proyecto de Laravel hay una carpeta llamada `database/migrations`. En ella se encuentran las migraciones para crear la ase de datos. Para ello es necesario entrar en el proyecto a través de la terminal y ejecutar el comando `php artisan migrate:fresh`. 
	
	Hay que tener en cuenta que al crear la base de datos, esta está sin ningún dato. **Para poder usar la web es necesario crear un administrador mediante consola**, usando `php artisan tinker`. Los pasos son los siguientes:
	- Entrar en el proyecto `cd a21alvarogl/proyecto`
	- Ejecutar `php artisan migrate fresh`
	- Entrar en Laravel tinker `php artisan tinker`
	- Crear un usuario administrador de la siguiente manera:
	
```
// Ve introduciendo los comandos de uno en uno

use App\Models\User;
$u = new User; 
$u->name = 'Crono';
$u->username = 'crono';
$u->email = 'cronotest@gmail.com';
$u->password = 'abc123.';
$u->admin = true;
$u->save();
```

  - Es necesario crear al administrador desde consola porque en la web, por motivos de seguridad, al crear un usuario no puedes elegir el valor del booleano admin.
  - Lo siguiente para poder usar la web con normalidad es entrar en la web es: 
  	- iniciar sesión con el usuario que has creado
  	- Ir a tu perfil
  	- Entrar al panel de administrador 
  	- Añadir categorías e idiomas (al menos un par de cada para probar los filtros del buscador), estas son necesarias para poder crear los test.
  	- Si lo prefieres puedes crearlas por consola de esta manera:
  
```
// Ve introduciendo los comandos de uno en uno

use App\Models\Category;
$c = new Category; 
$c->name = 'Videojuegos';
$c->slug = 'videojuegos';
$c->save();

use App\Models\Language;
$l = new Language; 
$l->name = 'Español';
$l->slug = 'espanol';
$l->save();

```
	
  - Hecho esto ya puedes ir a la pestaña de crear test y empezar a subir tus propios test a la web.

  -  Usuarios do sistema. Usuarios da aplicación.
  	A la página se puede acceder como un usuario no registrado, uno registrado y un administrador.

- #### Para poner en marcha el proyecto
	Cada vez que queramos poner en marcha el proyecto es necesario entrar en él (`cd a21alvarogl/proyecto`) y ejecutar:
	- `php artisan serve` en una pestaña
	- `npm run dev` en otra distinta

## Manual entorno de desarrollo

- #### Resumen básico del sistema de directorios en el proyecto
	Los directorios a los que vas a tener que acceder más frecuentemente para trabajar son los siguientes:
	- `proyecto/resources/js` dentro de esta carpeta se encuentra el Front-End del proyecto, dividido en Shared (componentes que se comparten en todo el proyecto) y Pages (las páginas de la web)
	- `proyecto/app/Http/Controllers` aquí se trabaja el Back-End
	- `proyecto/routes/web.php` en este archivo es donde se definen las rutas
	- `proyecto/database/migrations` carpeta con las migraciones de la base de datos
	- `proyecto/app/Models` aquí es donde se guardan los modelos de las tablas de la base de datos
	- `proyecto/public`en esta carpeta se guardan las imágenes públicas en la web
	- `../../proyecto/storage` dentro de esta carpeta es donde se almacenan las imágenes que se suban al servidor

- #### Información relativa a la administración del sistema, es decir, tareas que se deberán realizar una vez que el sistema esté funcionando
	Una vez la web se encuentre funcionando se deberán realizar las típicas tareas de mantenimiento. Estas consisten en generar periódicamente copias de seguridad de la base de datos, moderar los usuarios y el contenido que se sube a la web y estar corregir problemas de seguridad que se vayan encontrando.

- #### Información relativa al mantenimiento del sistema:
    A futuro la web se puede mejorar añadiendo nuevas funcionalidades. 
    Las más relevantes dirían que son:
    - Poder editar los test ya creados.
    - En el resumen del test, al pinchar en uno de los cuadrados que representan las preguntas que has realizado, que se muestre el título de las preguntas que has fallado junto con la respuesta correcta.
    - Más modos de juego.

    Además, siempre se podrán añadir mejoras de la interfaz, la seguridad o la optimización del código. Con respecto a los fallos, es inevitable que vayan surgiendo nuevos cuanto más testeas la página, pero el más relevante es el de las imágenes (del cual hablo detalladamente en la parte de codificación y pruebas en la parte del prototipo final). 