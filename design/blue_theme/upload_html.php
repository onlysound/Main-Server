<?
    echo $print_result;
?>
	<table>
		<form action="<?echo 'http://'.$available_host['adress'].'/upload.php';?>" method="POST" enctype="multipart/form-data">
		<tr>
			<td>
				<input type="file" name="file1" /><br>
				<input type="file" name="file2" /><br>
				<input type="file" name="file3" /><br>
			</td>
			<td>
				<input type="hidden" name="id" value="<? echo $_SESSION['ID'];?>" />
				<input type="hidden" name="type" value="h" />
				<input type="submit" name="submit" value="Submit" />
			</td>
		</tr>
		</form>
	</table>
	<br/><br/>