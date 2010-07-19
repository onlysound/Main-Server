<?
//zagruzka tolko nuznqh v dannqi moment otrqvkov
$text['title']['title']='Only Sound';
$text['title']['separator']=' :: ';
$text['title']['registration']='New User';
$text['title']['add']='Sucessfull';
$text['title']['activate']['sucecc']='Sucessfully activated';
$text['title']['activate']['fail']='Activation failed';
$text['title']['registation']='Sucessfully registered';
$text['title']['index']='Int';
$text['title']['upload']='Upload';
$text['title']['songs']='All Songs';
$text['title']['user_info']='Info';
$text['title']['my_info']='My Info';
$text['title']['config']='Profile Configurations';
$text['title']['avatar']='Avatar Page';
$text['title']['playlist']='PlayList';
$text['title']['search']='Search';
$text['title']['profile']='Profile';

$text['menu']['search']['name']='Search:';
$text['menu']['search']['user']='User';
$text['menu']['search']['song']='Songs';
$text['menu']['search']['performer']='Performer';

$text['sex'][0]='Sex';
$text['sex']["male"]='Male';
$text['sex']["female"]='Female';
$text['sex']['both']="Both";

if($modul_to_load=='show_info_perf'){
  $text['perf']['not_exist']="Performer not exist";
  $text['perf']['id']="Please check performer id.";
}

if($modul_to_load=='playlist_create' OR
   $modul_to_load=='playlist_delete' OR
   $modul_to_load=='playlist_show' OR
   $modul_to_load=='playlist_song_add' ){
  $text['playlist']['new']='Create';
  $text['playlist']['name']='Playlist Title';
  $text['playlist']['desc']='Description';
  $text['playlist']['options']['open']='Open';
  $text['playlist']['options']['close']='Close';
  $text['playlist']['empty']='Sorry. This list is empty.';
  $text['playlist']['create']['to_create']='Create new playlist.';
  $text['playlist']['create']['succes']='List created succesfully.';
  $text['playlist']['create']['list_max']='You have a maximum playlists number.';
  $text['playlist']['create']['list_exist']='This list is already exist';
  $text['playlist']['delete']='Delete Playlist';
  $text['playlist']['no_row']='No playlist found. Create at least one first.';
  $text['playlist']['user_no_row']='Seems that this user didnt create at Playlist yet.';
}

$text['month'][0]='Januar';
$text['month'][1]='Februar';
$text['month'][2]='Martch';
$text['month'][3]='April';
$text['month'][4]='May';
$text['month'][5]='June';
$text['month'][6]='Jule';
$text['month'][7]='August';
$text['month'][8]='September';
$text['month'][9]='October';
$text['month'][10]='November';
$text['month'][11]='Decamber';

$text['info']['name']='Name';
$text['info']['f_name']='Family name';
$text['info']['mail']='Email';
$text['info']['nick']='Nick Name';
$text['info']['age']='Age';
$text['info']['city']='Town';
$text['info']['tegs']='Tegs';

if(false){
  $text['messages']['receive']='Received';
  $text['messages']['sended']='Sended';
  $text['messages']['send']='Send';
  $text['messages']['no_mes']='there is no message 4 U.';
  $text['messages']['not_sended']='Not Sended';
  $text['messages']['new']='Create New';
  $text['messages']['button']['send']='send';
  $text['messages']['button']['set']='set';
  $text['messages']['deleted']='Delete';
  $text['messages']['repeat']='Please do not peret yourprevious message';
  $text['messages']['wrong_from_to']='You entered a wronf value for from to';
  $text['messages']['sended_success']='Sended sussessfully';
  $text['messages']['deleted_success']='Deleted sussessfully';
  $text['messages']['select_id']='Please select id';
  $text['messages']['wrong_mes']='There is no such message';
  $text['messages']['wrong_mes_stat']='Something wrong with status of massage';
  $text['messages']['sended']='Sended su';
}

$text['login_field']['login']='Login';
$text['login_field']['logout']='Logout';
$text['login_field']['pass']='Pass';
$text['login_field']['reg']='Register';
$text['login_field']['enter']='Enter';

