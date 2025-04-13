# Codificación y Pruebas

## Primer prototipo del proyecto (27-10-2023)

#### -¿Qué se ha hecho?
- Configurar el entorno de desarrollo.
- Crear la base de datos del proyecto.
- Crear el layout del proyecto junto con la barra de navegación.

#### -Explicación de cada parte
- ###### Configurar el entorno de desarrollo.
	En el caso de este proyecto estoy usando Laravel (framework de php), Vue (framework de JavaScript), Tailwind (framework de css), Mysql e Inertia que se usa para "enlazar" Laravel y Vue, está enfocado en crear webs SPA (Single Page Aplication) de manera sencilla y permite gestionar las rutas desde el lado del servidor pese al estar usando Vue. 
- ###### Crear la base de datos del proyecto.
	Para crear la base de datos del proyecto he usado Eloquent el ORM (object-relational mapper) de Laravel. 
	Eloquent se basa en sistema de Modelos y Migraciones
- ###### Crear el layout del proyecto junto con la barra de navegación.
	Primero creé en un componente Vue con la barra de navegación, luego hice otro componente que importa la barra de navegación y el footer. Entre ellos se encuentra un slot que recibe los componentes con el contenido de cada página.
	
	Al empezar a crear la barra de navegación esta me permitió probar lo básico de Tailwind, siendo este bastante cómodo de usar. Además, aquí ya he empezado a sacar provecho a Inertia. Como ya había mencionado, con Inertia puedes crear SPA y gestionar las rutas desde el lado del servidor. 

	Al crear una SPA tienes la ventaja de que eliminas el tener que recargar la web cada vez que cambias de página creando experiencia de usuario sea muy fluida. Esto también hace que tengas que cambiar la forma con la que estructuras el proyecto, lo cúal se me hizo un poco confuso.

	Para empezar importé de forma global (para así no tener que importarlo cada vez que me haga falta) un componente llamado `<Link>` de Inertia. Link es la alternativa de inertia de usar la clásica etiqueta `<a>` de  html. Dentro de Link introduzco una ruta, las cuales están definidas en el archivo web.php dentro de la carpeta routes. Y al usar Inertia tengo que especificar que componente Vue quiero que se cargue al acceder a ellas. 

#### -Dificultades encontradas
Esta parte del proyecto resultó ser más compleja de lo que esperaba. 
En un principio contaba con configurar el entorno de desarrollo bastantes rápido y ponerme ya con el proyecto en sí. Pero al final me daban errores en la configuración de los distintos elementos del stack de desarrollo. Y tuve que estar revisando bien los archivos de configuración de laravel para ver que dependencias fallaban y que otras me hacían falta instalar.

Para crear la base de datos he tenido que usar Eloquent, el cual usa un sistema de Modelos y Migraciones. Aunque una vez lo entiendes se vuelve bastante sencillo y rápido crear y modificar la base de datos, al principio tuve bastantes problemas con las relaciones entre tablas. Además, tuve que traducir la base de datos al inglés porque Laravel por defecto tiene unas convenciones para los nombres de los modelos y las migraciones y si los nombres ya están en inglés te ahorras posibles problemas.

Finalmente, para crear el layout y la barra de navegación no tuve que hacer nada especialmente complicado. La dificultad residía en que son tecnologías nuevas y no estoy familiarizado con ellas (excepto Vue). Por ello, lo que más me ha costado ha sido ser capaz de estructurar mentalmente el proyecto. Especialmente el como funciona y se organizan los directorios en Laravel y el como gestionar una SPA.

## Segundo prototipo del proyecto (10-11-2023)

#### -¿Qué se ha hecho?
- Creado el footer.
- Añadido clases personalizadas a Tailwind.
- Instalado Headless UI.
- Modificada la base de datos.
- El prototipo del sistema de login.
- El prototipo del sistema de creación de test.
#### -Explicación de cada parte

- ###### Creado el footer.
	Simplemente cree un sencillo footer con el logo y el nombre de la web.
- ###### Añadido clases personalizadas a Tailwind.
	En tailwind puedes crear tus propias clases personalizadas modificando el archivo tailwind.config.js. Lo que hice fue añadir la paleta de colores que quiero usar en la web junto a unas sombras personalizas (pues las que tienen por defecto Tailwind difieren a las que usaba en los mockup). Además ya aproveché para empezar a da estilos a la web.
