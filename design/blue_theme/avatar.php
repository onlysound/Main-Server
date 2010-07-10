<?
echo $info['avatar'];

    if(!$result){    	echo $me->get_status();    }
?>
  <table>
		<form action="" method="POST" enctype="multipart/form-data">
		<tr>
			<td>
				<input type="file" name="file" />
			</td>
			<td>
				<input type="hidden" name="pp" value="<?echo $input['pp'];?>" />
				<input type="hidden" name="ss" value="<?echo $input['ss'];?>" />
				<input type="submit" name="submit" value="Submit" />
			</td>
		</tr>
		</form>
	</table>
	<br/><br/>