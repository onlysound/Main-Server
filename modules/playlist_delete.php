<?
if(!isset($passed))exit('0');
$playlist = new playlist($connect->get_connection());

if(isset($input['pp']) and (is_numeric($input['pp']))){
	$result = $playlist->delete($_SESSION['ID'],$input['pp']);
}

if($result){
    exit('1');
}else{
    exit($playlist->get_status());
}



?>
