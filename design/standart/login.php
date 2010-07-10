<?
echo '
<form action="login.php" method="POST">
	<table width="300" border="1">
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
</form>
';
?>

