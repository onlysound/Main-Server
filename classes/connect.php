<?

class connector{
	private $connect;
	private $status;
//------------
    public function __construct(){//<<ready

		$ret='OK';
		$pathToHostingClass=pathinfo(realpath(__FILE__));
		require($pathToHostingClass["dirname"].'/../config.php');
	 	$connect_try=mysql_connect( $connect[$what]['host'], $connect[$what]['user'], $connect[$what]['pass']);
		if($connect_try){

			if (!mysql_select_db($connect[$what]['db'], $connect_try)) {
   				 $ret='DB_SELECT_ERR';
			}else{
				$this->set_connection($connect_try);
				mysql_query("SET NAMES  cp1251;");
			}
			
		}else{
			$ret='SERVER_CONECTION_ERR';
		}
		
		$this->set_status($ret);
	}
	public function __destruct(){//<<ready
		mysql_close($this->get_connection());
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
	public function make_log( $log_text ){//<<ready

		$date_time=date('Y-m-d H:i:s');
		if(mysql_query("INSERT INTO `logs` (`log_date`,`log_text`) VALUES ('$date_time','$log_text')",$this->connect)) return true;
		else return false;
	}
}

?>