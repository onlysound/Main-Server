<?
if(count($_GET))$input=&$_GET;
if(count($_POST)){
    foreach($_POST as $key => $value){
    	$input[$key]=&$_POST[$key];
    }
}
if(isset($input['action'])){
	switch($input['action']){
		case 'check':
			if(isset($input['host']) and is_numeric($input['host'])){				include_once('classes/connect.php');
				include_once('classes/host.php');
				$connect= new connector();
				$host = new host($connect->get_connection());
				if($host->check_server($input['host'])) exit('{result: 1}');				else exit('{result: 0}');			}else{exit('{result: 0}');}
			break;
		case 'available':

				include_once('classes/connect.php');
				include_once('classes/host.php');
				$connect= new connector();
				$host = new host($connect->get_connection());

                $available_server=$host->get_available_server();
                if(!$available_server) exit('{result: 0}');
                else exit('{id: '.$available_server['id'].',
adress: '.$available_server['adress'].',
port: '.$available_server['port'].'
}');

			break;
	}
}

?>