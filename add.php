<?
//sdelat proverku na to otkuda uzer pri6el
//o6qbki
	/*errs[]
	NAME_SET    	- nepravilno vvedennoe imja
	NAME_LEN 		- nevernaja dlinna imeni
	NAME_SUMB 		- nevernqi nabor simvolov v imeni
	F_NAME_SET 		- nepravilno vvedennoe familija
	F_NAME_LEN 		- nevernaja dlinna familii
	F_NAME_SUMB 	- nevernqi nabor simvolov v familii
	SEX				- nevernqi sex uzera
	MAIL_SET		- nepravilnqi vvedennqi mail
	MAIL_LEN		- nevernaja dlinna emaila
	MAIL_SUMB		- nevernqi nabor simvolov v emaile
	PASS_SET    	- nepravilno vvedennoe pass
	PASS_LEN 		- nevernaja dlinna passa
	PASS_SUMB 		- nevernqi nabor simvolov v passe
	BD_SET			- data vvedena neverno
	BD_DATE			- takogo dnja v kalendare netu
	QUEST_SET    	- nepravilno vvedennoe vopros
	QUEST_LEN 		- nevernaja dlinna qoprosa
	QUEST_SUMB 		- nevernqi nabor simvolov v voprose
	ANS_SET    		- nepravilno vvedennoe vopros
	ANS_LEN 		- nevernaja dlinna otveta
	ANS_SUMB 		- nevernqi nabor simvolov v otvete

	MAIL_RET		- povtor maila, takoi uze est
	NO_MAIL			- takoi mail ne naiden(ne dobavilsja)
	USER_ID_RET		- povtor uzerovskogo id(4udo)
	CONF_ID_RET		- povtor configskogo id(4udo)
	ACTIV_ERR 		- o6qbka sozdanija activacii
	INSERT_ERR 		- o6qbka o6qbka vstavki

	CONNECT_ERR 	- o6qbka podklju4enija
	DB_ERR 			- o6qbka vqbora bazq dannqh
	*/

