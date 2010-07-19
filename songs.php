<?

if(count($_GET))$input=&$_GET;
if(count($_POST))
{
  foreach($_POST as $key => $value)
  {
    $input[$key]=&$_POST[$key];
  }
}
if(isset($_GET['action']) or isset($_POST['action']))
{
  session_start();
  include_once 'classes/functions.php';
  switch($input['action'])
  {
    case 'info':
      if(isset($input['ss']) and is_numeric($input['ss']))
      {
        include_once('classes/session_lang.php');
        include_once ('classes/connect.php');
        $connect =  new connector();

        if($connect->get_status()!='SERVER_CONECTION_ERR')
        {
          if($connect->get_status()!='DB_SELECT_ERR')
          {
              include_once('classes/song.php');
              include_once('modules/show_song_info.php');
          }
        }
        exit();
      }

      break;
    case 'delete':
      if(isset($input['ss']) and is_numeric($input['ss']))
      {
        include_once('classes/session_lang.php');
        include_once ('classes/connect.php');
        $connect =  new connector();

        if($connect->get_status()!='SERVER_CONECTION_ERR')
        {
          if($connect->get_status()!='DB_SELECT_ERR')
          {
            $passed=true;
            include_once ('classes/playlist.php');
               include_once('modules/song_delete.php');
          }
        }
        exit();
      }
      break;
    default:
      $module='error';
      $error_to_write =& $text['error']['search'];
  }
}

  $page_name =& $text['title']['user_info'];
  $modul_to_load='show_songs';
  include_once('header.php');

?>