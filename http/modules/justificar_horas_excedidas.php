<?php
include('D:/Jarvis/modules/justificador/functions.php');
$result=read_text_file();

$img01=imagecreatefrombmp('D:/Jarvis/modules/justificador/images/25-gridTop-5-10.bmp'); // novedad vigente, green image
$img02=imagecreatefrombmp('D:/Jarvis/modules/justificador/images/305-370-10-40.bmp'); // marcaciones desordenadas
$img03=imagecreatefrombmp('D:/Jarvis/modules/justificador/images/542-370-10-40.bmp'); // marcaciones desordenadas
$img04=imagecreatefrombmp('D:/Jarvis/modules/justificador/images/523-360-10-60.bmp'); // cartel sesion caducada
$img05=imagecreatefrombmp('D:/Jarvis/modules/justificador/images/160-gridTop-20-10-0.bmp'); // nov 16
$img06=imagecreatefrombmp('D:/Jarvis/modules/justificador/images/160-gridTop-20-10-1.bmp'); // nov 16 rosa
$img07=imagecreatefrombmp('D:/Jarvis/modules/justificador/images/1170-745-180-1.bmp'); // barra estado

$sobre='';
for($i=0;isset($result[$i]['nombre']);$i++){
 wapi_screenshot($handle,'D:\Jarvis\screenshots\00.bmp',523,360,10,60); //cartel sesion caducada
 $img00=imagecreatefrombmp('D:\Jarvis\screenshots\00.bmp');
 if(image_compare($img00,$img04)) lost_session();
 if($result[$i]['sobre']!=$sobre) inserta_sobre($result[$i]['sobre']);
 $sobre=$result[$i]['sobre'];
 recorre_calendario($result[$i]['fecha']);
  $gridTop=346;
  for($g=0;$g<5;$g++){
   $gridTop+=24;
   wapi_screenshot($handle,'D:\Jarvis\screenshots\00.bmp',25,($gridTop+4),5,10);$img00=imagecreatefrombmp('D:\Jarvis\screenshots\00.bmp');
   if(image_compare($img00,$img01)){// grid vigente
    wapi_screenshot($handle,'D:\Jarvis\screenshots\00.bmp',160,$gridTop,20,10);
    $img00=imagecreatefrombmp('D:\Jarvis\screenshots\00.bmp');
    if(image_compare($img00,$img05)||image_compare($img00,$img06)){// si es novedad 16
     pointer(450,$gridTop);click_left();wapi_sendkeys('justificado');
     wapi_sendkeys('{tab}');wapi_sendkeys('r');
     bton_gen_nov();wapi_sendkeys('{enter}');
    }
   }
  }
}
?>