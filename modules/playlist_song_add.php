<?
if(!isset($passed))exit('0');
$playlist = new playlist($connect->get_connection());

if(isset($input['ss']) and is_numeric($input['ss'])){
    $song=$input['ss'];
}else{

if(isset($input['pp']) and (is_numeric($input['pp']))){

if($result){
    exit('1');


?>