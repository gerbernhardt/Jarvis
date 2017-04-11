<?php

# NOVEDAD 16
pointer(170,$gridTop);
click_left();

if(in_array($sobre,$comision)){
 if($d2-$d1>1000){
  $horaComp=substr($fechaComp,11,2);
  if($horaComp=='07')
   wapi_sendkeys(41);
  else wapi_sendkeys(7);
  pointer(238,$gridTop);click_left();wapi_sendkeys('E');
  pointer(480,$gridTop);click_left();wapi_sendkeys('justificado');
 }else{
  wapi_sendkeys(16);
  pointer(238,$gridTop);click_left();wapi_sendkeys('S');
  # MODIFICAR HORARIO
  pointer(420,$gridTop);click_left();wapi_sendkeys(' ');
 }
}else{ wapi_sendkeys(16);
 pointer(238,$gridTop);click_left();wapi_sendkeys('S');
 # MODIFICAR HORARIO
 pointer(420,$gridTop);click_left();wapi_sendkeys($hora);
}

wapi_screenshot($handle,'D:/Jarvis/screenshots/00.bmp',234,300,6,10);$img00=imagecreatefrombmp('D:/Jarvis/screenshots/00.bmp');
if(!image_compare($img00,$img06)&&!image_compare($img00,$img07)){
 # JUSTIFICAR
 pointer(480,$gridTop);click_left();wapi_sendkeys('justificado');
 pointer(560,$gridTop);click_left();wapi_sendkeys('r');
}

?>
