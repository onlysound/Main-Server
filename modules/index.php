<?
$logo='TEST';

//$title=$text['title']['title'].$text['title']['separator'].$text['title']['index'];
//zdes titala podgruzka modulja

$name_show=$_SESSION['NAME'].' '.$_SESSION['SECOND_NAME'];
$last_login=$_SESSION['LAST_LOGIN'];

if($modul_to_load=='show_songs'){
	$show_song_js='<script  src="/javascript/show_song.js" type="text/javascript"></script>';
}

if(isset($load_add_function) and $load_add_function==1)
 	$main_functions_js='<script  src="/javascript/functions.js" type="text/javascript"></script>';
?>

