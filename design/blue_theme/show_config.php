<?
//echo 'test';
$connect= new connector();
$me = new user($_SESSION['ID'],session_id(),$connect->get_connection());
$other = new other($connect->get_connection());

$info=$me->select_my_info();
$countries=$other->select_countries();
$total_counties=count($other->select_countries('MORE'));
$count_counties=count($countries);
$langs=$other->select_languages();
$total_langs=count($other->select_languages('MORE'));
$count_langs=count($langs);

list($bd['year'],$bd['month'],$bd['day'])=explode('-',$info['dob']);

$name_isset=false;
if(isset($input['name']) and ($name=check_text($input['name']))) $name_isset=true;
$second_isset=false;
if(isset($input['second']) and ($second=check_text($input['second']))) $second_isset=true;
$nick_isset=false;
if(isset($input['nick']) and ($nick=check_text($input['nick']))) $nick_isset=true;
$day_isset=false;
if(isset($input['day']) and (is_numeric($input['day'])) and ($input['day']>0 and $input['day']<32)){	$day=$input['day'];
	$day_isset=true;}
$month_isset=false;
if(isset($input['month']) and (is_numeric($input['month'])) and ($input['month']>0 and $input['month']<13)){	$month=$input['month'];
	$month_isset=true;}
$year_isset=false;
if(isset($input['year']) and (is_numeric($input['year'])) and ($input['year']>1901 and $input['year']<2001)){	$year=$input['year'];
	$year_isset=true;}
$country_isset=false;
if(isset($input['country']) and (is_numeric($input['country'])) and ($input['country']>1 and $input['country']<$total_counties)){	$country=$input['country'];
	$country_isset=true;}
$lang_isset=false;
if(isset($input['lang']) and (is_numeric($input['lang'])) and ($input['lang']>1 and $input['lang']<$total_langs)){	$lang=$input['lang'];
	$lang_isset=true;}

if(!$info){
	//proverka po4emu

}else{
    if($name_isset){    	$info['name']=$name;
        $result=$me->change_name($name);    }
    if($second_isset){    	$info['second']=$second;    	$result=$me->change_second($second);    }
    if($nick_isset){    	$info['nick_name']=$nick;    	$result=$me->change_nick($nick);    }
    if($day_isset and $month_isset and $year_isset){    	$bd['year']=$year;
    	$bd['day']=$day;
    	$bd['month']=$month;    	$dob=$year."-".$month."-".$day;
    	echo $year."-".$month."-".$day;
    	$result=$me->change_dob($dob);    }
    if($country_isset){    	$info['country_id']=$country;    	$result=$me->change_country($country);    }
    if($lang_isset){    	$info['lang_id']=$lang;
    	echo "tut";    	$result=$me->change_lang($lang);    }

    if(!$result){    	echo $me->get_status();    }

}
?>
<br/><br/>
<? echo $text['config']['name'];?>
<table>
	<form action="" method="GET">
	<tr>
		<td><input type="text" name="name" <? if(isset($info['name']) and $info['name']!="" and $info['name']!='0')echo 'value="'.$info['name'].'"';?> size="50" maxlength="255" /><input type="hidden" name="pp" value="<? echo $input['pp'];?>" /></td><td><input type="submit" value="<? echo $text['config']['confirm'];?>" size="25" maxlength="25" /></td>
	</tr>
	</form>
</table>
<br/><br/>
<? echo $text['config']['second'];?>
<table>
	<form action="" method="GET">
	<tr>
		<td><input type="text" name="second" <? if(isset($info['second']) and $info['second']!="" and $info['second']!='0')echo 'value="'.$info['second'].'"';?> size="50" maxlength="255" /><input type="hidden" name="pp" value="<? echo $input['pp'];?>" /></td><td><input type="submit" value="<? echo $text['config']['confirm'];?>" size="25" maxlength="25" /></td>
	</tr>
	</form>
