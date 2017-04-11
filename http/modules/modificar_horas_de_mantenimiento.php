<?php

include('D:/Jarvis/modules/justificador/functions.php');
open_window();
$file=wapi_dialog('open',"Text File \0*.txt\0");
if(!file_exists($file)) exit();

$img01=imagecreatefrombmp('D:/Jarvis/modules/justificador/images/25-gridTop-5-10.bmp'); // novedad vigente, green image
$img02=imagecreatefrombmp('D:/Jarvis/modules/justificador/images/305-370-10-40.bmp'); // marcaciones desordenadas
$img03=imagecreatefrombmp('D:/Jarvis/modules/justificador/images/542-370-10-40.bmp'); // marcaciones desordenadas
$img04=imagecreatefrombmp('D:/Jarvis/modules/justificador/images/523-360-10-60.bmp'); // cartel sesion caducada

$img06=imagecreatefrombmp('D:/Jarvis/modules/justificador/images/234-300-6-10-8.bmp'); // 80 horas excedidas
$img07=imagecreatefrombmp('D:/Jarvis/modules/justificador/images/234-300-6-10-9.bmp'); // 90 horas excedidas
$img08=imagecreatefrombmp('D:/Jarvis/modules/justificador/images/160-gridTop-20-10-0.bmp'); // nov 16
$img09=imagecreatefrombmp('D:/Jarvis/modules/justificador/images/160-gridTop-20-10-1.bmp'); // nov 16 rosa
$img10=imagecreatefrombmp('D:/Jarvis/modules/justificador/images/160-gridTop-20-10-2.bmp'); // nov 16 amarillo

$data=array();
if($link=fopen($file,'r')){
 while($line=fgets($link,250)){
  //print strlen($line);
  if(strlen($line)==18){
   $data=explode(' ',$line);
   //$data[1].=':00';
   $fechaComp=$line;
   print $data[0]."\n";
  }elseif($line!=''){

inserta_sobre($line);
recorre_calendario($data[0]);
$gridTop=346;
  for($g=0;$g<5;$g++){
   $gridTop+=24;
     wapi_screenshot($handle,'D:/Jarvis/screenshots/00.bmp',25,$gridTop+4,5,10);$img00=imagecreatefrombmp('D:/Jarvis/screenshots/00.bmp');
     if(image_compare($img00,$img02)){// analiza la marcacion
      wapi_screenshot($handle,'D:/Jarvis/screenshots/00.bmp',34,$gridTop+4,122,10);$img00=imagecreatefrombmp('D:/Jarvis/screenshots/00.bmp');
      $fechaClip=image_to_text($img00);
////////////////////////

    $d1=strtotime(make_date($fechaComp));
    $d2=strtotime(make_date($fechaClip));

    if($d2-$d1>0){/// A PARTIR DE ACA ARREGLAR!!!!!!
     wapi_screenshot($handle,'D:/Jarvis/screenshots/00.bmp',160,$gridTop,20,10);$img00=imagecreatefrombmp('D:/Jarvis/screenshots/00.bmp');
     if((image_compare($img00,$img08))||(image_compare($img00,$img09))||(image_compare($img00,$img10))){// si es novedad 16
      pointer(420,$gridTop);click_left();wapi_sendkeys($data[1]);

      pointer(450,$gridTop);click_left();
      wapi_screenshot($handle,'D:/Jarvis/screenshots/00.bmp',234,300,6,10);$img00=imagecreatefrombmp('D:/Jarvis/screenshots/00.bmp');
      if(!image_compare($img00,$img06)&&!image_compare($img00,$img07))
       wapi_sendkeys('justificado');
      else wapi_sendkeys('no justificado');

      wapi_sendkeys('{tab}');wait();wapi_sendkeys('R');
     }
    }

////////////////////////
     }
   }
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
  }
  }
 }
 fclose($link);
}
?>