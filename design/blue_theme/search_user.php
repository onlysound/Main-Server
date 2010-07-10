
<?echo $print_table_to_page;?>


<table>
<form action="" method="GET">
<tr>
	<td><? echo $text['info']['name'];?></td>
	<td><input type="text" name="user_name" size="25" maxlength="25" /></td>
</tr>
<tr>
	<td><? echo $text['info']['f_name'];?></td>
	<td><input type="text" name="user_f_name" size="25" maxlength="25" /></td>
</tr>
<tr>
	<td><? echo $text['info']['nick'];?></td>
	<td><input type="text" name="user_nick" size="25" maxlength="25" /></td>
</tr>
<tr>
	<td><? echo $text['info']['age'];?></td>
	<td>
	<select name="age1" size="1" height="1">
		<?
			for($i=18;$i<75;$i++) echo '<option value="'.$i.'">'.$i.'</option>';
		?>
	</select>-
	<select name="age2" size="1" height="1">
		<?
			for($i=18;$i<75;$i++) echo '<option value="'.$i.'">'.$i.'</option>';
		?>
	</select>
	</td>
</tr>
<tr>
	<td><? echo $text['sex'][0];?></td>
	<td><input type="radio" name="user_sex" value="2" checked="checked"/><? echo $text['sex']['both']?><br>
		<input type="radio" name="user_sex" value="0"/><? echo $text['sex']['male']?><br>
		<input type="radio" name="user_sex" value="1"/><? echo $text['sex']['female']?>
	</td>
</tr>
<tr>
		<td><?echo $text['config']['country'];?></td>
		<td>
		<select size="1" height="1" name="user_country">
			<option value="0">-------</option>
			<?
				$opt='';
				for($i=0;$i<$count_counties;$i++){
					if($countries[$i]['id']==$info['country_id']){						$opt.='<option value="'.$countries[$i]['id'].'" selected="yes">'.$countries[$i]['country'].'</option>';
					}else{						$opt.='<option value="'.$countries[$i]['id'].'">'.$countries[$i]['country'].'</option>';
					}
				}
				echo $opt;
			?>
		</select>
		</td>
</tr>
<tr>
	<td><? echo $text['info']['city'];?></td>
	<td><input type="text" name="user_city" size="25" maxlength="25" /></td>
</tr>
<tr>
		<td><?echo $text['config']['lang'];?></td>
		<td>
		<select size="1" height="1" name="user_lang">
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
		</td>
</tr>
<tr>
	<td></td>
	<td>
	<input type="hidden" name="type" value="<? echo $input['type'];?>" />
	<input type="submit" value="<? echo $text['search']['search_button'];?>" size="25" maxlength="25" />
	</td>
</tr>
</form>

</table>
