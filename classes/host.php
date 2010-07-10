<?

class host{
	private $connect;
	private $status;
//----------------------------------
	function host($connect = NULL){
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
//----------------------------------
	public function check_server_response($host){
    	$starttime = microtime(true);
    	$file      = fsockopen($host, 80, $errno, $errstr, 5);
    	$stoptime  = microtime(true);
    	$status    = 0;

    	if (!$file) $status = -1;  // Site is down
    	else{
        	fclose($file);
        	$status = ($stoptime - $starttime) * 1000;
        	$status = floor($status);
    	}
	    return $status;
	}
	public function is_server_online($adress){
    	$file      = fsockopen($adress, 80, $errno, $errstr, 10);
    	if (!$file) $status = FALSE;  // Site is down
    	else{
        	$status=TRUE;
    	}
	    fclose($file);
        return $status;
	}
	public function check_server($host_id){

    	$ans=mysql_query("SELECT
    	`host`.`server_address`
    	FROM `host`
		WHERE `host`.`id`=".$host_id."
		LIMIT 1;",$this->get_connection());

		if(mysql_num_rows($ans)==1){
			$ans=mysql_fetch_row($ans);
			return $this->is_server_online($ans[0]);
         }else{
         	return FALSE;
         }
	}
	public function get_available_server(){
		$min_memory_condition=1024*1024*1024;//1 gig min
    	$ans=mysql_query("SELECT
    	`host`.`id`,
    	`host`.`server_name` as adress,
    	`host`.`port`
    	FROM `host`
		WHERE `host`.`memory_left`>".$min_memory_condition."
		ORDER BY `host`.`id` ASC
		LIMIT 10;",$this->get_connection());

    	if(mysql_num_rows($ans)!=0){
			$ans=mysql_array($ans);
			foreach($ans as $key => $value){
				 if($this->is_server_online($value['adress'])) return $value;
			}
		}

		$this->set_status('NO_SERVER_AVAILABLE');
		return FALSE;
	}
	public function get_this_id(){
		return $this->get_server_id($_SERVER['SERVER_NAME']);
	}
	public function get_this_name(){
		return $this->get_server_name($_SERVER['SERVER_ADDR']);
	}
	public function get_this_location(){
		return $this->get_server_location($_SERVER['SERVER_NAME']);
	}
	public function get_server_id($host){
		$query="SELECT
    	`host`.`id`
    	FROM `host`
		WHERE ";
		$query.="`host`.`server_name` like '".$host."' OR `host`.`server_address`='".$host."'";
		$query.=" LIMIT 1;";

		$ans=mysql_query($query,$this->get_connection());

		if(mysql_num_rows($ans)!=0){
			$ans=mysql_fetch_row($ans);
			return $ans[0];
		}else{
         	$this->set_status('EMPTY_LIST');
         	return FALSE;
        }
	}
	public function get_server_name($host){
		$query="SELECT
    	`host`.`server_name`
    	FROM `host`
		WHERE ";
		if(is_numeric($host)) $query.="`host`.`id`=".$host;
		else $query.="`host`.`server_address`='".$host."'";
		$query.=" LIMIT 1;";

		$ans=mysql_query($query,$this->get_connection());

		if(mysql_num_rows($ans)!=0){
			$ans=mysql_fetch_row($ans);

			return $ans[0];
		}else{
         	$this->set_status('EMPTY_LIST');
         	return FALSE;
        }
	}
	public function get_server_location($host){
		$query="SELECT
    	`host`.`store_location`
    	FROM `host`
		WHERE ";
		if(is_numeric($host)) $query.="`host`.`id`=".$host;
		else $query.="`host`.`server_name` like '".$host."' OR `host`.`server_address`='".$host."'";
		$query.=" LIMIT 1;";

		$ans=mysql_query($query,$this->get_connection());

		if(mysql_num_rows($ans)!=0){
			$ans=mysql_fetch_row($ans);
			return $ans[0];
		}else{
         	$this->set_status('EMPTY_LIST');
         	return FALSE;
        }
	}
	public function curent_server_space(){
		return disk_free_space('/');
	}
	public function set_server_space($host_id){
       	$ans=mysql_query("SELECT
    	`host`.`memory_left`
    	FROM `host`
		WHERE `host`.`id`=".$host_id."
		LIMIT 1;",$this->get_connection());

		if(mysql_num_rows($ans)!=0){
			$ans=mysql_array($ans);
			return $ans;
		}else{
         	$this->set_status('EMPTY_LIST');
         	return FALSE;
        }
	}
	public function setup_new_server($location = 'songs/'){
     	$free_space=disk_free_space('/');
     	$server_name=$_SERVER['SERVER_NAME'];
     	$server_addres=$_SERVER['SERVER_ADDR'];
     	$port=$_SERVER['SERVER_PORT'];

     	$ans=mysql_query("SELECT server_add('".$server_name."','".$server_addres."','".$port."','".$location."','".$free_space."');",$this->get_connection());
		//echo mysql_error();
		$ans=mysql_fetch_row($ans);

		if($ans[0]!=0){
		    return TRUE;
		}elseif($ans[0]==0){
			$this->set_status('SERVER_EXIST');
		    return FALSE;
		}
	}
}

?>
