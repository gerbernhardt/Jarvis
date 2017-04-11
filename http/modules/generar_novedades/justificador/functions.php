<?php

function click_left(){
 wapi_mouse_event(MOUSE_LEFTDOWN,0,0,0,0);wapi_mouse_event(MOUSE_LEFTUP,0,0,0,0);
}
function dbclick_left(){
 wapi_mouse_event(MOUSE_LEFTDOWN,0,0,0,0);wapi_mouse_event(MOUSE_LEFTUP,0,0,0,0);
 wapi_mouse_event(MOUSE_LEFTDOWN,0,0,0,0);wapi_mouse_event(MOUSE_LEFTUP,0,0,0,0);
}
function pointer($x,$y){ wapi_set_cursor_pos($x,$y);
}

function wait(){ global $handle; $wait=imagecreatefrombmp('D:/Jarvis/modules/justificador/images/1170-745-180-1.bmp');
 $waitblack=imagecreatefrombmp('D:/Jarvis/modules/justificador/images/1170-745-180-1-black.bmp');
 usleep(500000);
 while(true){
  wapi_screenshot($handle,'D:/Jarvis/screenshots/wait01.bmp',1170,745,180,1);$wait01=imagecreatefrombmp('D:/Jarvis/screenshots/wait01.bmp');
  usleep(150000);
  wapi_screenshot($handle,'D:/Jarvis/screenshots/wait02.bmp',1170,745,180,1);$wait02=imagecreatefrombmp('D:/Jarvis/screenshots/wait02.bmp');
  usleep(150000);
  wapi_screenshot($handle,'D:/Jarvis/screenshots/wait03.bmp',1170,745,180,1);$wait03=imagecreatefrombmp('D:/Jarvis/screenshots/wait03.bmp');
  usleep(150000);
  wapi_screenshot($handle,'D:/Jarvis/screenshots/wait04.bmp',1170,745,180,1);$wait04=imagecreatefrombmp('D:/Jarvis/screenshots/wait04.bmp');
  usleep(150000);
  if(image_compare($wait,$wait01)&&image_compare($wait,$wait02)&&image_compare($wait,$wait03)) break;
  if(image_compare($waitblack,$wait04)) break;
  //print ".";
 }
}

function open_window(){ # CLICK VENTANA
 pointer(145,770);click_left();sleep(1);
 pointer(145,670);click_left();sleep(2);
}

function open_justificador(){
 # DOBLE CLICK ABRIR JUSTIFICADOR
 pointer(160,520);dbclick_left();wait();
 # ACEPTAR CARTEL DE RECLAMOS
 wapi_sendkeys('{enter}');wait();
}
function lost_session(){
 wapi_sendkeys('{enter}'); //ok
 // oppener window!
 wapi_sendkeys('{tab}');
 wapi_sendkeys('23012130');
 wapi_sendkeys('{enter}');
 sleep(5);
 wapi_sendkeys('{enter}'); //ok
 wait();
}

function make_date($date){
 $date=explode(' ',$date);
 $date[0]=explode('/',$date[0]);
 return $date[0][2].'-'.$date[0][1].'-'.$date[0][0].' '.$date[1];
}

function mnu_guardar(){
 pointer(120,70);click_left();wait();wapi_sendkeys('{enter}');
}
function mnu_copiar(){
 pointer(285,70);click_left();wait();
}
function mnu_pegar(){
 pointer(313,70);click_left();wait();
}
function mnu_limpiar(){
 pointer(337,70);click_left();wait();
}
function mnu_suprimir(){
 pointer(365,70);click_left();wait();
}

function bton_gen_nov(){
 // generar novedad
 pointer(750,460);click_left();wait();
}

function inserta_sobre($sobre){
 # INSERTA EL NRO DE SOBRE
 pointer(80,140);click_left();wapi_sendkeys('{F11}');wait();
 wapi_sendkeys($sobre);wait();
 wapi_sendkeys('^{F11}');wait();
}

