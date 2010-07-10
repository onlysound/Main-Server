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
<?echo $text['config']['age'];?>
<table>
	<form action="" method="GET">
	<tr>
		<td>
			<input type="hidden" name="pp" value="<? echo $input['pp'];?>" />
		<select size="1" height="0" name="day">
			<option value="0"><?echo $text['register']['bd']['day'];?></option>
			<?
				echo $options_DAYS;
				UNSET($options_DAYS);
			?>
		</select>
		<select size="1" height="1" name="month">
			<option value="0"><?echo $text['register']['bd']['month'];?></option>
			<?
				echo $options_MONTH;
				UNSET($options_MONTH);

			?>
		</select>
		<select size="1" height="1" name="year">
			<option value="0"><?echo $text['register']['bd']['year'];?></option>
			<?
				echo $options_YEARS;
				UNSET($options_YEARS);
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
				echo $options_COUNTRYS;
				UNSET($options_COUNTRYS);
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
				echo $options_LANGS;
				UNSET($options_LANGS);
			?>
		</select>
		<input type="hidden" name="pp" value="<? echo $input['pp'];?>" /></td><td><input type="submit" value="<? echo $text['config']['confirm'];?>" size="25" maxlength="25" /></td>
	</tr>
	</form>
</table>
<br/><br/>