//<<<<<<<<<<<------------------------------------------------------------------------------------------------------------rabota s db

	//include_once 'config.php';

	//if(mysql_connect( $connect[$what]['host'], $connect[$what]['user'], $connect[$what]['pass'])){
		//if(mysql_select_db($connect[$what]['db'])){
			
	include_once ('classes/connect.php');
	$connect =  new connector();
		
	if($connect->get_status()!='SERVER_CONECTION_ERR'){
		if($connect->get_status()!='DB_SELECT_ERR'){
		
			$post=&$_POST;
			$error_page = 'reg.php';
			$error = $error_page;
 			$err=0;

//<<<<<<<<<<<<<<<--------------------------------------------------------------------------------------proverka na vvodimqe simvolq
 			$post['name']=mysql_real_escape_string($post['name']);
 			$post['f_name']=mysql_real_escape_string($post['f_name']);
 			$post['mail']=mysql_real_escape_string($post['mail']);
 			$post['pass']=mysql_real_escape_string($post['pass']);
			$post['pass_2']=mysql_real_escape_string($post['pass_2']);
			$post['day']=mysql_real_escape_string($post['day']);
			$post['month']=mysql_real_escape_string($post['month']);
			$post['year']=mysql_real_escape_string($post['year']);
			$post['quest']=mysql_real_escape_string($post['quest']);
			$post['ans']=mysql_real_escape_string($post['ans']);
//<<<<<<<<<<<<<<<--------------------------------------------------------------------------------------konec proverki na vvodimqe simvolq
//---------------------------PROVERKA NA OBQ^KI VVODA INFQ
 			if($post['sex']=='true')$post['sex']=true;
 			if($post['sex']=='false')$post['sex']=false;

 			if(!isset($post['name']) OR is_bool($post['name']) OR count(explode(' ',$post['name']))>2){
				if(!$err) $error.='?';
				else $error.='&';
				$error.='errs['.$err++.']=NAME_SET';
			}

			if(strlen($post['name'])<3 OR strlen($post['name'])>25){
				if(!$err) $error.='?';
				else $error.='&';
				$error.='errs['.$err++.']=NAME_LEN';
			}

			preg_match_all('/([0-9A-Za-z\-\._])+/',$post['name'],$out);
			if(!$out){
				if(!$err) $error.='?';
				else $error.='&';
				$error.='errs['.$err++.']=NAME_SUMB';
			}

			if(!isset($post['f_name']) OR  is_bool($post['f_name']) OR count(explode(' ',$post['f_name']))>2){
				if(!$err) $error.='?';
				else $error.='&';
				$error.='errs['.$err++.']=F_NAME_SET';
			}

			if(strlen($post['f_name'])<3 OR strlen($post['f_name'])>25){
				if(!$err) $error.='?';
				else $error.='&';
				$error.='errs['.$err++.']=F_NAME_LEN';
			}

			preg_match_all('/([0-9A-Za-z\-\._])+/',$post['f_name'],$out);
			if(!$out){
				if(!$err) $error.='?';
				else $error.='&';
				$error.='errs['.$err++.']=F_NAME_SUMB';
			}

 			if(!isset($post['sex']) OR !is_bool($post['sex'])){
				if(!$err) $error.='?';
				else $error.='&';
				$error.='errs['.$err++.']=SEX';
			}

			if(!isset($post['mail']) OR  is_bool($post['mail']) OR count(explode(' ',$post['mail']))>1){
				if(!$err) $error.='?';
				else $error.='&';
				$error.='errs['.$err++.']=MAIL_SET';
			}

			if(strlen($post['mail'])<10 OR strlen($post['mail'])>100){
				if(!$err) $error.='?';
				else $error.='&';
				$error.='errs['.$err++.']=MAIL_LEN';
			}

			preg_match_all('/([0-9A-Za-z\.\-_]{3,50})*@([0-9A-Za-z\.\-_]{3,25})*\.(com|ru|net|lt|lv|ee|org|info)/',$post['mail'],$out,PREG_SET_ORDER);

			if($out[0]==''){
				if(!$err) $error.='?';
				else $error.='&';
				$error.='errs['.$err++.']=MAIL_SUMB';
			}

			if(!isset($post['pass']) OR !isset($post['pass_2']) OR $post['pass']!= $post['pass_2'] OR is_bool($post['pass']) OR count(explode(' ',$post['pass']))>1){
				if(!$err) $error.='?';
				else $error.='&';
				$error.='errs['.$err++.']=PASS_SET';
			}

			if(strlen($post['pass'])<6 OR strlen($post['pass'])>25 ){
				if(!$err) $error.='?';
				else $error.='&';
				$error.='errs['.$err++.']=PASS_LEN';
			}

			preg_match_all('/([0-9A-Za-z\-\._])+/',$post['pass'],$out);
			if(!$out){
				if(!$err) $error.='?';
				else $error.='&';
				$error.='errs['.$err++.']=PASS_SUMB';
			}

			$post['day']=is_numeric($post['day'])? intval($post['day']) : false;
			$post['month']=is_numeric($post['month'])? intval($post['month']) : false;
			$post['year']=is_numeric($post['year'])? intval($post['year']) : false;

			if(!isset($post['day']) OR !isset($post['month']) OR !isset($post['year']) OR is_bool($post['day'])  OR is_bool($post['month'])  OR is_bool($post['year']) OR !is_int($post['day']) OR !is_int($post['month']) OR !is_int($post['year'])){
				if(!$err) $error.='?';
				else $error.='&';
				$error.='errs['.$err++.']=BD_SET';
			}else{
				if(!checkdate($post['month'],$post['day'],$post['year'])){
					if(!$err) $error.='?';
					else $error.='&';
					$error.='errs['.$err++.']=BD_DATE';
				}else{
					$post['bd']=date("mm-dd-YYYY", mktime(0, 0, 0, $post['month'],$post['day'],$post['year']));
				}
			}

			if(!isset($post['quest']) OR is_bool($post['quest'])){
				if(!$err) $error.='?';
				else $error.='&';
				$error.='errs['.$err++.']=QUEST_SET';
			}

			if(strlen($post['quest'])<1 OR strlen($post['quest'])>256 ){
				if(!$err) $error.='?';
				else $error.='&';
				$error.='errs['.$err++.']=QUEST_LEN';
			}

			preg_match_all('/([0-9A-Za-z\-\._])+/',$post['quest'],$out);
			if(!$out){
				if(!$err) $error.='?';
				else $error.='&';
				$error.='errs['.$err++.']=QUEST_SUMB';
			}

			if(!isset($post['ans']) OR is_bool($post['ans'])){
				if(!$err) $error.='?';
				else $error.='&';
				$error.='errs['.$err++.']=ANS_SET';
			}

			if(strlen($post['ans'])<1 OR strlen($post['ans'])>32 ){
				if(!$err) $error.='?';
				else $error.='&';
				$error.='errs['.$err++.']=ANS_LEN';
			}

			preg_match_all('/([0-9A-Za-z\-\._])+/',$post['ans'],$out);
			if(!$out){
				if(!$err) $error.='?';
				else $error.='&';
				$error.='errs['.$err++.']=ANS_SUMB';
			}
//<<<<<<<<<<<<<<<<<<<<konec proverki vvodnqh dannqh

			if(	$error != $error_page){
				header('Location:'.$error);
				EXIT;
			}else{
			 	$post['name']=htmlspecialchars($post['name']);
			 	$post['f_name']=htmlspecialchars($post['f_name']);
			 	$post['mail']=htmlspecialchars($post['mail']);
			 	$post['pass']=htmlspecialchars($post['pass']);
			 	$post['quest']=htmlspecialchars($post['quest']);
				$post['ans']=htmlspecialchars($post['ans']);
			}

            /*
			SELECT user_new(uname CHAR(32), usecond CHAR(32), unick CHAR(32), umail CHAR(64), upass CHAR(32));

			1-������ �����
			0-��� ������ ������
			Upass- ��� ��5

			�� ��� ����� ������� �� ���� (�secret�+mail) * in triggers
            */
            //echo "SELECT user_new('".$post['name']."','".$post['f_name']."', '".$post['mail']."', '".$post['pass']."');";
			$ans=mysql_query("SELECT user_new('".$post['name']."','".$post['f_name']."', '".$post['mail']."', '".$post['pass']."');");
			//echo mysql_error();
			$ans=mysql_fetch_row($ans);
			if($ans[0]==1){
				if(!$err) $error.='?';
				else $error.='&';
				$error.='errs['.$err++.']=MAIL_RET';
				header('Location:'.$error);
				EXIT;
			}else{
				$code=$ans[0];
			}

            $ans=mysql_query("SELECT `id` FROM `users_info` WHERE `user_mail`='".$post['mail']."' LIMIT 1;");
            $ans=mysql_fetch_row($ans);
            $id=$ans[0];

			$ans=mysql_query("UPDATE `users_info` SET `sex`=".$post['sex'].",`dob`=".$post['bd']." WHERE `id`=".$id." LIMIT 1;");
			$ans=mysql_query("UPDATE `users_tech_info` SET `question`='".$post['quest']."',`answer`='".$post['ans']."' WHERE `id`=".$id." LIMIT 1;");

			//<<<<<<<<<<<<<<<<---------------------------------------------mail dlja activacii
			if($error == 'reg.php'){
				
				$page_name =& $text['title']['registation']; 
				
				$activation_link='http://'.$_SERVER['SERVER_NAME'].'/activate.php?id='.$id.'&code='.$code;
				$message=$text['add']['massage']['begin'].$activation_link.$text['add']['massage']['end'];
				
				$header =& $text['add']['message']['header'];
				$header2='From: sender@'.$_SERVER['SERVER_NAME']."\r\n".'Reply-To: sender@'.$_SERVER['SERVER_NAME']."\r\n".'X-Mailer: PHP/' . phpversion();

				mail($post['mail'],$header,$message,$header2);
			}
		}else{
			if(!$err) $error.='?';
			else $error.='&';
			$error.='errs['.$err++.']=DB_ERR';
			header('Location:'.$error);
			EXIT;
		}
	}else{
			if(!$err) $error.='?';
			else $error.='&';
			$error.='errs['.$err++.']=CONNECT_ERR';
			header('Location:'.$error);
			EXIT;
	}

	
	$ans =& $text['title']['add'];
	unset($connect);
	$modul_to_load='add';
	include_once('header.php');

?>