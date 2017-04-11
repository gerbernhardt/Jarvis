<?php

include('D:/Jarvis/modules/justificador/functions.php');
open_window();
$file=wapi_dialog('open',"Text File \0*.txt\0");
if(!file_exists($file)) exit();

$data=array();
if($link=fopen($file,'r')) {
 while($line=fgets($link,250)) {
  reemplazo($line);
 }
 fclose($link);
}

function reemplazo($data){ $data=explode("	",$data); $data['sobre']=$data[0];
 $data['reemplazado']=$data[1];
 $data['vacante']=$data[2];
 $data['desde']=$data[3];
 $data['hasta']=$data[4];
 $data['cargo']=$data[5];
 $data['area']=$data[6];
 $data['motivo']=$data[7];
 $data['observaciones']=$data[8];;
 pointer(95,215);click_left();wapi_sendkeys($data['sobre']);//wait();// SOBRE REEMPLAZANTE

 if($data['vacante']=='NO'){ // NOS ES CARGO VACANTE
  pointer(444,215);click_left();wapi_sendkeys($data['reemplazado']);//wait();// SOBRE REEMPLAZADO
  pointer(120,335);click_left();wapi_sendkeys($data['desde']);//wait();// DESDE
  pointer(274,335);click_left();wapi_sendkeys($data['hasta']);//wait();// HASTA
 }else{ // CARGO VACANTE
  pointer(190,290);click_left();//wait();// CLICK BOTON VACANTE
  pointer(120,335);click_left();wapi_sendkeys($data['desde']);//wait();// DESDE
  pointer(274,335);click_left();wapi_sendkeys($data['hasta']);//wait();// HASTA
  pointer(680,415);click_left();wait();click_left();wait();// ABRE MENU CATEGORIAS
  pointer(100,142);click_left();
  wapi_sendkeys($data['cargo'].'{PERCENT}'.$data['area'].'{PERCENT}{enter}');wait();// BUSCAR CATEGORIA
  pointer(413,443);click_left();if($data['reemplazado']!='') wapi_sendkeys($data['reemplazado']);//wait();// SOBRE REEMPLAZADO
 }
 if($data['cargo']=='8'&&$data['area']=='varios'){  pointer(140,500);click_left();wapi_sendkeys(6);//wait();// HORARIO MARCACION
  pointer(540,500);click_left();wapi_sendkeys(6);//wait();// HORARIO COBRO
  pointer(320,500);click_left();wapi_sendkeys('00:00');//wait();// HORARIO COBRO
  pointer(418,500);click_left();wapi_sendkeys('00:00');//wait();// HORARIO MARCACION
 }else{  pointer(140,500);click_left();wapi_sendkeys(7);//wait();// HORARIO MARCACION
 }
 pointer(138,557);click_left();wapi_sendkeys(strtoupper($data['motivo']));//wait();// MOTIVO
 pointer(138,585);click_left();wapi_sendkeys(strtoupper($data['observaciones']));//wait();// OBSERVACIONES
 pointer(656,656);click_left();wait();// BOTON GRABAR
 wapi_sendkeys('{enter}');wait();// ACEPTA CARTEL
 wapi_sendkeys('{enter}');wait();// ACEPTA CARTEL
 pointer(210,316);click_left();wait();// BOTON IMPRIMIR
 pointer(370,316);click_left();wait();// BOTON CANCELAR
}

$img01=imagecreatefrombmp('D:/Jarvis/modules/justificador/images/523-360-10-60.bmp'); // cartel sesion caducada
wapi_screenshot($handle,'D:/Jarvis/screenshots/00.bmp',523,360,10,60);$img00=imagecreatefrombmp('D:/Jarvis/screenshots/00.bmp'); //cartel sesion caducada
if(image_compare($img00,$img01)) lost_session();

?>