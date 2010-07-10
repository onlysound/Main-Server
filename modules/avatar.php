<?
//echo 'test';
$me = new user($_SESSION['ID'],session_id(),$connect->get_connection());

$info=$me->select_my_info();

if(!$info){
	//proverka po4emu

}else{
	if ($_FILES["file"]["error"] > 0){
		//echo "Error: " . $_FILES["file"]["error"] . "<br />";
	}else{		if(($_FILES["file"]["size"] / 1024)<100
		and $_FILES["file"]["type"]=='image/jpeg'
		or $_FILES["file"]["type"]=='image/gif'
		or $_FILES["file"]["type"]=='image/png'){			$old_name=&$_FILES["file"]["tmp_name"];
			if($_FILES["file"]["type"]=="image/jpeg")$extension='.jpg';
			if($_FILES["file"]["type"]=="image/gif")$extension='.gif';
			if($_FILES["file"]["type"]=="image/png")$extension='.png';
			do{				$new_name=gen_unick_name().$extension;			}while(file_exists('pics/'.$new_name));
			$old_avatar=$info['avatar'];
			$info['avatar']=$new_name;
			$change=$me->change_avatar($new_name);

			$image=new image();
			$image->load($old_name);
			$big_size=300;
			$small_size=50;
			if($image->getWidth()>$big_size)$image->resizeToWidth($big_size);
			if($image->getHeight()>$big_size)$image->resizeToHeight($big_size);
		   	$image->save('pics/'.$new_name);
		   	if($image->getWidth()>$small_size)$image->resizeToWidth($small_size);
			if($image->getHeight()>$small_size)$image->resizeToHeight($small_size);
		   	$image->save('pics_small/'.$new_name);
            unset($image);

			if($change and $old_avatar!='0' and file_exists('pics/'.$old_avatar)){
				unlink('pics_small/'.$old_avatar);
				unlink('pics/'.$old_avatar);			}
		}
	}

	if($info['avatar']=='0'){		$info['avatar']='empty.jpg';	}
	$info['avatar']="<img src='../../pics/".$info['avatar']."'>";

}
?>
