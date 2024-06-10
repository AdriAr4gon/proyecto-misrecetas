# Proyecto MisRecetas

Este proyecto es una aplicación web para gestionar tus recetas de cocina.

## Requisitos

- PHP
- MySQL
- XAMPP
- Composer

## Instalación de XAMPP

1. **Descarga XAMPP**: Puedes descargar XAMPP desde el [sitio web oficial de XAMPP](https://www.apachefriends.org/es/download.html). Asegúrate de descargar la versión que corresponde a tu sistema operativo (Windows, Linux o macOS).

2. **Instala XAMPP**: Ejecuta el archivo descargado para iniciar el instalador de XAMPP. Durante la instalación, puedes dejar todas las opciones por defecto. Esto instalará Apache, MySQL, PHP y otras utilidades en tu computadora.

3. **Inicia XAMPP**: Una vez instalado, puedes iniciar XAMPP a través del acceso directo que se creó en tu escritorio o en el menú de inicio. Esto abrirá el panel de control de XAMPP.

4. **Inicia los servicios**: En el panel de control de XAMPP, puedes iniciar los servicios que necesitas para tu proyecto. Para la mayoría de los proyectos PHP, necesitarás iniciar al menos los servicios Apache y MySQL. Simplemente haz clic en los botones "Start" junto a estos servicios para iniciarlos.

5. **Verifica la instalación**: Para verificar que XAMPP se instaló correctamente, abre un navegador web y navega a `http://localhost`. Si ves la página de inicio de XAMPP, entonces la instalación fue exitosa.

## Instrucciones de instalación

1. **Descarga el proyecto**: Puedes descargar el proyecto desde GitHub utilizando el botón "Code" y luego "Download ZIP". Descomprime el archivo ZIP en tu directorio local.

2. **Mueve el proyecto a la carpeta htdocs de XAMPP**: Copia la carpeta del proyecto descomprimido a la carpeta `htdocs` de tu instalación de XAMPP. Por ejemplo, si has instalado XAMPP en `C:\xampp`, deberías copiar la carpeta del proyecto a `C:\xampp\htdocs`.

3. **Crea la base de datos**: Abre una terminal desde XAMPP (Pulsando en SHELL) y navega hasta la carpeta del proyecto dentro de `htdocs`. Luego, con el servicio de MYSQL iniciado, ejecuta el siguiente comando desde la carpeta del proyecto para crear la base de datos utilizando el archivo `database.sql`:

   mysql -u root -p < database/database.sql

   Donde `root` es tu nombre de usuario de MySQL (Por defecto en XAMPP, es root). Se te pedirá que ingreses tu contraseña de MySQL (Por defecto no tienes contraseña, así que simplemente pulsa INTRO).

## Habilitar librerías en php.ini

Para habilitar las extensiones gd y zip en PHP, debes editar el archivo `php.ini` en tu instalación de XAMPP (Desde XAMPP, simplemente tienes que pulsar en el apartado Config de Apache y pulsar PHP(php.ini)). También puedes encontrar este archivo en `C:\xampp\php\php.ini`. Abre este archivo en un editor de texto, busca las líneas que dicen `;extension=gd` y `;extension=zip` y quita el punto y coma al principio de estas líneas para habilitar las extensiones. Guarda el archivo y reinicia XAMPP para que los cambios surtan efecto.

## Instalar Composer

Para instalar Composer en Windows, puedes descargar el instalador de Composer para Windows desde el [sitio web oficial de Composer](https://getcomposer.org/Composer-Setup.exe). Ejecuta el archivo descargado y sigue las instrucciones del instalador.

Después, abre el Visual Studio Code con el proyecto y abre un terminal desde Visual Studio Code. (En la barra de Visual Studio Code, haz click en terminal y presiona New Terminal)

Después inicia el siguiente comando: composer install

Con esto instalarás todas las dependencias necesarias para las funcionalidades relacionadas con exportar las recetas tanto en Excel como en PDF.

## Inicia XAMPP y abre el proyecto

Inicia el servidor Apache y MySQL en XAMPP y luego abre un navegador web y navega a `http://localhost/proyecto-misrecetas` para ver el proyecto.

## Uso

Una vez que hayas instalado y abierto el proyecto, puedes añadir, editar y eliminar recetas utilizando la interfaz web.
