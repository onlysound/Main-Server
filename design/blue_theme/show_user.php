<?
//echo 'test';
$connect= new connector();

$me = new user($_SESSION['ID'],session_id(),$connect->get_connection());

$user_isset=false;
if(isset($input['uu']) and (is_numeric($input['uu']))) $user_isset=true;

if($user_isset){	$info=$me->select_user_info($input['uu']);}else{	$info=$me->select_my_info();}

if(!$info){	//proverka po4emu
}else{
	$info['playlists']='<a href="/playlist.php?action=show&uu='.$info['user_id'].'">'.$info['playlists'].'</a>';
    if($info['avatar']=='0')$info['avatar']='empty.jpg';	$info['avatar']="<a href='http://www.muha.cc/show.php?pp=conf&ss=avatar' border=false><img src='../../pics/".$info['avatar']."'></a>";	echo listing($info);}
?>