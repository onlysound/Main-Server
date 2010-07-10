<?
	$connect= new connector();
	$max_file_size=16;//in Mb

	if(count($_FILES)==1){
		$file_obj=new files();
        $answer="{result: ";
		foreach($_FILES as $key => $value){
			if($value['name']!=''){
				$file_obj->load_file($value);
				//-tut ukazat razshqrenije faila
				$extension=$file_obj->get_file_extension();
				if($extension=='mp3'){
					if ($value["error"] > 0){
						$answer.='file_error\n';
					}else{
						if($value["size"]<$max_file_size*1024*1024){
							//echo $value["tmp_name"];
							$song=new mp3($value["tmp_name"]);
							$technical_info=$song->get_info();
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
  ["filesize"]=>int(2969728)
  ["length"]=>string(5) "12:22"
*/
							$song_info=$song->get_id3();
/*
  ["tag"]=>string(3) "TAG"
  ["title"]=>string(19) "Небо Плачущей Осени"
  ["author"]=>string(5) "Марки"
  ["album"]=>string(15) "Письма в никуда"
  ["year"]=>string(4) "2009"
  ["comment"]=>string(30) " ????????????????????????????"
  ["genre_id"]=>int(121)
  ["genre"]=>string(9) "Punk Rock"
  ["bitrate"]=>int(32)
*/

							do{
								$new_name=gen_unick_name();
								$new_name.='.'.$extension;
								$host=new host($connect->get_connection());
								$available_host=$host->get_available_server();
								$location=$host->get_server_location($available_host['id']).$new_name;

							}while(file_exists($location));

							if(!$song_id3->error)$return=$file_obj->save($location);
							else{
								$answer.='song_format\n';
							}
							if($return){
								$song_db=new song($connect->get_connection());
								foreach($song_info as $key => $value){
									if(($temp = check_text($value)))$value=$temp;
								}
								$ans=$song_db->add_new($_SESSION['ID'],$song_info,$technical_info,$new_name,$available_host);
								if($ans) $answer.='sucess\n';
								else  $answer.=$song_db->get_status().'\n';
							}
						}
					}
				}else{ $answer.='incorrect_extension\n';}
			}
		}
	}else{ $answer.='empty\n';}
    echo $answer.'}';
?>
