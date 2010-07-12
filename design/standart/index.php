<?php
if(isset($_SESSION['ID']) AND is_numeric($_SESSION['ID'])){//zaloginen
  $login_place='
	<table width="100%" border="1">
		<tr>
			You entered as :'.$name_show.'<br>
			<a href="logout.php">'.$text['login_field']['logout'].'</a>
		</tr>
	</table>';

 $menu_to_show='
	<ul>
		<li><a href="songs.php">Songs</a></li>
		<li><a href="upload.php">Upload</a></li>
		<li><a href="playlist.php?action=show">Playlists</a></li>
		<li><a href="profile.php">My info</a></li>		
		<li><a href="show.php?pp=conf">Configuration</a></li>
	</ul>
';

}else{//nezaloginen
 $login_place='<form action="login.php" method="POST">
               <table width="100%" border="1">
                  <tr>
                    <td>'.$text['login_field']['login'].'</td>
                    <td><input type="text" name="mail" size="25" maxlength="25" /></td>
       </tr>
                  <tr>
                    <td>'.$text['login_field']['pass'].'</td>
                    <td><input type="password" name="pass" size="25" maxlength="25" /></td>
       </tr>
                  <tr height="22">
                    <td><a href="reg.php">'.$text['login_field']['reg'].'</td>
                    <td><input type="submit" value="'.$text['login_field']['enter'].'"/></td>
       </tr>
      </table>
     </form>';
$menu_to_show='
			<ul>
			     <li><a href="reg.php?action=login">'.$text['login_field']['login'].'</a></li>
                 <li><a href="reg.php">'.$text['login_field']['reg'].'</a></li>
			</ul>';
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=cp1251">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title><?echo $title;?></title>
    <link type="text/css" href="/css/index.css" rel="stylesheet">

<?php if($modul_to_load=='show_songs'){
 echo $show_song_js;
 unset($show_song_js);
}
if(isset($load_add_function) and $load_add_function==1){
  echo $main_functions_js;
  unset($main_functions_js);
 }
 ?>

</head>
<body>


<div id="container">
	<div id="header">
           <div width="200" id="MainLogo"><a href=""><? echo $logo;unset($logo);?></a></div>
           <div id="LoginMenu"><? echo $login_place;unset($login_place);?></div>
           <div id="Banner"><? echo $baner;unset($baner);?></div>
	</div>
	<div id="navigation">
		<ul>
			<li><a href='search.php?type=song'><? echo $text['menu']['search']['song'];?></a></li>
			<li><a href='search.php?type=perf'><? echo $text['menu']['search']['performer'];?></a></li>
<?php 
if(isset($_SESSION['ID']) AND is_numeric($_SESSION['ID']))echo "
			<li><a href='search.php?type=user'>".$text['menu']['search']['user']."</a></li>";
?>
		</ul>
	</div>
	<div id="content-container">
		<div id="section-navigation">
			<div id="MainMenu"><? echo $menu_to_show;unset($menu_to_show)?></div>
		</div>
        <div id="content">
    		<?include($module_dezign);?>
        </div>
        <div id="footer">
           Only Sound Project 2010
        </div>
	</div>
</div>
</body>
</html>