</table>
<br/><br/>
<? echo $text['config']['nick'];?>
<table>
	<form action="" method="GET">
	<tr>
		<td><input type="text" name="nick" <? if(isset($info['nick_name']) and $info['nick_name']!="" and $info['nick_name']!='0')echo 'value="'.$info['nick_name'].'"';?> size="50" maxlength="255" /><input type="hidden" name="pp" value="<? echo $input['pp'];?>" /></td><td><input type="submit" value="<? echo $text['config']['confirm'];?>" size="25" maxlength="25" /></td>
	</tr>
	</form>
</table>
<br/><br/>
<?echo $text['register']['bd'][0];?>
<table>
	<form action="" method="GET">
	<tr>
		<td>
			<input type="hidden" name="pp" value="<? echo $input['pp'];?>" />
		<select size="1" height="0" name="day">
			<option value="0"><?echo $text['register']['bd']['day'];?></option>
			<?
				$opt='';
				for($i=1;$i<=31;$i++){					if($i==$bd['day']){$opt.='<option value="'.$i.'" selected="yes">'.$i.'</option>';}
					else{$opt.='<option value="'.$i.'">'.$i.'</option>';}				}
				echo $opt;
			?>
		</select>
		<select size="1" height="1" name="month">
			<option value="0"><?echo $text['register']['bd']['month'];?></option>
			<?
				$opt='';
				for($i=1;$i<=12;$i++){					if($i==$bd['month']){$opt.='<option value="'.($i).'" selected="yes">'.$text['month'][$i-1].'</option>';}
					else{$opt.='<option value="'.$i.'">'.$text['month'][$i-1].'</option>';}				}
				echo $opt;
			?>
		</select>
		<select size="1" height="1" name="year">
			<option value="0"><?echo $text['register']['bd']['year'];?></option>
			<?
				$opt='';
				for($i=1998;$i>1930;$i--){					if($i==$bd['year']){$opt.='<option value="'.$i.'" selected="yes">'.$i.'</option>';}
					else{$opt.='<option value="'.$i.'">'.$i.'</option>';}				}
				echo $opt;
			?>
		</select>
		</td><td><input type="submit" value="<? echo $text['config']['confirm'];?>" size="25" maxlength="25" /></td>
	</tr>
	</form>
</table>
<br/><br/>
<?echo $text['config']['country'];?>
<table>
	<form action="" method="GET">
	<tr>
		<td>
		<select size="1" height="1" name="country">
			<option value="0">-------</option>
			<?
				$opt='';
				for($i=0;$i<$count_counties;$i++){
					if($countries[$i]['id']==$info['country_id']){$opt.='<option value="'.$countries[$i]['id'].'" selected="yes">'.$countries[$i]['country'].'</option>';}
					else{$opt.='<option value="'.$countries[$i]['id'].'">'.$countries[$i]['country'].'</option>';}
				}
				echo $opt;
			?>
		</select>
		<input type="hidden" name="pp" value="<? echo $input['pp'];?>" /></td><td><input type="submit" value="<? echo $text['config']['confirm'];?>" size="25" maxlength="25" /></td>
	</tr>
	</form>
</table>
<br/><br/>
<?echo $text['config']['lang'];?>
<table>
	<form action="" method="GET">
	<tr>
		<td>
		<select size="1" height="1" name="lang">
			<option value="0">-------</option>
			<?
				$opt='';
				for($i=0;$i<$count_langs;$i++){
					if($langs[$i]['id']==$info['lang_id']){$opt.='<option value="'.$langs[$i]['id'].'" selected="yes">'.$langs[$i]['lang'].'</option>';}
					else{$opt.='<option value="'.$langs[$i]['id'].'">'.$langs[$i]['lang'].'</option>';}
				}
				echo $opt;
			?>
		</select>
		<input type="hidden" name="pp" value="<? echo $input['pp'];?>" /></td><td><input type="submit" value="<? echo $text['config']['confirm'];?>" size="25" maxlength="25" /></td>
	</tr>
	</form>
</table>
<br/><br/>
