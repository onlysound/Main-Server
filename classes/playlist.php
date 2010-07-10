<?

class playlist{
	private $connect;
	private $status;
    //------------------------------
    public function __construct($connect = NULL){//<<ready

		if($connect != NULL){
			$this->connect = $connect;
		}else{
			$connect= new connector();
			if($connect->get_status()=="OK"){
				$this->set_connection($connect);
				if($ret=='OK')  $this->set_id($user_id);
			}else{
				//instrukcija vqpoljaetsja v sju4ae esli netu konnecta k baze
			}
			
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
	//------------------------------
	public function create_new($user_id,$new_list_name,$description){
        //SELECT playlist_new(lname CHAR(255), luser INTEGER(11));
        //0-
		//1-
		//2-

 		$ans=mysql_query("SELECT playlist_new('".$new_list_name."',".$user_id.",'".$description."');",$this->get_connection());
		$ans=mysql_fetch_row($ans);

		if($ans[0]==0){
			return TRUE;
         }elseif($ans[0]==1){
         	$this->set_status('LIST_MAX');
         	return FALSE;
         }elseif($ans[0]==2){
         	$this->set_status('LIST_EXIST');
         	return FALSE;
         }
 	}
 	public function delete($user_id,$list_id){
 		//SELECT playlist_delete(llist INTEGER(11), luser INTEGER(11));
		//0-
		//1-
		//2-
		//3-
  		$ans=mysql_query("SELECT playlist_delete(".$list_id.",".$user_id.");",$this->get_connection());
		$ans=mysql_fetch_row($ans);

		if($ans[0]==0){
			return TRUE;
         }elseif($ans[0]==1){
         	$this->set_status('LIST_NOT_EXIST');
         	return FALSE;
         }elseif($ans[0]==2){
         	$this->set_status('USER_WRONG');
         	return FALSE;
         }elseif($ans[0]==3){
         	$this->set_status('GENERAL');
         	return FALSE;
         }
 	}
	public function select_info($list_id){
        //SELECT * FROM `playlist` WHERE `id`=list LIMIT 1;

 		$ans=mysql_query("SELECT
 		`playlist`.`id` as id,
   		`playlist`.`user` as user,
   		`playlist`.`name` as name,
   		`playlist`.`desc` as descr,
   		`playlist`.`song_num` as song_num
 		FROM `playlist`
 		WHERE `playlist`.`id`=".$list_id."
 		LIMIT 1;",$this->get_connection());

		if(mysql_num_rows($ans)!=0){
			$ans=mysql_fetch_assoc($ans);
			return mysql_fetch_assoc($ans);
         }else{
         	$this->set_status('NO_ROW');
         	return FALSE;
         }
 	}
   	public function select_all($user_id){
   		 $ans=mysql_query("SELECT
 		`playlist`.`id` as id,
   		`playlist`.`user` as user,
   		`playlist`.`name` as name,
   		`playlist`.`desc` as descr,
   		`playlist`.`song_num` as song_num
 		FROM `playlist`
 		WHERE `playlist`.`user`=".$user_id."
 		AND `playlist`.`name`!='0';
		",$this->get_connection());
		if(mysql_num_rows($ans)!=0){
			$ans=mysql_array($ans);
			return $ans;
         }else{
         	$this->set_status('NO_ROW');
         	return FALSE;
         }
   	}
	public function select_songs_general($user_id,$from = 0,$type = 'LESS'){

        $ans=mysql_query("SELECT playlist_select_general_id(".$user_id.");",$this->get_connection());
		$ans=mysql_fetch_row($ans);

		if($ans[0]!=0){
			$general_pl_num=$ans[0];
			return $this->select_songs($general_pl_num,$from,$type);
		}elseif($ans[0]==0){
			$this->set_status('FAKE_USER');
         	return FALSE;
		}
	}
	public function select_songs($list_id,$from = 0,$type = 'LESS' ){
        if($type=='LESS'){
        	$ans=mysql_query("
			SELECT `performer`.`id` AS pid,
			`performer`.`name` AS pname,
			`songs_info`.`id` AS sid,
			`songs_info`.`name` AS sname,
			`users_songs_info`.`id` user_sid
			FROM `song_playlist`
			JOIN (
			`users_songs_info` , `performer` , `songs_info`
			) ON (
			 `song_playlist`.`song`=`users_songs_info`.`id`
			AND `users_songs_info`.`author_num` = `performer`.`id`
			AND `users_songs_info`.`song_num` = `songs_info`.`id`
			)WHERE `song_playlist`.`playlist`=".$list_id." ORDER BY `list_id` ASC LIMIT ".$from.",".($from+50).";
			",$this->get_connection());
        }elseif($type=='MORE'){
	        $ans=mysql_query("
			SELECT
			`song_playlist`.`list_id` as ord,
			`users_songs_info`.`id` as song_id,
			`users_songs_info`.`length` as len,
			`users_songs_info`.`bitrate` as bitr,
			`songs_info`.`name` as song_name,
			`performer`.`id` as perf_id,
			`performer`.`name` as perf_name
			FROM `song_playlist`
			JOIN (`users_songs_info`,`songs_info`,`performer`)
			ON ( `song_playlist`.`song`=`users_songs_info`.`id` AND
			`users_songs_info`.`author_num`=`performer`.`id` AND
			`users_songs_info`.`song_num`=`songs_info`.`id`
			)WHERE `song_playlist`.`playlist`=".$list_id." ORDER BY `list_id` ASC LIMIT ".$from.",".($from+50).";
			",$this->get_connection());
        }

		if(mysql_num_rows($ans)!=0){
			$owner=mysql_query("
			SELECT `user`
			FROM `playlist`
			WHERE `playlist`.`id`=".$list_id." LIMIT 1;
			",$this->get_connection());

			$ans=mysql_array($ans);
			$ans['owner']=mysql_fetch_row($owner);
			return $ans;
         }else{
         	$this->set_status('EMPTY_LIST');
         	return FALSE;
         }
	}
	public function count($user_id){
		//SELECT playlist_count(userid INTEGER(11));
	    $ans=mysql_query("SELECT playlist_count(".$user_id.");",$this->get_connection());
		$ans=mysql_fetch_row($ans);

		if($ans[0]==0){
			$ans=mysql_fetch_assoc($ans);
			return $ans;
		}elseif($ans[0]==1){
			$this->set_status('FAKE_USER');
         	return FALSE;
		}
	}
	public function count_songs($list_id){
		//SELECT playlist_count(userid INTEGER(11));
	    $ans=mysql_query("SELECT playlist_count_songs(".$list_id.");",$this->get_connection());
		$ans=mysql_fetch_row($ans);

		if($ans[0]!=0){
			return $ans[0];
		}elseif($ans[0]==0){
			$this->set_status('FAKE_LIST');
         	return FALSE;
		}
	}
	public function count_songs_general($user_id){
		//SELECT playlist_count(userid INTEGER(11));

	    $ans=mysql_query("SELECT playlist_select_general_id(".$user_id.");",$this->get_connection());
		$ans=mysql_fetch_row($ans);

		if($ans[0]!=0){
			$general_pl_num=$ans[0];
			$ans=$this->count_songs($general_pl_num);
			return $ans;
		}elseif($ans[0]==0){
			$this->set_status('FAKE_USER');
         	return FALSE;
		}
	}
	public function change_song_row($song_id,$list_id,$new_row){
		//SELECT songs_list_change( new_id INT , ssong INT, slist INT );
		//0- 
		//1-
		//2-
	    $ans=mysql_query("SELECT songs_list_change(".$new_row.",".$song_id.",".$list_id.");",$this->get_connection());
        $ans=mysql_fetch_row($ans);

		if($ans[0]==0){
			return TRUE;
         }elseif($ans[0]==1){
         	$this->set_status('LIST_NOT_EXIST');
         	return FALSE;
         }elseif($ans[0]==2){
         	$this->set_status('USER_WRONG');
         	return FALSE;
         }
	}
	public function change_name($owner,$list_id,$new_name){
		//SELECT playlist_change_name(llist INTEGER(11), luser INTEGER(11), lnewname CHAR(255));
		//0-
		//1-
		//2-
		//3-

	    $ans=mysql_query("SELECT playlist_change_name(".$list_id.",".$owner.",".$new_name.");",$this->get_connection());
        $ans=mysql_fetch_row($ans);

		if($ans[0]==0){
			return TRUE;
         }elseif($ans[0]==2){
         	$this->set_status('NAME_REPEAT');
         	return FALSE;
         }elseif($ans[0]==1){
         	$this->set_status('USER_WRONG');
         	return FALSE;
         }elseif($ans[0]==3){
         	$this->set_status('GENERAL');
         	return FALSE;
         }
	}
	public function song_add($owner,$list_id,$song_id){
		//SELECT song_list_add(ssong INTEGER(11), slist INTEGER(11), suser INTEGER(11))
		//0-
		//1-
		//2-
		//3-

	    $ans=mysql_query("SELECT song_list_add(".$song_id.",".$list_id.",".$owner.");",$this->get_connection());
        $ans=mysql_fetch_row($ans);

		if($ans[0]==0){
			return TRUE;
         }elseif($ans[0]==1){
         	$this->set_status('LIST_NOT_EXIST');
         	return FALSE;
         }elseif($ans[0]==2){
         	$this->set_status('USER_WRONG');
         	return FALSE;
         }elseif($ans[0]==3){
         	$this->set_status('REPEAT_SONG_IN_LIST');
         	return FALSE;
         }
	}
	public function song_add_to_general($user_id,$song_id){
		$ans=mysql_query("SELECT playlist_select_general_id(".$user_id.");",$this->get_connection());
		$ans=mysql_fetch_row($ans);

		if($ans[0]!=0){
			$general_pl_num=$ans[0];
			return $this->song_add($user_id,$general_pl_num,$song_id);
		}elseif($ans[0]==0){
         	return FALSE;
		}
	}
    public function song_delete($owner,$list_id,$song_id){
		//SELECT song_list_delete(ssong INTEGER(11), slist INTEGER(11), suser INTEGER(11))
		//0-
		//1-
		//2-

	    $ans=mysql_query("SELECT song_list_delete(".$song_id.",".$list_id.",".$owner.");",$this->get_connection());
        $ans=mysql_fetch_row($ans);

		if($ans[0]==0){
			return TRUE;
         }elseif($ans[0]==1){
         	$this->set_status('LIST_NOT_EXIST');
         	return FALSE;
         }elseif($ans[0]==2){
         	$this->set_status('USER_WRONG');
         	return FALSE;
         }
   }
	public function song_delete_general($owner,$song_id)
	{
		$ans=mysql_query("SELECT playlist_select_general_id(".$owner.");",$this->get_connection());
		echo mysql_error();
		$ans=mysql_fetch_row($ans);

		if($ans[0]!=0){
			$general_pl_num=$ans[0];
			return $this->song_delete($owner,$general_pl_num,$song_id);
		}elseif($ans[0]==0){
         	return FALSE;
		}
	}
}

?>
