<?

//index budet vesti na novoxti saita
//esli 4elovek uze zaloginen to nepozvolit emu zaiti na etu stranice

$input=&$_GET;
$modul_to_load='reg';

if(isset($_GET['action']) or isset($_POST['action'])){
	switch($input['action']){
		case 'login':
            $modul_to_load='login';
			break;
		case 'reg':
			$modul_to_load='reg';
			break;
		default:
			$modul_to_load='login';
	}
}
//nazvanie faila v papke dizainov
include_once('header.php');

?>