<?
if(!isset($passed))exit('0');
$connect= new connector();
$song = new playlist($connect->get_connection());

if(isset($input['ss']) and (is_numeric($input['ss']))){	if(isset($input['pp']) and (is_numeric($input['pp']))){		$result = $song->song_delete($_SESSION['ID'],$input['pp'],$input['ss']);	}else{		$result = $song->song_delete_general($_SESSION['ID'],$input['ss']);	}

}else{	exit('SONG');}

if($result){
    exit('1');
}else{
    exit($song->get_status());
}
?>
