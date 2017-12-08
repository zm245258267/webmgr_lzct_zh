/*
SQLyog Ultimate v11.22 (64 bit)
MySQL - 5.7.18-log : Database - lzct_gamelog
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`lzct_gamelog` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `lzct_gamelog`;

/*Table structure for table `gamelog_99001_20171122` */

DROP TABLE IF EXISTS `gamelog_99001_20171122`;

CREATE TABLE `gamelog_99001_20171122` (
  `eventId` bigint(20) NOT NULL COMMENT '行为ID',
  `playerId` bigint(20) NOT NULL COMMENT '角色ID',
  `playerName` varchar(48) NOT NULL COMMENT '角色名',
  `playerAccount` varchar(128) NOT NULL COMMENT '账号',
  `castleLevel` int(11) NOT NULL DEFAULT '0' COMMENT '城堡等级',
  `countryId` int(11) NOT NULL DEFAULT '0' COMMENT '国家ID',
  `viplv` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'VIP等级',
  `charlevel` int(11) NOT NULL DEFAULT '0' COMMENT '角色等级',
  `targetId` bigint(20) DEFAULT NULL COMMENT '目标ID',
  `targetName` varchar(48) DEFAULT NULL COMMENT '目标名',
  `field1` varchar(128) DEFAULT NULL COMMENT '数据1',
  `field2` varchar(128) DEFAULT NULL COMMENT '数据2',
  `field3` varchar(128) DEFAULT NULL COMMENT '数据3',
  `field4` varchar(128) DEFAULT NULL COMMENT '数据4',
  `field5` varchar(128) DEFAULT NULL COMMENT '数据5',
  `field6` varchar(128) DEFAULT NULL COMMENT '数据6',
  `field7` varchar(128) DEFAULT NULL COMMENT '数据7',
  `field8` varchar(128) DEFAULT NULL COMMENT '数据8',
  `field9` varchar(128) DEFAULT NULL COMMENT '数据9',
  `field10` varchar(128) DEFAULT NULL COMMENT '数据10',
  `spid` char(16) NOT NULL DEFAULT '' COMMENT '渠道ID',
  `sbid` char(16) NOT NULL DEFAULT '' COMMENT '子渠道ID',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '日志时间',
  KEY `playerId` (`playerId`),
  KEY `playerName` (`playerName`),
  KEY `time` (`time`,`playerId`),
  KEY `time_2` (`time`,`playerName`),
  KEY `eventId` (`eventId`,`playerId`),
  KEY `eventId_2` (`eventId`,`playerName`),
  KEY `spid` (`spid`,`sbid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `gamelog_99001_20171122` */

insert  into `gamelog_99001_20171122`(`eventId`,`playerId`,`playerName`,`playerAccount`,`castleLevel`,`countryId`,`viplv`,`charlevel`,`targetId`,`targetName`,`field1`,`field2`,`field3`,`field4`,`field5`,`field6`,`field7`,`field8`,`field9`,`field10`,`spid`,`sbid`,`time`) values (1,201711220001,'testrole1','testaccount1&m-test-a',9,1,0,9,NULL,NULL,'192.168.0.1','ff:ff:ff:ff:ff',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','2017-11-22 22:08:46'),(1,201711220001,'testrole1','testaccount1&m-test-a',9,1,0,9,NULL,NULL,'192.168.0.1','ff:ff:ff:ff:ff',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','2017-11-22 22:08:46');

/*Table structure for table `gamelog_99001_20171123` */

DROP TABLE IF EXISTS `gamelog_99001_20171123`;

CREATE TABLE `gamelog_99001_20171123` (
  `eventId` bigint(20) NOT NULL COMMENT '行为ID',
  `playerId` bigint(20) NOT NULL COMMENT '角色ID',
  `playerName` varchar(48) NOT NULL COMMENT '角色名',
  `playerAccount` varchar(128) NOT NULL COMMENT '账号',
  `castleLevel` int(11) NOT NULL DEFAULT '0' COMMENT '城堡等级',
  `countryId` int(11) NOT NULL DEFAULT '0' COMMENT '国家ID',
  `viplv` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'VIP等级',
  `charlevel` int(11) NOT NULL DEFAULT '0' COMMENT '角色等级',
  `targetId` bigint(20) DEFAULT NULL COMMENT '目标ID',
  `targetName` varchar(48) DEFAULT NULL COMMENT '目标名',
  `field1` varchar(128) DEFAULT NULL COMMENT '数据1',
  `field2` varchar(128) DEFAULT NULL COMMENT '数据2',
  `field3` varchar(128) DEFAULT NULL COMMENT '数据3',
  `field4` varchar(128) DEFAULT NULL COMMENT '数据4',
  `field5` varchar(128) DEFAULT NULL COMMENT '数据5',
  `field6` varchar(128) DEFAULT NULL COMMENT '数据6',
  `field7` varchar(128) DEFAULT NULL COMMENT '数据7',
  `field8` varchar(128) DEFAULT NULL COMMENT '数据8',
  `field9` varchar(128) DEFAULT NULL COMMENT '数据9',
  `field10` varchar(128) DEFAULT NULL COMMENT '数据10',
  `spid` char(16) NOT NULL DEFAULT '' COMMENT '渠道ID',
  `sbid` char(16) NOT NULL DEFAULT '' COMMENT '子渠道ID',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '日志时间',
  KEY `playerId` (`playerId`),
  KEY `playerName` (`playerName`),
  KEY `time` (`time`,`playerId`),
  KEY `time_2` (`time`,`playerName`),
  KEY `eventId` (`eventId`,`playerId`),
  KEY `eventId_2` (`eventId`,`playerName`),
  KEY `spid` (`spid`,`sbid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `gamelog_99001_20171123` */

insert  into `gamelog_99001_20171123`(`eventId`,`playerId`,`playerName`,`playerAccount`,`castleLevel`,`countryId`,`viplv`,`charlevel`,`targetId`,`targetName`,`field1`,`field2`,`field3`,`field4`,`field5`,`field6`,`field7`,`field8`,`field9`,`field10`,`spid`,`sbid`,`time`) values (1,201711220001,'testrole1','testaccount1&m-test-a',9,1,0,9,NULL,NULL,'192.168.0.1','ff:ff:ff:ff:ff',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','2017-11-23 22:08:46');

/*Table structure for table `gamelog_99001_20171130` */

DROP TABLE IF EXISTS `gamelog_99001_20171130`;

CREATE TABLE `gamelog_99001_20171130` (
  `eventId` bigint(20) NOT NULL COMMENT '行为ID',
  `playerId` bigint(20) NOT NULL COMMENT '角色ID',
  `playerName` varchar(48) NOT NULL COMMENT '角色名',
  `playerAccount` varchar(128) NOT NULL COMMENT '账号',
  `castleLevel` int(11) NOT NULL DEFAULT '0' COMMENT '城堡等级',
  `countryId` int(11) NOT NULL DEFAULT '0' COMMENT '国家ID',
  `viplv` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'VIP等级',
  `charlevel` int(11) NOT NULL DEFAULT '0' COMMENT '角色等级',
  `targetId` bigint(20) DEFAULT NULL COMMENT '目标ID',
  `targetName` varchar(48) DEFAULT NULL COMMENT '目标名',
  `field1` varchar(128) DEFAULT NULL COMMENT '数据1',
  `field2` varchar(128) DEFAULT NULL COMMENT '数据2',
  `field3` varchar(128) DEFAULT NULL COMMENT '数据3',
  `field4` varchar(128) DEFAULT NULL COMMENT '数据4',
  `field5` varchar(128) DEFAULT NULL COMMENT '数据5',
  `field6` varchar(128) DEFAULT NULL COMMENT '数据6',
  `field7` varchar(128) DEFAULT NULL COMMENT '数据7',
  `field8` varchar(128) DEFAULT NULL COMMENT '数据8',
  `field9` varchar(128) DEFAULT NULL COMMENT '数据9',
  `field10` varchar(128) DEFAULT NULL COMMENT '数据10',
  `spid` char(16) NOT NULL DEFAULT '' COMMENT '渠道ID',
  `sbid` char(16) NOT NULL DEFAULT '' COMMENT '子渠道ID',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '日志时间',
  KEY `playerId` (`playerId`),
  KEY `playerName` (`playerName`),
  KEY `time` (`time`,`playerId`),
  KEY `time_2` (`time`,`playerName`),
  KEY `eventId` (`eventId`,`playerId`),
  KEY `eventId_2` (`eventId`,`playerName`),
  KEY `spid` (`spid`,`sbid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `gamelog_99001_20171130` */

/*!50106 set global event_scheduler = 1*/;

/* Event structure for event `eve_create_gamelog_table_901` */

/*!50106 DROP EVENT IF EXISTS `eve_create_gamelog_table_901`*/;

DELIMITER $$

/*!50106 CREATE DEFINER=`root`@`localhost` EVENT `eve_create_gamelog_table_901` ON SCHEDULE EVERY 1 DAY STARTS '2017-11-20 22:00:00' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
	    call `proc_create_gamelog_table`(concat('gamelog_99001_',date_format(adddate(curdate(),interval 1 day),'%Y%m%d')));
	END */$$
DELIMITER ;

/* Procedure structure for procedure `proc_create_gamelog_table` */

/*!50003 DROP PROCEDURE IF EXISTS  `proc_create_gamelog_table` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_create_gamelog_table`(in _tb char(32) CHARACTER SET utf8)
    SQL SECURITY INVOKER
BEGIN    
    SET @_sql=CONCAT("CREATE TABLE IF NOT EXISTS `",_tb,"` (
  `eventId` bigint(20) NOT NULL COMMENT '行为ID',
  `playerId` bigint(20) NOT NULL COMMENT '角色ID',
  `playerName` varchar(48) NOT NULL COMMENT '角色名',
  `playerAccount` varchar(128) NOT NULL COMMENT '账号',
  `castleLevel` int(11) NOT NULL DEFAULT '0' COMMENT '城堡等级',
  `countryId` int(11) NOT NULL DEFAULT '0' COMMENT '国家ID',
  `viplv` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'VIP等级',
  `charlevel` int(11) NOT NULL DEFAULT '0' COMMENT '角色等级',
  `targetId` bigint(20) DEFAULT NULL COMMENT '目标ID',
  `targetName` varchar(48) DEFAULT NULL COMMENT '目标名',
  `field1` varchar(128) DEFAULT NULL COMMENT '数据1',
  `field2` varchar(128) DEFAULT NULL COMMENT '数据2',
  `field3` varchar(128) DEFAULT NULL COMMENT '数据3',
  `field4` varchar(128) DEFAULT NULL COMMENT '数据4',
  `field5` varchar(128) DEFAULT NULL COMMENT '数据5',
  `field6` varchar(128) DEFAULT NULL COMMENT '数据6',
  `field7` varchar(128) DEFAULT NULL COMMENT '数据7',
  `field8` varchar(128) DEFAULT NULL COMMENT '数据8',
  `field9` varchar(128) DEFAULT NULL COMMENT '数据9',
  `field10` varchar(128) DEFAULT NULL COMMENT '数据10',
  `spid` char(16) NOT NULL DEFAULT '' COMMENT '渠道ID',
  `sbid` char(16) NOT NULL DEFAULT '' COMMENT '子渠道ID',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '日志时间',
  KEY `playerId` (`playerId`),
  KEY `playerName` (`playerName`),
  KEY `time` (`time`,`playerId`),
  KEY `time_2` (`time`,`playerName`),
  KEY `eventId` (`eventId`,`playerId`),
  KEY `eventId_2` (`eventId`,`playerName`),
  KEY `spid` (`spid`,`sbid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8
");    
    PREPARE _presql FROM @_sql;
    EXECUTE _presql;
    DEALLOCATE PREPARE _presql;   
    END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
