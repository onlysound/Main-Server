<?

	$other = new other($connect->get_connection());
	
	$countries=$other->select_countries();
	$total_counties=count($other->select_countries('MORE'));
	$count_counties=count($countries);
	$langs=$other->select_languages();
	$total_langs=count($other->select_languages('MORE'));
	$count_langs=count($langs);
	
	if((isset($input['user_name']) AND $input['user_name']!='')
	or (isset($input['user_f_name']) AND $input['user_f_name']!='')
	or (isset($input['user_nick']) AND $input['user_nick']!='')
	or (isset($input['age1']) AND isset($input['age2']) AND is_numeric($input['age1']) AND is_numeric($input['age2']) AND $input['age1']>10 AND $input['age1'] <100 AND $input['age2']>10 AND $input['age2']<100)
	or (isset($input['sex']) AND ($input['sex']==0 OR $input['sex']==1))
	or (isset($input['user_city']) AND $input['user_city']!='')
	or (isset($input['user_country']) AND is_numeric('user_country'))
	or (isset($input['user_lang']) AND is_numeric('user_lang'))){	
	     $result=$other->search_user($input);
	     if(!$result){	     	if($other->get_status()=='EMPTY'){
		    	$print_table_to_page=$text['search']['empty'];
		    }	     }else{	     	for($i=0;$i<count($result);$i++){		     	$result[$i]['name']="<a href='show.php?pp=info&uu=".$result[$i]['id']."'>".$result[$i]['name']."</a>";
		     	if($result[$i]['avatar']=='0')$result[$i]['avatar']='empty.jpg';
				$result[$i]['avatar']="<img src='../../pics_small/".$result[$i]['avatar']."'>";		     }
		     $print_table_to_page=table($result);	     }
	     
		$options_COUNTRY='';
		for($i=0;$i<$count_counties;$i++){
			if($countries[$i]['id']==$info['country_id']){
				$options_COUNTRY.='<option value="'.$countries[$i]['id'].'" selected="yes">'.$countries[$i]['country'].'</option>';
			}else{
				$options_COUNTRY.='<option value="'.$countries[$i]['id'].'">'.$countries[$i]['country'].'</option>';
			}
		}
					 
		$options_LANG='';
		for($i=0;$i<$count_langs;$i++){
			if($langs[$i]['id']==$info['lang_id']){$options_LANG.='<option value="'.$langs[$i]['id'].'" selected="yes">'.$langs[$i]['lang'].'</option>';}
			else{$options_LANG.='<option value="'.$langs[$i]['id'].'">'.$langs[$i]['lang'].'</option>';}
		}	}

?>