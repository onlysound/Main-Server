<?
   if(isset($_SESSION['LANG']))$lang_file_to_load=&$_SESSION['LANG'];
    else $lang_file_to_load='eng';
    
	$lang='lang/'.$lang_file_to_load.'.php';
	if(!is_file($lang))$lang='lang/eng.php';
    
	include($lang);
?>