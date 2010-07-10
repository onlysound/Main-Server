<?
if($loged){//zaloginen
	 $login_place='
						<table width="100%" border="1">
              				<tr>
              					vq vo6li kak:'.$name_show.'<br>
                				<a href="logout.php">'.$text['login_field']['logout'].'</a>
							</tr>
						</table>';

	$menu_to_show='
	            		<table width="100%" border="1">
              				<tr>
                				<td><a href="songs.php">Songs</a></td>
                			</tr>
                			<tr>
                				<td><a href="upload.php">Upload</a></td>
                			</tr>
              				<tr>
                				<td><a href="playlist.php?action=show">Playlists</a></td>
							</tr>
							<tr>
                				<td><a href="show.php?pp=info">My info</a></td>
							</tr>
							<tr>
                				<td><a href="show.php?pp=conf">Configuration</a></td>
							</tr>
						</table>
';

}else{//nezaloginen
 $login_place='<form action="login.php" method="POST">
            			<table width="100%" border="1">
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
$menu_to_show='
	            		<table width="100%" border="1">
              				<tr>
                				<td><a href="reg.php?action=login">'.$text['login_field']['login'].'</a></td>
              				<tr>
                				<td><a href="reg.php">'.$text['login_field']['reg'].'</a></td>
							</tr>
						</table>';
}
?>

<html>
<head>
  	<title><?echo $title;?></title>
	<link type="text/css" href="/css/main_1.css" rel="stylesheet">

<?if($modul_to_load=='show_songs'){	echo $show_song_js;}
if(isset($load_add_function) and $load_add_function==1){
 	echo $main_functions_js;
 }
 ?>

</head>
<body bgcolor="0000ff"><center>
<table width="80%">
	<tr>
	   	<td colspan="2">

		   	<table border="1" width="100%" height="67">
  			   	<tr>
     				<td width="89">
					<a href=""><? echo $logo;?></a></td>
     				<td width="253">
					 <? echo $login_place;?>
					</td>
     				<td><? echo $baner?></td>
  				</tr>
			</table>

		</td>
    </tr>
	<tr>
	   	<td width="10%" valign="top">
      		<table width="100%" border="1" >
        		<tr>
          			<td><? echo $menu_to_show;?>
		  			</td>
		 		</tr>
        		<tr>
          			<td>
		  				<table width="100%" border="1">
              				<tr>
                				<td><strong><? echo $text['menu']['search']['name'];?></strong></td>
							</tr>
							<tr>
								<td><a href='search.php?type=user'><? echo $text['menu']['search']['user'];?></a></td>
							</tr>
							<tr>
								<td><a href='search.php?type=song'><? echo $text['menu']['search']['song'];?></a></td>
							</tr>
							<tr>
								<td><a href='search.php?type=perf'><? echo $text['menu']['search']['performer'];?></a></td>
							</tr>

						</table>
		  			</td>
				</tr>

	  		</table>
		</TD>
		<td align='center'><?include($module_dezign);?></td>
	</TR>
	<tr valign="top">
	   	<td colspan="2">Belqi Durak GROUP 2008</td>
	</tr>
</TABLE>
</body>
</html>