- ###### Instalado Headless UI.
	Headless UI es una librería de código abierto que contiende componentes para Tailwind.
- ###### Modificada la base de datos.
	Tras empezar con la creación de la sistema de login y sobretodo con la creación de los test, tuve que modificar la base de datos para que funcionase correctamente. Eliminando, añadiendo y modificando tablas en el proceso.
 - ###### Hecho el prototipo del sistema de login.
	 Creado un sistema de login donde se puede registrar un usuario, iniciar sesión y cerrar sesión. Además limité el acceso a algunas partes de la web solo a usuarios registrados.
 - ###### Hecho el prototipo del sistema de creación de test
	Creado un prototipo del sistema para crear los test en la página. El sistema es el siguiente:
	- Primero un formulario donde se introducen los datos generales del test.
	- Luego otro formulario donde se introduce una pregunta.
	- Después un formulario para introducir una respuesta a la pregunta.
	- Finalmente aparece el último formulario, el cual permite elegir la siguiente acción (añadir otra respuesta, otra pregunta o terminar el test).

#### -Dificultades encontradas
Para este prototipo lo más difícil fue crear la página para la creación de test. 
Primero tuve que aprender a subir datos al servidor. Para ello tuve que crear un método post personalizado que recoge los datos del componente Vue (el front-end) y los manda a un controlador (el back-end) y ya ahí gestionar la subida al servidor. Para que esto funcione adecuadamente, es necesario tener bien definidos los modelos de cada tabla en Laravel. Tras varios intentos conseguí que se subiesen los datos.

El problema vino al querer hacer que en una sola página se pudiese rellenar todos los datos de la web (información general, preguntas y respuestas) al mismo tiempo. 
Al tener los campos del test en tablas separadas (tests, questions, answers etc.) a la hora de hacer el post con los datos no era capaz de indicar a que pertenecía cada cosa. Por ejemplo, en la tabla test guardo el id de todas las preguntas que contienen, y al mismo tiempo en la tabla questions guardo todas las respuestas. Al querer hacer todo a la vez tenia el problema de que no podía decir que las preguntas con id 1, 2 y 3 pertenecían al test con id 1. Y que las respuestas con id 1 y 2 pertenecía a la pregunta 1 (por ejemplo). 

Al final, decidí rehacer esa parte, y tener un componente para cada acción. De esta forma primero creo el test, luego la pregunta, después la respuesta y por último la siguiente acción. Al estructurarlo de esta manera, soluciono el problema pues voy subiendo los datos en orden.

## Tercer prototipo del proyecto (24-11-2023)

#### -¿Qué se ha hecho?
- Mejorados los estilos.
- Mejorada la parte de crear test.
- El prototipo del buscador de test.
- El prototipo de la biblioteca para guardar test.
- Empezada la pestaña para más información.
- Empezada la pestaña para realizar los test.
- El prototipo de la página de inicio.
- Empezado con los perfiles de usuario.
- Otros pequeños cambios.
  
#### -Explicación de cada parte
- ###### Mejorados los estilos.
	Retocado los estilos de la web, ajustando los colores para que se vean bien en todos los tipos de pantalla. Añadido nuevos detalles a los elementos junto con la imagen de fondo, animaciones y breakpoints.
- ###### Mejorada la parte de crear test.
	Añadido mejoras a los formularios de crear test. Ahora para seleccionar un idioma se debe de escoger desde un select que recibe los datos desde el lado del servidor, al igual que las categorías.
- ###### Hecho el prototipo del buscador de test.
	Hecho un prototipo de la pestaña para buscar test. Por defecto muestra todos los test de la web. Luego ofrece la opción de filtrar por nombre, categorías o idioma. Además los resultados se muestran de forma dinámica, según vas escribiendo palabras en el buscador.
- ###### Empezada la pestaña para más información.
	Esta es una pestaña a la que se accede tras pulsar sobre un test. En ella se muestra la información detallada de cada test. Además es también la pestaña que se usa para realizar los test y para guardarlos en la biblioteca.
- ###### Empezada la pestaña para realizar los test.
	La pestaña para realizar los test es la principal web. Hasta el momento la pestaña tiene la funcionalidad de mostrar cada pregunta con su respectivas respuestas. Al pulsar en una pregunta, si está bien el color de todas la preguntas cambiará a blanco y si está mal a naranja. Tras 1 segundo de espera se pasará a la siguiente pregunta y así hasta que se acabe el test.
