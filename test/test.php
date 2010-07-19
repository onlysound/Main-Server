<?php
$mysql_host='SQL09.FREEMYSQL.NET';
$mysql_name='tunderhren';
$mysql_pass='T4bvkc021';
$mysql_db='onlysounddb';

$link = mysql_connect($mysql_host, $mysql_name, $mysql_pass);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
$db_selected = mysql_select_db($mysql_db, $link);
if (!$db_selected) {
    die ('Can\'t use foo : ' . mysql_error());
}else echo 'connected!';

$handle = file_get_contents("structure.sql");
mysql_query($handle);
echo mysql_error();

?>
