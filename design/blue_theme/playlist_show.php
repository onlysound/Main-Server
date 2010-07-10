<?
if($playlist_isset){
	echo $table_print_to_page;	echo $bottom_print;}else{   	echo $table_print_to_page;
   	if(!$user_isset){
		echo "<a href='/playlist.php?action=new'>".$text['playlist']['create']['to_create']."</a>";
	}}


?>
