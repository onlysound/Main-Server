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
<table width=500>
	<tr>
		<td width=100>avtor</td>
		<td><?echo get_name($message_header['avtor']);?></td>
	</tr>
	<tr>
		<td>polu4atel</td>
		<td><?echo get_name($message_header['polu4atel']);?></td>
	</tr>
	<tr>
		<td>data</td>
		<td><?echo $message_header['date'];?></td>
	</tr>
	<tr>
		<td>Dremja</td>
		<td><?echo $message_header['time'];?></td>
	</tr>
	<tr>
		<td>nazvanie</td>
		<td><?echo $message_header['title'];?></td>
	</tr>
	<tr>
		<td colspan=2 height=300><?echo $message_header['text'];?></td>
	</tr>
</table>