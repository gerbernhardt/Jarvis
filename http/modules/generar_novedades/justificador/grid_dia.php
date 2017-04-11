<?php

$horaClip=substr($fechaClip,11,2);
$minutosClip=substr($fechaClip,14,2);

if($fecha==substr($fechaClip,0,10)){ $d1=strtotime(make_date($fechaComp));
 $d2=strtotime(make_date($fechaClip));
 if(($d2-$d1<120)&&!in_array($sobre,$comision)){  //print 'Anular:'.$fecha.' / Anterior:'.$fechaComp.' / Actual:'.$fechaClip.' / Diff:'.($d2-$d1);  include('grid_hora_es_anular.php');
 }else{

  # ENTRE LAS 05 Y 06HS
  $hora='06:00';
  if($horaClip=='05') include('grid_hora_e_05-06.php');

  if($minutosClip<=15)
   $hora='06:'.$minutosClip;
  else $hora='07:00';
  if($horaClip=='06') include('grid_hora_e_05-06.php');

  # ENTRA LAS 07 Y 13HS
  if($horaClip>'06'&&$horaClip<'14'){   if($minutosClip>15) include('grid_hora_s_07-13.php');
  }

  # ENTRE LAS 14 Y 15HS
  $hora='14:00';
  if($horaClip=='14') include('grid_hora_s_14-15.php');
  $hora='15:00';
  if($horaClip=='15') include('grid_hora_s_14-15.php');

  # ENTRE LAS 16 Y 17HS
  $hora='16:00';
  if($horaClip=='16') include('grid_hora_s_16-17.php');
  $hora='17:00';
  if($horaClip=='17') include('grid_hora_s_16-17.php');

  # ENTRE LAS 18 Y 23HS
  $hora='18:00';
  if($horaClip>=18) include('grid_hora_s_18-23.php');
 }
 $fechaComp=$fechaClip;
 mnu_guardar();
} else "Fecha mal copiada: $fechaClip\n";
?>