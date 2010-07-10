<?

class user{
	private $connect;
	private $id;
	private $status;
//--------------------------
	public function __construct($user_id, $session_id,$connect = NULL){//<<ready

    	if($connect!=NULL){
            $this->set_connection($connect);
    	}else{
			$connect= new connector();
			if($connect->status=="OK")$this->set_connection($connect);
			else{
				//instrukcija vqpoljaetsja v sju4ae esli netu konnecta k baze
			}
    	}
    	
        //proverka sessii
        if(is_numeric($user_id)){
			$ans=mysql_query("SELECT  `session` 
							  FROM `users_tech_info`
							  WHERE  `id`=".$user_id."
							  LIMIT 1;",$this->connect);
			$ans=mysql_fetch_row($ans);
			if($ans[0]==$session_id) $this->set_id($user_id);
        }

	}
	public function __destruct(){
		//mysql_close($this->connect);
	}
	public function get_connection(){
		return $this->connect;
	}
	private function set_connection( $connect ){
		$this->connect = $connect;
	}
	private function set_status( $status ){//<<ready
		$this->status = $status;
	}
	public function get_status(){//<<ready
		return $this->status;
	}
//-------------------------
	private function set_id( $id ){//<<ready
		$this->id = $id;
	}
	public function get_id(){//<<ready
		return $this->id;
	}
//---------------------------rabota s infoi v tablice user info

	public function select_my_info(){
		return $this->select_user_info($this->get_id());
	}
	public function select_user_info($user_info_id){
		//vadat infu o kakom to polzovatele
		$ans=mysql_query("
			SELECT
			`users_info`.`id` as user_id,
			`users_info`.`nick_name`,
			`users_info`.`created`,
			`users_info`.`name`,
			`users_info`.`second_name` as second,
			`users_info`.`dob`,
			`users_info`.`avatar`,
			`users_tech_info`.`active` as active,
			`users_tech_info`.`online` as online,
			`users_tech_info`.`pl_num` as playlists,
			`users_tech_info`.`song_total` as songs,
			`users_info`.`country` as country_id,
			`country`.`country_full` as country,
			`users_info`.`town` as town_id,
			`town`.`town` as town,
			`users_info`.`lang` as lang_id,
			`langs`.`lang` as lang,
			`users_info`.`text`
			 FROM `users_info`
			 JOIN (`country`,`town`,`langs`,`users_tech_info`) ON
			 (`users_info`.`country`=`country`.`id`
			 and `users_info`.`town`=`town`.`id`
			 and `users_info`.`lang`=`langs`.`id`
			 and `users_info`.`id` = `users_tech_info`.`id`)
			 WHERE `users_info`.`id`=".$user_info_id." LIMIT 1;
			 ",$this->connect);

         if(mysql_num_rows($ans)==1){
			return mysql_fetch_assoc($ans);
         }else{
         	return 0;
         }
	}
	public function change_pass($old_pass,$new_pass){
	/*
	SELECT user_change_pass(uid INTEGER(11), uold_pass CHAR(32), unew_pass char(32));
	0-óäà÷íî èçìåíåíî
	1-òàêîãî óçåðà íåòó
	2-óçåð íå â ñåòè
	3-ñòàðûé ïàðîëü íå ïîäõîäèò

	Uold_pass,unew_pass – âñå ïàñû â ìä5
	*/
		$ans=mysql_query("SELECT user_change_pass(".$this->get_id().",MD5(".$old_pass."),MD5(".$new_pass."));",$this->connect);
		if($ans==0){
			return 1;
		}
	}
    /*
	0-óäà÷íî èçìåíåíî
	1-òàêîãî óçåðà íåòó
	2-óçåð íå â ñåòè
    */
	public function change_name($uname){
		//SELECT user_change_name (uid INTEGER(11), uname CHAR(32));
		$ans=mysql_query("SELECT user_change_name(".$this->get_id().",'".$uname."');",$this->connect);
		$ans = mysql_fetch_row($ans);

		if($ans[0]==0){
			return TRUE;
		}elseif($ans[0]==1){
			$this->set_status('USER_NOT_EXIST');
        	return FALSE;
		}elseif($ans[0]==2){
			$this->set_status('USER_OFFLINE');
        	return FALSE;
		}
	}
	public function change_second($usecond){
		//SELECT user_change_second (uid INTEGER(11), usecond CHAR(32));
		$ans=mysql_query("SELECT user_change_second(".$this->get_id().",'".$usecond."');",$this->connect);
		$ans = mysql_fetch_row($ans);

		if($ans[0]==0){
			return TRUE;
		}elseif($ans[0]==1){
			$this->set_status('USER_NOT_EXIST');
        	return FALSE;
		}elseif($ans[0]==2){
			$this->set_status('USER_OFFLINE');
        	return FALSE;
		}
	}
	public function change_nick($unick){
		//SELECT user_change_nick(uid INTEGER(11), unick CHAR(32));
		$ans=mysql_query("SELECT user_change_nick(".$this->get_id().",'".$unick."');",$this->connect);
		$ans = mysql_fetch_row($ans);

		if($ans[0]==0){
			return TRUE;
		}elseif($ans[0]==1){
			$this->set_status('USER_NOT_EXIST');
        	return FALSE;
		}elseif($ans[0]==2){
			$this->set_status('USER_OFFLINE');
        	return FALSE;
		}
	}
	public function change_dob($udob){
		//SELECT user_change_dob (uid INTEGER(11), udob DATE);
		$ans=mysql_query("SELECT user_change_dob(".$this->get_id().",'".$udob."');",$this->connect);
		$ans = mysql_fetch_row($ans);

		if($ans[0]==0){
			return TRUE;
		}elseif($ans[0]==1){
			$this->set_status('USER_NOT_EXIST');
        	return FALSE;
		}elseif($ans[0]==2){
			$this->set_status('USER_OFFLINE');
        	return FALSE;
		}
	}
	public function change_avatar($uavatar){
		//SELECT user_change_avatar (uid INTEGER(11), uavatar CHAR(64));
		$ans=mysql_query("SELECT user_change_avatar(".$this->get_id().",'".$uavatar."');",$this->connect);
		$ans = mysql_fetch_row($ans);

		if($ans[0]==0){
			return TRUE;
		}elseif($ans[0]==1){
			$this->set_status('USER_NOT_EXIST');
        	return FALSE;
		}elseif($ans[0]==2){
			$this->set_status('USER_OFFLINE');
        	return FALSE;
		}
	}
	public function change_country($ucountry){
		//SELECT user_change_country (uid INTEGER(11), ucountry INTEGER(11));
		$ans=mysql_query("SELECT user_change_country(".$this->get_id().",'".$ucountry."');",$this->connect);
		$ans = mysql_fetch_row($ans);

		if($ans[0]==0){
			return TRUE;
		}elseif($ans[0]==1){
			$this->set_status('USER_NOT_EXIST');
        	return FALSE;
		}elseif($ans[0]==2){
			$this->set_status('USER_OFFLINE');
        	return FALSE;
		}
	}
	public function change_town($utown){
		//SELECT user_change_town (uid INTEGER(11), utown INTEGER(11));
		$ans=mysql_query("SELECT user_change_town(".$this->get_id().",".$utown.");",$this->connect);
		$ans = mysql_fetch_row($ans);

		if($ans[0]==0){
			return TRUE;
		}elseif($ans[0]==1){
			$this->set_status('USER_NOT_EXIST');
        	return FALSE;
		}elseif($ans[0]==2){
			$this->set_status('USER_OFFLINE');
        	return FALSE;
		}
	}
	public function change_lang($ulang){
		//SELECT user_change_lang (uid INTEGER(11), ulang INTEGER(11));
		$ans=mysql_query("SELECT user_change_lang(".$this->get_id().",".$ulang.");",$this->connect);
		$ans = mysql_fetch_row($ans);

		if($ans[0]==0){
			return TRUE;
		}elseif($ans[0]==1){
			$this->set_status('USER_NOT_EXIST');
        	return FALSE;
		}elseif($ans[0]==2){
			$this->set_status('USER_OFFLINE');
        	return FALSE;
		}
	}
 	public function change_text($utext){
		//SELECT user_change_text(uid INTEGER(11), utext TEXT);
		$ans=mysql_query("SELECT user_change_text(".$this->get_id().",'".$utext."');",$this->connect);
		$ans = mysql_fetch_row($ans);

		if($ans[0]==0){
			return TRUE;
		}elseif($ans[0]==1){
			$this->set_status('USER_NOT_EXIST');
        	return FALSE;
		}elseif($ans[0]==2){
			$this->set_status('USER_OFFLINE');
        	return FALSE;
		}
	}
}

class moderator extends user{
//------------------------------------------------
/*
0-âñå ïðîøëî íîðìàëüíî
1-íåòó òàêîãî àâòîðà
2(äëÿ coutry,town,lang)-òàêîãî çíà÷åíèÿ íåòó â áàçå
*/
	public function performer_change_name($pid,$pnewname){
     	//SELECT performer_change_name(pid INTEGER(11), pnewname CHAR(64))
     	$ans=mysql_query("SELECT performer_change_name(".$pid.",".$pnewname.");",$this->connect);
		if($ans==0){
			return 1;
		}

 	}
	public function performer_change_info($pid,$pnewinfo){
     	//SELECT performer_change_info(pid INTEGER(11), pnewinfo TEXT)
     	$ans=mysql_query("SELECT performer_change_info(".$pid.",".$pnewinfo.");",$this->connect);
		if($ans==0){
			return 1;
		}
 	}
	public function performer_change_site($pid,$pnewsite){
     	//SELECT performer_change_site(pid INTEGER(11), pnewsite CHAR(128))
     	$ans=mysql_query("SELECT performer_change_site(".$pid.",".$pnewsite.");",$this->connect);
		if($ans==0){
			return 1;
		}
 	}
	public function performer_change_pic($pid,$pnewpic){
     	//SELECT performer_change_pic(pid INTEGER(11), pnewpic CHAR(64))
     	$ans=mysql_query("SELECT performer_change_pic(".$pid.",".$pnewpic.");",$this->connect);
		if($ans==0){
			return 1;
		}
 	}
	public function performer_change_country($pid,$pnewcntry){
     	//SELECT performer_change_country(pid INTEGER(11), pnewcntry INTEGER(11))
     	$ans=mysql_query("SELECT performer_change_country(".$pid.",".$pnewcntry.");",$this->connect);
		if($ans==0){
			return 1;
		}
 	}
	public function performer_change_town($pid,$pnewtwn){
     	//SELECT performer_change_town(pid INTEGER(11), pnewtwn INTEGER(11))
     	$ans=mysql_query("SELECT performer_change_town(".$pid.",".$pnewtwn.");",$this->connect);
		if($ans==0){
			return 1;
		}
 	}
	public function performer_change_lang($pid,$pnewlng){
     	//SELECT performer_change_lang(pid INTEGER(11), pnewlng INTEGER(11))
     	$ans=mysql_query("SELECT performer_change_lang(".$pid.",".$pnewlng.");",$this->connect);
		if($ans==0){
			return 1;
		}
 	}
//------------------------------------------------
/*
Èçìåíèòü èíôî î ïåñíå
0-âñå ïðîøëî óñïåøíî
1-íåòó òàêîé ïåñíè
2-àâòîð,ñòèëü,ÿçûê íå òîò
*/
	public function song_info_change_author($siid,$siauthor){
     	//SELECT song_info_change_author(siid INTEGER(11), siauthor INTEGER(11))
     	$ans=mysql_query("SELECT song_info_change_author(".$siid.",".$siauthor.");",$this->connect);
		if($ans==0){
			return 1;
		}
 	}
	public function song_info_change_name($siid,$siname){
     	//SELECT song_info_change_name(siid INTEGER(11), siname CHAR(64))
     	$ans=mysql_query("SELECT song_info_change_name(".$siid.",".$siname.");",$this->connect);
		if($ans==0){
			return 1;
		}
 	}
	public function song_info_change_len($siid,$silen){
     	//SELECT song_info_change_len(siid INTEGER(11), silen TIME)
     	$ans=mysql_query("SELECT song_info_change_len(".$siid.",".$silen.");",$this->connect);
		if($ans==0){
			return 1;
		}
 	}
	public function song_info_change_genre($siid,$sigenre){
     	//SELECT song_info_change_genre(siid INTEGER(11), sigenre INTEGER(11))
     	$ans=mysql_query("SELECT song_info_change_genre(".$siid.",".$sigenre.");",$this->connect);
		if($ans==0){
			return 1;
		}
 	}
	public function song_info_change_year($siid,$siyear){
     	//SELECT song_info_change_year(siid INTEGER(11), siyear INTEGER(11))
     	$ans=mysql_query("SELECT song_info_change_year(".$siid.",".$siyear.");",$this->connect);
		if($ans==0){
			return 1;
		}
 	}
	public function song_info_change_info($siid,$siinfo){
     	//SELECT song_info_change_info(siid INTEGER(11), siinfo TEXT)
     	$ans=mysql_query("SELECT song_info_change_len(".$siid.",".$siinfo.");",$this->connect);
		if($ans==0){
			return 1;
		}
 	}
	public function song_info_change_text($siid,$sitext){
     	//SELECT song_info_change_text(siid INTEGER(11), sitext TEXT)
     	$ans=mysql_query("SELECT song_info_change_text(".$siid.",".$sitext.");",$this->connect);
		if($ans==0){
			return 1;
		}
 	}
	public function song_info_change_lang($siid,$silang){
     	//SELECT song_info_change_lang(siid INTEGER(11), silang INTEGER(11))
     	$ans=mysql_query("SELECT song_info_change_lang(".$siid.",".$silang.");",$this->connect);
		if($ans==0){
			return 1;
		}
 	}
//------------------------------------------------
/*
Îáüåäèíåíèå ïåñåí
0-îáüåäèíèëèñü óñïåøíî
1-íåòó êîíå÷íîé ïåñíè
2-íåòó ïåñíè êîòîðóþ îáüåäèíÿòü
*/
	public function song_union($ssource,$sjoint){
     	//SELECT song_union(ssource INTEGER(11), sjoint INTEGER(11))
     	$ans=mysql_query("SELECT song_union(".$ssource.",".$sjoint.");",$this->connect);
		if($ans==0){
			return 1;
		}
 	}
//------------------------------------------------
	public function performer_union($psource,$pjoint){
     	//SELECT performer_union(psource INTEGER(11), pjoint INTEGER(11))
     	//0-îáüåäèíèëèñü óñïåøíî
		//1-íåòó êîíå÷íîãî àâòîðà
		//2-íåòó àâòîðà êîòîðîãî îáüåäèíÿòü
     	$ans=mysql_query("SELECT performer_union(".$psource.",".$pjoint.");",$this->connect);
		if($ans==0){
			return 1;
		}
 	}
	public function performer_add($pname){
     	//SELECT performer_add(pname INTEGER(11))
     	//0-òàêîé ïåðôîðìåð óæå ñóùåñòâóåò
		//Íîìåð- íîìåð ïîä êîòîðûì íîâûé àâòîð áûë äàáàâëåí
     	$ans=mysql_query("SELECT performer_add(".$pname.");",$this->connect);
		if($ans==0){
			return 1;
		}
 	}
	public function performer_delete($pid){
     	//SELECT performer_delete(pid INTEGER(11))
     	//0-àâòîð óäàëåí
		//1-Òàêîãî àâòîðà íåòó
     	$ans=mysql_query("SELECT performer_delete(".$pid.");",$this->connect);
		if($ans==0){
			return 1;
		}
 	}
}

?>
