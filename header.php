<?

//include_once('classes/classes.php');
session_start();

$baner='Banner place';
$default_module='news';

include_once 'classes/connect.php';
include_once ('classes/functions.php');
$connect =  new connector();
	
if($connect->get_status()!='SERVER_CONECTION_ERR'){
	if($connect->get_status()!='DB_SELECT_ERR'){}
}	

if(isset($_SESSION['ID'])){
	switch($modul_to_load){
		case 'avatar':
			include_once ('classes/user.php');
			include_once ('classes/image.php');
			break;
		case 'news':
			break;
		case 'show_user':
			include_once ('classes/user.php');
			break;
		case 'show_songs':
			include_once ('classes/song.php');
			include_once ('classes/playlist.php');
			break;
		case 'show_song_info':
			include_once ('classes/song.php');
			break;
		case 'show_config':
			include_once ('classes/user.php');
			include_once ('classes/other.php');
			break;
		case 'show_info_perf':
			include_once ('classes/other.php');
			break;	
		case 'playlist_create':
			include_once ('classes/playlist.php');
			break;
		case 'search_user':
			include_once ('classes/other.php');
			break;
		case 'upload_html':
			include_once ('classes/host.php');
			break;
		case 'playlist_create':
			include_once ('classes/playlist.php');
			break;
		case 'playlist_show':
			include_once ('classes/playlist.php');
			break;
		default:
			$unloged_close_page_attempt=1;
	}
}else{
	switch($modul_to_load){
		case 'activate':
			break;
		case 'add':
			break;
		case 'news_unlogged':
			//
			break;
		case 'reg':
			//
			break;
		case 'login':
			//
			break;
		default:
			$unloged_close_page_attempt=1;
	}
}

switch($modul_to_load){//dlja vseh..
	case 'search_song':
		include_once ('classes/other.php');
		break;
	case 'search_perf':
		include_once ('classes/other.php');
		break;
	case 'error':
		include_once ('classes/other.php');
		break;
	default:
		if($loged_close_page_attempt==1){
			$modul_to_load='closed_unlogged';
			$dont_load_module=1;
		}elseif($unloged_close_page_attempt==1){
			$modul_to_load='closed_unlogged';
			$dont_load_module=1;
		}
		break;
}

    //===========================
    include_once('classes/session_lang.php');
    $title = $text['title']['title'].$text['title']['separator'].$page_name;
    //--------------------
    
    include('modules/index.php');//--index vsegda podgruzaetsja

	$module='modules/'.$modul_to_load.'.php';
	if(!is_file($module)){
		$module='modules/'.$default_module.'.php';
	}
	if(!isset($dont_load_module) OR $dont_load_module!=1)include($module);//zagruzka funkcij modulej
    //--------------------
    
	//vaborka desaina
    include_once('classes/session_design.php');
   	
    include($diz);
    //konec designa
?>