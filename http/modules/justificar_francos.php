<?php
include('D:/Jarvis/modules/justificador/functions.php');
$result=read_text_file();

$img01=imagecreatefrombmp('D:/Jarvis/modules/justificador/images/24-gridTop-5-10.bmp'); // novedad vigente, blue image
$img02=imagecreatefrombmp('D:/Jarvis/modules/justificador/images/523-360-10-60.bmp'); // cartel sesion caducada
$img03=imagecreatefrombmp('D:/Jarvis/modules/justificador/images/535-375-100-10.bmp'); // no posee francos disponibles

$sobre='';
for($i=0;isset($result[$i]['nombre']);$i++) {
 wapi_screenshot($handle,'D:/Jarvis/screenshots/00.bmp',523,360,10,60); //cartel sesion caducada
 $img00=imagecreatefrombmp('D:/Jarvis/screenshots/00.bmp');
 if(image_compare($img00,$img02)) lost_session();
 if($result[$i]['sobre']!=$sobre) inserta_sobre($result[$i]['sobre']);
 $sobre=$result[$i]['sobre'];
 recorre_calendario($result[$i]['fecha']);
 $gridTop=548;
 for($g=0;$g<3;$g++){
  $gridTop+=24;
  wapi_screenshot($handle,'D:/Jarvis/screenshots/00.bmp',24,$gridTop,5,10);
  $img00=imagecreatefrombmp('D:/Jarvis/screenshots/00.bmp');
  if(image_compare($img00,$img01)){// analiza la marcacion
   pointer(54,$gridTop);click_left();wapi_sendkeys('58');wapi_sendkeys('{tab}');wait();
   // por si no posee francos
   wapi_screenshot($handle,'D:/Jarvis/screenshots/00.bmp',535,375,100,10);
   $img00=imagecreatefrombmp('D:/Jarvis/screenshots/00.bmp');
   if(image_compare($img00,$img03)){
    wapi_sendkeys('{enter}');wapi_sendkeys('{enter}');wapi_sendkeys('{enter}');
    mnu_limpiar();
   }
   // end ---------------------
   mnu_guardar();
  }
 }
}
exit();

?>