- ###### Hecho el prototipo de la biblioteca para guardar test.
	En la biblioteca se pueden guardar los test que quieras. Para hacer eso simplemente tienes que pulsar el botón "guardar" en la pestaña de información detallada. Si luego quieres quitar ese mismo test de la biblioteca hay otro botón para hacerlo. En el caso de que no haya ningún test guardado, aparece un mensaje explicando que no tiene ningún test guardado y con un enlace para ir a la pestaña de buscar test.
- ###### Hecho el prototipo de la página de inicio.
	El prototipo de la página de inicio es simplemente un mensaje explicando de que trata la web con un enlace a la pestaña de buscar test.
- ###### Empezado con los perfiles de usuario.
	Empezado con las pestañas para ver los perfiles de los usuarios pero de momento solo es un componente Vue que ofrece la opción de cerrar sesión.
- ###### Otros cambios.
	Otros pequeños cambios que hice fueron:
	- Modificar la barra de navegación, añadiendo un icono para el usuario y quitando la opción de cerrar sesión.
	- Mover esa opción de cerrar sesión a la página del perfil de Usuario.
	- Mejorados los estilos.
#### -Dificultades encontradas
El mayor problema que he tenido fue para mostrar las preguntas y respuestas por orden. Desde el controlador mando toda la información del test y la recibo como prop en el componente Vue. Eso hace que si simplemente haces un `v-for` para mostrar todas las preguntas, van a aparecer todas a la vez. Para arreglar esto, se guarda en una variable la pregunta actual y se muestra solo la pregunta que se corresponda con esa variable (por ejemplo, si la variable vale 0 se muestra la primera pregunta), al seleccionar una respuesta se aumenta en 1 el contador de la variable.
El mismo problema sucede con las respuestas, junto con el problema añadido de que tienen que coincidir con la pregunta que está en ese momento. Para arreglarlo es necesario tener una propiedad computada que filtra las respuestas según la pregunta actual. 

Con respecto al resto de páginas, en la del buscador lo más complicado era hacer el sistema de filtrado de test. Especialmente en el momento en el que tienes varios formas distintas para filtrar los test.
En la pestaña para más información tuve que usar un método get para pasar el id del test sobre el que se ha pulsado (y así pasar solo los datos de ese test). Además tuve algunos problemas para que la imagen se adaptase al tamaño del contenedor sin deformarse ni perder el tamaño.

## Prototipo final del proyecto (17-12-2023)

#### -¿Qué se ha hecho?
- Hecha la pestaña de valoración y resumen.
- Hecho los perfiles de usuario
- Mejorada la pestaña de realizar test y añadido el modo de juego casual.
- Maquetada la pestaña de información detallada.
- Modificada la barra de navegación para que sea responsiva.
- Modificada la pestaña de buscar para que sea responsiva.
- Añadida la paginación a los test.
- Implementada la API de Open Trivia Database.
- Añadida la responsividad en los apartados que faltaban
- Añadida la opción de borrar test
- Añadido el panel de administrador
- Subida de archivos al servidor
- Otros pequeños cambios.
  
#### -Explicación de cada parte
- ###### Pestaña de valoración y resumen
    Esta es una pestaña que aparece tras acabar un test. En ella se invocan dos componentes de Vue, uno con el resumen y otro con el formulario para valorar el test. En el resumen se muestra la puntuación (si estás en el modo casual) y el número de preguntas que has acertado (junto con unos cuadrados que lo indican gráficamente). El componente de valoración se muestra si el usuario está autenticado y permite que quien quiera valore el test.
- ###### Perfiles de usuario.
    Implementados los perfiles de usuario a los cuales puedes acceder al pulsar el nombre del autor en los tests. En ellos se puede ver la siguiente información:
    - Nombre y nombre de usuario
    - Número de me gustas que han recibido sus tests.
    - Una descripción que haya añadido el usuario de sí.
    - Todos los tests que haya creado.  
    - En el caso de que estés viendo tu propio perfil de usuario, se ofrece la opción de editar los datos que aparecen y de cerrar sesión. Además, puedes acceder a tu propio perfil desde la barra de navegación.
- ###### Mejorada la pestaña de realizar tests y añadido el modo casual.
    He implementado algunas mejoras en la realización del test. La principal es que ahora hay una barra que muestra gráficamente cuánto tiempo te queda para responder a la pregunta. Además, se ha implementado el modo de juego casual, donde no hay límite de tiempo ni puntuación. Para elegir el modo en el que realizar el test, ahora el botón de realizar test en la pestaña de información detallada despliega un menú desplegable que permite elegir entre ambas opciones.
