<?

 //o6qbki
	/*errs[]
	NAME_SET    	- nepravilno vvedennoe imja
	NAME_LEN 		- nevernaja dlinna imeni
	NAME_SUMB 		- nevernqi nabor simvolov v imeni
	F_NAME_SET 		- nepravilno vvedennoe familija
	F_NAME_LEN 		- nevernaja dlinna familii
	F_NAME_SUMB 	- nevernqi nabor simvolov v familii
	SEX				- nevernqi sex uzera
	MAIL_SET		- nepravilnqi vvedennqi mail
	MAIL_LEN		- nevernaja dlinna emaila
	MAIL_SUMB		- nevernqi nabor simvolov v emaile
	PASS_SET    	- nepravilno vvedennoe pass
	PASS_LEN 		- nevernaja dlinna passa
	PASS_SUMB 		- nevernqi nabor simvolov v passe
	BD_SET			- data vvedena neverno
	BD_DATE			- takogo dnja v kalendare netu
	QUEST_SET    	- nepravilno vvedennoe vopros
	QUEST_LEN 		- nevernaja dlinna qoprosa
	QUEST_SUMB 		- nevernqi nabor simvolov v voprose
	ANS_SET    		- nepravilno vvedennoe vopros
	ANS_LEN 		- nevernaja dlinna otveta
	ANS_SUMB 		- nevernqi nabor simvolov v otvete

	MAIL_RET		- povtor maila, takoi uze est
	NO_MAIL			- takoi mail ne naiden(ne dobavilsja)
	USER_ID_RET		- povtor uzerovskogo id(4udo)
	CONF_ID_RET		- povtor configskogo id(4udo)
	ACTIV_ERR 		- o6qbka sozdanija activacii
	INSERT_ERR 		- o6qbka o6qbka vstavki

	CONNECT_ERR 	- o6qbka podklju4enija
	DB_ERR 			- o6qbka vqbora bazq dannqh



if(isset($input['errs'])){

	var_dump($input['errs']);
}

if (isset($input['action']) and $input['action']=="login"){
	echo '<form action="login.php" method="POST">
	            			<table width="200" border="1">
	              				<tr>
	                				<td width="50">'.$text['login_field']['login'].'</td>
	                				<td><input type="text" name="mail" size="25" maxlength="25" /></td>
								</tr>
	              				<tr>
	                				<td width="50">'.$text['login_field']['pass'].'</td>
	                				<td><input type="password" name="pass" size="25" maxlength="25" /></td>
								</tr>
	              				<tr height="22">
	                				<td width="50"><a href="reg.php">'.$text['login_field']['reg'].'</td>
	                				<td><input type="submit" value="'.$text['login_field']['enter'].'"/></td>
								</tr>
							</table>
						</form>';
	exit();}
?>

<form action="add.php" method="POST">
	<table>
		<tr>
			<td><?echo $text['info']['name'];?></td>
			<td><input type="text" name='name'  align="LEFT" size="25" maxlength="100" /></td>
		</tr>
		<tr>
			<td><?echo $text['info']['f_name'];?></td>
			<td><input type="text" name='f_name'  align="LEFT" size="25" maxlength="100" /></td>
		</tr>

		<tr>
			<td><?echo $text['info']['mail'];?></td>
			<td><input type="text" name='mail'  align="LEFT" size="25" maxlength="100" /></td>
		</tr>
		<tr>
			<td><?echo $text['register']['pass'];?></td>
			<td><input type="password" name="pass" align="LEFT" size="25" maxlength="25" /></td>
		</tr>
		<tr>
			<td><?echo $text['register']['pass_2'];?></td>
			<td><input type="password" name="pass_2" align="LEFT" size="25" maxlength="25" /></td>
		</tr>
		<tr>

		<tr>
			<td><?echo $text['sex'][0];?></td>
			<td><input type="radio" name="sex" value="true" checked="checked" /><?echo $text['sex']['male'];?><br>
				<input type="radio" name="sex" value="false" ><?echo $text['sex']['female'];?></td>
		</tr>
		<tr>
			<td><?echo $text['register']['bd'][0];?></td>
			<td>
				<select size="1" height="0" name="day">
					<option value="0"><?echo $text['register']['bd']['day'];?></option>
					<?
						for($i=1;$i<=31;$i++) echo '<option value="'.$i.'">'.$i.'</option>';
					?>
				</select>
				<select size="1" height="1" name="month">
					<option value="0"><?echo $text['register']['bd']['month'];?></option>
					<?
					for($i=0;$i<12;$i++) echo '<option value="'.$i.'">'.$text['month'][$i].'</option>';
					?>
				</select>
				<select size="1" height="1" name="year">
					<option value="0"><?echo $text['register']['bd']['year'];?></option>
					<?
						for($i=1901;$i<=2000;$i++) echo '<option value="'.$i.'">'.$i.'</option>';
					?>
				</select>

			</td>
		</tr>
			<td><?echo $text['register']['quest'];?></td>
			<td><input type="text" name="quest" align="LEFT" size="25"/></td>
		</tr>
		<tr>
			<td><?echo $text['register']['ans'];?></td>
			<td><input type="text" name="ans" align="LEFT" size="25" maxlength="50" /></td>
		</tr>
		<tr>
			<td><input type="reset" value="<?echo $text['register']['reset'];?>"/></td>
			<td><input type="submit" value="<?echo $text['register']['send'];?>"/></td>
		</tr>
	</table>
</form> */?>