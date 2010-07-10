<?
include_once('classes/connect.php');
include_once('classes/host.php');

$connect= new connector();
$new_host = new host($connect->get_connection());

if($new_host->setup_new_server())exit('1');
else exit ('0');

?>