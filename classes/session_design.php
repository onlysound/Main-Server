<?

	if(isset($_SESSION['DIZ']))$diz_file_to_load=&$_SESSION['DIZ'];
    else $diz_file_to_load='standart';
    
    $diz='design/'.$diz_file_to_load.'/index.php';

    if(!is_file($diz)){
    	$diz='design/standart/index.php';
		$_SESSION['DIZ']='standart';
    	
    	$module_dezign='design/standart/'.$modul_to_load.'.php';
		if(!is_file($module_dezign)){
			$module_dezign='design/standart/'.$default_module.'.php';
		}

    }else{

    	$module_dezign='design/'.$diz_file_to_load.'/'.$modul_to_load.'.php';
		if(!is_file($module_dezign)){
			$module_dezign='design/'.$diz_file_to_load.'/'.$default_module.'.php';
		}
    }

?>