- ###### Maquetada la pestaña para más información.
    Hecha la maquetación de la pestaña de información detallada, ahora se muestran más datos relacionados con el test, como las valoraciones que tiene o la puntuación que has conseguido la última vez que has realizado el test. Se da la opción de valorar directamente el test desde esta pestaña sin necesidad de tener que volver a realizar el test.
- ###### Modificada la barra de navegación a una responsiva.
    Hasta ahora, la barra de navegación solo se veía bien en pantallas grandes. Ahora, cuando la pantalla es demasiado pequeña, la barra colapsa en un menú hamburguesa, quedando así el logo y el botón para desplegar el menú.
- ###### Modificada la pestaña de buscar para que sea responsiva.
    Similar al caso anterior, la pestaña de buscar al tener una barra lateral para implementar el buscador y los filtros. Esto hace que en pantallas pequeñas no se vea bien, de forma que ahora cuando la barra lateral ocupa demasiado simplemente colapsa y se añade un botón para desplegarla cuando sea necesario.
- ###### Añadida la paginación a los tests.
    Es una funcionalidad necesaria para este tipo de webs en las que se sube constantemente contenido. Ahora solo se cargan una determinada cantidad de tests a la vez, y para ver todos simplemente se avanza de página. Esto evita problemas de rendimiento y que la página sea demasiado grande.
- ###### Implementación de la API de Open Trivia Database
    Esta API devuelve diversas preguntas de trivial. La forma en la que la he implementado no es para conseguir preguntas para los tests, sino para que los usuarios que no sepan qué crear tengan alguna inspiración. Esta API la uso en un componente que devuelve 10 preguntas aleatorias en la pestaña para crear tests y preguntas. La idea es que si alguien quiere crear un test pero no sabe sobre qué hacerlo, genere preguntas y con suerte encuentre entre ellas algún tema que le motive. De la misma forma, si quiere añadir más preguntas a un test pero no se le ocurre qué más poner, puede usar alguna de las preguntas aleatorias para sacar una idea. 
- ###### Añadida la responsividad en las pestañas que faltaban
    - Hecho que las pestañas de información detallada, valoración, realizar test y el perfil se vean bien en móvil y tablet.
- ###### Añadida la opción de borrar test
    - Gracias a esto, ahora los usuarios pueden entrar a la pestaña de información detallada y verán, si el test es suyo, un botón que les deja borrar el test. En el caso de que el usuario sea un administrador siempre va a poder borrar cualquier test.
- ###### Panel de administrador
    - Los usuarios administradores al entrar en su perfil verán un botón para entrar a este panel. En él se pueden añadir nuevas categorías e idiomas para los test.
- ###### Subida de archivos en el servidor
    - Ahora se puede añadir una imágen los test, a las preguntas y tu propio usuario (un avatar). Estas imágenes se quedan guardadas dentro de `storage/images` en laravel (en una web en producción con montones de imágenes habría que usar un servicio externo como s3) y lo que se guarda en la base de datos es la ruta para acceder a esa imagen.
- ###### Otras mejoras
    - Aparte de lo anteriormente citado, también he ido arreglado diferentes bugs y errores en la maquetación y los estilos de web (por ejemplo arreglar que las textos muy largos se desbordaban). Uno de los cambios que he añadido es que ahora por defecto se muestran los test mas recientes primero.

#### -Dificultades encontradas
Respecto a las dificultades encontradas, cabe destacar la maquetación de la web y la subida de archivos.

La adaptación de la barra de navegación a móviles fue mucho más compleja de lo que parecía a primera vista. En un principio, intenté convertirla en un dropdown utilizando un componente de Headless UI, pero encontré errores en la maquetación al emplear flex. Finalmente, opté por un enfoque en el que, cuando la pantalla es demasiado pequeña, el flex-row se convierte en un flex-col, de modo que el contenido se distribuye en una columna hacia abajo. Para ocultar elementos en Tailwind, se utiliza la clase `hidden`, de manera que, utilizando JavaScript, puedes hacer que, al pulsar el botón, las clases de los elementos que están ocultos con `hidden` cambien a `flex` en su lugar.

