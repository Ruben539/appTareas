# appTareas
App para completar y llevar el control de las tareas del usuario

# Para poder utilizar el sistema se debe realizar la configuracion del backend que esta en laravel y tambien del front en en react

# TODO: Configuracion del backend en laravel, se debe acceder a la carpeta api con el comando cd api y una vez dentro se inicia la configuracion.
1- composer install.
2- se procede a la crearcion del archivo .env, el cual llevara toda la conexion para nuestro proyecto. Para que sea mas facil en el archivo .env-example se encuetra la 
informacion de la base de datos y las demas conexiones asi que puede copiar y pegar el mismo.
3- Una vez que se tenga el archivo .env creado, se procede a crear la base de datos, en el repositorio se encuentra la base de datos o tambien peude utlizar el comando 
php artisan migrate --seed para crear la base de datos y las tablas.
4- Levantar el proyecto, todo el proyecto se ejecutara en el localhost asi qeu en caso de no ser necesario no necesita ninguna configuracion adicional. Para ejeuctar el serve
se utiliza el comando php artisan serve y se puede acceder a la pagina dandole ctrl + click sobre la url que le proporciona.

Con eso ya se realiza la configuracion del backend de la aplicacion.

# TODO: Configuracion de frontend de la aplicacion. Si esta dentro de la carpeta del backend debe salir de ella y entrar a la carpeta de app.
1-npm install
2- npm install axios
3- Para realizar el despliegue de la app debe ejecutar el comando npm run dev el cual si se instalo el npm, levantara la aplicacion con el host de la misma.
Deebe tener en cuenta que todas las configuracion se deben de realizar en sua carpetas correspondientes.