<?

class player{
	private $stream_file;
	private $status;

	public function player($file){
		if(file_exists($file)){
	 		$this->stream_file=fopen($file,'r');
	 	}else{
	 		 $this->set_status('WRONG_FILE');
		}
	}
	private function set_status( $status ){//<<ready
		$this->status = $status;
	}
	public function get_status(){//<<ready
		return $this->status;
	}
	public function stream(){
		rewind($this->stream_file);
 		fpassthru($this->stream_file);
	}
}

?>