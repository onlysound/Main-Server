<?php

if(count($_GET))$input=&$_GET;
if(count($_POST)){
    foreach($_POST as $key => $value){
    	$input[$key]=&$_POST[$key];
    }
}

if(isset($input['ss']) and $input['ss']=='avatar'){
	$modul_to_load='avatar';
	$title =& $text['title']['avatar'];
}else{
	$title =& $text['title']['config'];
	$modul_to_load='show_config';
}

	include_once('header.php');

?>