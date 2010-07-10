<?php

$other = new other($connect->get_connection());

if(isset($input['perf']) and is_numeric($input['perf'])) $perf=$input['perf'];
else {	$info =& $text['perf']['id'];
    exit();}

$info=$other->select_performer_info($perf);

if(!$info){
	//proverka po4emu
    if($other->get_status()=='EMPTY'){
    	$info =$ $text['perf']['not_exist'];
    }
}else{
    $info['song_num']='<a href="/search.php?pp='.$info['name'].'&type=song">'.$info['song_num']."</a>";
	//echo listing($info);
}

?>