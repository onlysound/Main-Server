<?

if($message_headers!='NO_MES'){
	$write_to=$text['messages']['deleted'];
	if($gettype=='sende')$write_to=$text['messages']['send'];
	
	for($i=0;$i<count($message_headers)-2 AND $i<$message_per_page;$i++){
		//echo $messages_headers[$i]['mes_id'].'sdffsd';
		
		$title='<a href="?type=read&mes_id='.$message_headers[$i]['mes_id'].'">'.$message_headers[$i]['title'].'</a>';
		
		if($message_headers[$i]['read']==0)$title='<strong>'.$title.'</strong>';
		
		$table.='
		
		<tr>
			<td>'.($i+1+$message_from).'</td>
			<td>'.get_name($message_headers[$i]['id']).'</td>
			<td>'.$message_headers[$i]['date'].'</td>
			<td>'.$message_headers[$i]['time'].'</td>
			<td>'.$title.'</td>
			<td><a href="messages.php?type='.$gettype.'&id='.$message_headers[$i]['mes_id'].'">'.$write_to.'</td>
		</tr>
		';
	}

	if($message_headers['num']>20){
		
		$pages=ceil($message_headers['num']/$message_per_page);
		
		for($i=0;$i<$pages;$i++)$print_page.='<a href="'.$link.'&from='.($i*$message_per_page).'&to='.($i*$message_per_page+$message_per_page).'">'.($i+1).'</a> ';
	}
}else{
$table='
<tr>
	<td colspan=6>'.$text['messages']['no_mes'].'</td>
</tr>';	
} 

?>

<table>
	<tr>
		<td><a href="?type=geted"><?echo $text['messages']['receive'];?></a></td>
		<td><a href="?type=sended"><?echo $text['messages']['sended'];?></a></td>
		<td><a href="?type=not_sended"><?echo $text['messages']['not_sended'];?></a></td>
		<td><a href="?type=send"><?echo $text['messages']['new'];?></a></td>
	</tr>
</table>

<table>
<tr>
	<td>¹</td>
	<td>Id</td>
	<td> date</td>
	<td> Vremja</td>
	<td>Zagolovok</td>
	<td>action</td>
</tr>
<?
echo $table;
?>
</table>
<?
echo $print_page;
?>