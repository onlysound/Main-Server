<?
if(!isset($passed))exit('0');
$playlist = new playlist($connect->get_connection());

if(isset($input['ss']) and is_numeric($input['ss'])){
    $song=$input['ss'];
}else{    exit('SONG');}

if(isset($input['pp']) and (is_numeric($input['pp']))){	$result = $playlist->song_add($_SESSION['ID'],$input['pp'],$input['ss']);}else{	$result = $playlist->song_add_to_general($_SESSION['ID'],$input['ss']);}

if($result){
    exit('1');}else{    exit($playlist->get_status());}


?>