if($modul_to_load=='reg' ){
  $text['register']['pass']='Password';
  $text['register']['pass_2']='Pasword 2';
  $text['register']['bd'][0]='Date of Birth';
  $text['register']['bd']['day']='Chose day';
  $text['register']['bd']['month']='Chose month';
  $text['register']['bd']['year']='Chose Year';
  $text['register']['quest']='Question';
  $text['register']['ans']='Answer';
  $text['register']['reset']='Reset';
  $text['register']['send']='Send';
  $text['register']['success']='Added Successfully.<br>Go to your mail and activate your acc<br><a href="http://'.$_SERVER['SERVER_NAME'].'">Main Page</a>';
}

if($modul_to_load=='search_user' OR
   $modul_to_load=='search_song' OR
   $modul_to_load=='search_perf' OR
   $modul_to_load=='show_song_info' ){
  $text['search']['search_button']='Search';
  $text['search']['empty']='Nothing Found.';
  $text['search']['totaly']='Totaly Found: ';
  $text['search']['perf_name']='Performer: ';
  $text['search']['song_name']='Song: ';
  $text['search']['event_type']='Chose event type';
  $text['search']['event_cost']='Chose event price';
}

if($modul_to_load=='search_user' OR
   $modul_to_load=='show_config' ){
  $text['config']['name']='Name';
  $text['config']['second']='Second';
  $text['config']['nick']='Nick';
  $text['config']['confirm']='Change';
  $text['config']['age']='Age';
  $text['config']['country']='Country';
  $text['config']['lang']='Language';
}

if($modul_to_load=='activate' ){
  $text['activate']['success']='Activated Successfully';
  $text['activate']['code_err']='Wrong cod for your activation. plese chek in again.';
  $text['activate']['no_id']='Sorry but we cant find your id';
  $text['activate']['activated']='Already activated';
  $text['activate']['id_not_int']='Something wrong with your id number.';
  $text['activate']['db_err']='Cant connect to db. sorry';
  $text['activate']['connect_err']='Cont connect anywhere.sorry.';
  $text['activate']['act_timeout']='Time to activate account has passed.';
}

if($modul_to_load=='add' ){
  $text['add']['sucess']='Added Sucessfully.<br>Please Follow the instructions in your Email latter.<br> <a href="http://'.$_SERVER['SERVER_NAME'].'">Main Page</a>';
  $text['add']['fail']='Surry. Registation Fail.';
  $text['add']['massage']['begin']='Thanks for registration at '.$_SERVER['SERVER_NAME'].'!<br>
  Please follow that link to activate your account ';
  $text['add']['massage']['end']=' <br>Kind regards.';
  $text['add']['message']['header']='Welcome to '.$_SERVER['SERVER_NAME'];
}

$text['error']['type']='Sorry. But there is somethin wrong with your type.....';
$text['error']['search']='Wrong search type.';
$text['error']['loged_only']='This function is available only for loged uzser.';
$text['error']['user_only']='';
$text['error']['org_only']='';
$text['error']['org_pri_only']='';
$text['error']['admin_only']='';
$text['error']['friend_only']='';
$text['error']['member_only']='';
$text['error']['wrong_polu4']='sorry.  we cant find adresser for this email.';
$text['error']['wrong_stat']='You entered wrong status';
$text['error']['same_id']='You cant send mail to your self.';
$text['error']['wrong_title']='Something wrong with title you entered';
$text['error']['wrong_text']='Something wrong with text you entered';
$text['error']['not_active']='Please activate your accout first';
$text['error']['pass_err']='Wrong pass';
$text['error']['mail_set']='Something wrong with your email';
$text['error']['mail_len']='To short email';
$text['error']['mail_sumb']='Email contains wrong sumbols';
$text['error']['pass_len']='to short pass';
$text['error']['pass_sumb']='passs word conatins wrong sumblos';
$text['error']['no_mail']='there is no suck email in our database';
$text['error']['no_config']='Something wrong with your account. Please contact one of our managers. your error kod is 1045';
$text['error']['connect_err']='Cant connect to database. Please contact one of our managers. your error kod is 1047';
$text['error']['db_err']='catn chose database.Please contact one of our managers. your error kod is 1046';
$text['error']['wrong_action']='You entered a wrong action. please chek it maza faka...';
$text['error']['wrong_message_dir']='Sorry. But there is no such directory.';
$text['error']['wrong_message_id']='Sorry. Something wrong with message id.';

?>