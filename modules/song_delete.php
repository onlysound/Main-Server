<?
if(!isset($passed))exit('0');
$connect= new connector();
$song = new playlist($connect->get_connection());

if(isset($input['ss']) and (is_numeric($input['ss']))){

}else{

if($result){
    exit('1');
}else{
    exit($song->get_status());
}
?>