<?
//echo 'test';
$connect= new connector();

$me = new user($_SESSION['ID'],session_id(),$connect->get_connection());

$user_isset=false;
if(isset($input['uu']) and (is_numeric($input['uu']))) $user_isset=true;

if($user_isset){

if(!$info){

	$info['playlists']='<a href="/playlist.php?action=show&uu='.$info['user_id'].'">'.$info['playlists'].'</a>';

?>