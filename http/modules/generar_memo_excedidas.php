<?php
include('D:/Jarvis/modules/justificador/functions.php');
$result=read_text_file();

$j=0;
$agente=array();
function insert($data,$first){
 global $j,$agente;
 if($first==false) $j++;
 $agente[$j]['sobre']=$data['sobre'];
 $agente[$j]['nombre']=$data['nombre'];
 $hour=explode(':',$data['horas']);
 $agente[$j]['horas']=(int)$hour[0];
 $agente[$j]['minutos']=(int)$hour[1];
}

function update($data){
 global $j,$agente;
 $hour=explode(':',$data['horas']);
 $agente[$j]['horas']+=(int)$hour[0];
 $agente[$j]['minutos']+=(int)$hour[1];
}

for($i=0;$i<count($result);$i++) {
 if($i==0){
  insert($result[$i],true);
 }else{
  if($result[$i]['sobre']==$result[$i-1]['sobre'])
   update($result[$i]);
  else insert($result[$i],false);
 }
}

$word=new COM('word.application');
$word->visible=false;
$wordFile=wapi_dialog('open',"Word File \0*.doc\0");
$word->Documents->Open($wordFile);
$select=$word->Selection;
//$select->insertbreak;
//$select->EndKey;
//$select->BoldRun;
for($i=0;$i<11;$i++) $select->MoveDown;
$select->MoveUP;
for($i=0;$i<count($agente);$i++){
 $horas=intval($agente[$i]['horas'])+intval($agente[$i]['minutos']/60);
 $minutos=intval($agente[$i]['minutos']%60);
 if($minutos>0&&$minutos<30){$minutos=30;}
 elseif($minutos>30){$minutos=0;$horas++;}

 $select->TypeText($agente[$i]['nombre']);
 $select->MoveRight;

 $select->TypeText('Sobre: '.$agente[$i]['sobre']);
 $select->MoveRight;

 $select->TypeText('horas excedidas:');
 $select->MoveRight;

 $select->TypeText(str_pad($horas,2,0,STR_PAD_LEFT).':'.str_pad($minutos,2,0,STR_PAD_LEFT));
 $select->MoveRight;

 $select->MoveRight;
 print '.';
}

$word->Documents->Save();
$word->ActiveDocument->Close(false);
$word->Quit();
$word=null;
unset($word);
exit;

?>