<?php

# NOVEDAD 4
pointer(170,$gridTop);
click_left();

$fechaX=explode('/',$fecha);
$diaX=$fechaX[0];
$fechaX=date('D',strtotime($fechaX[2].'-'.$fechaX[1].'-'.$fechaX[0]));

if(($fechaX=='Sat'||$fechaX=='Sun'||isset($feriados[$diaX]))&&!in_array($sobre,$comision)){
 wapi_sendkeys(16);
}elseif(in_array($sobre,$comision)){
 if($horaClip=='07')
  wapi_sendkeys(41);
 else wapi_sendkeys(7);
}else{
 wapi_sendkeys(4);
}

# SALIDA
pointer(238,$gridTop);click_left();wapi_sendkeys('S');

if($fechaX=='Sat'||$fechaX=='Sun'||isset($feriados[$diaX])){
 wapi_screenshot($handle,'D:/Jarvis/screenshots/00.bmp',234,300,6,10);$img00=imagecreatefrombmp('D:/Jarvis/screenshots/00.bmp');
 if(!image_compare($img00,$img06)){
  # JUSTIFICAR
  pointer(480,$gridTop);click_left();wapi_sendkeys('justificado');
  pointer(560,$gridTop);click_left();wapi_sendkeys('r');
 }
}else{  pointer(480,$gridTop);click_left();wapi_sendkeys('justificado');
}

?>