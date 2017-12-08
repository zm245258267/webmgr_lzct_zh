/*
SQLyog Ultimate v11.22 (64 bit)
MySQL - 5.7.18-log : Database - lzct_gamedb
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`lzct_gamedb` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `lzct_gamedb`;

/*Table structure for table `game_chardesc` */

DROP TABLE IF EXISTS `game_chardesc`;

CREATE TABLE `game_chardesc` (
  `charid` bigint(20) NOT NULL COMMENT '角色ID',
  `spid` char(16) NOT NULL DEFAULT '' COMMENT '渠道ID',
  `sbid` char(16) NOT NULL DEFAULT '' COMMENT '子渠道ID',
  `userid` bigint(10) NOT NULL COMMENT '用户ID',
  `account` varchar(64) NOT NULL COMMENT '账号',
  `charname` varchar(48) NOT NULL COMMENT '角色名',
  `serverid` int(5) NOT NULL COMMENT '服务器ID',
  `charlevel` int(11) NOT NULL DEFAULT '0' COMMENT '角色等级',
  `gold` int(10) NOT NULL DEFAULT '0' COMMENT '元宝数',
  `guildid` bigint(20) NOT NULL DEFAULT '0' COMMENT '主线任务ID',
  `charstate` int(11) NOT NULL DEFAULT '0' COMMENT '角色状态',
  `createtime` datetime NOT NULL COMMENT '创角时间',
  `updatetime` datetime DEFAULT NULL COMMENT '最后更新时间',
  `loginip` varchar(48) DEFAULT NULL COMMENT '登陆IP',
  `viplv` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'VIP等级',
  `vipexp` int(11) NOT NULL DEFAULT '0' COMMENT 'VIP经验',
  `castlelevel` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '城堡等级',
  `countryid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '国家ID',
  `firstrechargetime` datetime DEFAULT NULL COMMENT '首充时间',
  `firstrechargelevel` int(11) NOT NULL DEFAULT '0' COMMENT '首充等级',
  `totalrecharge` int(11) NOT NULL DEFAULT '0' COMMENT '总充值金额',
  PRIMARY KEY (`charid`),
  UNIQUE KEY `charname` (`charname`),
  KEY `account` (`account`),
  KEY `createtime` (`createtime`),
  KEY `updatetime` (`updatetime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `game_chardesc` */

insert  into `game_chardesc`(`charid`,`spid`,`sbid`,`userid`,`account`,`charname`,`serverid`,`charlevel`,`gold`,`guildid`,`charstate`,`createtime`,`updatetime`,`loginip`,`viplv`,`vipexp`,`castlelevel`,`countryid`,`firstrechargetime`,`firstrechargelevel`,`totalrecharge`) values (960010001,'m-test-a','test1',0,'test1&m-test-a','测测1',99001,2,6699,1001,0,'2017-11-21 22:45:18','2017-11-21 22:45:21',NULL,0,0,2,0,NULL,0,0),(960010002,'m-test-a','test1',0,'test2&m-test-a','测测2',99001,3,5999,2001,0,'2017-11-21 22:45:18','2017-11-21 22:45:21',NULL,0,0,2,0,NULL,0,0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
