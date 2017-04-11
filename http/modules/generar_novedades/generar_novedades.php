<?php

include('D:/Jarvis/modules/justificador/functions.php');
open_window();
include('D:/Jarvis/modules/justificador/data.php');

$img02=imagecreatefrombmp('D:/Jarvis/modules/justificador/images/25-gridTop-5-10.bmp'); // novedad vigente, green image
$img03=imagecreatefrombmp('D:/Jarvis/modules/justificador/images/305-370-10-40.bmp'); // marcaciones desordenadas
$img04=imagecreatefrombmp('D:/Jarvis/modules/justificador/images/542-370-10-40.bmp'); // marcaciones desordenadas
$img05=imagecreatefrombmp('D:/Jarvis/modules/justificador/images/523-360-10-60.bmp'); // cartel sesion caducada
$img06=imagecreatefrombmp('D:/Jarvis/modules/justificador/images/234-300-6-10-8.bmp'); // 80 horas excedidas
$img07=imagecreatefrombmp('D:/Jarvis/modules/justificador/images/234-300-6-10-9.bmp'); // 90 horas excedidas

wapi_screenshot($handle,'D:/Jarvis/screenshots/00.bmp',523,360,10,60);$img00=imagecreatefrombmp('D:/Jarvis/screenshots/00.bmp'); //cartel sesion caducada
if(image_compare($img00,$img05)) lost_session();

foreach($sobres as $sobre){
 wapi_screenshot($handle,'D:/Jarvis/screenshots/waitblack.bmp',1170,745,180,1);$wait=imagecreatefrombmp('D:/Jarvis/screenshots/waitblack.bmp');
 $waitblack=imagecreatefrombmp('D:/Jarvis/modules/justificador/images/1170-745-180-1-black.bmp');
 if(image_compare($waitblack,$wait)){  @exec('php jarvis.php menu=4 sobre='.$sobre)&&exit();
 }
 if(!isset($_ARGS['sobre'])) $_ARGS['sobre']=$sobre;
 if($sobre>=$_ARGS['sobre']){
  inserta_sobre($sobre);
  foreach($dias as $dia){   $fecha=$dia.'/'.$periodo;
   if(recorre_calendario($fecha,true)){
    $fechaComp='01/01/2000 00:00:00';
    $gridTop=350;
    for($g=0;$g<5;$g++){
     $gridTop+=24;
     wapi_screenshot($handle,'D:/Jarvis/screenshots/00.bmp',25,$gridTop,5,10);$img00=imagecreatefrombmp('D:/Jarvis/screenshots/00.bmp');
     if(image_compare($img00,$img02)){// analiza la marcacion
/*
pointer(152,$gridTop);
click_left();
mnu_copiar();
$fechaClip=wapi_get_clipboard();
*/

      wapi_screenshot($handle,'D:/Jarvis/screenshots/00.bmp',34,$gridTop,122,10);$img00=imagecreatefrombmp('D:/Jarvis/screenshots/00.bmp');
      $fechaClip=image_to_text($img00);
      //print $fechaClip."\n";exit();
      include('D:/Jarvis/modules/justificador/grid_dia.php');
     }
    }
    //print "fin for g+5\n";
    bton_gen_nov();
    // controlar error analizar dia marcaciones desordenadas
    wapi_screenshot($handle,'D:/Jarvis/screenshots/00.bmp',305,370,10,40);$img00=imagecreatefrombmp('D:/Jarvis/screenshots/00.bmp');
    if(image_compare($img00,$img03)){pointer(590,440);wapi_sendkeys('{enter}');}
    wapi_screenshot($handle,'D:/Jarvis/screenshots/00.bmp',542,370,10,40);$img00=imagecreatefrombmp('D:/Jarvis/screenshots/00.bmp');
    if(image_compare($img00,$img04)){pointer(824,440);wapi_sendkeys('{enter}');}
    wapi_screenshot($handle,'D:/Jarvis/screenshots/00.bmp',523,360,10,60);$img00=imagecreatefrombmp('D:/Jarvis/screenshots/00.bmp'); //cartel sesion caducada
    if(image_compare($img00,$img05)){
     lost_session();
    }else{
     pointer(100,100);wapi_sendkeys('{enter}');
    }
   //print "fin if reccore calendario\n";
   }
  //print "fin for each dia\n";
  }
 }
}
//print "fin for each sobre\n";
?>