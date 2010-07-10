<?
//index budet vesti na novoxti saita

$page_name =& $text['title']['index'];
$modul_to_load='news';//nazvanie faila v papke dizainov

if(isset($_GET['errs']) or isset($_POST['errs'])){

	if(isset($_GET['errs']))$input=&$_GET;
    if(isset($_POST['errs']))$input=&$_POST;

 	$modul_to_load='error';
 	switch($input['errs'][0]){

		case 'NOT_ACTIVE';
			$error_to_write =& $text['error']['not_active'];
			break;
		case 'PASS_ERR';
			$error_to_write =& $text['error']['pass_err'];
			break;
		case 'PASS_SET';
			$error_to_write =& $text['error']['wrong_text'];
			break;
		case 'PASS_LEN';
			$error_to_write =& $text['error']['pass_len'];
			break;
		case 'PASS_SUMB';
			$error_to_write =& $text['error']['pass_sumb'];
			break;
		case 'MAIL_SET';
			$error_to_write =& $text['error']['mail_set'];
			break;
		case 'MAIL_LEN';
			$error_to_write =& $text['error']['mail_len'];
			break;
		case 'MAIL_SUMB';
			$error_to_write =& $text['error']['mail_sumb'];
			break;
		case 'NO_MAIL';
			$error_to_write =& $text['error']['no_mail'];
			break;
		case 'NO_CONFIG';
			$error_to_write =& $text['error']['no_config'];
			break;
		case 'CONNECT_ERR';
			$error_to_write =& $text['error']['connect_err'];
			break;
		case 'DB_ERR';
			$error_to_write =& $text['error']['db_err'];
			break;
		default:
			$error_to_write =& $text['error']['wrong_action'];
	}
}

	include_once('header.php');
?>
