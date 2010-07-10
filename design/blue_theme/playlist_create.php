<?
$connect= new connector();

$playlist_name=false;
$playlist_desc=false;
if(isset($input['pl_name']) and (check_text($input['pl_name'])) and strlen($input['pl_name'])>2) $playlist_name=true;
if(isset($input['pl_desc']) and (check_text($input['pl_desc']))) $playlist_desc=true;

	if($playlist_name){

		$playlist = new playlist($connect->get_connection());
		$playlists_create_status = $playlist->create_new($_SESSION['ID'],$input['pl_name'],$input['pl_desc']);

		if(!$playlists_create_status ){
			//proverka po4
		    if($playlist->get_status()=='LIST_MAX'){		    	echo $text['playlist']['create']['list_max'];		    }elseif($playlist->get_status()=='LIST_EXIST'){		    	echo $text['playlist']['create']['list_exist'];		    }
		}else{
			echo $text['playlist']['create']['succes']."</br>
				<a href='/playlist.php?action=new'>".$text['playlist']['create']['to_create']."</a>";;
		}
    }else{    	echo "
    	<table>
			<form action='' method='GET'>
			<tr>
				<td>".$text['playlist']['name']."</td>
				<td><input type='text' name='pl_name' size='25' maxlength='25' /></td>
			</tr>
			<tr>
				<td>".$text['playlist']['desc']."</td>
				<td><input type='text' name='pl_desc' size=\'25' maxlength='25' />
				<input type='hidden' name='action' value='".$input['action']."' /></td>
			</tr>
			<tr>
				<td></td>
				<td>
				<input type='submit' value='".$text['playlist']['new']."' size='25' maxlength='25' />
			</td>
			</tr>
			</form>

			</table>
    	";    }
?>