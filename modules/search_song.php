<?

	$other = new other($connect->get_connection());
	$song_text=false;
	$perf_text=false;
	if(isset($input['ss']) and (check_text($input['ss']))) $song_text=true;
	if(isset($input['pp']) and (check_text($input['pp']))) $perf_text=true;
	if($song_text or $perf_text or $perf_num_text){
	
	    $rows_rep_page=20;
		$show_pages=10;
	
	    if(isset($input['from']) and is_numeric($input['from'])){
	    	$from=$input['from'];
	    	$from=floor($from / $rows_rep_page);
	    	$from=$from*$rows_rep_page;
	    }else $from = 0;
	
		$pattern="";
	
		if($song_text){
	    	$pattern.="`songs_info`.`name` like '%".$input['ss']."%'";
	    }
	    if($perf_text and $song_text){	    	$pattern.=" AND ";	    }
	    if($perf_text){	    	$pattern.="`performer`.`name` LIKE '%".$input['pp']."%'";	    }
	
		$total = $other->search_song_count($pattern);
		if($from>$total or $total<0) $from=0;
	
	  	$result = $other->search_song($pattern,$from);
		if(!$result){
			if($other->get_status()=='EMPTY'){
		    	 $str=&$text['search']['empty'];
		    }
		}else{
	
			for($i=0;$i<count($result);$i++){
				$result[$i]['pname']='<a href="/show.php?pp=perf&perf='.$result[$i]['pid'].'">'.$result[$i]['pname'].'</a>';
				//$result[$i]['sname']='<a href="/songs.php?action=info&ss='.$result[$i]['sid'].'">'.$result[$i]['sname'].'</a>';
				$result[$i]['sname']='<a href="javascript:add('.$result[$i]['sid'].');">'.$result[$i]['sname'].'</a>';
			}
	        $totally_found=&$text['search']['totaly'].$total;
			$table_to_print=table($result)."<br><br>";
	
			$num = ceil($total  / $rows_rep_page);
	
			$start_count = floor($from / ($rows_rep_page*$show_pages));
			$pages_left = $num - $start_count*$show_pages;
	        $str="";
			if($start_count>0){
				$str.='<a href="/search.php?type='.$input['type'].'&from='.(($start_count-1)*$rows_rep_page*$show_pages);
	
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
				$str.='<a href="/search.php?type='.$input['type'].'&from='.($start_count*$rows_rep_page*$show_pages+$i*$rows_rep_page);
	
				if($song_text){
	    			$str.='&ss='.$input['ss'];
	    		}
			    if($perf_text){
			    	$str.='&pp='.$input['pp'];
			    }
			    $str.='">'.($show_pages*$start_count+$i+1).'</a> ';
			}
			if($print){				$str.='<a href="/search.php?type='.$input['type'].'&from='.(($start_count+1)*$rows_rep_page*$show_pages);
	
				if($song_text){
	    			$str.='&ss='.$input['ss'];
	    		}
			    if($perf_text){
			    	$str.='&pp='.$input['pp'];
			    }
			    $str.='"> >> </a> ';			}
		}
	}

?>