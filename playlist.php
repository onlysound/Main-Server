<?

$page_name =& $text['title']['playlist'];
$modul_to_load='playlist_show';

if(count($_GET))$input=&$_GET;
if(count($_POST)){
    foreach($_POST as $key => $value){
    	$input[$key]=&$_POST[$key];
    }
}

if(isset($_GET['action']) or isset($_POST['action'])){

	switch($input['action']){
		case 'new':
			$modul_to_load='playlist_create';
			break;
		case 'show':
			$modul_to_load='playlist_show';
			break;
		case 'delete':
		//delete actions hapens here
			include_once('classes/session_lang.php');
			include_once ('classes/connect.php');
			$connect =  new connector();
				
			if($connect->get_status()!='SERVER_CONECTION_ERR'){
				if($connect->get_status()!='DB_SELECT_ERR'){
					
					include_once ('classes/playlist.php');
   					include_once('modules/playlist_delete.php');
				}
			}	
			exit();
			break;
		case 'add':
		//delete actions hapens here

			if(isset($input['ss']) and is_numeric($input['ss'])){
				
				include_once('classes/session_lang.php');
				include_once ('classes/connect.php');
				$connect =  new connector();
					
				if($connect->get_status()!='SERVER_CONECTION_ERR'){
					if($connect->get_status()!='DB_SELECT_ERR'){
						
						include_once ('classes/playlist.php');
	   					include_once('modules/playlist_song_add.php');
					}
				}	
				exit();
			}
			break;
		default:
			$module='error';
			$error_to_write =& $text['error']['search'];
	}
}

	include_once('header.php');

?>