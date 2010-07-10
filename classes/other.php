<?

class other{
	private $connect;
	private $status;
    //-----------------
    public function __construct($connect = NULL){//<<ready

    	if($connect!=NULL){
            $this->set_connection($connect);
    	}else{
	    	$ret='OK';
		 	include_once 'config.php';
			$this->set_connection(mysql_connect( $connect[$what]['host'], $connect[$what]['user'], $connect[$what]['pass']));

			if($this->get_connection()){
				if (!mysql_select_db($connect[$what]['db'], $this->get_connection())) {
	   				 $ret='DB_ERR';
				}
			}else $ret='CONNECT_ERR';

			$this->set_status($ret);
    	}
	}
    private function set_connection( $connect ){
		$this->connect = $connect;
	}
	public function get_connection(){
		return $this->connect;
	}
	private function set_status( $status ){//<<ready
		$this->status = $status;
	}
	public function get_status(){//<<ready
		return $this->status;
	}
	//-----------------
    public function search_user(&$incoming){
    	$first=0;

		$query="SELECT
		`users_info`.`id`,
		`users_info`.`nick_name`,
		`users_info`.`name`,
		`users_info`.`second_name`,
		`users_info`.`sex` ,
		`users_info`.`dob`,
		`users_info`.`avatar`,
		`country`.`id` as country_id,
		`country`.`country_full` as country_full,
		`town`.`id` as town_id,
		`town`.`town` as town,
		`langs`.`id` as lang_id,
		`langs`.`lang` as lang
		FROM `users_info`
		JOIN (`country`,`town`,`langs`)
		ON (`users_info`.`country`=`country`.`id`
		AND `users_info`.`town`=`town`.`id`
		AND `users_info`.`lang`=`langs`.`id`)
		WHERE";
		if(isset($incoming['user_name']) AND $incoming['user_name']!=''){
			$incoming['user_name']=check_text($incoming['user_name']);
			if(!$incoming['user_name']) break;
			$first=1;
			$query.=" `users_info`.`name` LIKE '".$incoming['user_name']."%'";
		}
		if(isset($incoming['user_f_name']) AND $incoming['user_f_name']!=''){
			$incoming['user_f_name']=check_text($incoming['user_f_name']);
			if(!$incoming['user_f_name']) break;
			if($first==1)$query.=" AND";
			$first=1;
			$query.=" `users_info`.`second_name` LIKE '".$incoming['user_f_name']."%'";
		}
		if(isset($incoming['user_nick']) AND $incoming['user_nick']!=''){
			$incoming['user_nick']=check_text($incoming['user_nick']);
			if(!$incoming['user_nick']) break;
			if($first==1)$query.=" AND";
			$first=1;
			$query.=" `users_info`.`nick_nick` LIKE '%".$incoming['user_nick']."%'";
		}
		if(isset($incoming['age1']) AND isset($incoming['age2']) AND is_numeric($incoming['age1']) AND is_numeric($incoming['age2']) AND $incoming['age1']>10 AND $incoming['age1'] <100 AND $incoming['age2']>10 AND $incoming['age2']<100){


			if($incoming['age1']>$incoming['age2']){
			$help=$incoming['age1'];
			$incoming['age1']=$incoming['age2'];
			$incoming['age2']=$help;
		}
			if($incoming['age1']!=$incoming['age2']){
				if($first==1)$query.=" AND";
				$first=1;
				$query.=" (datediff(CURDATE(),`users_info`.`dob`)/365>'".$incoming['age1']."' AND datediff(CURDATE(),`users_info`.`dob`)/365<'".$incoming['age2']."')";
			}
		}
		if(isset($incoming['sex']) AND ($incoming['sex']==0 OR $incoming['age2']==1)){
			if($first==1)$query.=" AND";
			$first=1;
			$query.=" `users_info`.`sex`='".$incoming['sex']."'";
		}
		if(isset($incoming['user_country']) AND $incoming['user_country']!='' AND $incoming['user_country']!='0' and is_numeric($incoming['user_country'])){
			if($first==1)$query.=" AND";
			$first=1;
			$query.=" `users_info`.`country` = ".$incoming['user_country'];
		}
		if(isset($incoming['user_city']) AND $incoming['user_city']!=''){
			$incoming['user_city']=check_text($incoming['user_city']);
			if(!$incoming['user_city']) break;
			if($first==1)$query.=" AND";
			$first=1;
			$query.=" `users_info`.`town` = '".$incoming['user_city']."%'";
		}
		if(isset($incoming['user_lang']) AND $incoming['user_lang']!='' and $incoming['user_lang']!='0' and is_numeric($incoming['user_lang'])){
			if($first==1)$query.=" AND";
			$first=1;
			$query.=" `users_info`.`lang` = ".$incoming['user_lang'];
		}
		if($first==1){
			$query.=" LIMIT 0,100";

			$ans=mysql_query($query,$this->connect);

			if(mysql_num_rows($ans)>0){
				return mysql_array($ans);
			}else{
				$this->set_status('EMPTY');
	        	return FALSE;
			}
		}
    }
	public function count_table_rows($type = 'COUNTRY'){

		if($type=='COUNTRY'){
			$table_to_count="country";
		}elseif($type=='LANGS'){
			$table_to_count="langs";
		}
        $ans=mysql_query("
		SELECT COUNT(*)
		FROM `".$table_to_count."`
		LIMIT 1;",$this->connect);

		if(mysql_num_rows($ans)>0){
			return mysql_array($ans);
		}else{
			$this->set_status('EMPTY');
        	return FALSE;
		}
    }
    
    public function select_countries($select_type = 'SMALL'){

		if($select_type=='SMALL'){
			$many='WHERE `country`.`common`>0 ORDER BY `country`.`common` DESC,`country`.`country` ASC';
		}elseif($select_type=='ALL'){
			$many="ORDER BY `country`.`country` ASC ";
		}
        $ans=mysql_query("
		SELECT
		`country`.`id` as id,
		`country`.`country` as country
		FROM `country`
		".$many.";",$this->connect);

		if(mysql_num_rows($ans)>0){
			return mysql_array($ans);
		}else{
			$this->set_status('EMPTY');
        	return FALSE;
		}
    }
    public function select_languages($select_type = 'SMALL'){

		if($select_type=='SMALL'){
			$many='WHERE `langs`.`common`>0 ORDER BY `langs`.`common` DESC,`langs`.`lang` ASC ;';
		}elseif($select_type=='ALL'){
			$many="ORDER BY `langs`.`lang` ASC ;";
		}
        $ans=mysql_query("
		SELECT
		`langs`.`id` as id,
		`langs`.`lang` as lang
		FROM `langs`
		".$many.";",$this->connect);

		if(mysql_num_rows($ans)>0){
			return mysql_array($ans);
		}else{
			$this->set_status('EMPTY');
        	return FALSE;
		}
    }
    public function search_song_count($name_like){

        $ans=mysql_query("
		SELECT COUNT(*) AS total
		FROM `songs_info`
		JOIN (
		 `performer`
		) ON ( `songs_info`.`author` = `performer`.`id`)
		WHERE ".$name_like."
		LIMIT 5000;",$this->connect);

		$ans = mysql_fetch_row($ans);

		if($ans[0]>0){
			return $ans[0];
		}else{
			$this->set_status('EMPTY');
        	return FALSE;
		}
    }
	public function search_song($name_like,$from = 0){
 		$ans=mysql_query("
		SELECT `performer`.`id` AS pid,
		`performer`.`name` AS pname,
		`songs_info`.`id` AS sid,
		`songs_info`.`name` AS sname
		FROM `songs_info`
		JOIN (
		 `performer`
		) ON ( `songs_info`.`author` = `performer`.`id`)
		WHERE ".$name_like."
		LIMIT  ".$from.",20;
		",$this->connect);

		if(mysql_num_rows($ans)>0){
			return mysql_array($ans);
		}else{
			$this->set_status('EMPTY');
        	return FALSE;
		}
    }
	public function search_performer_count($name_like){

        $ans=mysql_query("
		SELECT COUNT(*) AS total
		FROM `performer`
		WHERE `performer`.`name` like '".$name_like."'
		LIMIT 5000;",$this->connect);

		$ans = mysql_fetch_row($ans);

		if($ans[0]>0){
			return $ans[0];
		}else{
			$this->set_status('EMPTY');
        	return FALSE;
		}
    }
    public function search_performer($name_like,$from = 0 ){

        $ans=mysql_query("
		SELECT `performer`.`id` AS pid,
		`performer`.`name` AS pname
		FROM `performer`
		WHERE `performer`.`name` like '".$name_like."'
		LIMIT  ".$from.",20;
		",$this->connect);

		//return mysql_error();
		//return $ans;
		// mysql_num_fields($result)

		if(mysql_num_rows($ans)>0){
			return mysql_array($ans);
		}else{
			$this->set_status('EMPTY');
        	return FALSE;
		}
    }
    public function select_performer_info($performer_id){
    	//SELECT * FROM `performer` WHERE `id`=1 LIMIT 1;
    	$ans=mysql_query("
		SELECT
		`performer`.`id` as id,
		`performer`.`name` as name,
		`performer`.`info` as info,
		`performer`.`site` as site,
		`performer`.`pic` as foto,
		`performer`.`album_num` as album_num,
		`performer`.`song_num` as song_num,
		`country`.`country_full` as country,
		`town`.`id` as town_id,
		`town`.`town` as town,
		`langs`.`id` as lang_id,
		`langs`.`lang` as lang
		FROM `performer`
		JOIN (`country`,`town`,`langs`) ON
			 (`performer`.`country`=`country`.`id`
			 and `performer`.`town`=`town`.`id`
			 and `performer`.`lang`=`langs`.`id`)
		WHERE `performer`.`id`=".$performer_id." LIMIT 1;
		",$this->connect);

    	if(mysql_num_rows($ans)==1){
			return mysql_fetch_assoc($ans);
		}else{
			$this->set_status('EMPTY');
        	return false;
		}
    }
    public function select_song_info(){
    	//SELECT * FROM `songs_info` WHERE `id`=1 LIMIT 1;
    }
    public function select_album_info(){
    	//SELECT * FROM `album` WHERE `id`=1 LIMIT 1;
    }
    public function variations(){
    	//SELECT `performer`.`id` AS pid,
		//`performer`.`name` AS pname,
		//`songs_info`.`id` AS sid,
		//`songs_info`.`name` AS sname,
		//`users_songs_info`.`length`,
		//`users_songs_info`.`bitrate`,
		//`users_songs_info`.`added`,
		//`users_songs_info`.`listened`
		//FROM `users_songs_info`
		//JOIN (
		// `performer`,`songs_info`
		//) ON ( `users_songs_info`.`author_num` = `performer`.`id` AND `users_songs_info`.`song_num`=`songs_info`.`id`)
		//WHERE `users_songs_info`.`author_num`=1210 OR `users_songs_info`.`song_num`=1
		//LIMIT  0,20;
    }
}

?>