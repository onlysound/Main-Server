<?
/*
	NOT_ACTIVE		- ne activirovano
	PASS_ERR		- nevernqi pass

	MAIL_SET		- nepravilnqi vvedennqi mail
	MAIL_LEN		- nevernaja dlinna emaila
	MAIL_SUMB		- nevernqi nabor simvolov v emaile
	PASS_SET    	- nepravilno vvedennoe pass
	PASS_LEN 		- nevernaja dlinna passa
	PASS_SUMB 		- nevernqi nabor simvolov v passe

	NO_MAIL			- ne naiden config\
	NO_CONFIG		- ne naideno takoe mqlo

	CONNECT_ERR 	- o6qbka podklju4enija
	DB_ERR 			- o6qbka vqbora bazq dannqh
*/
	$err=0;

	$post=&$_POST;
	$error_page='index.php';
	$error = $error_page;

	if(!isset($post['mail']) OR  is_bool($post['mail'])){
		if(!$err) $error.='?';
		else $error.='&';
		$error.='errs['.$err++.']=MAIL_SET';
	}

	if(strlen($post['mail'])<10 OR strlen($post['mail'])>64){

		if(!$err) $error.='?';
			else $error.='&';
			$error.='errs['.$err++.']=MAIL_LEN';
		}

	//^\w+([0-9A-Za-z\.\-_]{3,50})*\w@\w([0-9A-Za-z\.\-_]{3,25})\.(com|ru|net|lt|lv|ee|org|info)
	preg_match_all('/([0-9A-Za-z\.\-_]{3,50})*@([0-9A-Za-z\.\-_]{3,25})*\.(com|ru|net|lt|lv|ee|org|info)/',$post['mail'],$out,PREG_SET_ORDER);
	if(!$out[0]){
		if(!$err) $error.='?';
		else $error.='&';
		$error.='errs['.$err++.']=MAIL_SUMB';
	}

	if(!isset($post['pass']) OR is_bool($post['pass'])){
	if(!$err) $error.='?';
		else $error.='&';
		$error.='errs['.$err++.']=PASS_SET';
	}

	if(strlen($post['pass'])<6 OR strlen($post['pass'])>32){
		if(!$err) $error.='?';
		else $error.='&';
		$error.='errs['.$err++.']=PASS_LEN';
	}

	preg_match_all('/([0-9A-Za-z\-\._]+)/',$post['pass'],$out,PREG_SET_ORDER);
	if(!$out){
		if(!$err) $error.='?';
		else $error.='&';
		$error.='errs['.$err++.']=PASS_SUMB';
	}

	$post['pass']=md5($post['pass']);

	if(	$error != $error_page){
		header('Location:'.$error);
		EXIT;
	}

	//--------------------------------------
	include_once ('classes/connect.php');
	
	$connect =  new connector();	
	if($connect->get_status()!='SERVER_CONECTION_ERR'){
		if($connect->get_status()!='DB_SELECT_ERR'){

   			session_start();
			session_regenerate_id();
			//$ans=mysql_query("SELECT `id`,`pass`,`type`,`now_login`,`langs` FROM `login` WHERE `email`='".$post['mail']."' LIMIT 0,1");
			
			$post['mail']=mysql_real_escape_string($post['mail']);
			$post['pass']=mysql_real_escape_string($post['pass']);
	
			$ans=mysql_query("SELECT user_log_in('".$post['mail']."','".$post['pass']."','".session_id()."');");
			
			$ans=mysql_fetch_row($ans);
			//var_dump($ans);
			
			if($ans[0]==-1){
				if(!$err) $error.='?';
				else $error.='&';
				$error.='errs['.$err++.']=NO_MAIL';
				header('Location:'.$error);
				EXIT;
			}elseif($ans[0]==-2){
				if(!$err) $error.='?';
				else $error.='&';
				$error.='errs['.$err++.']=PASS_ERR';
				header('Location:'.$error);
				EXIT;
			}elseif($ans[0]==-3){
				if(!$err) $error.='?';
				else $error.='&';
				$error.='errs['.$err++.']=NOT_ACTIVE';
				header('Location:'.$error);
				EXIT;
			}

			//$session_id=$ans[0];

			/*
			$ans=mysql_query("SELECT `con_lang`,`con_design` FROM `config` WHERE `con_user_id`='".$id."' LIMIT 0,1");
			if(!mysql_num_rows($ans)){
				if(!$err) $error.='?';
				else $error.='&';
				$error.='errs['.$err++.']=NO_CONFIG';
				header('Location:'.$error);
				EXIT;
			}

			$site_lang=mysql_result($ans,0,'con_lang');
			$design=mysql_result($ans,0,'con_design');

			$query="UPDATE `login` SET `last_login`='".$now_login."',`now_login` = '".$date."',`session` = '".session_id()."' WHERE `email`='".$post['mail']."' LIMIT 1";
			if(!mysql_query($query)){
				if(!$err) $error.='?';
				else $error.='&';
				$error.='errs['.$err++.']=UPDATE_ERR';
				header('Location:'.$error);
				EXIT;
			}
			*/

			//include_once('classes.php');


			$_SESSION['ID']=$ans[0];
			//$_SESSION['SITE_LANG']=$site_lang;
			//$_SESSION['DIZ']=$design;

			header('Location: http://'.$_SERVER['SERVER_NAME']);

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
?>