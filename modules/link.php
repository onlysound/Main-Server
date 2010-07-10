<?
if(!isset($passed))exit('0');

if(isset($input['ss']) and is_numeric($input['ss'])){
    $song=$input['ss'];
}else{
    exit('SONG');
}

$song=new song($connect->get_connection());
$server_adress=$song->get_link_toServer($input['ss']);

if(!$server_adress)exit('{result: SONG}');

$file='http://'.$song->get_link_toServer($input['ss']).'/stream.php?ss='.$input['ss'];
echo $file;
if(!$file){	exit($song->get_status());}

?>