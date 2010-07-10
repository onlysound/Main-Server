<?
if(!isset($_SESSION['ID'])){	exit('0');}

$pl = new song($connect->get_connection());
$song_text=false;
if(isset($input['ss']) and (is_numeric($input['ss']))){
	$song_id=$input['ss'];
	$song_text=true;
}

if($song_text){
    $rows_rep_page=10;
	$show_pages=10;

    if(isset($input['from']) and is_numeric($input['from'])){
    	$from=$input['from'];
    	$from=floor($from / $rows_rep_page);
    	$from=$from*$rows_rep_page;
    }else $from = 0;
    //----------------------
	$total = $pl->count_clones($song_id);
	if($from>$total or $total<0) $from=0;

	if(isset($input['type']) and $input['type']=='full'){		$full='lite';
		$type_text='Lite';		$result = $pl->select_clones($song_id,$from,'MORE');	}else{
		$full='full';
		$type_text='Full';		$result = $pl->select_clones($song_id,$from);	}
  	//------------------------------
	if(!$result){
		if($pl->get_status()=='EMPTY_LIST'){
	    	echo $text['search']['empty'];
	    }
	}else{

		for($i=0;$i<count($result);$i++){			$min=floor($result[$i]['len']/60);
			if(strlen($min)==1)$min='0'.$min;
			$sec=$result[$i]['len']-$min*60;
			if(strlen($sec)==1)$sec='0'.$sec;
			$result[$i]['len']=$min.':'.$sec;
			if(isset($result[$i]['bitr']))$result[$i]['bitr'].=' kbps';
			$result[$i]['pname']='<a href="/show.php?pp=perf&perf='.$result[$i]['pid'].'">'.$result[$i]['pname'].'</a>';
			$result[$i]['add']='<a href="/playlist.php?action=add&ss='.$result[$i]['user_sid'].'"> ADD </a>';
		}
        echo $text['search']['totaly'].$total;

        $type_out.='     <a href="/songs.php?action='.$input['action'].'&type='.$full.'&from='.$from;

			if($song_text){
    			$type_out.='&ss='.$input['ss'];
    		}

		$type_out.='"> '.$type_text.' text </a> ';

		echo $type_out;

		echo table($result)."<br><br>";

		$num = ceil($total  / $rows_rep_page);

		$start_count = floor($from / ($rows_rep_page*$show_pages));
		$pages_left = $num - $start_count*$show_pages;
        $str="";
		if($start_count>0){
			$str.='<a href="/songs.php?from='.(($start_count-1)*$rows_rep_page*$show_pages);

			if($song_text){
    			$str.='&ss='.$input['ss'];
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

		    $str.='">'.($show_pages*$start_count+$i+1).'</a> ';
		}
		if($print){
			$str.='<a href="/songs.php?from='.(($start_count+1)*$rows_rep_page*$show_pages);

			if($song_text){
    			$str.='&ss='.$input['ss'];
    		}

		    $str.='"> >> </a> ';
		}
		echo $str;
	}}else{	echo 'error';}


?>