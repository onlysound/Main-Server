<?


//var_dump($message_header);

?>

<table>
	<tr>
		<td><a href="?type=geted"><?echo $text['messages']['receive'];?></a></td>
		<td><a href="?type=sended"><?echo $text['messages']['sended'];?></a></td>
		<td><a href="?type=not_sended"><?echo $text['messages']['not_sended'];?></a></td>
		<td><a href="?type=send"><?echo $text['messages']['new'];?></a></td>
	</tr>
</table>
<form action='<? echo $_SERVER['PHP_SELF']?>?type=send' method="GET">
<table width=500>
	<tr>
		<td width=100>Ot:</td>
		<td><?echo $client_name;?></td>
	</tr>
	<tr>
		<td>To</td>
		<td><input type="hidden" name="type" value="send" />
			<? echo $polu4atel;?></td>
	</tr>
	<tr>
		<td>nazvanie</td>
		<td><input type="text" name="title" size="50" maxlength="300" /></td>
	</tr>
	<tr>
		<td colspan=2 height=300><textarea name="mes" cols="60" rows="18" wrap="OFF"></textarea></td>
	</tr>
	<tr>
		<td colspan=2 height=30><input type="submit" name="action" value="<? echo $text['messages']['button']['send'];?>"/>
								<input type="submit" name="action" value="<? echo $text['messages']['button']['set'];?>" /></td>
	</tr>
</table>
</form>