function recorre_calendario($fecha,$break=false){
 global $handle;
 // fecha a analizar
 $fechaAux=explode('/',$fecha);// la desmenuza
 // creo los arrays invertidos con las coordenadas
 $said=array('Sun'=>0,'Mon'=>1,'Tue'=>2,'Wed'=>3,'Thu'=>4,'Fri'=>5,'Sat'=>6);
 $dias=array('Sun'=>540,'Mon'=>570,'Tue'=>600,'Wed'=>630,'Thu'=>660,'Fri'=>690,'Sat'=>710);
 $semanas=array(1=>180,2=>200,3=>220,4=>240,5=>260,6=>280);
 // saco el dia de la semana
 $dia=date('D',strtotime($fechaAux[2].'-'.$fechaAux[1].'-'.$fechaAux[0]));
 $columna=$dias[$dia]; //obtengo la columna en base al dia
 // saco el dia 1 del mes
 $diff=date('D',strtotime($fechaAux[2].'-'.$fechaAux[1].'-01'));
 $diff=$said[$diff]; //obtengo la diferencia
 // en base a la diferencia del dia 1
 // modifica la fila del calendario
 $semana=0;
 for($i=1;$i<=42;$i++){
  if($i<=7) $semana=1;
  elseif($i<=14) $semana=2;
  elseif($i<=21) $semana=3;
  elseif($i<=28) $semana=4;
  elseif($i<=35) $semana=5;
  elseif($i<=42) $semana=6;
  if($i==intval($fechaAux[0])+$diff){
 //  print 'Dia: '.$fechaAux[0].' --- Semana: '.$semana;
   break;
  }
 }
 $fila=$semanas[$semana];
 if($break==true){
  wapi_screenshot($handle,'D:/Jarvis/screenshots/00.bmp',($columna-10),($fila-5),25,15);
  $img=imagecreatefrombmp('D:/Jarvis/screenshots/00.bmp');
  if(search_color($img,16711680)){
   pointer($columna,$fila);click_left();wait();
   return true;
  }else{   return false;  }
 }else{
  pointer($columna,$fila);click_left();wait();
  return true;
 }
}

function image_to_text(&$img){ for($i=0;$i<10;$i++) $imgs[$i]=imagecreatefrompng('D:/Jarvis/modules/justificador/images/'.$i.'.png');
 //11796441
 $colors=array(0,255);
 image_convert($img,$colors);

 $text='';$w=6;$h=10;
 $numbers=array(
	// POSICION DE FECHA
	0=>0,1=>7, //DIA
	2=>18,3=>25, //MES
	4=>36,5=>43,6=>50,7=>57,//AÑO
    // TIEMPO
	8=>68,9=>75,//HORA
	10=>86,11=>93,//MINUTOS
	12=>104,13=>111//AÑO
 );
 for($i=0;$i<count($numbers);$i++){
  $image=imagecreatetruecolor($w,$h);
  imagecopy($image,$img,0,0,$numbers[$i],0,$w,$h);
  for($j=0;$j<10;$j++){
   if(image_compare($imgs[$j],$image))
    $text.=$j;
   else $text.='';
  }
  if($i==1||$i==3) $text.='/';
  if($i==7) $text.=' ';
  if($i==9||$i==11) $text.=':';
 }
 return $text;}

function read_text_file(){ open_window();
 $file=wapi_dialog('open',"Text File \0*.txt\0");
 if(!file_exists($file)) exit();

 $data=array();
 if($link=fopen($file,'r')){
  while($line=fgets($link,255)){
   if(preg_match('/105 /',$line)){
    $data[]=explode(' ',$line);
   }
  }
  fclose($link);
 }
 $result=array();
 for($i=0;$i<count($data);$i++){
  $result[$i]['sobre']=$data[$i][2];
  $result[$i]['nombre']='';
  for($j=3;$j<9;$j++){
   if(!preg_match('/\//',$data[$i][$j])){
    $result[$i]['nombre'].=' '.$data[$i][$j];
    // Correccion del error al exportar pdf a txt
    // 8555 lescano, luis alberto correct
    // lescano, luis alberto8555 incorrect
    $len=strlen($result[$i]['nombre']);
    if(intval(substr($result[$i]['nombre'],strlen($result[$i]['nombre'])-5,5))>0){
     $result[$i]['nombre']=$result[$i]['sobre'].' '.$result[$i]['nombre'];
     $result[$i]['sobre']=substr($result[$i]['nombre'],strlen($result[$i]['nombre'])-5,5);
     $result[$i]['nombre']=substr($result[$i]['nombre'],0,strlen($result[$i]['nombre'])-5);
    }elseif(intval(substr($result[$i]['nombre'],strlen($result[$i]['nombre'])-4,4))>0){
     $result[$i]['nombre']=$result[$i]['sobre'].' '.$result[$i]['nombre'];
     $result[$i]['sobre']=substr($result[$i]['nombre'],strlen($result[$i]['nombre'])-4,4);
     $result[$i]['nombre']=substr($result[$i]['nombre'],0,strlen($result[$i]['nombre'])-4);
    }elseif(intval(substr($result[$i]['nombre'],strlen($result[$i]['nombre'])-3,3))>0){
     $result[$i]['nombre']=$result[$i]['sobre'].' '.$result[$i]['nombre'];
     $result[$i]['sobre']=substr($result[$i]['nombre'],strlen($result[$i]['nombre'])-3,3);
     $result[$i]['nombre']=substr($result[$i]['nombre'],0,strlen($result[$i]['nombre'])-3);
    }//end of parch
   }else break;
  }
  $result[$i]['fecha']=$data[$i][$j];
  $result[$i]['desde']=$data[$i][$j+1];
  $result[$i]['hasta']=$data[$i][$j+2];
  $result[$i]['total']=$data[$i][$j+3];
  $result[$i]['horas']=$data[$i][$j+3];
 }
 return $result;}

?>