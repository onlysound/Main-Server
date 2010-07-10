<?

class files{
	private $file_name;
    private $file_temp;
	private $file_extension;

    public function load_file(&$file_path){
    	preg_match("/^([0-9A-Za-zà-ÿÀ-ß\-_\s\{\}\[\]\(\)']+).([0-9A-Za-zà-ÿÀ-ß\-_]+)$/",$file_path['name'],$out);
		$this->file_name=$out[1];;
		$this->file_extension=$out[2];
		$this->file_temp=$file_path['tmp_name'];
    }
    function save($filename, $permissions=null) {
    	//echo $filename;
    	$filecontents= file_get_contents($this->file_temp);
    	$ans=file_put_contents($filename,$filecontents);
      	if( $permissions != null) {
         	chmod($filename,$permissions);
      	}
      	return $ans;
   }
    public function get_file_name(){
		return $this->file_name;
	}
	public function get_file_extension(){//<<ready
		return $this->file_extension;
	}
}

?>
