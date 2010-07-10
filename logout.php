<?
session_start();
if(isset($_SESSION['ID'])){
	
	session_destroy();
	header('Location: http://'.$_SERVER['SERVER_NAME']);
	EXIT;
}

?>