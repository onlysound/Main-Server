-- phpMyAdmin SQL Dump
-- version 3.2.2.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 12, 2010 at 05:25 PM
-- Server version: 5.1.41
-- PHP Version: 5.2.10-2ubuntu6.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `php_mx`
--

-- --------------------------------------------------------

--
-- Table structure for table `activation_info`
--

DROP TABLE IF EXISTS `activation_info`;
CREATE TABLE IF NOT EXISTS `activation_info` (
  `user_id` int(11) NOT NULL,
  `activation_code` char(32) NOT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

DROP TABLE IF EXISTS `album`;
CREATE TABLE IF NOT EXISTS `album` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id alboma.... unikalen\r\neto mogut zapolnjat tolko adminq\r\nili s utverzdenija adminov',
  `name` char(64) NOT NULL DEFAULT '' COMMENT 'nazvanie alboma',
  `year` date DEFAULT NULL COMMENT 'god vqhoda',
  `info` text COMMENT 'opisanie',
  `pic` char(64) DEFAULT NULL COMMENT 'kartinka alboma',
  `type` tinyint(1) NOT NULL COMMENT '0-imennoj\r\n1-sbornik',
  `song_num` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `year` (`year`),
  FULLTEXT KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 COMMENT='id alboma.... unikalen\r\neto mogut zapolnjat tolko adminq\r\nil' AUTO_INCREMENT=7032 ;

-- --------------------------------------------------------

--
-- Table structure for table `album_performer`
--

DROP TABLE IF EXISTS `album_performer`;
CREATE TABLE IF NOT EXISTS `album_performer` (
  `album` int(11) NOT NULL,
  `performer` int(11) NOT NULL,
  `song` int(11) NOT NULL,
  KEY `album` (`album`),
  KEY `performer` (`performer`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
CREATE TABLE IF NOT EXISTS `country` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `country` char(64) NOT NULL,
  `country_full` char(128) NOT NULL,
  `common` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'this field attempts to the records which are rare to request (0)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `average` (`common`,`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=192 ;

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

DROP TABLE IF EXISTS `forum`;
CREATE TABLE IF NOT EXISTS `forum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(255) NOT NULL,
  `author` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` int(11) DEFAULT '0' COMMENT 'komu dostupen forum 0-vsem',
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 COMMENT='zdes produmat sismtemu komu dostupen forum' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

DROP TABLE IF EXISTS `genre`;
CREATE TABLE IF NOT EXISTS `genre` (
  `id` int(11) NOT NULL,
  `genre` char(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Table structure for table `genre_performer`
--

DROP TABLE IF EXISTS `genre_performer`;
CREATE TABLE IF NOT EXISTS `genre_performer` (
  `performer` int(11) NOT NULL,
  `genre` int(11) NOT NULL,
  PRIMARY KEY (`performer`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Table structure for table `host`
--

DROP TABLE IF EXISTS `host`;
CREATE TABLE IF NOT EXISTS `host` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `server_name` char(32) DEFAULT NULL,
  `server_address` char(16) DEFAULT NULL,
  `port` int(11) DEFAULT '80',
  `store_location` char(32) DEFAULT '/',
  `memory_left` int(11) NOT NULL DEFAULT '0',
  `songs_total` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `server_name` (`server_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `langs`
--

DROP TABLE IF EXISTS `langs`;
CREATE TABLE IF NOT EXISTS `langs` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `lang` char(64) NOT NULL DEFAULT '',
  `common` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'this field relates to extesity of this record',
  PRIMARY KEY (`id`),
  KEY `lang` (`lang`(5))
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 COMMENT='tablica jazqkov' AUTO_INCREMENT=101 ;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `time` time DEFAULT NULL,
  `date` date DEFAULT NULL,
  `text` text,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `date` (`date`,`time`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `text` text,
  PRIMARY KEY (`id`),
  KEY `text` (`text`(1))
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mess_forum`
--

DROP TABLE IF EXISTS `mess_forum`;
CREATE TABLE IF NOT EXISTS `mess_forum` (
  `forum` int(11) NOT NULL,
  `mess_id` int(11) NOT NULL,
  `mess` int(11) NOT NULL,
  `author` int(11) NOT NULL COMMENT 'kto napisla',
  KEY `forum` (`forum`,`mess_id`),
  KEY `mess` (`mess`),
  KEY `author` (`author`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` time DEFAULT NULL,
  `date` date DEFAULT NULL,
  `posted_by` int(11) NOT NULL,
  `text` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `posted_by` (`posted_by`),
  KEY `date` (`date`,`time`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `performer`
--

DROP TABLE IF EXISTS `performer`;
CREATE TABLE IF NOT EXISTS `performer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(64) NOT NULL,
  `info` text NOT NULL COMMENT 'info ob ispolnitele',
  `site` char(128) DEFAULT NULL,
  `pic` char(64) DEFAULT NULL,
  `country` int(11) DEFAULT '0',
  `town` int(11) DEFAULT '0',
  `lang` int(11) DEFAULT '0',
  `album_num` int(11) DEFAULT '0',
  `song_num` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `country` (`country`,`town`),
  KEY `lang` (`lang`),
  FULLTEXT KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 COMMENT='ispolnitel... gruppa ili pivec' AUTO_INCREMENT=6393 ;

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

DROP TABLE IF EXISTS `playlist`;
CREATE TABLE IF NOT EXISTS `playlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `name` char(255) DEFAULT NULL,
  `desc` text COMMENT 'opisanie',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'komu k etomu playlistu est dostup\r\n0 - vsem\r\n1 - druzjam\r\n2 - opredeljonnqm licam\r\n3 - nikomu\r\n4 - nividimka\r\n5 - vidim i dotupen tolko krugu lic',
  `song_num` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user` (`user`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `singer`
--

DROP TABLE IF EXISTS `singer`;
CREATE TABLE IF NOT EXISTS `singer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(64) NOT NULL,
  `second name` char(64) DEFAULT NULL,
  `nick` char(64) NOT NULL,
  `dob` date DEFAULT NULL COMMENT 'date of birth',
  `dod` date DEFAULT NULL COMMENT 'date of dath',
  `desc` text,
  PRIMARY KEY (`id`),
  KEY `second name` (`second name`(6),`name`(6)),
  KEY `nick` (`nick`(3))
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `songs_info`
--

DROP TABLE IF EXISTS `songs_info`;
CREATE TABLE IF NOT EXISTS `songs_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` int(11) NOT NULL,
  `name` char(64) DEFAULT NULL,
  `lenght` time NOT NULL,
  `genre` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `info` text COMMENT 'kto napisal kogda',
  `text` text NOT NULL COMMENT 'slova pesni',
  `such_songs` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `author` (`author`),
  FULLTEXT KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=112800 ;

-- --------------------------------------------------------

--
-- Table structure for table `song_album`
--

DROP TABLE IF EXISTS `song_album`;
CREATE TABLE IF NOT EXISTS `song_album` (
  `song` int(11) NOT NULL,
  `album` int(11) NOT NULL,
  KEY `song` (`song`),
  KEY `album` (`album`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 COMMENT='skrepljajus4aja baza';

-- --------------------------------------------------------

--
-- Table structure for table `song_playlist`
--

DROP TABLE IF EXISTS `song_playlist`;
CREATE TABLE IF NOT EXISTS `song_playlist` (
  `playlist` int(11) NOT NULL,
  `list_id` int(11) NOT NULL DEFAULT '0' COMMENT 'otobzaet porjadok lista',
  `song` int(11) NOT NULL,
  KEY `playlist` (`playlist`,`list_id`),
  KEY `song` (`song`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 COMMENT='svajz mezdu play listami i pesnjami';

-- --------------------------------------------------------

--
-- Table structure for table `town`
--

DROP TABLE IF EXISTS `town`;
CREATE TABLE IF NOT EXISTS `town` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country` smallint(6) NOT NULL,
  `town` char(64) NOT NULL,
  `common` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'this field relates to common records',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `country` (`country`,`town`(5))
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=101 ;

-- --------------------------------------------------------

--
-- Table structure for table `typein`
--

DROP TABLE IF EXISTS `typein`;
CREATE TABLE IF NOT EXISTS `typein` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL,
  `code` char(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users_info`
--

DROP TABLE IF EXISTS `users_info`;
CREATE TABLE IF NOT EXISTS `users_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nick_name` char(32) NOT NULL,
  `user_mail` char(64) NOT NULL COMMENT 'mail dlja vhoda',
  `created` date NOT NULL,
  `name` char(32) DEFAULT NULL COMMENT 'imja klienta',
  `second_name` char(32) DEFAULT NULL COMMENT 'familija klienta',
  `sex` smallint(6) NOT NULL DEFAULT '0',
  `dob` date DEFAULT NULL,
  `avatar` char(64) DEFAULT '0' COMMENT 'avatar klienta\r\nne unikalen potomu kak est'' vozmoznost standartnqe avq stavit',
  `country` int(11) DEFAULT '0' COMMENT 'stranq vse po nomeram',
  `town` int(11) DEFAULT '0' COMMENT 'goroda vse po nomeram',
  `lang` int(11) DEFAULT '0' COMMENT 'jazqk toze po nomeram',
  `text` text COMMENT 'status polzovatelja, pripiska',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_mail` (`user_mail`),
  KEY `nick_name` (`nick_name`(6)),
  KEY `second_name` (`second_name`(6),`name`(3))
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `users_songs_info`
--

DROP TABLE IF EXISTS `users_songs_info`;
CREATE TABLE IF NOT EXISTS `users_songs_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `author_num` int(11) DEFAULT NULL,
  `song_num` int(11) NOT NULL,
  `genre` char(32) DEFAULT NULL,
  `bitrate` int(11) DEFAULT NULL,
  `length` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT '0',
  `size` int(11) DEFAULT NULL,
  `file_name` char(32) NOT NULL COMMENT 'gde razmes4jon fail',
  `hosting` int(11) NOT NULL DEFAULT '1',
  `rule` tinyint(4) DEFAULT '0' COMMENT '0-vse mogut proslu6ivat\r\n1- tolko druzja\r\n2-nikto ne mozet slu6at\r\n3-nikto ne vidit',
  `added` datetime DEFAULT NULL,
  `listened` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `song_num` (`song_num`),
  KEY `user` (`user`),
  KEY `author_num` (`author_num`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Table structure for table `users_songs_tech_info`
--

DROP TABLE IF EXISTS `users_songs_tech_info`;
CREATE TABLE IF NOT EXISTS `users_songs_tech_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `second` int(11) DEFAULT NULL COMMENT 'second id3 byte',
  `third` int(11) DEFAULT NULL COMMENT 'third id3 byte',
  `fourth` int(11) DEFAULT NULL COMMENT 'fourth id3 byte',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Table structure for table `users_tech_info`
--

DROP TABLE IF EXISTS `users_tech_info`;
CREATE TABLE IF NOT EXISTS `users_tech_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `active` int(11) DEFAULT '0',
  `pass` char(32) DEFAULT NULL,
  `session` char(32) DEFAULT NULL,
  `online` tinyint(4) NOT NULL DEFAULT '0',
  `question` char(255) NOT NULL COMMENT 'this question will be asken on password request',
  `answer` char(32) DEFAULT NULL COMMENT 'this is the answer for a question above',
  `pl_num` int(11) NOT NULL DEFAULT '1',
  `song_total` int(11) DEFAULT '0',
  `lang` char(10) DEFAULT 'eng',
  `design` char(32) DEFAULT 'standart',
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `access_count` int(11) DEFAULT NULL,
  `tipein` int(11) DEFAULT NULL COMMENT 'esli polzovatel zahodit bolee 5 raz c nevernqm ip dolzen vvesti typein\r\nego nomer tut',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_zone`
--

DROP TABLE IF EXISTS `user_zone`;
CREATE TABLE IF NOT EXISTS `user_zone` (
  `user` int(11) NOT NULL,
  `zone` int(11) NOT NULL,
  PRIMARY KEY (`user`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Table structure for table `zone`
--

DROP TABLE IF EXISTS `zone`;
CREATE TABLE IF NOT EXISTS `zone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` text,
  `forum` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `dorepeat`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` PROCEDURE `dorepeat`()
BEGIN
 SET @x = 1;
REPEAT 
	set @y=1;
        select COUNT(*) as rows from `song_playlist` where `playlist`=@x;
    repeat 
            set @y=@y+1;
	select @y;
    until @y > rows
    end repeat;
SET @x = @x + 1;
until @x > 12 end REPEAT;
END$$

--
-- Functions
--
DROP FUNCTION IF EXISTS `album_new`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `album_new`(aname CHAR(64), aperf CHAR(64)) RETURNS int(11)
BEGIN
	SELECT COUNT(*) into @album_exist FROM `album` WHERE `name`='aname' limit 1;
    IF @album_exist=1 THEN
    	RETURN 0;
    ELSE
    	INSERT INTO `album` (`name`) VALUES ('aname');
        SELECT `id` into @album_id FROM `album` WHERE `name`='aname' limit 1;
        RETURN @album_id;
    END IF;
END$$

DROP FUNCTION IF EXISTS `album_performer_add`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `album_performer_add`(album_id INTEGER(11), perf_id INTEGER(11), song_id INTEGER(11)) RETURNS tinyint(4)
BEGIN
	SELECT COUNT(*) into @row_exist FROM `album_performer` WHERE `album`=album_id AND `performer`=perf_id AND `song`=song_id LIMIT 1;
    IF @row_exist=1 THEN
    	RETURN 1;
    ELSE
    	INSERT INTO `album_performer` (`album`,`performer`,`song`) VALUES (album_id,perf_id,song_id);
        RETURN 0;
    END IF;
END$$

DROP FUNCTION IF EXISTS `forum_change_name`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `forum_change_name`(fid INTEGER(11), fauthor INTEGER(11), fnew_name CHAR(255)) RETURNS tinyint(4)
BEGIN

	SELECT COUNT(*) into @forum_exist FROM `forum` WHERE `id`=fid LIMIT 1;

    IF @forum_exist=1 THEN
    	SELECT `name`,`author` into @forum_name,@forum_author FROM `forum` WHERE `id`=fid LIMIT 1;
        
        IF @forum_author!=fauthor THEN
        	RETURN 2;
        END IF;
        
        IF @forum_name=fnew_name THEN
        	RETURN 3;
        END IF;
        
    	SELECT COUNT(*) into @forum_num FROM `forum` WHERE `author`=fauthor AND `name`=fnew_name LIMIT 1;
    	
    	IF @forum_num != 0 THEN
        	RETURN 4;
        ELSE
        	UPDATE `forum` SET `name`=fnew_name WHERE `id`=fid LIMIT 1;
        	RETURN 0;
        END IF;
    	
        
    ELSE
    	RETURN 1;
    END IF;
END$$

DROP FUNCTION IF EXISTS `forum_delete`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `forum_delete`(fid INTEGER(11), fauthor INTEGER(11)) RETURNS tinyint(4)
BEGIN
	SELECT count(*) into @forum_exist FROM `forum` WHERE `id`=fid LIMIT 1;
    
    IF @forum_exist = 1 THEN
    	SELECT `author` into @owner FROM `forum` WHERE `id`=fid;
    	IF @owner=fauthor THEN
    		DELETE FROM `forum` WHERE `id`=fid LIMIT 1;
        	DELETE FROM `mess_forum` WHERE `forum`=fid;
        	RETURN 0;
    	ELSE
     		RETURN 2;
    	END IF;
    ELSE
    	RETURN 1;
    END IF;
	

END$$

DROP FUNCTION IF EXISTS `forum_new`$$
CREATE DEFINER=`a3797240_php_mx`@`127.0.0.1` FUNCTION `forum_new`(fname CHAR(255), fauthor INTEGER(11), mtext TEXT) RETURNS tinyint(4)
BEGIN
	SELECT COUNT(*) into @user_exist FROM `users_tech_info` WHERE `id`=fauthor  AND `active`=1 LIMIT 1;
    
    IF @user_exist = 1 THEN
    	
    	SELECT COUNT(*) into @forum_num FROM `forum` WHERE `author`=fauthor AND `name`=fname LIMIT 1;
    
    	IF @forum_num!=0 THEN
    		RETURN 2;
    	ELSE
    		INSERT INTO `forum` (`name`,`author`,`date`) VALUES (fname,fauthor,CURDATE());
			SELECT MAX(`id`) into @forum_id FROM `forum` WHERE `author`=fauthor;
			INSERT INTO `messages` (`author`,`date`,`text`) VALUES (fauthor,NOW(),mtext);
			SELECT MAX(`id`) into @mess_id FROM `messages` WHERE `author`=fauthor;
			INSERT INTO `mess_forum` (`forum`,`mess_id`,`mess`,`author`) VALUES (@forum_id,1,@mess_id,fauthor);
  			RETURN 0;
    	END IF;
    
    ELSE
    	RETURN 1;
    END IF;

	
		
END$$

DROP FUNCTION IF EXISTS `msg_change_txt`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `msg_change_txt`(msgid INTEGER(11), msgauthor INTEGER(11), msgtext TEXT) RETURNS tinyint(4)
BEGIN
	
	SELECT COUNT(*) into @msg_exist FROM `messages` WHERE `id`=msgid LIMIT 1;
    
    IF @msg_exist THEN
    
    	SELECT `author` into @author FROM `messages` WHERE `id`=msgid LIMIT 1;
        
    	IF msgauthor=@author THEN
        
        		UPDATE `messages` SET `text`=msgtext WHERE `id`=msgid LIMIT 1;
    			RETURN 0;
   		ELSE
    		RETURN 2;
    	END IF;
    ELSE
    	RETURN 1;
    END IF;
END$$

DROP FUNCTION IF EXISTS `msg_delete`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `msg_delete`(msgid INTEGER(11), msgauthor INTEGER(11)) RETURNS tinyint(4)
BEGIN

	SELECT COUNT(*) into @msg_exist FROM `messages` WHERE `id`=msgid LIMIT 1;
    
    IF @msg_exist=1 THEN
    	SELECT `author` into @author FROM `messages` WHERE `id`=msgid LIMIT 1;
    	
    	IF msgauthor=@author THEN
    		DELETE FROM `messages` WHERE `id`=msgid LIMIT 1;
        	DELETE FROM `mess_forum` WHERE `mess`=msgid LIMIT 1;
    		RETURN 0;
    	ELSE
    		RETURN 2;
    	END IF;
    ELSE
    	RETURN 1;
    END IF;
END$$

DROP FUNCTION IF EXISTS `msg_new`$$
CREATE DEFINER=`a3797240_php_mx`@`127.0.0.1` FUNCTION `msg_new`(mauthor INTEGER(11), mforum INTEGER(11), mtext TEXT) RETURNS tinyint(4)
BEGIN

	SELECT COUNT(*) into @forum_exist FROM `forum` WHERE `id`=mforum LIMIT 1;
    
    IF @forum_exist!= 0 THEN
    
    	SELECT COUNT(*) into @authors_mess_num FROM `mess_forum` WHERE `forum`=mforum and `author`=mauthor ORDER BY `mess_id` DESC LIMIT 1;
        
        SET @post=0;
        
        IF @authors_mess_num>0 THEN
        	SELECT `date` into @msg_time FROM `mess_forum` JOIN (`messages`) ON (`mess_forum`.`mess`=`messages`.`id`) WHERE `mess_forum`.`forum`=mforum and `mess_forum`.`author`=mauthor ORDER BY `mess_id` DESC LIMIT 1;
		
            IF @msg_time > (select now() - interval 60 SECOND) THEN
            	SET @post=0;
            ELSE
                SET @post=1;
            END IF;
            
        ELSE
        	SET @post=1;
        END IF;
        
        IF @post=1 THEN

        	INSERT INTO `messages` (`author`,`date`,`text`) VALUES (mauthor,NOW(),mtext);
			SELECT MAX(`id`) into @mess_id FROM `messages` WHERE `author`=mauthor LIMIT 1;
            SELECT COUNT(*) into @message_num FROM `mess_forum` WHERE `forum`=mforum LIMIT 1;
 			INSERT INTO `mess_forum` (`forum`,`mess_id`,`mess`,`author`) VALUES (mforum,(@message_num+1),@mess_id,mauthor);
  			RETURN 0;
       	ELSE
            RETURN 2;
        END IF;
    	
    ELSE
    	RETURN 1;
    END IF;
	
END$$

DROP FUNCTION IF EXISTS `performer_add`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `performer_add`(pname char(64)) RETURNS int(11)
BEGIN
	SELECT COUNT(*) into @performer_exist FROM `performer` WHERE `name`=pname limit 1;
    IF @performer_exist=1 THEN
    	RETURN 0;
    ELSE
    	INSERT INTO `performer` (`name`) VALUES (pname);
        SELECT `id` into @performer_id FROM `performer` WHERE `name`=pname limit 1;
        RETURN @performer_id;
    END IF;
END$$

DROP FUNCTION IF EXISTS `performer_change_country`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `performer_change_country`(pid INTEGER(11), pnewcntry INTEGER(11)) RETURNS tinyint(4)
BEGIN
	SELECT COUNT(*) into @perf_exist FROM `performer` WHERE `id`=pid LIMIT 1;
    IF @perf_exist = 1 THEN
    
    	SELECT COUNT(*) into @cntry_exist FROM `country` WHERE `id`=pnewcntry LIMIT 1;
        IF @cntry_exist=1 THEN
        	UPDATE `performer` SET `name`=pnewcntry WHERE `id`=pid LIMIT 1;
        	RETURN 0;
        ELSE
        	RETURN 2;
        END IF;
    ELSE
    	RETURN 1;
    END IF;
  
END$$

DROP FUNCTION IF EXISTS `performer_change_info`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `performer_change_info`(pid INTEGER(11), pnewinfo TEXT) RETURNS tinyint(4)
BEGIN
	SELECT COUNT(*) into @perf_exist FROM `performer` WHERE `id`=pid LIMIT 1;
    
    IF @perf_exist = 1 THEN
    	UPDATE `performer` SET `info`=pnewinfo WHERE `id`=pid LIMIT 1;
        RETURN 0;
    ELSE
    	RETURN 1;
    END IF;
  
END$$

DROP FUNCTION IF EXISTS `performer_change_lang`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `performer_change_lang`(pid INTEGER(11), pnewlng INTEGER(11)) RETURNS tinyint(4)
BEGIN
	SELECT COUNT(*) into @perf_exist FROM `performer` WHERE `id`=pid LIMIT 1;
    IF @perf_exist = 1 THEN
    
    	SELECT COUNT(*) into @lang_exist FROM `langs` WHERE `id`=pnewlng LIMIT 1;
        IF @lang_exist=1 THEN
        	UPDATE `performer` SET `name`=pnewlng WHERE `id`=pid LIMIT 1;
        	RETURN 0;
        ELSE
        	RETURN 2;
        END IF;
    ELSE
    	RETURN 1;
    END IF;
  
END$$

DROP FUNCTION IF EXISTS `performer_change_name`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `performer_change_name`(pid INTEGER(11), pnewname CHAR(64)) RETURNS tinyint(4)
BEGIN
	SELECT COUNT(*) into @perf_exist FROM `performer` WHERE `id`=pid LIMIT 1;
    
    IF @perf_exist = 1 THEN
    	UPDATE `performer` SET `name`=pnewname WHERE `id`=pid LIMIT 1;
        RETURN 0;
    ELSE
    	RETURN 1;
    END IF;
  
END$$

DROP FUNCTION IF EXISTS `performer_change_pic`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `performer_change_pic`(pid INTEGER(11), pnewpic CHAR(64)) RETURNS tinyint(4)
BEGIN
	SELECT COUNT(*) into @perf_exist FROM `performer` WHERE `id`=pid LIMIT 1;
    
    IF @perf_exist = 1 THEN
    	UPDATE `performer` SET `pic`=pnewpic WHERE `id`=pid LIMIT 1;
        RETURN 0;
    ELSE
    	RETURN 1;
    END IF;
  
END$$

DROP FUNCTION IF EXISTS `performer_change_site`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `performer_change_site`(pid INTEGER(11), pnewsite CHAR(128)) RETURNS tinyint(4)
BEGIN
	SELECT COUNT(*) into @perf_exist FROM `performer` WHERE `id`=pid LIMIT 1;
    
    IF @perf_exist = 1 THEN
    	UPDATE `performer` SET `site`=pnewsite WHERE `id`=pid LIMIT 1;
        RETURN 0;
    ELSE
    	RETURN 1;
    END IF;
  
END$$

DROP FUNCTION IF EXISTS `performer_change_town`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `performer_change_town`(pid INTEGER(11), pnewtwn INTEGER(11)) RETURNS tinyint(4)
BEGIN
	SELECT COUNT(*) into @perf_exist FROM `performer` WHERE `id`=pid LIMIT 1;
    IF @perf_exist = 1 THEN
    
    	SELECT COUNT(*) into @twn_exist FROM `town` WHERE `id`=pnewtwn LIMIT 1;
        IF @twn_exist=1 THEN
        	UPDATE `performer` SET `town`=pnewtwn WHERE `id`=pid LIMIT 1;
        	RETURN 0;
        ELSE
        	RETURN 2;
        END IF;
    ELSE
    	RETURN 1;
    END IF;
  
END$$

DROP FUNCTION IF EXISTS `performer_check`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `performer_check`(pname char(64)) RETURNS int(11)
BEGIN
	SELECT COUNT(*) into @performer_exist FROM `performer` WHERE `name`=pname limit 1;
    IF @performer_exist=0 THEN
    	INSERT INTO `performer` (`name`) VALUES (pname);
    END IF;
    SELECT `id` into @performer_id FROM `performer` WHERE `name`=pname limit 1;
    RETURN @performer_id;
END$$

DROP FUNCTION IF EXISTS `performer_dalete`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `performer_dalete`(pid iNTEGER(11)) RETURNS int(11)
BEGIN
	SELECT COUNT(*) into @performer_exist FROM `performer` WHERE `id`=pid LIMIT 1;
    IF @performer_exist=1 THEN
    	DELETE FROM `performer` WHERE `id`=pid limit 1;
        RETURN 0;
    ELSE
    	RETURN 1;
    END IF;
END$$

DROP FUNCTION IF EXISTS `performer_union`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `performer_union`(psource INTEGER(11), pjoint INTEGER(11)) RETURNS tinyint(4)
BEGIN
	SELECT COUNT(*) into @performer_source_exist FROM `performer` WHERE `id`=psource LIMIT 1;
    IF @performer_source_exist=1 THEN 
    	SELECT COUNT(*) into @performer_join_exist FROM `performer` WHERE `id`=psource LIMIT 1;
    	IF @performer_joint_exist=1 THEN 
        	DELETE FROM `performer` WHERE `id`=psource LIMIT 1;
            UPDATE `users_songs_info` SET `author_num`=psource WHERE `author_num`=pjoint;
            UPDATE `songs_info` SET `author`=psource WHERE `author`=pjoint;
            RETURN 0;
    	ELSE 
    		RETURN 2;
    	END IF;
    ELSE 
    	RETURN 1;
    END IF;
END$$

DROP FUNCTION IF EXISTS `playlist_change_name`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `playlist_change_name`(llist INTEGER(11), luser INTEGER(11), lnewname CHAR(255)) RETURNS tinyint(4)
BEGIN

	SELECT `user`,`name` into @owner,@list_name FROM `playlist` WHERE `id`=llist LIMIT 1;
	IF @owner=luser THEN
        
    	IF @list_name = '0' THEN
        	RETURN 3;
        END IF;
    
        SELECT COUNT(*) into @playlist_exist FROM `playlist` WHERE `user`=luser AND `name`=lnewname AND `id`!=llist LIMIT 1; 
        IF @playlist_exist>0 THEN
        	RETURN 2;
        END IF;
        
        UPDATE `playlist` SET `name`=lnewname WHERE `id`=llist LIMIT 1;
        RETURN 0;
    ELSE
		RETURN 1;
    end IF;
END$$

DROP FUNCTION IF EXISTS `playlist_count`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `playlist_count`(luser INTEGER(11), llist INTEGER(11)) RETURNS tinyint(4)
BEGIN
	SELECT COUNT(*) into @list_exist FROM `playlist` WHERE `id`=llist LIMIT 1;
    IF @list_exist=1 THEN
    	SELECT `pl_num` into @playlist_num FROM `users_tech_info` WHERE `id` = luser;
        SET @playlist_num = @playlist_num - 1;
    	RETURN @playlist_num;
    ELSE
    	RETURN 0;
    END IF;
	
END$$

DROP FUNCTION IF EXISTS `playlist_count_songs`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `playlist_count_songs`(llist INTEGER(11)) RETURNS int(11)
BEGIN
	SELECT COUNT(*) into @list_exist FROM `playlist` WHERE `id`=llist LIMIT 1;
    IF @list_exist=1 THEN
    	SELECT `song_num` into @songs_num FROM `playlist` WHERE `id` = llist;
        SET @songs_num = @songs_num;
    	RETURN @songs_num;
    ELSE
    	RETURN 0;
    END IF;
	
END$$

DROP FUNCTION IF EXISTS `playlist_delete`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `playlist_delete`(llist INTEGER(11), luser INTEGER(11)) RETURNS tinyint(4)
BEGIN

	SELECT COUNT(`id`) into @list_exist FROM `playlist` WHERE `id`=llist LIMIT 1;
    
    IF @list_exist=1 THEN
    
   		SELECT `user`,`name` into @owner,@list_name FROM `playlist` WHERE `id`=llist LIMIT 1;
    
    	IF @list_name = '0' THEN
        	RETURN 3;
        END IF;
    
    	IF @owner=luser THEN
    		DELETE FROM `playlist` WHERE `id`=llist LIMIT 1;
        	DELETE FROM `song_playlist` WHERE `playlist`=llist;
            SELECT `pl_num` into @pln FROM `users_tech_info` WHERE `id`=luser LIMIT 1;
            UPDATE `users_tech_info` SET `pl_num` = (@pln-1) WHERE `id`=luser LIMIT 1;
        	RETURN 0;
    	ELSE
			RETURN 2;
    	end IF;
    
    ELSE
     RETURN 1; 
    END IF;
END$$

DROP FUNCTION IF EXISTS `playlist_new`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `playlist_new`(lname CHAR(255), luser INTEGER(11), ldesc TEXT) RETURNS tinyint(4)
BEGIN
	SELECT COUNT(*) into @list_count FROM `playlist` WHERE `user`=luser LIMIT 1;
    
    IF @list_count<16 THEN
    
    	SELECT COUNT(*) into @list_exist FROM `playlist` WHERE `user`=luser and `name` like lname LIMIT 1;
        
        IF @list_exist=0 THEN
        	INSERT INTO `playlist` (`name`,`user`,`desc`) VALUES (lname,luser,ldesc);
            SELECT `pl_num` into @pln FROM `users_tech_info` WHERE `id`=luser LIMIT 1;
            UPDATE `users_tech_info` SET `pl_num` = (@pln+1) WHERE `id`=luser LIMIT 1;
    		RETURN 0;
        ELSE
        	RETURN 2;
        END IF;
    	
    ELSE
    	RETURN 1;
    END IF;
END$$

DROP FUNCTION IF EXISTS `playlist_select_general_id`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `playlist_select_general_id`(luser INTEGER(11)) RETURNS tinyint(4)
BEGIN
	SELECT COUNT(*) into @user_exist FROM `users_info` WHERE `id`=luser LIMIT 1;
    IF @user_exist=1 THEN
    	SELECT `id` into @pl_id FROM `playlist` WHERE `user` = luser and `name`='0' LIMIT 1;
    	RETURN @pl_id;
    ELSE
    	RETURN 0;
    END IF;
	
END$$

DROP FUNCTION IF EXISTS `server_add`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `server_add`(srv_name CHAR(32), srv_addr CHAR(16), srv_port INTEGER(11), srv_loc CHAR(32), srv_space BIGINT) RETURNS int(11)
BEGIN
	SELECT COUNT(*) into @server_exist FROM `host` WHERE `server_name`=srv_name limit 1;
        IF @server_exist=1 THEN
    	RETURN 0;
    ELSE
    	INSERT INTO `host` (`server_name`,`server_address`,`port`,`store_location`,`memory_left`) 
        VALUES (srv_name,srv_addr,srv_port,srv_loc,srv_space);
        SELECT `id` into @host_id FROM `host` WHERE `server_address`=srv_addr limit 1;
        RETURN @host_id;
    END IF;
END$$

DROP FUNCTION IF EXISTS `server_space`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `server_space`(srv_id INTEGER(11), srv_space BIGINT) RETURNS tinyint(4)
BEGIN
	SELECT COUNT(*) into @server_exist FROM `host` WHERE `id`=srv_id limit 1;
        IF @server_exist=1 THEN
    	RETURN 0;
    ELSE
    	UPDATE `host` SET `host`.`memory_left`=srv_space WHERE `host`.`id`=srv_id LIMIT 1;
        RETURN 1;
    END IF;
END$$

DROP FUNCTION IF EXISTS `song_add`$$
CREATE DEFINER=`a3797240_php_mx`@`127.0.0.1` FUNCTION `song_add`(suser INTEGER(11), sauthor CHAR(64), sname CHAR(64), sgenre CHAR(32), slen INTEGER, sbit INTEGER(11), syear INTEGER(11), ssize INTEGER(11), sfile_name CHAR(32), shost integer(11)) RETURNS mediumint(9)
BEGIN
    SET @song_id=0;
    SET @song_author=0;
    SET @such_songs=0;
    
    SELECT COUNT(*) into @song_exist FROM `songs_info` 
    JOIN (`performer`) ON (`songs_info`.`author`=`performer`.`id`) 
    WHERE `songs_info`.`name` like TRIM(sname) AND `performer`.`name` like concat('%',trim(sauthor),'%');
    
    IF @song_exist>0 THEN
    	SELECT `performer`.`id`,`songs_info`.`id`,`songs_info`.`such_songs` into @song_author,@song_id,@such_songs  FROM `songs_info` 
    	JOIN (`performer`) ON (`songs_info`.`author`=`performer`.`id`) 
        WHERE `songs_info`.`name` like TRIM(sname) AND `performer`.`name` like CONCAT('%',trim(sauthor),'%') LIMIT 1;
	ELSE
	
		SELECT COUNT(*) into @author_exist FROM `performer` WHERE `name` like trim(sauthor);
    
		IF @author_exist = 0 THEN
        	INSERT INTO `performer` (`name`,`song_num`) values (tRIM(sauthor),1);
        ELSEIF @author_exist = 1 THEN
        	SELECT `song_num` into @songs_num FROM `performer` WHERE `name` like trim(sauthor);	
        	UPDATE `performer` SET `song_num`=@songs_num+1 WHERE `name` like trim(sauthor);     
        END IF;
        
        SELECT `id` into @song_author FROM `performer` WHERE `name`=trim(sauthor) LIMIT 1;
        INSERT INTO `songs_info` (`author`,`name`,`lenght`,`genre`,`year`) values (@song_author,tRIM(sname),slen,sgenre,syear);	
        SELECT `id` into @song_id FROM `songs_info` WHERE `author`=@song_author AND `name`=TRIM(sname) LIMIT 1;

    END IF;
		
    UPDATE `songs_info` SET `such_songs`=(@such_songs+1) WHERE `id`=@song_id LIMIT 1;
    SELECT COUNT(*) into @song_exist FROM `users_songs_info` 
    WHERE `user`=suser AND `song_num`=@song_id AND `length`=slen LIMIT 1;
    
    IF @song_exist != 0 THEN
    	RETURN 1;
    END IF;

    INSERT INTO `users_songs_info` (`user`,`author_num`,`song_num`,`genre`,`bitrate`,`length`,`year`,`size`,`file_name`,`hosting`,`added`) 
    VALUES (suser,@song_author,@song_id,sgenre,sbit,slen,syear,ssize,sfile_name,shost,now());
	SELECT `id` into @list_id FROM `playlist` WHERE `user`=suser and `name`= '0' LIMIT 1;
	SELECT MAX(`id`) into @song_id FROM `users_songs_info` WHERE `user`=suser LIMIT 1;
    SELECT MAX(`list_id`) into @list_song_id FROM `song_playlist` WHERE `playlist`=@list_id LIMIT 1;
    
    SET @list_song_id=IFNULL(@list_song_id,1);
    
    INSERT INTO `song_playlist` (`playlist`,`list_id`,`song`) VALUES (@list_id,(@list_song_id+1),@song_id);
    SELECT `song_num` into @song_num FROM `playlist` WHERE `id`=@list_id LIMIT 1;
    UPDATE `playlist` SET `song_num`=(@song_num+1) WHERE `id`=@list_id LIMIT 1;
    RETURN @song_id;
END$$

DROP FUNCTION IF EXISTS `song_change_author`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `song_change_author`(suserid INTEGER(11), ssongid INTEGER(11), sauthor INTEGER(11)) RETURNS tinyint(4)
BEGIN
	SELECT COUNT(*) into @song_exist FROM `users_songs_info` WHERE `id`=ssongid LIMIT 1;
    IF @song_exist=1 THEN

    	SELECT `user` into @owner FROM `users_songs_info` WHERE `id`=ssongid LIMIT 1;
    	IF @owner=suserid THEN
    			
    		SELECT COUNT(*) into @author_exist FROM `performer` WHERE `id`=sauthor LIMIT 1;
    		IF @author_exist=1 THEN
    		
    			UPDATE `users_songs_info` SET `author_num`= sauthor
				WHERE `id` =ssongid and `user`=suserid LIMIT 1;
				RETURN 0;
    		ELSE
    			RETURN 3;
    		END IF;
    	ELSE
    		RETURN 2;
    	END IF;
    ELSE
    	RETURN 1;
    END IF;
  
END$$

DROP FUNCTION IF EXISTS `song_change_original`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `song_change_original`(suserid INTEGER(11), ssongid INTEGER(11), sauthor INTEGER(11)) RETURNS tinyint(4)
BEGIN
	SELECT COUNT(*) into @song_exist FROM `users_songs_info` WHERE `id`=ssongid LIMIT 1;
    IF @song_exist=1 THEN

    	SELECT `user` into @owner FROM `users_songs_info` WHERE `id`=ssongid LIMIT 1;
    	IF @owner=suserid THEN
    			
    		SELECT COUNT(*) into @author_exist FROM `performer` WHERE `id`=sauthor LIMIT 1;
    		IF @author_exist=1 THEN
    		
    			UPDATE `users_songs_info` SET `author_num`= sauthor
				WHERE `id` =ssongid and `user`=suserid LIMIT 1;
				RETURN 0;
    		ELSE
    			RETURN 3;
    		END IF;
    	ELSE
    		RETURN 2;
    	END IF;
    ELSE
    	RETURN 1;
    END IF;
  
END$$

DROP FUNCTION IF EXISTS `song_change_rule`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `song_change_rule`(suserid INTEGER(11), ssongid INTEGER(11), srule INTEGER(11)) RETURNS tinyint(4)
BEGIN
	SELECT COUNT(*) into @song_exist FROM `users_songs_info` WHERE `id`=ssongid LIMIT 1;
    IF @song_exist=1 THEN

    	SELECT `user` into @owner FROM `users_songs_info` WHERE `id`=ssongid LIMIT 1;
    	IF @owner=suserid THEN

    			UPDATE `users_songs_info` SET `rule`= srule
				WHERE `id` =ssongid and `user`=suserid LIMIT 1;
				RETURN 0;
    	ELSE
    		RETURN 2;
    	END IF;
    ELSE
    	RETURN 1;
    END IF;
  
END$$

DROP FUNCTION IF EXISTS `song_clone_count`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `song_clone_count`(sid INTEGER(11)) RETURNS int(11)
BEGIN
	SELECT COUNT(*) into @song_exist FROM `songs_info` WHERE `id`=sid LIMIT 1;
    IF @song_exist=1 THEN
    	SELECT `such_songs` into @songs_num FROM `songs_info` WHERE `id` = sid;
    	RETURN @songs_num;
    ELSE
    	RETURN 0;
    END IF;
	
END$$

DROP FUNCTION IF EXISTS `song_delete`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `song_delete`(sid INTEGER(11), suser INTEGER(11)) RETURNS tinyint(4)
BEGIN
	SELECT COUNT(*) into @song_exist FROM `users_songs_info` WHERE `id`= sid LIMIT 1;
    IF @song_exist=1 THEN
    
    	SELECT `user` into @owner FROM `users_songs_info` WHERE `id`= sid LIMIT 1;
    	IF suser=@owner THEN
    	
    		DELETE FROM `users_songs_info` WHERE `id`=sid LIMIT 1;
                                                			    					    		    		  			                    	RETURN 0;
    	ELSE
    		RETURN 2;
    	END IF;
        
    ELSE
    	RETURN 1;
    END IF;

END$$

DROP FUNCTION IF EXISTS `song_get_hosting`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `song_get_hosting`(sid INTEGER(11)) RETURNS text CHARSET cp1251
BEGIN
	SELECT COUNT(*) into @song_exist FROM `users_songs_info` WHERE `id`=sid LIMIT 1;
    IF @song_exist=1 THEN
    	
    	SELECT `hosting`,`rule` into @hosting,@rule FROM `users_songs_info` WHERE `id`=sid LIMIT 1;
		IF @rule = 2 THEN
        	RETURN -1;
        ELSEIF @rule = 1 THEN
        	RETURN -1;        END IF;	

  		RETURN @hosting;
    ELSE
    	RETURN 0;
    END IF;
END$$

DROP FUNCTION IF EXISTS `song_get_location`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `song_get_location`(sid INTEGER(11)) RETURNS text CHARSET cp1251
BEGIN
	SELECT COUNT(*) into @song_exist FROM `users_songs_info` WHERE `id`=sid LIMIT 1;
    IF @song_exist=1 THEN
    	
    	SELECT `host`.`store_location` into @location FROM `users_songs_info` INNER JOIN `host` ON (`users_songs_info`.`hosting` = `host`.`id`)
		WHERE `users_songs_info`.`id`=sid LIMIT 1;
  		RETURN @location;
    ELSE
    	RETURN 1;
    END IF;
END$$

DROP FUNCTION IF EXISTS `song_get_name`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `song_get_name`(sid INTEGER(11)) RETURNS char(32) CHARSET cp1251
BEGIN
	SELECT COUNT(*) into @song_exist FROM `users_songs_info` WHERE `id`=sid LIMIT 1;
    IF @song_exist=1 THEN
    	
    	SELECT `file_name`,`rule`,`listened` into @file_name,@rule,@listened FROM `users_songs_info` WHERE `id`=sid LIMIT 1;
		IF @rule = 2 THEN
        	RETURN -1;
        ELSEIF @rule = 1 THEN
        	RETURN -1;        END IF;	

		UPDATE `users_songs_info` SET `listened`=(@listened+1) WHERE `id`=sid LIMIT 1;
  		RETURN @file_name;
    ELSE
    	RETURN 0;
    END IF;
END$$

DROP FUNCTION IF EXISTS `song_info_change_author`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `song_info_change_author`(siid INTEGER(11), siauthor INTEGER(11)) RETURNS tinyint(4)
BEGIN
	SELECT COUNT(*) into @song_info_exist FROM `songs_info` WHERE `id`=siid LIMIT 1;
    IF @song_info_exist=1 THEN
    
    	SELECT COUNT(*) into @author_exist FROM `performer` WHERE `id`=siauthor LIMIT 1;
        IF @author_exist=1 THEN
        	UPDATE `songs_info` SET `author`=siauthor WHERE `id`=siid LIMIT 1;
            RETURN 0;
        ELSE
        	RETURN 2;
        END IF;
    ELSE
    	RETURN 1;
    END IF;
END$$

DROP FUNCTION IF EXISTS `song_info_change_genre`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `song_info_change_genre`(siid INTEGER(11), sigenre INTEGER(11)) RETURNS tinyint(4)
BEGIN
	SELECT COUNT(*) into @song_info_exist FROM `songs_info` WHERE `id`=siid LIMIT 1;
    IF @song_info_exist=1 THEN
    
    	SELECT COUNT(*) into @genre_exist FROM `genre` WHERE `id`=sigenre LIMIT 1;
        IF @genre_exist=1 THEN
        	UPDATE `songs_info` SET `genre`=sigenre WHERE `id`=siid LIMIT 1;
            RETURN 0;
        ELSE
        	RETURN 2;
        END IF;
    ELSE
    	RETURN 1;
    END IF;
END$$

DROP FUNCTION IF EXISTS `song_info_change_info`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `song_info_change_info`(siid INTEGER(11), siinfo TEXT) RETURNS tinyint(4)
BEGIN
	SELECT COUNT(*) into @song_info_exist FROM `songs_info` WHERE `id`=siid LIMIT 1;
    IF @song_info_exist=1 THEN
    
    	UPDATE `songs_info` SET `info`=siinfo WHERE `id`=siid LIMIT 1;
        RETURN 0;
    ELSE
    	RETURN 1;
    END IF;
END$$

DROP FUNCTION IF EXISTS `song_info_change_lang`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `song_info_change_lang`(siid INTEGER(11), silang INTEGER(11)) RETURNS tinyint(4)
BEGIN
	SELECT COUNT(*) into @song_info_exist FROM `songs_info` WHERE `id`=siid LIMIT 1;
    IF @song_info_exist=1 THEN
    
    	SELECT COUNT(*) into @lang_exist FROM `langs` WHERE `id`=silang LIMIT 1;
        IF @lang_exist=1 THEN
        	UPDATE `songs_info` SET `lang`=silang WHERE `id`=siid LIMIT 1;
            RETURN 0;
        ELSE
        	RETURN 2;
        END IF;
    ELSE
    	RETURN 1;
    END IF;
END$$

DROP FUNCTION IF EXISTS `song_info_change_len`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `song_info_change_len`(siid INTEGER(11), silen TIME) RETURNS tinyint(4)
BEGIN
	SELECT COUNT(*) into @song_info_exist FROM `songs_info` WHERE `id`=siid LIMIT 1;
    IF @song_info_exist THEN
    
    	UPDATE `songs_info` SET `lenght`=silen WHERE `id`=siid LIMIT 1;
        RETURN 0;
    ELSE
    	RETURN 1;
    END IF;
END$$

DROP FUNCTION IF EXISTS `song_info_change_name`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `song_info_change_name`(siid INTEGER(11), siname CHAR(64)) RETURNS tinyint(4)
BEGIN
	SELECT COUNT(*) into @song_info_exist FROM `songs_info` WHERE `id`=siid LIMIT 1;
    IF @song_info_exist=1 THEN
    
    	UPDATE `songs_info` SET `name`=siname WHERE `id`=siid LIMIT 1;
        RETURN 0;
    ELSE
    	RETURN 1;
    END IF;
END$$

DROP FUNCTION IF EXISTS `song_info_change_text`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `song_info_change_text`(siid INTEGER(11), sitext TEXT) RETURNS tinyint(4)
BEGIN
	SELECT COUNT(*) into @song_info_exist FROM `songs_info` WHERE `id`=siid LIMIT 1;
    IF @song_info_exist=1 THEN
    
    	UPDATE `songs_info` SET `text`=sitext WHERE `id`=siid LIMIT 1;
        RETURN 0;
    ELSE
    	RETURN 1;
    END IF;
END$$

DROP FUNCTION IF EXISTS `song_info_change_year`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `song_info_change_year`(siid INTEGER(11), siyear inTEGER(11)) RETURNS tinyint(4)
BEGIN
	SELECT COUNT(*) into @song_info_exist FROM `songs_info` WHERE `id`=siid LIMIT 1;
    IF @song_info_exist=1 THEN
    
    	UPDATE `songs_info` SET `year`=siyaer WHERE `id`=siid LIMIT 1;
        RETURN 0;
    ELSE
    	RETURN 1;
    END IF;
END$$

DROP FUNCTION IF EXISTS `song_list_add`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `song_list_add`(ssong INTEGER(11), slist INTEGER(11), suser INTEGER(11)) RETURNS tinyint(1)
BEGIN
	SELECT COUNT(*) into @list_exist FROM `playlist` WHERE `id`=slist LIMIT 1;
    IF @list_exist=1 THEN
    
    	SELECT `user`,`name` into @list_owner,@list_name FROM `playlist` WHERE `id`=slist LIMIT 1;
   		IF @list_owner=suser THEN
            
            	SELECT COUNT(*) into @song_exist FROM `song_playlist` WHERE `playlist`=slist AND `song`=ssong LIMIT 1;
                IF @song_exist > 0 THEN 
                	RETURN 3;
                END IF;
            
        		SELECT MAX(`list_id`) into @id FROM `song_playlist` WHERE `playlist`=slist;
                 SET @id=IFNULL(@id,1);
				INSERT INTO `song_playlist` (`playlist`,`list_id`,`song`) VALUE (slist,(@id+1),ssong);
                SELECT `song_num` into @song_num FROM `playlist` WHERE `id`=slist LIMIT 1;
    			UPDATE `playlist` SET `song_num`=(@song_num+1) WHERE `id`=slist LIMIT 1;
                
  				RETURN 0;
    	ELSE
    		RETURN 2;
    	END IF;
    ELSE 
    	RETURN 1;
    END IF;
END$$

DROP FUNCTION IF EXISTS `song_list_change`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `song_list_change`(new_id INTEGER(11), ssong INTEGER(11), slist INTEGER(11), suser INTEGER(11)) RETURNS mediumint(9)
    COMMENT 'poka nedodelana nuzno sdelat prokrutku po vsem'
BEGIN
	SELECT COUNT(*) into @user_exist FROM `users_info` WHERE `id`=suser LIMIT 1;
    
    IF @user_exist=0 THEN
    	RETURN 3;
    END IF;
    
    SELECT COUNT(*) into @song_exist FROM `songs_info` WHERE `id`=ssong LIMIT 1;
    
    IF @song_exist=0 THEN
    	RETURN 4;
    END IF;
    
	SELECT COUNT(*) into @list_exist FROM `playlist` WHERE `id`=slist LIMIT 1;
    IF @list_exist=1 THEN
    
    	SELECT `user`,`name` into @list_owner,@list_name FROM `playlist` WHERE `id`=slist LIMIT 1;
   		IF @list_owner=suser THEN
        
			SELECT `list_id` into @current_song FROM `song_playlist` WHERE `playlist`=slist AND `song`=ssong LIMIT 1;
    		
    		IF @current_song > new_id THEN
            
            	WHILE @current_song > new_id DO
    				UPDATE `song_playlist` SET `list_id`=@current_song WHERE `playlist`=slist AND `list_id`=@current_song-1;
    				SET @current_song = @current_song-1;
  				END WHILE;
            ELSEIF @current_song < new_id THEN
            
            	WHILE @current_song < new_id DO
    				UPDATE `song_playlist` SET `list_id`=@current_song WHERE `playlist`=slist AND `list_id`=@current_song+1;
    				SET @current_song = @current_song+1;
  				END WHILE;
            ELSE
            	RETURN 0;
            END IF;
            
    		UPDATE `song_playlist` SET `list_id`=new_id WHERE `playlist`=slist AND `song`=ssong;
    		RETURN 0;
    	ELSE
    		RETURN 2;
    	END IF;
    ELSE 
    	RETURN 1;
    END IF;
END$$

DROP FUNCTION IF EXISTS `song_list_delete`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `song_list_delete`(ssong INTEGER(11), slist INTEGER(11), suser INTEGER(11)) RETURNS tinyint(4)
BEGIN
	SELECT COUNT(*) into @list_exist FROM `playlist` WHERE `id`=slist LIMIT 1;
    IF @list_exist=1 THEN
    
    	SELECT `user` into @list_owner FROM `playlist` WHERE `id`=slist LIMIT 1;
   		IF @list_owner=suser THEN
    
			SELECT MAX(`list_id`) into @max_list_id FROM `song_playlist` WHERE `playlist`=slist;
			SELECT `list_id` into @current_song FROM `song_playlist` WHERE `playlist`=slist AND `song`=ssong LIMIT 1;
    		DELETE FROM `song_playlist` WHERE `playlist`=slist AND song=ssong LIMIT 1;
            SELECT `song_num` into @song_num FROM `playlist` WHERE `id`=slist LIMIT 1;
    		UPDATE `playlist` SET `song_num`=(@song_num-1) WHERE `id`=slist LIMIT 1;
    
			WHILE @current_song < @max_list_id DO
    			UPDATE `song_playlist` SET `list_id`=@current_song WHERE `playlist`=slist AND `list_id`=@current_song+1;
    			SET @current_song = @current_song +1;
  			END WHILE;

  			RETURN 0;
    	ELSE
    		RETURN 2;
    	END IF;
    ELSE 
    	RETURN 1;
    END IF;
END$$

DROP FUNCTION IF EXISTS `song_tech_insert`$$
CREATE DEFINER=`a3797240_php_mx`@`127.0.0.1` FUNCTION `song_tech_insert`(sid INTEGER(11), ssecond INTEGER(11), sthird INTEGER(11), sfourth INTEGER(11)) RETURNS double
BEGIN
    
    SELECT COUNT(*) into @song_exist FROM `users_songs_info` 
    WHERE `id`=sid LIMIT 1;

    IF @song_exist>0 THEN
    	INSERT INTO `users_songs_tech_info` (`id`,`second`,`third`,`fourth`) VALUES (sid,ssecond,sthird,sfourth);
		RETURN 0;
	ELSE
    	RETURN 1;
    END IF;
END$$

DROP FUNCTION IF EXISTS `song_union`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `song_union`(ssource INTEGER(11), sjoint INTEGER(11)) RETURNS tinyint(4)
BEGIN
	SELECT COUNT(*) into @song_source_exist FROM `songs_info` WHERE `id`=ssource LIMIT 1;
    IF @song_source_exist=1 THEN
    	SELECT COUNT(*) into @song_joint_exist FROM `songs_info` WHERE `id`=sjoint LIMIT 1;
    	IF @song_joint_exist=1 THEN
    		DELETE FROM `songs_info` WHERE `id`=sjoint LIMIT 1;
            UPDATE `users_songs_info` SET `song_num`=ssource WHERE `song_num`=sjoint;
            RETURN 0;
    	ELSE
    		RETURN 2;
    	END IF;
    ELSE
    	RETURN 1;
    END IF;
END$$

DROP FUNCTION IF EXISTS `test`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `test`(par CHAR(64)) RETURNS int(11)
    DETERMINISTIC
BEGIN

	set @num = 811;
    
    WHILE @num < 6358 DO
    	SELECT COUNT(*) into @author_exist FROM `performer` WHERE `id`= @num limit 1;
    	IF @author_exist = 1 THEN
        	SELECT COUNT(*) into @songs_num FROM `songs_info` WHERE `author`= @num;
        	UPDATE `performer` SET `song_num`=@songs_num WHERE `id`= @num limit 1;
        END IF;
    	
    	set @num = @num + 1;
  	END WHILE;
   return 0; 
END$$

DROP FUNCTION IF EXISTS `typein_type_count`$$
CREATE DEFINER=`a3797240_php_mx`@`127.0.0.1` FUNCTION `typein_type_count`(ttype INTEGER(11)) RETURNS int(11)
BEGIN
	SELECT COUNT(*) into @type_count FROM `typein` WHERE `id`=ttype;
    RETURN @type_count;
END$$

DROP FUNCTION IF EXISTS `user_activate`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `user_activate`(uid INTEGER(11), user_code CHAR(32)) RETURNS tinyint(4)
BEGIN
	SELECT COUNT(*) into @row_exist FROM `activation_info` WHERE `user_id`=uid LIMIT 1;
	IF @row_exist = 1 THEN
    
    	SELECT `activation_code`,`date` into @code,@date_reged FROM `activation_info` WHERE `user_id`=uid LIMIT 1;
        IF @code = user_code THEN

            IF NOW()<=(@date_reged+INTERVAL 7 DAY) THEN
            	UPDATE `users_tech_info` SET `active`=1 WHERE `id`=uid LIMIT 1;
                DELETE FROM `activation_info` WHERE `user_id`=uid LIMIT 1;
            	RETURN 0;
            ELSE
            	RETURN 3;
            END IF;
        ELSE
        	RETURN 2;
        END IF;
    ELSE
    	RETURN 1;
    END IF;	
END$$

DROP FUNCTION IF EXISTS `user_change_avatar`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `user_change_avatar`(uid INTEGER(11), uavatar CHAR(64)) RETURNS tinyint(4)
BEGIN
	SELECT COUNT(*) into @user_exist FROM `users_tech_info` WHERE `id`=uid LIMIT 1;
    
    IF @user_exist = 1 THEN
    
    	SELECT `online` into @user_online FROM `users_tech_info` WHERE `id`=uid LIMIT 1;
        
        IF @user_online = 1 THEN
        	UPDATE `users_info` SET `avatar`=uavatar WHERE `id`=uid LIMIT 1;
        	RETURN 0;
        ELSE
        	RETURN 2;
        END IF;
    	
    ELSE
    	RETURN 1;
    END IF;
  
END$$

DROP FUNCTION IF EXISTS `user_change_country`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `user_change_country`(uid INTEGER(11), ucountry INTEGER(11)) RETURNS tinyint(4)
BEGIN
	SELECT COUNT(*) into @user_exist FROM `users_tech_info` WHERE `id`=uid LIMIT 1;
    
    IF @user_exist = 1 THEN
    
    	SELECT `online` into @user_online FROM `users_tech_info` WHERE `id`=uid LIMIT 1;
        
        IF @user_online = 1 THEN
        	UPDATE `users_info` SET `country`=ucountry WHERE `id`=uid LIMIT 1;
        	RETURN 0;
        ELSE
        	RETURN 2;
        END IF;
    	
    ELSE
    	RETURN 1;
    END IF;
  
END$$

DROP FUNCTION IF EXISTS `user_change_dob`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `user_change_dob`(uid INTEGER(11), udob DATE) RETURNS tinyint(4)
BEGIN
	SELECT COUNT(*) into @user_exist FROM `users_tech_info` WHERE `id`=uid LIMIT 1;
    
    IF @user_exist = 1 THEN
    
    	SELECT `online` into @user_online FROM `users_tech_info` WHERE `id`=uid LIMIT 1;
        
        IF @user_online = 1 THEN
        	UPDATE `users_info` SET `dob`=udob WHERE `id`=uid LIMIT 1;
        	RETURN 0;
        ELSE
        	RETURN 2;
        END IF;
    	
    ELSE
    	RETURN 1;
    END IF;
  
END$$

DROP FUNCTION IF EXISTS `user_change_lang`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `user_change_lang`(uid INTEGER(11), ulang INTEGER(11)) RETURNS tinyint(4)
BEGIN
	SELECT COUNT(*) into @user_exist FROM `users_tech_info` WHERE `id`=uid LIMIT 1;
    
    IF @user_exist = 1 THEN
    
    	SELECT `online` into @user_online FROM `users_tech_info` WHERE `id`=uid LIMIT 1;
        
        IF @user_online = 1 THEN
        	UPDATE `users_info` SET `lang`=ulang WHERE `id`=uid LIMIT 1;
        	RETURN 0;
        ELSE
        	RETURN 2;
        END IF;
    	
    ELSE
    	RETURN 1;
    END IF;
  
END$$

DROP FUNCTION IF EXISTS `user_change_name`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `user_change_name`(uid INTEGER(11), uname CHAR(32)) RETURNS tinyint(4)
BEGIN
	SELECT COUNT(*) into @user_exist FROM `users_tech_info` WHERE `id`=uid LIMIT 1;
    
    IF @user_exist = 1 THEN
    
    	SELECT `online` into @user_online FROM `users_tech_info` WHERE `id`=uid LIMIT 1;
        
        IF @user_online = 1 THEN
        	UPDATE `users_info` SET `name`=uname WHERE `id`=uid LIMIT 1;
        	RETURN 0;
        ELSE
        	RETURN 2;
        END IF;
    	
    ELSE
    	RETURN 1;
    END IF;
  
END$$

DROP FUNCTION IF EXISTS `user_change_nick`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `user_change_nick`(uid INTEGER(11), unick CHAR(32)) RETURNS tinyint(4)
BEGIN
	SELECT COUNT(*) into @user_exist FROM `users_tech_info` WHERE `id`=uid LIMIT 1;
    
    IF @user_exist = 1 THEN
    
    	SELECT `online` into @user_online FROM `users_tech_info` WHERE `id`=uid LIMIT 1;
        
        IF @user_online = 1 THEN
        	UPDATE `users_info` SET `nick_name`=unick WHERE `id`=uid LIMIT 1;
        	RETURN 0;
        ELSE
        	RETURN 2;
        END IF;
    	
    ELSE
    	RETURN 1;
    END IF;
  
END$$

DROP FUNCTION IF EXISTS `user_change_pass`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `user_change_pass`(uid INTEGER(11), uold_pass CHAR(32), unew_pass char(32)) RETURNS tinyint(4)
BEGIN
	SELECT COUNT(*) into @user_exist FROM `users_tech_info` WHERE `id`=uid LIMIT 1;
    
    IF @user_exist = 1 THEN
    
    	SELECT `online` into @user_online FROM `users_tech_info` WHERE `id`=uid LIMIT 1;
        
        IF @user_online = 1 THEN
        
        	SELECT `pass` into @old_pass FROM `users_tech_info` WHERE `id`=uid LIMIT 1;
            
            IF @old_pass = uold_pass THEN
            	UPDATE `users_tech_info` SET `pass`=unew_pass WHERE `id`=uid LIMIT 1;
        		RETURN 0;
            ELSE
            	RETURN 3;
            END IF;
        	
        ELSE
        	RETURN 2;
        END IF;
    	
    ELSE
    	RETURN 1;
    END IF;
  
END$$

DROP FUNCTION IF EXISTS `user_change_second`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `user_change_second`(uid INTEGER(11), usecond CHAR(32)) RETURNS tinyint(4)
BEGIN
	SELECT COUNT(*) into @user_exist FROM `users_tech_info` WHERE `id`=uid LIMIT 1;
    
    IF @user_exist = 1 THEN
    
    	SELECT `online` into @user_online FROM `users_tech_info` WHERE `id`=uid LIMIT 1;
        
        IF @user_online = 1 THEN
        	UPDATE `users_info` SET `second_name`=usecond WHERE `id`=uid LIMIT 1;
        	RETURN 0;
        ELSE
        	RETURN 2;
        END IF;
    	
    ELSE
    	RETURN 1;
    END IF;
  
END$$

DROP FUNCTION IF EXISTS `user_change_sex`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `user_change_sex`(uid INTEGER(11), usex TINYINT) RETURNS tinyint(4)
BEGIN
	SELECT COUNT(*) into @user_exist FROM `users_tech_info` WHERE `id`=uid LIMIT 1;
    
    IF @user_exist = 1 THEN
    
    	SELECT `online` into @user_online FROM `users_tech_info` WHERE `id`=uid LIMIT 1;
        
        IF @user_online = 1 THEN
        	UPDATE `users_info` SET `sex`=usex WHERE `id`=uid LIMIT 1;
        	RETURN 0;
        ELSE
        	RETURN 2;
        END IF;
    	
    ELSE
    	RETURN 1;
    END IF;
  
END$$

DROP FUNCTION IF EXISTS `user_change_text`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `user_change_text`(uid INTEGER(11), utext TEXT) RETURNS tinyint(4)
BEGIN
	SELECT COUNT(*) into @user_exist FROM `users_tech_info` WHERE `id`=uid LIMIT 1;
    
    IF @user_exist = 1 THEN
    
    	SELECT `online` into @user_online FROM `users_tech_info` WHERE `id`=uid LIMIT 1;
        
        IF @user_online = 1 THEN
        	UPDATE `users_info` SET `text`=utext WHERE `id`=uid LIMIT 1;
        	RETURN 0;
        ELSE
        	RETURN 2;
        END IF;
    	
    ELSE
    	RETURN 1;
    END IF;
  
END$$

DROP FUNCTION IF EXISTS `user_change_town`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `user_change_town`(uid INTEGER(11), utown INTEGER(11)) RETURNS tinyint(4)
BEGIN
	SELECT COUNT(*) into @user_exist FROM `users_tech_info` WHERE `id`=uid LIMIT 1;
    
    IF @user_exist = 1 THEN
    
    	SELECT `online` into @user_online FROM `users_tech_info` WHERE `id`=uid LIMIT 1;
        
        IF @user_online = 1 THEN
        	UPDATE `users_info` SET `town`=utown WHERE `id`=uid LIMIT 1;
        	RETURN 0;
        ELSE
        	RETURN 2;
        END IF;
    	
    ELSE
    	RETURN 1;
    END IF;
  
END$$

DROP FUNCTION IF EXISTS `user_log_in`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `user_log_in`(umail CHAR(64), upas CHAR(32), usession char(32)) RETURNS char(32) CHARSET cp1251
BEGIN
	SELECT `id` into @uid FROM `users_info` WHERE `user_mail` like umail LIMIT 1;
	set @user_exist=ifnull(@uid,0);
    IF @user_exist>0 THEN
    	
    	SELECT `active`,`pass`,`last_login` into @act_info,@act_pass,@last_time FROM `users_tech_info` WHERE `id`=@uid LIMIT 1;
        
        IF @act_info=0 THEN
        	RETURN -3;
        END IF;
        
        IF @act_pass=upas THEN
			UPDATE `users_tech_info` SET `session`=usession,`online`=1,`last_login`=NOW() WHERE `id`=@uid LIMIT 1;
  			RETURN @uid;	
        ELSE
        	        	RETURN -2;
        END IF;
    ELSE
    	RETURN -1;
    END IF;

END$$

DROP FUNCTION IF EXISTS `user_log_out`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `user_log_out`(uid INTEGER(11)) RETURNS tinyint(4)
BEGIN
SELECT COUNT(*) into @user_exist FROM `users_tech_info` WHERE `id`=uid;

    IF @user_exist=1 THEN
    	
		UPDATE `users_tech_info` SET `session`=0,`online`=0 WHERE `id`=uid LIMIT 1;
  		RETURN 0; 
    ELSE
    	RETURN 1;
    END IF;
END$$

DROP FUNCTION IF EXISTS `user_new`$$
CREATE DEFINER=`a3797240_php_mx`@`localhost` FUNCTION `user_new`(uname CHAR(32), usecond CHAR(32), umail CHAR(64), upass CHAR(32)) RETURNS char(32) CHARSET cp1251
BEGIN
	SELECT COUNT(*) into @mail_exist FROM `users_info` WHERE `user_mail`=umail LIMIT 1;
    
    IF @mail_exist!=0 THEN 
    	RETURN 1;
    ELSE 
    	INSERT INTO `users_info` (`name`,`second_name`,`user_mail`,`created`) VALUES (uname,usecond,umail,CURDATE());
		SELECT `id` into @u_id FROM `users_info` WHERE `user_mail`=umail LIMIT 1;
        INSERT INTO `users_tech_info` (`id`,`pass`) VALUES (@u_id,md5(upass));
		INSERT INTO `playlist` (`name`,`user`) VALUES (0,@u_id);
        
        SET @code =MD5(concat('secret',umail));
		INSERT INTO `activation_info` (`user_id`,`activation_code`,`date`)
    	VALUES (@u_id ,@code,now());
  		RETURN @code;
    END IF;
END$$

DELIMITER ;
