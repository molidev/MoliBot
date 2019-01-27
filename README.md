# MoliBot

MoliBot es un bot de Telegram que permite realizar varias funcionales de forma sencilla

### Requisitos

Para poder utilizar dicho bot es necesario tener :
 - Un servidor web y un dominio con SSL(es muy necesario sinó las conexiones mediante el weebhook no se realizarán)
 - Crear un bot previamente,para ello podemos seguir el siguiente tutorial: [Tutorial] (https://planetachatbot.com/c%C3%B3mo-crear-un-bot-para-telegram-y-darle-funcionalidad-c5c7ec833f49)
   (¡¡ Posteriormente configuraremos el WebHook en el siguiente apartado !!)
   
### Configuración de parámetros

* Para configurar el WebHook(que es el que le indicará a telegram donde se encuentra almacenado nuestro request.php) iremos a un navegador de internet y introduciremos la siguiente dirección :
  ```
  https://api.telegram.org/bot<TOKEN>/setWebhook?url=
  ``` 
  en esta dirección tendremos que poner el token de nuestro bot y la dirección(donde se encuentra el request.php en nuestro dominio) quedando de la siguiente forma :
  ```
  https://api.telegram.org/bot123456789/setWebhook?url=https://www.miservidor.com/bot/request.php
  ```
  En 123456789 pondremos el token y en url nuestra dirección donde se encuentra el request.php
* Una vez establecido el Webhook tendremos que editar en request.php el contenido de la variable $botToken por el token de nuestro bot.
* Para cualquier mejora, nueva implementación o modificación la tendreis que realizar dentro del Switch que es el encargado de interpretar los comandos.
  
### Configuración de function ConsultaServicios()

* Como habeís podido ver esta función nos permite consultar estados de servicios que tenga nuestro servidor para ello usa el archivo consulta.sh(!!!Muy importante cambiar la ruta !!!)
  Este archivo recibe mediante parámetro un servicio e indica si está encendido o nó.
* Es necesario dar a consulta.sh permisos especiales debido a que el usuario que ejecutará ese .sh será (www-data) y el script realiza consultas con el usuario root
  para solventar este inconveniente le daremos los siguientes permisos:
 ```
          chmod u+s consulta.sh
 ```
 Y por el permiso de ejecución :
 ```         
          chmod +x consulta.sh 
 ```
          
 (Todo los permisos se deben de dar con el usurio root)
          
