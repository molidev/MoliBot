# MoliBot

MoliBot is a Telegram bot that allow make some functionalities in a simple way

### Requirements

For use this but it's necessary has :
 - One web server with SSL certificate and your own domain name (SSL certificate is very important because if you don´t have any certificate webhook doesn´t works)
 - You need create one bot, If you haven´t got any bot -> use this easy tutorial: [Tutorial](https://planetachatbot.com/c%C3%B3mo-crear-un-bot-para-telegram-y-darle-funcionalidad-c5c7ec833f49)
 * (WebHook will be configurated on the next step)
   
### Installation Instructions   
   
### Configuration of parameters

* For configure WebHook(will indicate to Telegram where have located request.php) we will go to web browser and we will write this link :
  ```
  https://api.telegram.org/bot<TOKEN>/setWebhook?url=
  ``` 
  on this link we will have to put the token of the bot and path of request.php in our domain (this is a example) :
  ```
  https://api.telegram.org/bot123456789/setWebhook?url=https://www.miservidor.com/bot/request.php
  ```
  On 123456789 we will need put the token and on url(https://www.miservidor.com/bot/request.php) we will add path of request.php
* On the next step we will modify on request.php the content of variable $botToken and will put we our token.
* For improve the code or implement new thing, for example add new command -> edit swich estructure on line 39 of request.php.
  
### Configuration function ConsultaServicios()

* This function will help us with checking state of service that has our server, use file -> consulta.sh (configure correctly the path)
  consulta.sh receive by parameters one service and check if the service is working or not.
* The file consulta.sh need special perms because the user that execute this .sh will be (www-data) and the script that performs queries is the user root( or other)
  for resolve this problem we will need give some permissions:
 ```
          chmod u+s consulta.sh
 ```
 and the execution permission :
 ```         
          chmod +x consulta.sh 
 ```
          
 (All perms it´s necessary give with the user root) for more information about perms system [SUID](https://www.linuxnix.com/suid-set-suid-linuxunix/)
 
### Improvements
* Readme -> English
* Working with pull requests for improve code
