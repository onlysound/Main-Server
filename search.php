<?

$module='search_user';
$page_name =& $text['title']['user_info'];

if(count($_GET))$input=&$_GET;
if(count($_POST)){
    foreach($_POST as $key => $value){
    	$input[$key]=&$_POST[$key];
    }
}

if(isset($input['type'])){
	switch($input['type']){
		case 'user':
			$modul_to_load='search_user';
			break;
		case 'song':
			$load_add_function=1;
			$modul_to_load='search_song';
			break;
		case 'perf':
			$modul_to_load='search_perf';
			break;
		default:
			$modul_to_load='error';
			$error_to_write =& $text['error']['search'];

	}
}

	include_once('header.php');

?>