<?php

$file=wapi_dialog('open',"Text File \0*.txt\0");
if(!file_exists($file)) exit();
$data=array();
if($link=fopen($file,'r')){
 while($line=fgets($link,255)){
  $line=explode("\t",$line);
  if(isset($line[6])){
   if(preg_match('/V/',$line[6]))$data[]=$line;
  }
 }fclose($link);
}
$word=new COM('word.application');
$word->visible=false;
$word->Documents->Open(wapi_dialog('open',"Word File \0*.doc\0"));
$select=$word->Selection;
//$select->insertbreak;
//$select->EndKey;
//$select->BoldRun;
for($i=0;$i<50;$i++) $select->MoveDown;
for($i=0;$i<count($data);$i++){
 $select->TypeText('- '.$data[$i][1].' - Sobre: '.$data[$i][0]."\n");
 $select->InlineShapes->AddPicture('D:/Documents/carnets/imagenes/'.$data[$i][0].'.jpg');
 $select->TypeText("\n\n");
}
$word->Documents->Save();
$word->ActiveDocument->Close(false);
$word->Quit();
$word=null;
unset($word);

?>