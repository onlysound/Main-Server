<?

	$max_file_size=16;//in Mb
    $host=new host($connect->get_connection());
	$available_host=$host->get_available_server();
	$server='';
	preg_match('|(http://)?([^/]+)*/?.*|',$_SERVER['HTTP_REFERER'],$server);
    if($host->get_server_id($server[2])){    	preg_match_all('|{\s*result\s*:\s*([^}]*)?\s*}|',$input['ans'],$out);
    	for($i=0;$i<count($out[1]);$i++){    		$print_result.=($i+1).' file status: '.$out[1][$i].'<br>';    	}    }
?>
