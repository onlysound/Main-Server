<?
$playlist = new playlist($connect->get_connection());

$playlist_isset=false;
if(isset($input['pp']) and (is_numeric($input['pp']))) $playlist_isset=true;

if($playlist_isset){
	$rows_rep_page=50;
	$show_pages=10;

    if(isset($input['from']) and is_numeric($input['from'])){
    	$from=$input['from'];
    	$from=floor($from / $rows_rep_page);
    	$from=$from*$rows_rep_page;
    }else $from = 0;

	//----------
	$total = $playlist->count_songs($input['pp']);
    $result = $playlist->select_songs($input['pp'],$from);

    if(!$result){    	 if($playlist->get_status()=='EMPTY_LIST'){
		    $table_print_to_page=$text['playlist']['empty'];
		 }
	}else{
		for($i=0;$i<count($result)-1;$i++){
			$result[$i]['pname']='<a href="/show.php?pp=perf&perf='.$result[$i]['pid'].'">'.$result[$i]['pname'].'</a>';
			if($result['owner']==$_SESSION['ID'])$result[$i]['delete']='<a href="delete">delete</a>';
		}
		$table_print_to_page=table($result)."<br><br>";  //------final table to print

		$num = ceil($total  / $rows_rep_page);

		$start_count = floor($from / ($rows_rep_page*$show_pages));
		$pages_left = $num - $start_count*$show_pages;
        $str="";
		if($start_count>0){
			$str.='<a href="/playlist.php?action=show&pp='.$input['pp'].'&from='.(($start_count-1)*$rows_rep_page*$show_pages);

			if($song_text){
    			$str.='&ss='.$input['ss'];
    		}
		    if($perf_text){
		    	$str.='&pp='.$input['pp'];
		    }
		    $str.='"> << </a> ';
		}

        if($pages_left>$show_pages){
        	$count_till=$show_pages;
        	$print=1;
        }else{
        	$count_till=$pages_left;
        	$print=0;
        }

		for($i=0;$i<$count_till;$i++){
			$str.='<a href="/playlist.php?action=show&pp='.$input['pp'].'&from='.($start_count*$rows_rep_page*$show_pages+$i*$rows_rep_page);

			if($song_text){
    			$str.='&ss='.$input['ss'];
    		}
		    if($perf_text){
		    	$str.='&pp='.$input['pp'];
		    }
		    $str.='">'.($show_pages*$start_count+$i+1).'</a> ';
		}
		if($print){
			$str.='<a href="/playlist.php?action=show&pp='.$input['pp'].'&from='.(($start_count+1)*$rows_rep_page*$show_pages);

			if($song_text){
    			$str.='&ss='.$input['ss'];
    		}
		    if($perf_text){
		    	$str.='&pp='.$input['pp'];
		    }
		    $str.='"> >> </a> ';

		}

		$bottom_print=&$str;
	}
}else{    $user_isset=false;
	if(isset($input['uu']) and (is_numeric($input['uu']))) $user_isset=true;

	if($user_isset){		 $playlists_list = $playlist->select_all($input['uu']);	}else{		$playlists_list = $playlist->select_all($_SESSION['ID']);	}

	if(!$playlists_list ){
		//proverka po4
	    if($playlist->get_status()=='NO_ROW'){	    	if($user_isset){	    		$table_print_to_page=&$text['playlist']['user_no_row'];
			}else{				$table_print_to_page=&$text['playlist']['no_row'];
			}	    }
	}else{
		for($i=0;$i<count($playlists_list);$i++){
				$playlists_list[$i]['name']='<a href="/playlist.php?action=show&pp='.$playlists_list[$i]['id'].'">'.$playlists_list[$i]['name'].'</a>';
				if(!$user_isset)$playlists_list[$i]['delete']='<a href="/playlist.php?action=delete&pp='.$playlists_list[$i]['id'].'"> DELETE </a>';
			}

		$table_print_to_page=table($playlists_list);
	}
}


?>
