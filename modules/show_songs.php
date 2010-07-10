<?

$pl = new song($connect->get_connection());
$song_text=false;
$pl_text=false;

    $rows_rep_page=50;
	$show_pages=10;
    if(isset($input['from']) and is_numeric($input['from'])){

    	$from=$input['from'];
    	$from=floor($from / $rows_rep_page);
    	$from=$from*$rows_rep_page;
    }else $from = 0;

	$total = $pl->count_user_songs($_SESSION['ID']);
	if($from>$total or $total<0) $from=0;

  	$result = $pl->select_user_songs($_SESSION['ID'],$from);
	if(!$result){
		if($pl->get_status()=='EMPTY'){
	    	echo $text['search']['empty'];
	    }
	}else{

		for($i=0;$i<count($result)-1;$i++){
			$result[$i]['pname']='<a href="/show.php?pp=perf&perf='.$result[$i]['pid'].'">'.$result[$i]['pname'].'</a>';
			$result[$i]['sname']='<a href="javascript:showlink('.$result[$i]['user_sid'].');">'.$result[$i]['sname'].'</a>';
			$result[$i]['delete']='<a href="/songs.php?action=delete&ss='.$result[$i]['user_sid'].'"> delete </a>';
		}
        $total_text=$text['search']['totaly'].$total;
		$table_to_print=table($result)."<br><br>";

		$num = ceil($total  / $rows_rep_page);

		$start_count = floor($from / ($rows_rep_page*$show_pages));
		$pages_left = $num - $start_count*$show_pages;
        $str="";
		if($start_count>0){
			$str.='<a href="/songs.php?from='.(($start_count-1)*$rows_rep_page*$show_pages);

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
			$str.='<a href="/songs.php?from='.($start_count*$rows_rep_page*$show_pages+$i*$rows_rep_page);

			if($song_text){
    			$str.='&ss='.$input['ss'];
    		}
		    if($ppl_text){
		    	$str.='&pp='.$input['pp'];
		    }
		    $str.='">'.($show_pages*$start_count+$i+1).'</a> ';
		}
		if($print){
			$str.='<a href="/songs.php?from='.(($start_count+1)*$rows_rep_page*$show_pages);

			if($song_text){
    			$str.='&ss='.$input['ss'];
    		}
		    if($perf_text){
		    	$str.='&pp='.$input['pp'];
		    }
		    $str.='"> >> </a> ';
		}
		$bottom_scroll=&$str;
	}

?>