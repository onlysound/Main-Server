<?

function make_log($log){
	
}
function mysql_array(&$mysql_result){
    for($i=0;$i<mysql_num_rows($mysql_result);$i++){
    	for($j=0;$j<mysql_num_fields($mysql_result);$j++){
    		$field=mysql_fetch_field($mysql_result,$j);
    		$ret[$i][$field->name]=mysql_result($mysql_result,$i,$j);
    	}
    }
	return $ret;
}
function table(&$array){

		$ret="<table>";
		if(isset($array['owner']))$minus=1;
		else $minus=0;
		for($i=0;$i<count($array)-$minus;$i++){
			$ret.="<tr>";
			if($i==0){
				$ret.="<td>#</td>";
				foreach($array[$i] as $key => $value){
                	$ret.="<td>".$key."</td>";
				}
				$ret.="</tr><tr>";
			}
			$ret.="<td>".($i+1)."</td>";
			foreach($array[$i] as $key => $value){
				$ret.="<td>".$value."</td>";
			}
			$ret.="</tr>";
		}
		$ret.="</table>";
       	return $ret;
	}
function listing(&$array){
		$ret="<table>";
		foreach($array as $key => $value){
                	$ret.="<tr><td>".$key."</td><td>".$value."</td></tr>";
		}
		$ret.="</table>";
       	return $ret;
	}
function check_text(&$string){
		$string=str_replace('\"','\'',$string);
		preg_match_all('/([0-9A-Za-zÀ-ßà-ÿ\-\._])+/',$string,$out,PREG_SET_ORDER);
		if(!$out){
			return false;
		}
		$string=mysql_real_escape_string($string);
		return $string;
	}
function gen_unick_name(){
        $len=25;
        $str='';
        $rand_values=array(
        '1','2','3','4','5','6','7','8','9','0',
        'a','b','c','d','e','f','g','h','i','j',
        'k','l','m','n','o','p','q','r','s','t',
        'u','v','w','x','y','z','A','B','C','D',
        'E','F','G','H','I','J','K','L','M','N',
        'O','P','Q','R','S','T','U','V','W','X',
        'Y','Z');

        for($i=0;$i<$len;$i++){
        	list($usec, $sec) = explode(' ', microtime());

			$seed=(float) $sec + ((float) $usec * 100000);
			srand($seed);
			$randval= rand(1,62);

			$str.=$rand_values[$randval];
        }
        return $str;
	}

function root_folder($file)
{
	$pathtoConfig=pathinfo(realpath($file));
	//var_dump($pathtoConfig);
	return $pathtoConfig["dirname"];	
}

?>