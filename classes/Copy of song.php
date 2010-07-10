<?

class song{
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
 	public function add_new($user_id,$sond_info,$tecnical_info,$file_name,$location){
		//SELECT song_add(suser INTEGER(11), sauthor CHAR(64), sname CHAR(64), slen TIME, sbit INTEGER(11), sloc CHAR(255));
    	//0-äîáàâëåííà óñïåøíî
		//1-ïîõîäó òàêàÿ ïåñíÿ óæå ñóùåñòâóåò

/*
  ["version_id"]=>int(1)
  ["version"]=>string(14) "MPEG Version 1"
  ["layer_id"]=>int(1)
  ["layer"]=>string(7) "Layer I"
  ["protection"]=>string(3) "CRC"

  ["sampling_rate"]=>bool(false)
  ["padding"]=>string(3) "off"
  ["private"]=>string(3) "off"
  ["channel_mode"]=>string(6) "stereo"
  ["copyright"]=>string(3) "off"
  ["original"]=>string(2) "on"
*/
/*["bitrate"]=>int(32)
  ["tag"]=>string(3) "TAG"
  ["title"]=>string(19) "Íåáî Ïëà÷óùåé Îñåíè"
  ["author"]=>string(5) "Ìàðêè"
  ["album"]=>string(15) "Ïèñüìà â íèêóäà"
  ["year"]=>string(4) "2009"
  ["comment"]=>string(30) " ????????????????????????????"
  ["genre_id"]=>int(121)
  ["genre"]=>string(9) "Punk Rock"
  ["filesize"]=>int(2969728)
  ["length"]=>string(5) "12:22"
*/

		//['bitrate']
		//var_dump($sond_info,$tecnical_info);
		if($sond_info['author']=='')$sond_info['author']='unknown';
		if($sond_info["title"]=='')$sond_info["title"]='unknown';
		if($sond_info["album"]=='')$sond_info["album"]='unknown';
		if($sond_info["genre"]=='')$sond_info["genre"]='unknown';
		if($sond_info["year"]=='')$sond_info["year"]='0';
		//FUNCTION 				`song_add`(	suser INTEGER(11), sauthor CHAR(64), 		sname CHAR(64), 			sgenre CHAR(32), 			slen INTEGER, 			sbit INTEGER(11), 		syear INTEGER(11), 		ssize INTEGER(11), 			sfile_name cHAR(32), sloc CHAR(64))
  		$ans=mysql_query("SELECT song_add(".$user_id.",\"".$sond_info['author']."\",\"".$sond_info['title']."\",\"".$sond_info['genre']."\",".$sond_info['length'].",".$sond_info['bitrate'].",".$sond_info["year"].",".$sond_info["filesize"].",\"".$file_name."\",".$location.");",$this->get_connection());
		$ans=mysql_fetch_row($ans);
       	if($ans[0]!=1){
       		$song_num=$ans[0];
			$ans=mysql_query("SELECT song_tech_insert(".$song_num.",".$tecnical_info['second'].",".$tecnical_info['third'].",".$tecnical_info['fourth'].");",$this->get_connection());
            $ans=mysql_fetch_row($ans);
			echo mysql_error();

			$ans=mysql_query("SELECT album_new('".$sond_info['album']."','".$sond_info['author']."');",$this->get_connection());
			$ans=mysql_fetch_row($ans);

         	$album_num=$ans[0];
			$ans=mysql_query("SELECT performer_check('".$sond_info['author']."');",$this->get_connection());
			$ans=mysql_fetch_row($ans);
			$perf_num=$ans[0];

			$ans=mysql_query("SELECT album_performer_add(".$album_num.",".$perf_num.",".$song_num.");",$this->get_connection());
			$ans=mysql_fetch_row($ans);

            return TRUE;
		}elseif($ans[0]==1){
			$this->set_status('SONG_EXIST');
		    return FALSE;
		}
 	}
	public function change_author($user_id,$song_id,$new_author){
		//SELECT song_change_author(suserid INTEGER(11), ssongid INTEGER(11), sauthor INTEGER(11));
		//0-âñå ïðîøëî óñïåøíî
		//1-ïåñíè íå ñóùåñòâóåò
		//2-ïîëüçîâàòåëü íå òîò
		//3-àâòîð íå ñóùåñòâóåò

  		$ans=mysql_query("SELECT song_change_author(".$user_id.",".$song_id.",".$new_author.");",$this->get_connection());
		$ans=mysql_fetch_row($ans);

		if($ans[0]==0){
			return TRUE;
         }elseif($ans[0]==1){
         	$this->set_status('SONG_EXIST');
         	return FALSE;
         }
 	}
    public function change_rule($user_id,$song_id,$new_rule){
		//SELECT song_change_rule(suserid INTEGER(11), ssongid INTEGER(11), srule INTEGER(11));
		//0-âñå ïðîøëî óñïåøíî
		//1-ïåñíè íå ñóùåñòâóåò
		//2-ïîëüçîâàòåëü íå òîò

  		$ans=mysql_query("SELECT song_change_rule(".$user_id.",".$song_id.",".$new_rule.");",$this->get_connection());
		$ans=mysql_fetch_row($ans);

		if($ans[0]==0){
			return TRUE;
         }elseif($ans[0]==1){
         	$this->set_status('SONG_NOT_EXIST');
         	return FALSE;
         }elseif($ans[0]==1){
         	$this->set_status('WRONG_USER');
         	return FALSE;
         }
 	}
    public function delete_from_list($user_id,$song_id){
		//SELECT song_delete(sid INTEGER(11), suser INTEGER(11));
		//0-óñïåøíî óäàëåíà
		//1-ïåñíè íå ñóùåñòâóåò
		//2-þçåð íå òîò(ðàçêîìåíòèòü äëÿ óäàëåíèÿ èç âñåõ ëèñòîâ)

  		$ans=mysql_query("SELECT song_delete(".$song_id.",".$user_id.");",$this->get_connection());
		$ans=mysql_fetch_row($ans);

		if($ans[0]==0){
			return TRUE;
         }elseif($ans[0]==1){
         	$this->set_status('SONG_NOT_EXIST');
         	return FALSE;
         }elseif($ans[0]==1){
         	$this->set_status('WRONG_USER');
         	return FALSE;
         }
 	}
    public function get_link_toServer($song_id){
        $host_id=$this->get_hosting($song_id);
        $host=new host($this->get_connection());
        $host_name=$host->get_server_name($host_id);
        unset($host);
        return $host_name;
 	}
    public function get_hosting($song_id){
		//SELECT `song_get_location`(sid INTEGER(11));
		//Àäðåñ ïåñíè
		//1-ïåñíè íå ñóùåñòâóåò
		//2-ïåñíÿ ýòîìó þçåðó íå äîñòóïíà

  		$ans=mysql_query("SELECT song_get_hosting(".$song_id.");",$this->get_connection());
		$ans=mysql_fetch_row($ans);

		if($ans[0]==-1){
			$this->set_status('NO_PERMITION');
         	return FALSE;
         }elseif($ans[0]==0){
         	$this->set_status('SONG_NO_EXIST');
         	return FALSE;
         }else{
         	return $ans[0];
         }
 	}
   	public function select_user_songs($user_id,$from = 0,$type = 'LESS'){
		$help=new playlist($this->get_connection());
		$return=$help->select_songs_general($user_id,$from,$type);
		unset($help);
		return $return;
	}
	public function count_user_songs($user_id){
	    $help=new playlist($this->get_connection());
		$return=$help->count_songs_general($user_id);
		unset($help);
		return $return;
	}
    public function select_clones($song_id,$from = 0,$type = 'LESS'){
		if($type=='LESS'){
        	$ans=mysql_query("
			SELECT
			`performer`.`id` AS pid,
			`performer`.`name` AS pname,
			`songs_info`.`id` AS sid,
			`songs_info`.`name` AS sname,
			`users_songs_info`.`id` user_sid,
			`users_songs_info`.`length` as len,
			`users_songs_info`.`bitrate` as bitr
			FROM `songs_info`
			JOIN (
			`users_songs_info` , `users_songs_tech_info` , `performer`
			) ON (
			`songs_info`.`id`=`users_songs_info`.`song_num`
            AND `songs_info`.`author` = `performer`.`id`
			AND `users_songs_info`.`id` = `users_songs_tech_info`.`id`
			)WHERE `songs_info`.`id`=".$song_id." LIMIT ".$from.",".($from+50).";
			",$this->get_connection());
        }elseif($type=='MORE'){
	        $ans=mysql_query("
			SELECT
			`performer`.`id` AS pid,
			`performer`.`name` AS pname,
			`songs_info`.`id` AS sid,
			`songs_info`.`name` AS sname,
			`users_songs_info`.`id` user_sid,
			`users_songs_info`.`length` as len,
			`users_songs_info`.`bitrate` as bitr,
            `users_songs_tech_info`.`second` as second,
            `users_songs_tech_info`.`third` as third,
            `users_songs_tech_info`.`fourth` as fourth
			FROM `songs_info`
			JOIN (
			`users_songs_info` , `users_songs_tech_info` , `performer`
			) ON (
			`songs_info`.`id`=`users_songs_info`.`song_num`
            AND `songs_info`.`author` = `performer`.`id`
			AND `users_songs_info`.`id` = `users_songs_tech_info`.`id`
			)WHERE `songs_info`.`id`=".$song_id." LIMIT ".$from.",".($from+50).";
			",$this->get_connection());
        }


		if(mysql_num_rows($ans)!=0){
			$ans=mysql_array($ans);
			return $ans;
		}else{
        	$this->set_status('EMPTY_LIST');
        	return FALSE;
        }
	}
	public function count_clones($song_id){
	        $ans=mysql_query("
			SELECT song_clone_count(".$song_id.");",$this->get_connection());
        $ans=mysql_fetch_row($ans);

		if($ans[0]!=0){
			return $ans[0];
		}elseif($ans[0]==0){
			$this->set_status('FAKE_LIST');
         	return FALSE;
		}
	}
}

?>
