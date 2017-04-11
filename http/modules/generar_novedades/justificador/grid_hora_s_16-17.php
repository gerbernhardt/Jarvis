<?php

# NOVEDAD 16
pointer(170,$gridTop);click_left();wapi_sendkeys(16);

# SALIDA
pointer(238,$gridTop);click_left();wapi_sendkeys('S');

# MODIFICAR HORARIO
pointer(420,$gridTop);click_left();wapi_sendkeys($hora);

wapi_screenshot($handle,'D:/Jarvis/screenshots/00.bmp',234,300,6,10);$img00=imagecreatefrombmp('D:/Jarvis/screenshots/00.bmp');
if(!image_compare($img00,$img06)){
 # JUSTIFICAR
 pointer(480,$gridTop);click_left();wapi_sendkeys('justificado');
 pointer(560,$gridTop);click_left();wapi_sendkeys('r');
}

?>