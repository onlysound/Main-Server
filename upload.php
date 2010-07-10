<?
	$modul_to_load='upload_html';
	
	if(count($_GET))$input=&$_GET;
	if(count($_POST)){
	    foreach($_POST as $key => $value){
	    	$input[$key]=&$_POST[$key];
	    }
	}
	if( $input['pp']=='' )$input['pp']='song';
	
	if(isset($_GET['pp']) or isset($_POST['pp'])){
		switch($input['pp']){
			case 'song':
				$modul_to_load='upload_html';
				break;
			default:
				$modul_to_load='error';
				$error_to_write =& $text['error']['search'];
		}
	}
	
	$page_name =& $text['title']['upload'];
	include_once('header.php');

?>