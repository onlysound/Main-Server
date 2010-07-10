<?

	$other = new other($connect->get_connection());
	if(isset($input['ss']) and ($pattern = check_text($input['ss']))){
	
	    $rows_rep_page=20;
		$show_pages=10;
	
	    if(isset($input['from']) and is_numeric($input['from'])){	    	$from=$input['from'];
	    	$from=floor($from / $rows_rep_page);
	    	$from=$from*$rows_rep_page;	    }else $from = 0;
	
		if(strlen($pattern)==1) $pattern = $pattern."%";
	    else $pattern = "%".$pattern."%";
	
		$total = $other->search_performer_count($pattern);
		if($from>$total or $total<0) $from=0;
	
	  	$result = $other->search_performer($pattern,$from);
		if(!$result){
			$print_table_to_page='emtpy -> '.$other->get_status();    //pustoj rezultat
		}else{	
	 		for($i=0;$i<count($result);$i++){
				$result[$i]['pname']='<a href="/show.php?pp=perf&perf='.$result[$i]['pid'].'">'.$result[$i]['pname'].'</a>';
			}
			$print_table_to_page= table($result)."<br><br>";
	
			$num = ceil($total  / $rows_rep_page);
	
			$start_count = floor($from / ($rows_rep_page*$show_pages));
			$pages_left = $num - $start_count*$show_pages;
	
			if($start_count>0){				$bottom_string.='<a href="/search.php?type='.$input['type'].'&from='.(($start_count-1)*$rows_rep_page*$show_pages).'&ss='.$input['ss'].'"> <- </a> ';			}
	
	
	        if($pages_left>$show_pages){	        	$count_till=$show_pages;
	        	$print=1;	        }else{	        	$count_till=$pages_left;	        	$print=0;	        }
	
			for($i=0;$i<$count_till;$i++){
				$bottom_string.='<a href="/search.php?type='.$input['type'].'&from='.($start_count*$rows_rep_page*$show_pages+$i*$rows_rep_page).'&ss='.$input['ss'].'">'.($show_pages*$start_count+$i+1).'</a> ';
			}
			if($print) $bottom_string.='<a href="/search.php?type='.$input['type'].'&from='.(($start_count+1)*$rows_rep_page*$show_pages).'&ss='.$input['ss'].'"> -> </a> ';
		}
	}

?>