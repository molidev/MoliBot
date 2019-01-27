<?php
 
$botToken = "INTRODUCE_API_BOT";
 
$website = "https://api.telegram.org/bot".$botToken;
 
$update = file_get_contents('php://input');
$update = json_decode($update, TRUE);
$modo = 0;
 
$chatId = $update["message"]["chat"]["id"];
$chatType = $update["message"]["chat"]["type"];
$userId = $update["message"]['from']['id'];
$firstname = $update["message"]['from']['username'];
if ($firstname=="") {
    $modo=1;
    $firstname = $update["message"]['from']['first_name'];
}
 
if ($modo == 0) {
    $firstname = "@".$firstname;
}
 
$message = $update["message"]["text"];
 
$agg = json_encode($update, JSON_PRETTY_PRINT);
 
 
 
 
//Obtenemos el Comando
$arr = explode(' ',trim($message));
$command = $arr[0];
 
$message = substr(strstr($message," "), 1);


//Switch encargado de procesar los comandos
switch ($command) {
    case '/ayuda':
        $response = "- Ayuda -.";
        sendMessage($chatId, $response);
        break;
    case '/servicios':
        consultaServicios($chatId);
        break;
}

function consultaServicios($chatId){
    $response = " 🔸 Estado de los Servicios 🔸 ";
    sendMessage($chatId, $response);
    $estado1 = shell_exec('/home/Scripts/consulta.sh apache2');
    $estado2 = shell_exec('/home/Scripts/consulta.sh bind9');
    $estado3 = shell_exec('/home/Scripts/consulta.sh plexmediaServer');
    $estados = '➡️'.' '.strtoupper($estado1).'➡️'.' '.strtoupper($estado2).'➡️'.' '.strtoupper($estado3);
    sendMessage($chatId, $estados); 
 }
 
function sendMessage($chatId, $response, $keyboard = NULL){
    if (isset($keyboard)) {
        $teclado = '&reply_markup={"keyboard":['.$keyboard.'], "resize_keyboard":true, "one_time_keyboard":true}';
    }
    $url = $GLOBALS[website].'/sendMessage?chat_id='.$chatId.'&parse_mode=HTML&text='.urlencode($response).$teclado;
    file_get_contents($url);
}

 
?>