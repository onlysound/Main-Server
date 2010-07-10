<?

$modul_to_load='show_user';
$page_name =& $text['title']['search'];

if(count($_GET))$input=&$_GET;
if(count($_POST)){
    foreach($_POST as $key => $value){
    	$input[$key]=&$_POST[$key];
    }
}

if(isset($_GET['pp']) or isset($_POST['pp'])){

	switch($input['pp']){
		case 'info':
			$modul_to_load='show_user';
			break;
		case 'conf':
			$modul_to_load='show_config';
			break;
		case 'song':
		//proverka id pesni
			$modul_to_load='show_song_info';
			break;
		case 'perf':
		//proverka id
			$modul_to_load='show_info_perf';
			break;
		default:
			$modul_to_load='error';
			$error_to_write =& $text['error']['search'];

	}
}
	include_once('header.php');

?>