Para solucionar los problemas de maquetación en la pestaña de búsqueda, apliqué un enfoque similar al anterior. Cuando la pantalla no es lo suficientemente grande, el menú colapsará y se mostrará un botón para elegir si quieres ver la barra lateral o los tests. Tuve que solucionar algunos problemas de maquetación, como ocultar los tests para mostrar la barra y luego, al agrandar la ventana, volver a mostrar los tests.

Siguiendo estos mismo principios el resto de pestañas las he adaptado a móvil de forma similar, intercambiando según el tamaño entre flex-row y flex-col etc. 

Eso sí, maquetar la pestaña de información detallada resultó más difícil de lo esperado, ya que al tener tanta información al mismo tiempo, me costaba encontrar una forma de que quedara bonita y organizada.

El mayor problema que he tenido hasta la fecha es la subida de archivos al servidor. Tras varios intentos he conseguido hacer que funciones la subida de archivos al servidor. Para hacer que funcione tengo un campo `input type="file"` que recibe la imagen luego cuando el usuario hace submit manda los datos de la imagen junto con los del resto del formulario al servidor. Ya ahí guardo la imagen dentro de `storage/images/` y dependiendo de a donde pertenezca la imagen (test, pregunta, usuario) a una carpeta u otro. En una variable almaceno la ruta a esa imagen, y esa ruta es lo que guardo en la base de datos.
Toda esta parte funciona sin problemas, las imágenes se quedan guardas en el proyecto y la ruta se guarda en el servidor. El problema es que luego cuando intento colocar esa ruta en el atributo `src` no se ve la imagen, y no sé muy bien por qué. En un principio hay que usar la variación de `src` de vue, `:src`, que permite completar la ruta con la parte que no se guarda en la base de datos y la que sí. La ruta guardada en la base de datos está bien, así que asumo que el error se encuentro en como intento acceder a la imagen o equivocándome al específicar la parte de ruta que no se guarda en base de datos. 

Al añadir las funcionalidades de borrar test y el panel de usuario tuve que tener especial cuidado de que solo se muestren estas opciones a los usuarios correspondientes, y al mismo tiempo estar verificando que el usuario es el correcto en el  Back-End antes de aplicar los cambios.
La parte de eliminar test me ha dado especiales problemas porque debido a que la tabla tests se relaciona con muchas otras, necesitaba asgurarme que se borraban los datos de ese test en todo el resto de tablas que lo tenía como llave foránea.

Finalmente, la creación de los perfiles, la pestaña de valoración y resumen, y la paginación no fueron tan complicadas como podría parecer inicialmente. Obviamente, tuve mis dificultades y fue necesario que rehiciera algunas cosas, pero por suerte pude aplicar bastante del conocimiento que ya había adquirido haciendo el resto de las pestañas. Lo más difícil de esas partes fue solucionar distintos problemas que iban surgiendo en según qué situaciones. Por ejemplo, verificar que si el usuario autenticado intenta acceder a su perfil desde un test, ofrezca la opción de editar el perfil, pero para el resto de los usuarios no, o mostrar las preguntas correctas pero no la puntuación en el resumen si se hace un test de forma casual (donde no hay puntuación), etc.

## Conclusión

A lo largo de este documento creo que he dajado bastante claro mi experiencia al realizar el proyecto. Ha sido la primera vez que realizo un proyecto de esta escala, y aunque ha sido un reto, lo cosidero una experiencia muy enriquecedora. Todos los problemas que he tenido para diseñar una base de datos con tantas tablas relacionas entre sí, pensar en que tecnologías iba a usar, hacer una SPA, programar la propia web... Me han hecho mejorar bastante como desarrollador.

Incluso fuera del ámbito de la programación una parte a la que le tuve que dedicar mucho tiempo para estar conforme era la de diseñar la propia web. Quería hacer una web de estética retrofuturista con colores vivos que aunque el diseño en sí es sencillo a la vista llama la atención. 
Fue bastante complicado encontrar la paleta de colores definitiva, pues según el tono del colo se veía bien un tipo distinto de pantallas, así que fui probando hasta encontrar un equilibrio. 
Diseñar el logo y los iconos de la web también me llevo bastante tiempo, pues casi no tengo experiencia creando imágenes vectoriales. pero tras bastantes intentos estoy contento con el resultado.

El proyecto me ha costado más de lo que esperaba en un principio, pero al final he podido llevarlo adelante. Hay bastantes detalles a la hora de crear un proyecto que hace unos meses no habría tenido en cuenta que ahora sí voy a tener. En conclusión, estoy satisfecho.