<?
//nado dodelat kuda otdavat otvet scripta....a tak gotovo

//o6qbki
/*
CONNECT_ERR	- o6qbka podklu4enija
DB_ERR	- o6qbka bazq
ID_NOT_INT	- id ne v tom formate
NO_ID    	- takogo id netu
CODE_ERR 	- nevernqi kod
ACTIVATED	- uze activirovali
*/

//verno - true(bool)

$id=$_GET['id'];
$code=$_GET['code'];
$status='';
$page_name =& $text['title']['activate']['fail']; 

$id=is_numeric($id)? intval($id) : false;

	//include_once 'config.php';

	//if(mysql_connect( $connect[$what]['host'], $connect[$what]['user'], $connect[$what]['pass'])){
		//if(mysql_select_db($connect[$what]['db'])){

	include_once ('classes/connect.php');
	$connect =  new connector();
		
	if($connect->get_status()!='SERVER_CONECTION_ERR'){
		if($connect->get_status()!='DB_SELECT_ERR'){
			
			if(is_int($id)){
				preg_match_all('/([0-9A-Za-z]){32}/',$code,$out);
				if(!$out){
					$status =& $text['activate']['code_err'];
				}else{
					$ans=mysql_query("SELECT user_activate(".$id.",'".$code."');");
					$ans=mysql_fetch_row($ans);

            		$ans=$ans[0];
            		if($ans==0){
            			$status =& $text['activate']['success'];
            			$page_name =& $text['title']['activate']['sucecc']; 
            		}elseif($ans==1){
            			$status =& $text['activate']['activated'];
            		}elseif($ans==2){
            			$status =& $text['activate']['code_err'];
            		}elseif($ans==3){
            			$status =& $text['activate']['act_timeout'];
            		}				}
			}else $status =& $text['activate']['id_not_int'];
		}else $status =& $text['activate']['db_err'];
	}else $status =& $text['activate']['connect_err'];
	unset($connect);
	
	$modul_to_load='activate';
	include_once('header.php');
?>