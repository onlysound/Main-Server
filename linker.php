<?

session_start();

//if(count($_GET))$input=&$_GET;
//if(count($_POST)){
//    foreach($_POST as $key => $value){
//    	$input[$key]=&$_POST[$key];
//    }
//}
$input=&$_REQUEST;
include_once('classes/session_lang.php');
//var_dump($input);
if(isset($input['ss']) and is_numeric($input['ss']))
{
	include_once ('classes/connect.php');
	include_once ('classes/song.php');
	
	$connect =  new connector();	
	if($connect->get_status()!='SERVER_CONECTION_ERR')
	{
		if($connect->get_status()!='DB_SELECT_ERR')
		{
			$passed=true;
			include_once('modules/link.php');
		}
	}	

}else{	exit('0');}


?>