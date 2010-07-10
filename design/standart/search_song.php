<table>
<form action="" method="GET">
<tr>
	<td><? echo $text['search']['perf_name'];?></td>
	<td><input type="text" name="pp" <? if(isset($input['pp']))echo 'value="'.$input['pp'].'"';?> size="50" maxlength="255" /></td><td></td>
</tr>
<tr>
	<td><? echo $text['search']['song_name'];?></td>
	<td><input type="text" name="ss" <? if(isset($input['ss']))echo 'value="'.$input['ss'].'"';?> size="50" maxlength="255" /><input type="hidden" name="type" value="<? echo $input['type'];?>" /></td><td><input type="submit" value="<? echo $text['search']['search_button'];?>" size="25" maxlength="25" /></td>
</tr>
</form>

</table>
<br><br>
<?
	echo  $totally_found;
	echo $table_to_print;
	echo $str;
?>