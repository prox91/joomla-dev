CREATE DATABASE  IF NOT EXISTS `vnsoftskills` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `vnsoftskills`;
-- MySQL dump 10.13  Distrib 5.5.16, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: vnsoftskills
-- ------------------------------------------------------
-- Server version	5.5.27

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `d3sgo_assets`
--

DROP TABLE IF EXISTS `d3sgo_assets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_assets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set parent.',
  `lft` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set lft.',
  `rgt` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set rgt.',
  `level` int(10) unsigned NOT NULL COMMENT 'The cached level in the nested tree.',
  `name` varchar(50) NOT NULL COMMENT 'The unique name for the asset.\n',
  `title` varchar(100) NOT NULL COMMENT 'The descriptive title for the asset.',
  `rules` varchar(5120) NOT NULL COMMENT 'JSON encoded access control.',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_asset_name` (`name`),
  KEY `idx_lft_rgt` (`lft`,`rgt`),
  KEY `idx_parent_id` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_assets`
--

LOCK TABLES `d3sgo_assets` WRITE;
/*!40000 ALTER TABLE `d3sgo_assets` DISABLE KEYS */;
INSERT INTO `d3sgo_assets` VALUES (1,0,1,81,0,'root.1','Root Asset','{\"core.login.site\":{\"6\":1,\"2\":1},\"core.login.admin\":{\"6\":1},\"core.login.offline\":{\"6\":1},\"core.admin\":{\"8\":1},\"core.manage\":{\"7\":1},\"core.create\":{\"6\":1,\"3\":1},\"core.delete\":{\"6\":1},\"core.edit\":{\"6\":1,\"4\":1},\"core.edit.state\":{\"6\":1,\"5\":1},\"core.edit.own\":{\"6\":1,\"3\":1}}'),(2,1,1,2,1,'com_admin','com_admin','{}'),(3,1,3,6,1,'com_banners','com_banners','{\"core.admin\":{\"7\":1},\"core.manage\":{\"6\":1},\"core.create\":[],\"core.delete\":[],\"core.edit\":[],\"core.edit.state\":[]}'),(4,1,7,8,1,'com_cache','com_cache','{\"core.admin\":{\"7\":1},\"core.manage\":{\"7\":1}}'),(5,1,9,10,1,'com_checkin','com_checkin','{\"core.admin\":{\"7\":1},\"core.manage\":{\"7\":1}}'),(6,1,11,12,1,'com_config','com_config','{}'),(7,1,13,16,1,'com_contact','com_contact','{\"core.admin\":{\"7\":1},\"core.manage\":{\"6\":1},\"core.create\":[],\"core.delete\":[],\"core.edit\":[],\"core.edit.state\":[],\"core.edit.own\":[]}'),(8,1,17,30,1,'com_content','com_content','{\"core.admin\":{\"7\":1},\"core.manage\":{\"6\":1},\"core.create\":{\"3\":1},\"core.delete\":[],\"core.edit\":{\"4\":1},\"core.edit.state\":{\"5\":1},\"core.edit.own\":[]}'),(9,1,31,32,1,'com_cpanel','com_cpanel','{}'),(10,1,33,34,1,'com_installer','com_installer','{\"core.admin\":[],\"core.manage\":{\"7\":0},\"core.delete\":{\"7\":0},\"core.edit.state\":{\"7\":0}}'),(11,1,35,36,1,'com_languages','com_languages','{\"core.admin\":{\"7\":1},\"core.manage\":[],\"core.create\":[],\"core.delete\":[],\"core.edit\":[],\"core.edit.state\":[]}'),(12,1,37,38,1,'com_login','com_login','{}'),(13,1,39,40,1,'com_mailto','com_mailto','{}'),(14,1,41,42,1,'com_massmail','com_massmail','{}'),(15,1,43,44,1,'com_media','com_media','{\"core.admin\":{\"7\":1},\"core.manage\":{\"6\":1},\"core.create\":{\"3\":1},\"core.delete\":{\"5\":1}}'),(16,1,45,46,1,'com_menus','com_menus','{\"core.admin\":{\"7\":1},\"core.manage\":[],\"core.create\":[],\"core.delete\":[],\"core.edit\":[],\"core.edit.state\":[]}'),(17,1,47,48,1,'com_messages','com_messages','{\"core.admin\":{\"7\":1},\"core.manage\":{\"7\":1}}'),(18,1,49,50,1,'com_modules','com_modules','{\"core.admin\":{\"7\":1},\"core.manage\":[],\"core.create\":[],\"core.delete\":[],\"core.edit\":[],\"core.edit.state\":[]}'),(19,1,51,54,1,'com_newsfeeds','com_newsfeeds','{\"core.admin\":{\"7\":1},\"core.manage\":{\"6\":1},\"core.create\":[],\"core.delete\":[],\"core.edit\":[],\"core.edit.state\":[],\"core.edit.own\":[]}'),(20,1,55,56,1,'com_plugins','com_plugins','{\"core.admin\":{\"7\":1},\"core.manage\":[],\"core.edit\":[],\"core.edit.state\":[]}'),(21,1,57,58,1,'com_redirect','com_redirect','{\"core.admin\":{\"7\":1},\"core.manage\":[]}'),(22,1,59,60,1,'com_search','com_search','{\"core.admin\":{\"7\":1},\"core.manage\":{\"6\":1}}'),(23,1,61,62,1,'com_templates','com_templates','{\"core.admin\":{\"7\":1},\"core.manage\":[],\"core.create\":[],\"core.delete\":[],\"core.edit\":[],\"core.edit.state\":[]}'),(24,1,63,66,1,'com_users','com_users','{\"core.admin\":{\"7\":1},\"core.manage\":[],\"core.create\":[],\"core.delete\":[],\"core.edit\":[],\"core.edit.state\":[]}'),(25,1,67,70,1,'com_weblinks','com_weblinks','{\"core.admin\":{\"7\":1},\"core.manage\":{\"6\":1},\"core.create\":{\"3\":1},\"core.delete\":[],\"core.edit\":{\"4\":1},\"core.edit.state\":{\"5\":1},\"core.edit.own\":[]}'),(26,1,71,72,1,'com_wrapper','com_wrapper','{}'),(27,8,18,29,2,'com_content.category.2','Uncategorised','{\"core.create\":[],\"core.delete\":[],\"core.edit\":[],\"core.edit.state\":[],\"core.edit.own\":[]}'),(28,3,4,5,2,'com_banners.category.3','Uncategorised','{\"core.create\":[],\"core.delete\":[],\"core.edit\":[],\"core.edit.state\":[]}'),(29,7,14,15,2,'com_contact.category.4','Uncategorised','{\"core.create\":[],\"core.delete\":[],\"core.edit\":[],\"core.edit.state\":[],\"core.edit.own\":[]}'),(30,19,52,53,2,'com_newsfeeds.category.5','Uncategorised','{\"core.create\":[],\"core.delete\":[],\"core.edit\":[],\"core.edit.state\":[],\"core.edit.own\":[]}'),(31,25,68,69,2,'com_weblinks.category.6','Uncategorised','{\"core.create\":[],\"core.delete\":[],\"core.edit\":[],\"core.edit.state\":[],\"core.edit.own\":[]}'),(32,24,64,65,1,'com_users.category.7','Uncategorised','{\"core.create\":[],\"core.delete\":[],\"core.edit\":[],\"core.edit.state\":[]}'),(33,1,73,74,1,'com_finder','com_finder','{\"core.admin\":{\"7\":1},\"core.manage\":{\"6\":1}}'),(34,1,75,76,1,'com_joomlaupdate','com_joomlaupdate','{\"core.admin\":[],\"core.manage\":[],\"core.delete\":[],\"core.edit.state\":[]}'),(35,1,77,78,1,'com_jce','jce','{}'),(36,27,19,20,3,'com_content.article.1','Kỹ năng mềm là gì?','{\"core.delete\":{\"6\":1},\"core.edit\":{\"6\":1,\"4\":1},\"core.edit.state\":{\"6\":1,\"5\":1}}'),(37,27,21,22,3,'com_content.article.2','Kỹ năng giải quyêt vấn đề','{\"core.delete\":{\"6\":1},\"core.edit\":{\"6\":1,\"4\":1},\"core.edit.state\":{\"6\":1,\"5\":1}}'),(38,1,79,80,1,'com_jcomments','jcomments','{}'),(39,27,23,24,3,'com_content.article.3','Bí quyết sáng tạo Đột phá','{\"core.delete\":{\"6\":1},\"core.edit\":{\"6\":1,\"4\":1},\"core.edit.state\":{\"6\":1,\"5\":1}}'),(40,27,25,26,3,'com_content.article.4','Marketing Online','{\"core.delete\":{\"6\":1},\"core.edit\":{\"6\":1,\"4\":1},\"core.edit.state\":{\"6\":1,\"5\":1}}'),(41,27,27,28,3,'com_content.article.5','Tiết kiệm 10% thu nhập mỗi tháng','{\"core.delete\":{\"6\":1},\"core.edit\":{\"6\":1,\"4\":1},\"core.edit.state\":{\"6\":1,\"5\":1}}');
/*!40000 ALTER TABLE `d3sgo_assets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_associations`
--

DROP TABLE IF EXISTS `d3sgo_associations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_associations` (
  `id` varchar(50) NOT NULL COMMENT 'A reference to the associated item.',
  `context` varchar(50) NOT NULL COMMENT 'The context of the associated item.',
  `key` char(32) NOT NULL COMMENT 'The key for the association computed from an md5 on associated ids.',
  PRIMARY KEY (`context`,`id`),
  KEY `idx_key` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_associations`
--

LOCK TABLES `d3sgo_associations` WRITE;
/*!40000 ALTER TABLE `d3sgo_associations` DISABLE KEYS */;
/*!40000 ALTER TABLE `d3sgo_associations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_banner_clients`
--

DROP TABLE IF EXISTS `d3sgo_banner_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_banner_clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `contact` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `extrainfo` text NOT NULL,
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `metakey` text NOT NULL,
  `own_prefix` tinyint(4) NOT NULL DEFAULT '0',
  `metakey_prefix` varchar(255) NOT NULL DEFAULT '',
  `purchase_type` tinyint(4) NOT NULL DEFAULT '-1',
  `track_clicks` tinyint(4) NOT NULL DEFAULT '-1',
  `track_impressions` tinyint(4) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`id`),
  KEY `idx_own_prefix` (`own_prefix`),
  KEY `idx_metakey_prefix` (`metakey_prefix`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_banner_clients`
--

LOCK TABLES `d3sgo_banner_clients` WRITE;
/*!40000 ALTER TABLE `d3sgo_banner_clients` DISABLE KEYS */;
/*!40000 ALTER TABLE `d3sgo_banner_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_banner_tracks`
--

DROP TABLE IF EXISTS `d3sgo_banner_tracks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_banner_tracks` (
  `track_date` datetime NOT NULL,
  `track_type` int(10) unsigned NOT NULL,
  `banner_id` int(10) unsigned NOT NULL,
  `count` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`track_date`,`track_type`,`banner_id`),
  KEY `idx_track_date` (`track_date`),
  KEY `idx_track_type` (`track_type`),
  KEY `idx_banner_id` (`banner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_banner_tracks`
--

LOCK TABLES `d3sgo_banner_tracks` WRITE;
/*!40000 ALTER TABLE `d3sgo_banner_tracks` DISABLE KEYS */;
/*!40000 ALTER TABLE `d3sgo_banner_tracks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_banners`
--

DROP TABLE IF EXISTS `d3sgo_banners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `imptotal` int(11) NOT NULL DEFAULT '0',
  `impmade` int(11) NOT NULL DEFAULT '0',
  `clicks` int(11) NOT NULL DEFAULT '0',
  `clickurl` varchar(200) NOT NULL DEFAULT '',
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `catid` int(10) unsigned NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `custombannercode` varchar(2048) NOT NULL,
  `sticky` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `params` text NOT NULL,
  `own_prefix` tinyint(1) NOT NULL DEFAULT '0',
  `metakey_prefix` varchar(255) NOT NULL DEFAULT '',
  `purchase_type` tinyint(4) NOT NULL DEFAULT '-1',
  `track_clicks` tinyint(4) NOT NULL DEFAULT '-1',
  `track_impressions` tinyint(4) NOT NULL DEFAULT '-1',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `reset` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `language` char(7) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `idx_state` (`state`),
  KEY `idx_own_prefix` (`own_prefix`),
  KEY `idx_metakey_prefix` (`metakey_prefix`),
  KEY `idx_banner_catid` (`catid`),
  KEY `idx_language` (`language`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_banners`
--

LOCK TABLES `d3sgo_banners` WRITE;
/*!40000 ALTER TABLE `d3sgo_banners` DISABLE KEYS */;
/*!40000 ALTER TABLE `d3sgo_banners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_categories`
--

DROP TABLE IF EXISTS `d3sgo_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asset_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'FK to the #__assets table.',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0',
  `lft` int(11) NOT NULL DEFAULT '0',
  `rgt` int(11) NOT NULL DEFAULT '0',
  `level` int(10) unsigned NOT NULL DEFAULT '0',
  `path` varchar(255) NOT NULL DEFAULT '',
  `extension` varchar(50) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `note` varchar(255) NOT NULL DEFAULT '',
  `description` mediumtext NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `access` int(10) unsigned NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  `metadesc` varchar(1024) NOT NULL COMMENT 'The meta description for the page.',
  `metakey` varchar(1024) NOT NULL COMMENT 'The meta keywords for the page.',
  `metadata` varchar(2048) NOT NULL COMMENT 'JSON encoded metadata properties.',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `created_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `language` char(7) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cat_idx` (`extension`,`published`,`access`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_path` (`path`),
  KEY `idx_left_right` (`lft`,`rgt`),
  KEY `idx_alias` (`alias`),
  KEY `idx_language` (`language`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_categories`
--

LOCK TABLES `d3sgo_categories` WRITE;
/*!40000 ALTER TABLE `d3sgo_categories` DISABLE KEYS */;
INSERT INTO `d3sgo_categories` VALUES (1,0,0,0,13,0,'','system','ROOT','root','','',1,0,'0000-00-00 00:00:00',1,'{}','','','',0,'2009-10-18 16:07:09',0,'0000-00-00 00:00:00',0,'*'),(2,27,1,1,2,1,'uncategorised','com_content','Uncategorised','uncategorised','','',1,0,'0000-00-00 00:00:00',1,'{\"target\":\"\",\"image\":\"\"}','','','{\"page_title\":\"\",\"author\":\"\",\"robots\":\"\"}',42,'2010-06-28 13:26:37',0,'0000-00-00 00:00:00',0,'*'),(3,28,1,3,4,1,'uncategorised','com_banners','Uncategorised','uncategorised','','',1,0,'0000-00-00 00:00:00',1,'{\"target\":\"\",\"image\":\"\",\"foobar\":\"\"}','','','{\"page_title\":\"\",\"author\":\"\",\"robots\":\"\"}',42,'2010-06-28 13:27:35',0,'0000-00-00 00:00:00',0,'*'),(4,29,1,5,6,1,'uncategorised','com_contact','Uncategorised','uncategorised','','',1,0,'0000-00-00 00:00:00',1,'{\"target\":\"\",\"image\":\"\"}','','','{\"page_title\":\"\",\"author\":\"\",\"robots\":\"\"}',42,'2010-06-28 13:27:57',0,'0000-00-00 00:00:00',0,'*'),(5,30,1,7,8,1,'uncategorised','com_newsfeeds','Uncategorised','uncategorised','','',1,0,'0000-00-00 00:00:00',1,'{\"target\":\"\",\"image\":\"\"}','','','{\"page_title\":\"\",\"author\":\"\",\"robots\":\"\"}',42,'2010-06-28 13:28:15',0,'0000-00-00 00:00:00',0,'*'),(6,31,1,9,10,1,'uncategorised','com_weblinks','Uncategorised','uncategorised','','',1,0,'0000-00-00 00:00:00',1,'{\"target\":\"\",\"image\":\"\"}','','','{\"page_title\":\"\",\"author\":\"\",\"robots\":\"\"}',42,'2010-06-28 13:28:33',0,'0000-00-00 00:00:00',0,'*'),(7,32,1,11,12,1,'uncategorised','com_users','Uncategorised','uncategorised','','',1,0,'0000-00-00 00:00:00',1,'{\"target\":\"\",\"image\":\"\"}','','','{\"page_title\":\"\",\"author\":\"\",\"robots\":\"\"}',42,'2010-06-28 13:28:33',0,'0000-00-00 00:00:00',0,'*');
/*!40000 ALTER TABLE `d3sgo_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_contact_details`
--

DROP TABLE IF EXISTS `d3sgo_contact_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_contact_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `con_position` varchar(255) DEFAULT NULL,
  `address` text,
  `suburb` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `postcode` varchar(100) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `misc` mediumtext,
  `image` varchar(255) DEFAULT NULL,
  `imagepos` varchar(20) DEFAULT NULL,
  `email_to` varchar(255) DEFAULT NULL,
  `default_con` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `catid` int(11) NOT NULL DEFAULT '0',
  `access` int(10) unsigned NOT NULL DEFAULT '0',
  `mobile` varchar(255) NOT NULL DEFAULT '',
  `webpage` varchar(255) NOT NULL DEFAULT '',
  `sortname1` varchar(255) NOT NULL,
  `sortname2` varchar(255) NOT NULL,
  `sortname3` varchar(255) NOT NULL,
  `language` char(7) NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `metadata` text NOT NULL,
  `featured` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Set if article is featured.',
  `xreference` varchar(50) NOT NULL COMMENT 'A reference to enable linkages to external data sets.',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_state` (`published`),
  KEY `idx_catid` (`catid`),
  KEY `idx_createdby` (`created_by`),
  KEY `idx_featured_catid` (`featured`,`catid`),
  KEY `idx_language` (`language`),
  KEY `idx_xreference` (`xreference`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_contact_details`
--

LOCK TABLES `d3sgo_contact_details` WRITE;
/*!40000 ALTER TABLE `d3sgo_contact_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `d3sgo_contact_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_content`
--

DROP TABLE IF EXISTS `d3sgo_content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_content` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `asset_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'FK to the #__assets table.',
  `title` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `title_alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT 'Deprecated in Joomla! 3.0',
  `introtext` mediumtext NOT NULL,
  `fulltext` mediumtext NOT NULL,
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `sectionid` int(10) unsigned NOT NULL DEFAULT '0',
  `mask` int(10) unsigned NOT NULL DEFAULT '0',
  `catid` int(10) unsigned NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `images` text NOT NULL,
  `urls` text NOT NULL,
  `attribs` varchar(5120) NOT NULL,
  `version` int(10) unsigned NOT NULL DEFAULT '1',
  `parentid` int(10) unsigned NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `access` int(10) unsigned NOT NULL DEFAULT '0',
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `metadata` text NOT NULL,
  `featured` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Set if article is featured.',
  `language` char(7) NOT NULL COMMENT 'The language code for the article.',
  `xreference` varchar(50) NOT NULL COMMENT 'A reference to enable linkages to external data sets.',
  PRIMARY KEY (`id`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_state` (`state`),
  KEY `idx_catid` (`catid`),
  KEY `idx_createdby` (`created_by`),
  KEY `idx_featured_catid` (`featured`,`catid`),
  KEY `idx_language` (`language`),
  KEY `idx_xreference` (`xreference`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_content`
--

LOCK TABLES `d3sgo_content` WRITE;
/*!40000 ALTER TABLE `d3sgo_content` DISABLE KEYS */;
INSERT INTO `d3sgo_content` VALUES (1,36,'Kỹ năng mềm là gì?','ky-nang-mem-la-gi','','<p><strong>Kỹ năng mềm</strong>(hay còn gọi là Kỹ năng thực hành xã hội) là thuật ngữ dùng để chỉ các <span class=\"new\">kỹ năng</span> quan trọng trong cuộc sống con người như: kỹ năng sống, giao tiếp, lãnh đạo, làm việc theo nhóm, kỹ năng quản lý thời gian, thư giãn, vượt qua khủng hoảng, sáng tạo và đổi mới...</p>\r\n<p>Kỹ năng mềm khác với <span class=\"new\">kỹ năng cứng</span> để chỉ <span class=\"new\">trình độ chuyên môn</span>, kiến thức chuyên môn hay <span class=\"new\">bằng cấp</span> và <span class=\"new\">chứng chỉ</span> chuyên môn.</p>\r\n<p>Thực tế cho thấy người thành đạt chỉ có 25% là do những kiến thức chuyên môn, 75% còn lại được quyết định bởi những kỹ năng mềm họ được trang bị.</p>\r\n<p>Kỹ năng “mềm” chủ yếu là những kỹ năng thuộc về tính cách con người, không mang tính chuyên môn, không thể sờ nắm, không phải là kỹ năng cá tính đặc biệt, chúng quyết định khả năng bạn có thể trở thành nhà lãnh đạo, thính giả, nhà thương thuyết hay người hòa giải xung đột. Những kỹ năng “cứng” ở nghĩa trái ngược thường xuất hiện trên bản lý lịch-khả năng học vấn của bạn, kinh nghiệm và sự thành thạo về chuyên môn.</p>','',1,0,0,2,'2013-05-17 22:07:27',732,'admin','2013-05-17 15:25:44',732,0,'0000-00-00 00:00:00','2013-05-17 15:25:44','0000-00-00 00:00:00','{\"image_intro\":\"\",\"float_intro\":\"\",\"image_intro_alt\":\"\",\"image_intro_caption\":\"\",\"image_fulltext\":\"\",\"float_fulltext\":\"\",\"image_fulltext_alt\":\"\",\"image_fulltext_caption\":\"\"}','{\"urla\":null,\"urlatext\":\"\",\"targeta\":\"\",\"urlb\":null,\"urlbtext\":\"\",\"targetb\":\"\",\"urlc\":null,\"urlctext\":\"\",\"targetc\":\"\"}','{\"show_title\":\"\",\"link_titles\":\"\",\"show_intro\":\"\",\"show_category\":\"\",\"link_category\":\"\",\"show_parent_category\":\"\",\"link_parent_category\":\"\",\"show_author\":\"\",\"link_author\":\"\",\"show_create_date\":\"\",\"show_modify_date\":\"\",\"show_publish_date\":\"\",\"show_item_navigation\":\"\",\"show_icons\":\"\",\"show_print_icon\":\"\",\"show_email_icon\":\"\",\"show_vote\":\"\",\"show_hits\":\"\",\"show_noauth\":\"\",\"urls_position\":\"\",\"alternative_readmore\":\"\",\"article_layout\":\"\",\"show_publishing_options\":\"\",\"show_article_options\":\"\",\"show_urls_images_backend\":\"\",\"show_urls_images_frontend\":\"\"}',2,0,4,'','',1,22,'{\"robots\":\"\",\"author\":\"\",\"rights\":\"\",\"xreference\":\"\"}',0,'*',''),(2,37,'Kỹ năng giải quyêt vấn đề','ky-nang-giai-quyet-van-de','','<p align=\"justify\"><span style=\"font-size: small;\">Là một nhà quản lý, hàng ngày bạn phải tiếp cận và xử lý vô vàn những vấn đề trong công việc, trong gia đình và ngoài xã hội. Có bao giờ bạn thấy mệt mỏi và bị <strong>stress</strong> vì cứ phải gặp những vấn đề lặp đi lặp lại, từ những vụ việc đơn giản đến phức tạp? Nếu bạn đã và đang trong hoàn cảnh vừa nêu, thì đã đến lúc bạn phải nhìn lại mình và hãy trang bị cho mình <span style=\"color: #0000ff;\">kỹ năng giải quyết vấn đề</span> cần thiết của một nhà quản lý.<br /> </span></p>\r\n<p> </p>\r\n<p align=\"justify\"><span style=\"font-size: small;\">Trong thời buổi hội nhập kinh tế hiện nay, thị trường không ngừng thay đổi, tạo ra một áp lực cho nhà quản lý phải đối phó với các vấn đề muôn hình vạn trạng và thường là trong tình thế khẩn trương. Chính tình thế khẩn trương này làm cho nhà quản lý nhiều khi đưa ra những quyết định thiếu sáng suốt có khi lại là những sai lầm nghiêm trọng.<br /> </span></p>\r\n<p> </p>\r\n<p align=\"justify\"><span style=\"font-size: small;\">Điều này không những ảnh hưởng lớn đến quá trình kinh doanh mà còn kéo theo sự lo lắng, hoài nghi của nhiều người khác, thậm chí làm nảy sinh hàng loạt vấn đề khác mà hậu quả của nó thì khó ai có thể lường trước được.<br /> Nhằm giúp nhà quản lý tháo gỡ vướng mắc này, chúng tôi xin chia sẻ<span style=\"font-size: small;\"> <strong>6 giai <span style=\"font-size: small;\">đo<span style=\"font-size: small;\">ạn</span></span></strong></span><strong> căn bản trong việc giải quyết vấn đề</strong> dưới đây.<br /> </span></p>\r\n<p> </p>\r\n<p align=\"justify\"><span style=\"font-size: small;\"><span style=\"color: #009900;\"><strong>1. Nhận ra vấn đề:</strong></span><br /> Trước khi bạn cố tìm hướng giải quyết vấn đề, bạn nên xem xét kỹ đó có thật sự là vấn đề đúng nghĩa hay không, bằng cách tự hỏi: chuyện gì sẽ xảy ra nếu...?, giả sử như việc này không thực hiện được thì...?, Bạn không nên lãng phí thời gian và sức lực vào giải quyết nếu nó có khả năng tự biến mất hoặc không quan trọng.</span></p>\r\n<p> </p>\r\n<p align=\"justify\"><span style=\"font-size: small;\"><strong><span style=\"color: #009900;\">2. Xác định chủ sở hữu của vấn đề:</span></strong><br /> Không phải tất cả các vấn đề có ảnh hưởng đến bạn đều do bạn tạo ra hoặc bắt buộc bạn phải giải quyết. Nếu bạn không có quyền hạn hay năng lực để giải quyết nó, cách tốt nhất là chuyển vấn đề đó sang cho người nào có <span style=\"color: #0000ff;\">khả năng giải quyết</span>. Có một câu nói nửa đùa nửa thật nhưng cũng đáng để bạn lưu ý: <strong><em>“Nhiệt tình cộng với thiếu hiểu biết đôi khi thành phá hoại”</em></strong>.<br /> </span></p>\r\n<p> </p>\r\n<p align=\"justify\"><span style=\"font-size: small;\"><span style=\"color: #009900;\"><strong>3. Hiểu vấn đề:</strong></span><br /> Chưa hiểu rõ nguồn gốc của vấn đề sẽ dễ dẫn đến cách giải quyết sai lệch, hoặc vấn đề cứ lặp đi lặp lại. Nếu nói theo ngôn ngữ của y khoa, việc “bắt không đúng bệnh” thì chỉ trị triệu chứng, chứ không trị được bệnh, đôi khi “tiền mất, tật mang”. Bạn nên dành thời gian để lấy những thông tin cần thiết liên quan vấn đề cần giải quyết, theo gợi ý sau: Mô tả ngắn gọn vấn đề; nó đã gây ra ảnh hưởng gì?, vấn đề xảy ra ở đâu?, lần đầu tiên nó được phát hiện ra là khi nào?, Có gì đặc biệt hay khác biệt trong vấn đề này không?<br /> </span></p>\r\n<p> </p>\r\n<p align=\"justify\"><span style=\"font-size: small;\"><span style=\"color: #009900;\"><strong>4. Chọn giải pháp:</strong></span><br /> Sau khi đã tìm hiểu được cội rễ của vấn đề, nhà quản lý sẽ đưa ra được rất nhiều giải pháp để lựa chọn. Yếu tố sáng tạo sẽ giúp nhà quản lý tìm được giải pháp đôi khi hơn cả mong đợi. Cần lưu ý là một giải pháp tối ưu phải đáp ứng được ba yếu tố: có tác dụng khắc phục giải quyết vấn đề dài lâu, có tính khả thi, và có tính hiệu quả .<br /> </span></p>\r\n<p> </p>\r\n<p align=\"justify\"><span style=\"font-size: small;\"><span style=\"color: #009900;\"><strong>5. Thực thi giải pháp:</strong></span><br /> Khi bạn tin rằng mình đã hiểu được vấn đề và biết cách giải quyết nó, bạn có thể bắt tay vào hành động. Để đảm bảo các giải pháp được ứng dụng hiệu quả, nhà quản lý cần phải xác định ai là người có liên quan, ai là người chịu trách nhiệm chính trong việc thực hiện giải pháp, thời gian để thực hiện là bao lâu, những nguồn lực sẵn có nào có thể hỗ trợ trong việc giải quyết vấn đề đó…<br /> </span></p>\r\n<p> </p>\r\n<p align=\"justify\"><span style=\"font-size: small;\"><span style=\"color: #009900;\"><strong>6. Đánh giá:</strong></span><br /> Sau khi đã đưa vào thực hiện một giải pháp, bạn cần kiểm tra xem cách giải quyết đó có tốt không và có đưa tới những ảnh hưởng không mong đợi nào không. Những bài học rút ra được ở khâu đánh giá này sẽ giúp bạn giảm được rất nhiều “calori chất xám” và nguồn lực ở những vấn đề khác lần sau.<br /> </span></p>\r\n<p> </p>\r\n<p align=\"justify\"><span style=\"font-size: small;\">Có thể bạn sẽ cảm thấy hơi rườm rà nếu làm theo các bước trên “vạn sự khởi đầu nan, gian nan chớ có nản”. Lần đầu tiên áp dụng một kỹ năng mới bao giờ cũng đòi hỏi sự kiên nhẫn và quyết tâm của bạn. Nếu bạn thường xuyên rèn luyện, thì dần dần <span style=\"color: #0000ff;\">kỹ năng giải quyết vấn đề</span> sẽ trở thành phản xạ vô điều kiện.<br /> </span></p>\r\n<p> </p>\r\n<p align=\"justify\"><span style=\"font-size: small;\"><em>Và đừng quên hướng dẫn cho nhân viên của bạn về kỹ năngnày, vì họ chính là cánh tay phải giải quyết vấn đề khi bạn vắng mặt đấy!</em></span></p>','',1,0,0,2,'2013-05-17 22:44:00',732,'bngnha','0000-00-00 00:00:00',0,0,'0000-00-00 00:00:00','2013-05-17 15:46:19','0000-00-00 00:00:00','{\"image_intro\":\"\",\"float_intro\":\"\",\"image_intro_alt\":\"\",\"image_intro_caption\":\"\",\"image_fulltext\":\"\",\"float_fulltext\":\"\",\"image_fulltext_alt\":\"\",\"image_fulltext_caption\":\"\"}','{\"urla\":null,\"urlatext\":\"\",\"targeta\":\"\",\"urlb\":null,\"urlbtext\":\"\",\"targetb\":\"\",\"urlc\":null,\"urlctext\":\"\",\"targetc\":\"\"}','{\"show_title\":\"\",\"link_titles\":\"\",\"show_intro\":\"\",\"show_category\":\"\",\"link_category\":\"\",\"show_parent_category\":\"\",\"link_parent_category\":\"\",\"show_author\":\"\",\"link_author\":\"\",\"show_create_date\":\"\",\"show_modify_date\":\"\",\"show_publish_date\":\"\",\"show_item_navigation\":\"\",\"show_icons\":\"\",\"show_print_icon\":\"\",\"show_email_icon\":\"\",\"show_vote\":\"\",\"show_hits\":\"\",\"show_noauth\":\"\",\"urls_position\":\"\",\"alternative_readmore\":\"\",\"article_layout\":\"\",\"show_publishing_options\":\"\",\"show_article_options\":\"\",\"show_urls_images_backend\":\"\",\"show_urls_images_frontend\":\"\"}',1,0,3,'','',1,10,'{\"robots\":\"\",\"author\":\"\",\"rights\":\"\",\"xreference\":\"\"}',0,'*',''),(3,39,'Bí quyết sáng tạo Đột phá','bi-quyet-sang-tao-dot-pha','','<p align=\"justify\">Bạn đã từng nảy ra một ý tưởng? Nó làm bạn háo hức tới mức mất ăn mất ngủ? Bạn cảm thấy tràn ngập khí thế ngay cả lúc tắm? Bạn muốn thực hiện nó lắm… và bạn chia sẻ với 1 người, 2 người, 3 người… họ đều bảo nó phi “thực tế”.. Bạn bắt đầu nghĩ&nbsp; “hình như nó… viển vông”… bạn đấu tranh nội tâm ghê lắm… và ý tưởng đó hiện giờ đang nằm xó nào rồi nhỉ?</p>\r\n<p align=\"justify\">Nếu bạn đã từng rơi vào tình huống như trên, xin chúc mừng! Bạn có khả năng sáng tạo, vì ít nhất bạn cũng đã từng nghĩ ra một thứ gì đó mới mẻ! Và bạn đã đối mặt với thách thức phổ biến, những thứ “viển vông” thường có xu hướng bị… vùi dập bởi những bộ óc “thực tế”. Bản thân mình cũng đã trải nghiệm nhiều tình huống tương tự, những ý tưởng đưa ra được đánh giá khá thú vị, song khi qua màn kế hoạch thì thường phải ngậm ngùi nhường chỗ cho những ý tưởng “thực tế” hơn. Mình băn khoăn làm thế nào để tạo ra những ý tưởng đột phá, tức là không những thú vị mà còn khả thi?</p>\r\n<p align=\"justify\">Trong khi đang quay cuồng với mớ câu hỏi đó, cũng như những cảm xúc tiêu cực tạo ra vì một niềm tin rằng “mình rất phi thực tế”… thì gần đây một “cú đánh” đã khiến mình sực tỉnh! Trong cuốn sách “Cú đánh thức tỉnh trí Sáng tạo” nổi tiếng, Roger von Oech đã phang vào đầu mình hai câu chuyện có thực. Hai câu chuyện đã giúp mình nhận ra một “thực tế” ít ai biết, đó là : quá trình SÁNG TẠO đột phá hóa ra lại cần cả hai yếu tố: “viển vông” và “thực tế”.<br /> &nbsp;<br /> <strong>Câu chuyện thứ nhất</strong> kể về sơn tường nhà bạn. Nước sơn sau vài năm sẽ tróc ra và cần cạo đi để sơn mới, song việc cạo sơn khá vất vả. Một kỹ sư đã nảy ra một ý tưởng thú vị là trộn thuốc nổ vào sơn tường, sau đó muốn tróc ra hết thì chỉ một mồi lửa là xong! Rõ ràng là một ý tưởng phi thực tế, ngoài việc gây nguy hiểm ra thì cũng khỏi cần sơn luôn (có nguy cơ tường sập!). Song có một công ty đã nhìn vào khía cạnh tích cực của ý tưởng đó. Nó đã mở ra một hướng mới:&nbsp; “liệu có một cách nào đó khiến sơn tự động bong ra không?” và họ đã nghiên cứu ra được một chất phụ gia trộn vào sơn, khi có một chất phụ gia khác quết lên lớp sơn đó thì phản ứng hóa học sẽ khiến cho lớp sơn cũ bong ra! Như vậy là, một ý tưởng “viển vông” đã mở đường cho một phát minh “thực tế” thật tuyệt!</p>\r\n<p align=\"justify\"><strong>Câu chuyện thứ hai</strong> kể về một thành phố của Hà Lan từng gặp vấn đề rác thải, ban quản lý thành phố phải họp nhau lại và đưa ra nhiều giải pháp, từ việc tăng gấp đôi tiền phạt khi vứt rác không đúng quy định cho tới tăng số lượng người tuần tra để phát hiện vi phạm, song chỉ hiệu quả chút ít. Cuối cùng có người nảy ra ý tưởng “trả tiền cho những người nhặt rác bỏ vào thùng”, tất nhiên ý tưởng này là phi “thực tế” vì nếu làm như vậy chắc chắn thành phố sẽ phá sản.</p>\r\n<p align=\"justify\">Song nó đã mở ra một hướng mới là thay vì phạt người xả rác lung tung, hãy thưởng người chấp hành quy định. Và ban quản lý thành phố đã cho nghiên cứu phát triển một loại thùng rác điện tử, mỗi lần bạn bỏ rác vào nó lại phát ra một câu chuyện để chọc cười mọi người, tự đó thành phố sạch hẳn! Một ý tưởng “viển vông” đã lại mở đường cho một phát minh “thực tế” đầy ngoạn mục!</p>\r\n<p align=\"justify\"><strong>&nbsp;Khi bị “đánh” 2 cú liên tiếp</strong>, mình nhìn lại tất cả những lần chia sẻ ý tưởng trước đây và phát hiện ra một sai lầm phổ biến trong những cuộc thảo luận liên quan tới sáng tạo. Mặc dù trên bàn họp có thể có đủ những người hay đưa ra những ý tưởng “viển vông” và đủ những người có óc phân tích “thực tế”, đầy đủ cả 2 yếu tố đó chứ? Song vấn đề ở chỗ “viển vông” và “thực tế” là hai giai đoạn của quá trình Sáng tạo Đột phá song lại hay bị nhập làm một. Thế là người “viển vông” thì cố gắng bay lên cao, người “thực tế” thì cứ thế kéo xuống, hậu quả là lơ lửng tại chỗ, không đi tới đâu cả.<br /> &nbsp;<br /> Hoặc có những nhóm biết BrainStorm, dành 5-10 phút để viết ra mọi ý tưởng, sau đó bắt đầu đánh giá, chọn lựa song nhiều thì cũng chưa chắc đã có nhiều ý tưởng đột phá. Nguyên nhân ở chỗ nếu như họ không mắc sai lầm nhập hai quá trình “viển vông” và “thực tế” vào làm một, thì họ lại vô tình tách rời hai quá trình đó quá xa nhau mà không có sự kết nối. Thành ra sau khi “viển vông” đã đời với nhiều ý tưởng, thì trong quá trình “thực tế” họ tập trung loại bỏ những ý tưởng phi thực tế, thành ra cuối cùng tất nhiên kết quả là sẽ có những ý tưởng khá thực tế song không đột phá.</p>\r\n<p align=\"justify\">Vậy thì giải pháp ở đây là gì? Làm sao để Sáng tạo Đột phá? Kết hợp với nghiên cứu về sáng tạo của Roger Von, cùng với kinh nghiệm thực tế của bản thân, mình đã đúc rút ra một quy trình cực kì đơn giản và dễ nhớ giúp bạn và nhóm của bạn Sáng tạo Đột phá đó là :</p>\r\n<p align=\"justify\"><strong>Cần SÁNG TẠO, hãy SÁNG, rồi, TẠO</strong></p>\r\n<p align=\"justify\"><br /> Sáng tạo Đột phá là một quá trình bao gồm 4 giai đoạn rõ ràng.<br /> Giai đoạn “cần SÁNG TẠO”<br /> Một sáng kiến đột phá cần bắt nguồn từ một nhu cầu rõ ràng. Hãy làm rõ nhu cầu bằng cách viết ra tất cả những băn khoăn, những vấn đề cần giải quyết dưới dạng câu hỏi rõ ràng cho tất cả mọi người cùng nhìn thấy. Tôi đang cần giải quyết vấn đề gì cụ thể? Tôi đang băn khoăn điều gì cụ thể?<br /> &nbsp;<br /> <strong>Giai đoạn “hãy SÁNG”</strong><br /> Hãy nhớ không có gì là hoàn hảo, nên những ý tưởng mới đưa ra thường chưa hoàn thiện, song nó có thể là tia sáng cuối đường hầm, là cánh cửa mở ra một hướng đi hoàn toàn mới mà trước đó chưa ai từng khai phá. Do vậy, hãy trân trọng tất cả những ý tưởng đưa ra, dù là “viển vông” nhất.</p>\r\n<p align=\"justify\">Để có những ý tưởng khác biệt và “viển vông” nhất có thể, có một số mẹo nhỏ :</p>\r\n<p align=\"justify\"><em>1. Phân tích &amp; liên kết từ khóa (tham khảo Bí wyết Sáng tạo)</em><br /> <em>2. Nhập vai vào nhân vật khác và đặt câu hỏi. Ví dụ :</em><br /> - Một đứa nhóc 7 tuổi sẽ nghĩ những gì trong tình huống này?<br /> - Mr.Bean sẽ có những cách nào để giải quyết vấn đề này?<br /> - Một khách hàng khó tính sẽ nghĩ những gì về điều này?<br /> &nbsp;<br /> <em>3. Tìm đến một sự vật hay hiện tượng thiên nhiên và tự hỏi có gì liên quan. Ví dụ :</em><br /> - Cách bố trí các vân trên lá cây có sẽ giúp được chúng ta những gì?<br /> - Một cái phễu thì có những gì liên quan tới vấn đề chúng ta đang đối mặt?<br /> - Những con kiến trong tổ kiến sẽ gặp những khó khăn nào giống chúng ta?<br /> Nếu để ý bạn sẽ thấy trong các câu hỏi bên trên có rất nhiều từ “những”. Với cách đặt câu hỏi “có những cách nào? có những gì?” bạn sẽ có cơ hội tiếp cận với nhiều hướng suy nghĩ hơn.</p>\r\n<p align=\"justify\">Một lưu ý đặc biệt là để tránh sa lầy vào một luồng tư tưởng cá nhân nào đó, ở giai đoạn “hãy SÁNG” này hãy dành cho mỗi người ít nhất từ 3 đến 5 phút TĨNH LẶNG để suy nghĩ và viết ra những ý tưởng lóe lên trong đầu mình. Sau đó mọi người có thể chia sẻ những ý tưởng mà mình đã viết ra giấy.</p>\r\n<p align=\"justify\"><strong>Giai đoạn “rồi”</strong><br /> &nbsp;<br /> Đây là một giai đoạn quan trọng song thường bị bỏ qua. Các ý tưởng ở giai đoạn SÁNG có vai trò chính là những cánh cửa mở ra hướng đi mới, nhiệm vụ của bạn bây giờ là thử xem chúng sẽ dẫn tới đâu. Hãy xem xét lại từng ý tưởng và liên tục đặt những câu hỏi :</p>\r\n<p align=\"justify\">- Ý tưởng này có giá trị như thế nào?</p>\r\n<p align=\"justify\">- Ý tưởng này mở ra một hướng suy nghĩ nào khác biệt?</p>\r\n<p align=\"justify\">- Ý tưởng này sẽ dẫn chúng ta tới những ý tưởng nào khác?</p>\r\n<p align=\"justify\">Cử thử đi và bạn sẽ ngạc nhiên bởi những sáng kiến tuyệt vời được mở đường từ những ý tưởng đôi khi rất ngộ nghĩnh, thậm chí là viển vông nhất.</p>\r\n<p align=\"justify\"><strong>Giai đoạn “TẠO”</strong></p>\r\n<p align=\"justify\">TẠO ở đây là TẠO DỰNG, hay một cách nói khác của HÀNH ĐỘNG, chỉ HÀNH ĐỘNG mới tạo ra KẾT QUẢ. Đơn giản là sau đã có danh sách các ý tưởng hoàn thiện, hãy tìm ra và sắp xếp chúng theo các mức độ ưu tiên khác nhau, hãy ưu tiên nguồn lực thực hiện những ý tưởng ĐƠN GIẢN NHẤT mà tạo ra nhiều GIÁ TRỊ NHẤT trước và đảm bảo lưu giữ những ý tưởng khác để tra cứu khi cần.<br /> &nbsp;<br /> Đó là quá trình SÁNG TẠO ĐỘT PHÁ, bạn cũng không cần phải nhớ nhiều, chỉ cần bạn nhớ Hãy trân trọng mọi Ý TƯỞNG và khi “cần SÁNG TẠO, hãy SÁNG, rồi, TẠO!” Bạn sẽ đạt mọi kết quả mong muốn!</p>\r\n<p align=\"justify\">Một điều cuối cùng, SÁNG TẠO vừa là một khả năng, vừa là một thói quen và bạn hoàn toàn có thể rèn luyện. Có một cách giúp mình luôn duy trì sự Sáng tạo của bản thân là mỗi ngày trôi qua, cho dù ngày đó có gì xảy ra, vừa ý hay không vừa ý, mình đều nhìn lại chúng dưới một góc nhìn thú vị; nó không chỉ giúp bạn Sáng tạo hơn mà còn giúp bạn rèn luyện tư duy tích cực mỗi ngày!</p>','',1,0,0,2,'2013-05-18 22:30:45',732,'admin','2013-05-18 15:31:31',732,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','{\"image_intro\":\"\",\"float_intro\":\"\",\"image_intro_alt\":\"\",\"image_intro_caption\":\"\",\"image_fulltext\":\"\",\"float_fulltext\":\"\",\"image_fulltext_alt\":\"\",\"image_fulltext_caption\":\"\"}','{\"urla\":null,\"urlatext\":\"\",\"targeta\":\"\",\"urlb\":null,\"urlbtext\":\"\",\"targetb\":\"\",\"urlc\":null,\"urlctext\":\"\",\"targetc\":\"\"}','{\"show_title\":\"\",\"link_titles\":\"\",\"show_intro\":\"\",\"show_category\":\"\",\"link_category\":\"\",\"show_parent_category\":\"\",\"link_parent_category\":\"\",\"show_author\":\"\",\"link_author\":\"\",\"show_create_date\":\"\",\"show_modify_date\":\"\",\"show_publish_date\":\"\",\"show_item_navigation\":\"\",\"show_icons\":\"\",\"show_print_icon\":\"\",\"show_email_icon\":\"\",\"show_vote\":\"\",\"show_hits\":\"\",\"show_noauth\":\"\",\"urls_position\":\"\",\"alternative_readmore\":\"\",\"article_layout\":\"\",\"show_publishing_options\":\"\",\"show_article_options\":\"\",\"show_urls_images_backend\":\"\",\"show_urls_images_frontend\":\"\"}',2,0,2,'','',1,2,'{\"robots\":\"\",\"author\":\"\",\"rights\":\"\",\"xreference\":\"\"}',0,'*',''),(4,40,'Marketing Online','marketing-online','','<p>Khi marketing đã trở thành một công cụ trợ giúp đắc lực cho việc bán hàng thì rất nhiều phương tiện truyền thông quảng cáo đã liên tục ra đời để phục vụ cho mục tiêu của marketing. Nhưng hình như việc sử dụng quá nhiều một vài công cụ marketing đã làm người tiêu dùng luôn nghi ngờ mọi thứ đến với họ đều mang tính chất quảng cáo, do đó sẽ bị từ chối khỏi tâm trí khách hàng ngay tức khắc làm giảm hiệu quả của marketing rất nhiều. Do đó liệu pháp inbound Marketing – Marketing mạng xã hội là giải pháp tốt nhất</p>\r\n<p align=\"center\"><img title=\"nbound-vs-outbound-marketing\" src=\"http://www.kynang.edu.vn/images/stories/anhbaiviet/maketing-online/inbound-vs-outbound-marketing.png\" alt=\"nbound-vs-outbound-marketing\" width=\"650\" height=\"5831\" /></p>','',1,0,0,2,'2013-05-18 22:39:53',732,'Hong Phuong','0000-00-00 00:00:00',0,0,'0000-00-00 00:00:00','2013-05-18 15:40:03','0000-00-00 00:00:00','{\"image_intro\":\"\",\"float_intro\":\"\",\"image_intro_alt\":\"\",\"image_intro_caption\":\"\",\"image_fulltext\":\"\",\"float_fulltext\":\"\",\"image_fulltext_alt\":\"\",\"image_fulltext_caption\":\"\"}','{\"urla\":null,\"urlatext\":\"\",\"targeta\":\"\",\"urlb\":null,\"urlbtext\":\"\",\"targetb\":\"\",\"urlc\":null,\"urlctext\":\"\",\"targetc\":\"\"}','{\"show_title\":\"\",\"link_titles\":\"\",\"show_intro\":\"\",\"show_category\":\"\",\"link_category\":\"\",\"show_parent_category\":\"\",\"link_parent_category\":\"\",\"show_author\":\"\",\"link_author\":\"\",\"show_create_date\":\"\",\"show_modify_date\":\"\",\"show_publish_date\":\"\",\"show_item_navigation\":\"\",\"show_icons\":\"\",\"show_print_icon\":\"\",\"show_email_icon\":\"\",\"show_vote\":\"\",\"show_hits\":\"\",\"show_noauth\":\"\",\"urls_position\":\"\",\"alternative_readmore\":\"\",\"article_layout\":\"\",\"show_publishing_options\":\"\",\"show_article_options\":\"\",\"show_urls_images_backend\":\"\",\"show_urls_images_frontend\":\"\"}',1,0,1,'','',1,2,'{\"robots\":\"\",\"author\":\"\",\"rights\":\"\",\"xreference\":\"\"}',0,'*',''),(5,41,'Tiết kiệm 10% thu nhập mỗi tháng','tiet-kiem-thu-nhap-moi-thang','','<p>Chắc chắn bạn không thể trở thành triệu phú sau một đêm, nhưng bạn sẽ chẳng bao giờ <span style=\"text-decoration: underline;\">giàu</span> có nếu bạn không thể tự kiểm soát tài chính cá nhân của bản thân mình.</p>\r\n<p>Khi đề cập đến vấn đề “làm thế nào để trở nên giàu có”, chúng ta thường liên tưởng ngay đến những ông trùm trong giới kinh doanh như <strong>Donald Trump</strong> – kinh doanh bất động sản, <strong>Steve Jobs</strong> người hùng quá cố của Apple…Tuy nhiên, chiến lược <span style=\"text-decoration: underline;\">làm giàu</span> của bạn có thể bắt đầu từ những cấp độ đơn giản hơn rất nhiều, cụ thể như giàu lên từ việc quản lý tài chính cá nhân.<br /> <br /> Quản lý tài chính cá nhân là một phần quan trọng trong tiến trình loại bỏ nợ, kiểm soát chi phí và làm cho bạn trở nên giàu có hơn.&nbsp;Những ngày đầu áp dụng kế hoạch quản lý tài chính cá nhân vào cuộc sống, ban đầu bạn sẽ cảm thấy gò bó và nhàm chán. Mọi người xung quanh thấy bạn trở nên dè sẻn hơn, sống chi ly và tính toán hơn. Tuy nhiên, khi tham gia các chương trình đào tạo làm giàu của các chuyên gia, họ cũng sẽ chỉ ra rằng, quản lý tài chính cá nhân là một việc thực sự đáng làm.<br /> <br /> Chắc chắn bạn không thể trở thành triệu phú sau một đêm, nhưng bạn sẽ chẳng bao giờ giàu có nếu bạn không thể tự kiểm soát tài chính cá nhân của bản thân mình.&nbsp;Kiểm soát tốt tài chính cá nhân là bước đầu trên con đường làm giàu. <br /> Trò chơi cái xô thủng.</p>\r\n<p>Hãy thử hình dung chúng ta đang tham gia một trò chơi. Luật chơi yêu cầu sử dụng một cái xô 1 lít cũ, bị thủng nhiều lỗ để xách nước từ A đến thùng chứa 1.000 lít ở B. Chúng ta có 6 giờ đồng hồ để làm đầy thùng B.<br /> Bạn nghĩ chúng ta cần di chuyển bao nhiêu vòng để thắng cuộc?<br /> <br /> Thùng chứa nước B cũng như ước mơ sở hữu 1 triệu đô la đầu tiên. Công việc hằng ngày của bạn giống hành động đi xách nước đổ đầy cái thùng ấy. 6 giờ đồng hồ là cuộc sống 60 năm của bạn.<br /> <br /> Bạn không thể làm đầy được mục tiêu tài chính của mình thông qua một cái xô thủng. Dù bạn vất vả chạy đi chạy lại nhiều hơn nhưng bạn cũng không thể biết chính xác khi nào nước đầy thùng. Bạn sẽ rơi vào vòng lẩn quẩn cứ phải đi làm, nhận lương xong rồi chẳng dành dụm được bao nhiêu với số tiền nhận được… Chưa kể tiền bạn sẽ bị rò rỉ vào những chuyện mà bạn còn chẳng biết chắc là nên hay không.</p>\r\n<div align=\"center\"><img title=\"tiết kệm là nguyên tác của làm giàu\" src=\"http://www.kynang.edu.vn/images/stories/anhbaiviet/lam-giau/tiet-kiem.jpg\" alt=\"tiết kệm là nguyên tác của làm giàu\" /></div>\r\n<p><strong>Cách chiến thắng.</strong><br /> Bước đầu tiên ta cần bịt kín các chỗ thủng trong xô. Hãy thu thập tất cả những thông tin tài chính cần thiết của bản thân: thu nhập, lương, nợ nần, cà phê, chi tiêu lặt vặt … Thông tin nên lấy trong khoảng từ 3-6 tháng về trước để chia ra bình quân mức thu nhập và chi phí của bạn trong thời gian vừa qua.<br /> <br /> Bằng phương pháp liệt kê này, chúng ta sẽ biết được trong tháng mình đã chi bao nhiêu tiền, vào những việc gì, ước lượng bình quân mỗi tháng phải tiêu xài bao nhiêu tiền. Tương tự như thế để tính bình quân thu nhập mỗi tháng.<br /> Dựa vào danh sách đã liệt kê, hãy đánh dấu những danh mục nào là “bắt buộc có”, danh mục nào “có sẽ tốt hơn”.<br /> Nếu phân vân, hãy liệt kê theo thứ tự các nhu cầu. Đảm bảo từ ăn no, mặc ấm, sang ăn ngon mặc đẹp. Tiếp đó ưu tiên thanh toán các khoản nợ lãi suất cao, đến lãi thấp …<br /> <br /> Cũng có thể tham khảo công thức trích lại 10% tổng thu nhập cho bản thân, rồi sau đó mới dùng số tiền còn để thanh toán các chi phí.&nbsp;Vậy là bạn đã có được con số ước lượng cho thu nhập và chi phí của mình, kèm theo bảng ngân sách những khoản nên chi. Hãy áp dụng vào cuộc sống của mình ngay lập tức.<br /> <br /> Thời gian đầu, khi chưa quen với những con số và cách sống có kỷ luật, bạn có thể ghi con số tổng chi của bạn vào một mảnh giấy và bỏ trong bóp. Mỗi lần dự định chi thì bạn sẽ biết trong tháng này mình còn được quyền chi bao nhiêu tiền nữa… Tập dần sẽ thành thói quen.<br /> <br /> Cốt lõi của việc quản lý tài chính cá nhân là bạn phải thống kê được số tiền làm ra và chi tiêu trong từng tháng.<br /> Với thu nhập có hạn chỉ nên chi những khoản bắt buộc phải chi, sau đó tập làm quen với việc tiết kiệm 10% thu nhập hàng tháng. Từ số tiền tiết kiệm đó, bắt đầu xây dựng sự giàu có. Hãy lắp những viên gạch đầu tiên giúp bạn tiến đến cuộc sống mà bạn mong muốn.<br /> <br /> Chúc bạn thành công trong bước đầu tiên trên con đường làm giàu trở thành người quản lý tài chính cá nhân xuất sắc.</p>','',1,0,0,2,'2013-05-18 22:43:47',732,'Be Dep','0000-00-00 00:00:00',0,0,'0000-00-00 00:00:00','2013-05-18 15:44:05','0000-00-00 00:00:00','{\"image_intro\":\"\",\"float_intro\":\"\",\"image_intro_alt\":\"\",\"image_intro_caption\":\"\",\"image_fulltext\":\"\",\"float_fulltext\":\"\",\"image_fulltext_alt\":\"\",\"image_fulltext_caption\":\"\"}','{\"urla\":null,\"urlatext\":\"\",\"targeta\":\"\",\"urlb\":null,\"urlbtext\":\"\",\"targetb\":\"\",\"urlc\":null,\"urlctext\":\"\",\"targetc\":\"\"}','{\"show_title\":\"\",\"link_titles\":\"\",\"show_intro\":\"\",\"show_category\":\"\",\"link_category\":\"\",\"show_parent_category\":\"\",\"link_parent_category\":\"\",\"show_author\":\"\",\"link_author\":\"\",\"show_create_date\":\"\",\"show_modify_date\":\"\",\"show_publish_date\":\"\",\"show_item_navigation\":\"\",\"show_icons\":\"\",\"show_print_icon\":\"\",\"show_email_icon\":\"\",\"show_vote\":\"\",\"show_hits\":\"\",\"show_noauth\":\"\",\"urls_position\":\"\",\"alternative_readmore\":\"\",\"article_layout\":\"\",\"show_publishing_options\":\"\",\"show_article_options\":\"\",\"show_urls_images_backend\":\"\",\"show_urls_images_frontend\":\"\"}',1,0,0,'','',1,2,'{\"robots\":\"\",\"author\":\"\",\"rights\":\"\",\"xreference\":\"\"}',0,'*','');
/*!40000 ALTER TABLE `d3sgo_content` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_content_frontpage`
--

DROP TABLE IF EXISTS `d3sgo_content_frontpage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_content_frontpage` (
  `content_id` int(11) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`content_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_content_frontpage`
--

LOCK TABLES `d3sgo_content_frontpage` WRITE;
/*!40000 ALTER TABLE `d3sgo_content_frontpage` DISABLE KEYS */;
/*!40000 ALTER TABLE `d3sgo_content_frontpage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_content_rating`
--

DROP TABLE IF EXISTS `d3sgo_content_rating`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_content_rating` (
  `content_id` int(11) NOT NULL DEFAULT '0',
  `rating_sum` int(10) unsigned NOT NULL DEFAULT '0',
  `rating_count` int(10) unsigned NOT NULL DEFAULT '0',
  `lastip` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`content_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_content_rating`
--

LOCK TABLES `d3sgo_content_rating` WRITE;
/*!40000 ALTER TABLE `d3sgo_content_rating` DISABLE KEYS */;
/*!40000 ALTER TABLE `d3sgo_content_rating` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_core_log_searches`
--

DROP TABLE IF EXISTS `d3sgo_core_log_searches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_core_log_searches` (
  `search_term` varchar(128) NOT NULL DEFAULT '',
  `hits` int(10) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_core_log_searches`
--

LOCK TABLES `d3sgo_core_log_searches` WRITE;
/*!40000 ALTER TABLE `d3sgo_core_log_searches` DISABLE KEYS */;
/*!40000 ALTER TABLE `d3sgo_core_log_searches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_extensions`
--

DROP TABLE IF EXISTS `d3sgo_extensions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_extensions` (
  `extension_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL,
  `element` varchar(100) NOT NULL,
  `folder` varchar(100) NOT NULL,
  `client_id` tinyint(3) NOT NULL,
  `enabled` tinyint(3) NOT NULL DEFAULT '1',
  `access` int(10) unsigned NOT NULL DEFAULT '1',
  `protected` tinyint(3) NOT NULL DEFAULT '0',
  `manifest_cache` text NOT NULL,
  `params` text NOT NULL,
  `custom_data` text NOT NULL,
  `system_data` text NOT NULL,
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) DEFAULT '0',
  `state` int(11) DEFAULT '0',
  PRIMARY KEY (`extension_id`),
  KEY `element_clientid` (`element`,`client_id`),
  KEY `element_folder_clientid` (`element`,`folder`,`client_id`),
  KEY `extension` (`type`,`element`,`folder`,`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10012 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_extensions`
--

LOCK TABLES `d3sgo_extensions` WRITE;
/*!40000 ALTER TABLE `d3sgo_extensions` DISABLE KEYS */;
INSERT INTO `d3sgo_extensions` VALUES (1,'com_mailto','component','com_mailto','',0,1,1,1,'{\"legacy\":false,\"name\":\"com_mailto\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"COM_MAILTO_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0),(2,'com_wrapper','component','com_wrapper','',0,1,1,1,'{\"legacy\":false,\"name\":\"com_wrapper\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\n\\t\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"COM_WRAPPER_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0),(3,'com_admin','component','com_admin','',1,1,1,1,'{\"legacy\":false,\"name\":\"com_admin\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\n\\t\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"COM_ADMIN_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0),(4,'com_banners','component','com_banners','',1,1,1,0,'{\"legacy\":false,\"name\":\"com_banners\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\n\\t\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"COM_BANNERS_XML_DESCRIPTION\",\"group\":\"\"}','{\"purchase_type\":\"3\",\"track_impressions\":\"0\",\"track_clicks\":\"0\",\"metakey_prefix\":\"\"}','','',0,'0000-00-00 00:00:00',0,0),(5,'com_cache','component','com_cache','',1,1,1,1,'{\"legacy\":false,\"name\":\"com_cache\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"COM_CACHE_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0),(6,'com_categories','component','com_categories','',1,1,1,1,'{\"legacy\":false,\"name\":\"com_categories\",\"type\":\"component\",\"creationDate\":\"December 2007\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"COM_CATEGORIES_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0),(7,'com_checkin','component','com_checkin','',1,1,1,1,'{\"legacy\":false,\"name\":\"com_checkin\",\"type\":\"component\",\"creationDate\":\"Unknown\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2008 Open Source Matters. All rights reserved.\\n\\t\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"COM_CHECKIN_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0),(8,'com_contact','component','com_contact','',1,1,1,0,'{\"legacy\":false,\"name\":\"com_contact\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\n\\t\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"COM_CONTACT_XML_DESCRIPTION\",\"group\":\"\"}','{\"show_contact_category\":\"hide\",\"show_contact_list\":\"0\",\"presentation_style\":\"sliders\",\"show_name\":\"1\",\"show_position\":\"1\",\"show_email\":\"0\",\"show_street_address\":\"1\",\"show_suburb\":\"1\",\"show_state\":\"1\",\"show_postcode\":\"1\",\"show_country\":\"1\",\"show_telephone\":\"1\",\"show_mobile\":\"1\",\"show_fax\":\"1\",\"show_webpage\":\"1\",\"show_misc\":\"1\",\"show_image\":\"1\",\"image\":\"\",\"allow_vcard\":\"0\",\"show_articles\":\"0\",\"show_profile\":\"0\",\"show_links\":\"0\",\"linka_name\":\"\",\"linkb_name\":\"\",\"linkc_name\":\"\",\"linkd_name\":\"\",\"linke_name\":\"\",\"contact_icons\":\"0\",\"icon_address\":\"\",\"icon_email\":\"\",\"icon_telephone\":\"\",\"icon_mobile\":\"\",\"icon_fax\":\"\",\"icon_misc\":\"\",\"show_headings\":\"1\",\"show_position_headings\":\"1\",\"show_email_headings\":\"0\",\"show_telephone_headings\":\"1\",\"show_mobile_headings\":\"0\",\"show_fax_headings\":\"0\",\"allow_vcard_headings\":\"0\",\"show_suburb_headings\":\"1\",\"show_state_headings\":\"1\",\"show_country_headings\":\"1\",\"show_email_form\":\"1\",\"show_email_copy\":\"1\",\"banned_email\":\"\",\"banned_subject\":\"\",\"banned_text\":\"\",\"validate_session\":\"1\",\"custom_reply\":\"0\",\"redirect\":\"\",\"show_category_crumb\":\"0\",\"metakey\":\"\",\"metadesc\":\"\",\"robots\":\"\",\"author\":\"\",\"rights\":\"\",\"xreference\":\"\"}','','',0,'0000-00-00 00:00:00',0,0),(9,'com_cpanel','component','com_cpanel','',1,1,1,1,'{\"legacy\":false,\"name\":\"com_cpanel\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"COM_CPANEL_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0),(10,'com_installer','component','com_installer','',1,1,1,1,'{\"legacy\":false,\"name\":\"com_installer\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"COM_INSTALLER_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',0,0),(11,'com_languages','component','com_languages','',1,1,1,1,'{\"legacy\":false,\"name\":\"com_languages\",\"type\":\"component\",\"creationDate\":\"2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\n\\t\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"COM_LANGUAGES_XML_DESCRIPTION\",\"group\":\"\"}','{\"administrator\":\"en-GB\",\"site\":\"en-GB\"}','','',0,'0000-00-00 00:00:00',0,0),(12,'com_login','component','com_login','',1,1,1,1,'{\"legacy\":false,\"name\":\"com_login\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"COM_LOGIN_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0),(13,'com_media','component','com_media','',1,1,0,1,'{\"legacy\":false,\"name\":\"com_media\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"COM_MEDIA_XML_DESCRIPTION\",\"group\":\"\"}','{\"upload_extensions\":\"bmp,csv,doc,gif,ico,jpg,jpeg,odg,odp,ods,odt,pdf,png,ppt,swf,txt,xcf,xls,BMP,CSV,DOC,GIF,ICO,JPG,JPEG,ODG,ODP,ODS,ODT,PDF,PNG,PPT,SWF,TXT,XCF,XLS\",\"upload_maxsize\":\"10\",\"file_path\":\"images\",\"image_path\":\"images\",\"restrict_uploads\":\"1\",\"allowed_media_usergroup\":\"3\",\"check_mime\":\"1\",\"image_extensions\":\"bmp,gif,jpg,png\",\"ignore_extensions\":\"\",\"upload_mime\":\"image\\/jpeg,image\\/gif,image\\/png,image\\/bmp,application\\/x-shockwave-flash,application\\/msword,application\\/excel,application\\/pdf,application\\/powerpoint,text\\/plain,application\\/x-zip\",\"upload_mime_illegal\":\"text\\/html\"}','','',0,'0000-00-00 00:00:00',0,0),(14,'com_menus','component','com_menus','',1,1,1,1,'{\"legacy\":false,\"name\":\"com_menus\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"COM_MENUS_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',0,0),(15,'com_messages','component','com_messages','',1,1,1,1,'{\"legacy\":false,\"name\":\"com_messages\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"COM_MESSAGES_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0),(16,'com_modules','component','com_modules','',1,1,1,1,'{\"legacy\":false,\"name\":\"com_modules\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"COM_MODULES_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',0,0),(17,'com_newsfeeds','component','com_newsfeeds','',1,1,1,0,'{\"legacy\":false,\"name\":\"com_newsfeeds\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"COM_NEWSFEEDS_XML_DESCRIPTION\",\"group\":\"\"}','{\"show_feed_image\":\"1\",\"show_feed_description\":\"1\",\"show_item_description\":\"1\",\"feed_word_count\":\"0\",\"show_headings\":\"1\",\"show_name\":\"1\",\"show_articles\":\"0\",\"show_link\":\"1\",\"show_description\":\"1\",\"show_description_image\":\"1\",\"display_num\":\"\",\"show_pagination_limit\":\"1\",\"show_pagination\":\"1\",\"show_pagination_results\":\"1\",\"show_cat_items\":\"1\"}','','',0,'0000-00-00 00:00:00',0,0),(18,'com_plugins','component','com_plugins','',1,1,1,1,'{\"legacy\":false,\"name\":\"com_plugins\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"COM_PLUGINS_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',0,0),(19,'com_search','component','com_search','',1,1,1,1,'{\"legacy\":false,\"name\":\"com_search\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\n\\t\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"COM_SEARCH_XML_DESCRIPTION\",\"group\":\"\"}','{\"enabled\":\"0\",\"show_date\":\"1\"}','','',0,'0000-00-00 00:00:00',0,0),(20,'com_templates','component','com_templates','',1,1,1,1,'{\"legacy\":false,\"name\":\"com_templates\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"COM_TEMPLATES_XML_DESCRIPTION\",\"group\":\"\"}','{\"template_positions_display\":\"1\"}','','',0,'0000-00-00 00:00:00',0,0),(21,'com_weblinks','component','com_weblinks','',1,1,1,0,'{\"legacy\":false,\"name\":\"com_weblinks\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\n\\t\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"COM_WEBLINKS_XML_DESCRIPTION\",\"group\":\"\"}','{\"show_comp_description\":\"1\",\"comp_description\":\"\",\"show_link_hits\":\"1\",\"show_link_description\":\"1\",\"show_other_cats\":\"0\",\"show_headings\":\"0\",\"show_numbers\":\"0\",\"show_report\":\"1\",\"count_clicks\":\"1\",\"target\":\"0\",\"link_icons\":\"\"}','','',0,'0000-00-00 00:00:00',0,0),(22,'com_content','component','com_content','',1,1,0,1,'{\"legacy\":false,\"name\":\"com_content\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"COM_CONTENT_XML_DESCRIPTION\",\"group\":\"\"}','{\"article_layout\":\"_:default\",\"show_title\":\"1\",\"link_titles\":\"1\",\"show_intro\":\"1\",\"show_category\":\"1\",\"link_category\":\"1\",\"show_parent_category\":\"0\",\"link_parent_category\":\"0\",\"show_author\":\"1\",\"link_author\":\"0\",\"show_create_date\":\"0\",\"show_modify_date\":\"0\",\"show_publish_date\":\"1\",\"show_item_navigation\":\"1\",\"show_vote\":\"0\",\"show_readmore\":\"1\",\"show_readmore_title\":\"1\",\"readmore_limit\":\"100\",\"show_icons\":\"1\",\"show_print_icon\":\"1\",\"show_email_icon\":\"1\",\"show_hits\":\"1\",\"show_noauth\":\"0\",\"show_publishing_options\":\"1\",\"show_article_options\":\"1\",\"show_urls_images_frontend\":\"0\",\"show_urls_images_backend\":\"1\",\"targeta\":0,\"targetb\":0,\"targetc\":0,\"float_intro\":\"left\",\"float_fulltext\":\"left\",\"category_layout\":\"_:blog\",\"show_category_title\":\"0\",\"show_description\":\"0\",\"show_description_image\":\"0\",\"maxLevel\":\"1\",\"show_empty_categories\":\"0\",\"show_no_articles\":\"1\",\"show_subcat_desc\":\"1\",\"show_cat_num_articles\":\"0\",\"show_base_description\":\"1\",\"maxLevelcat\":\"-1\",\"show_empty_categories_cat\":\"0\",\"show_subcat_desc_cat\":\"1\",\"show_cat_num_articles_cat\":\"1\",\"num_leading_articles\":\"1\",\"num_intro_articles\":\"4\",\"num_columns\":\"2\",\"num_links\":\"4\",\"multi_column_order\":\"0\",\"show_subcategory_content\":\"0\",\"show_pagination_limit\":\"1\",\"filter_field\":\"hide\",\"show_headings\":\"1\",\"list_show_date\":\"0\",\"date_format\":\"\",\"list_show_hits\":\"1\",\"list_show_author\":\"1\",\"orderby_pri\":\"order\",\"orderby_sec\":\"rdate\",\"order_date\":\"published\",\"show_pagination\":\"2\",\"show_pagination_results\":\"1\",\"show_feed_link\":\"1\",\"feed_summary\":\"0\"}','','',0,'0000-00-00 00:00:00',0,0),(23,'com_config','component','com_config','',1,1,0,1,'{\"legacy\":false,\"name\":\"com_config\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"COM_CONFIG_XML_DESCRIPTION\",\"group\":\"\"}','{\"filters\":{\"1\":{\"filter_type\":\"NH\",\"filter_tags\":\"\",\"filter_attributes\":\"\"},\"6\":{\"filter_type\":\"BL\",\"filter_tags\":\"\",\"filter_attributes\":\"\"},\"7\":{\"filter_type\":\"NONE\",\"filter_tags\":\"\",\"filter_attributes\":\"\"},\"2\":{\"filter_type\":\"NH\",\"filter_tags\":\"\",\"filter_attributes\":\"\"},\"3\":{\"filter_type\":\"BL\",\"filter_tags\":\"\",\"filter_attributes\":\"\"},\"4\":{\"filter_type\":\"BL\",\"filter_tags\":\"\",\"filter_attributes\":\"\"},\"5\":{\"filter_type\":\"BL\",\"filter_tags\":\"\",\"filter_attributes\":\"\"},\"8\":{\"filter_type\":\"NONE\",\"filter_tags\":\"\",\"filter_attributes\":\"\"}}}','','',0,'0000-00-00 00:00:00',0,0),(24,'com_redirect','component','com_redirect','',1,1,0,1,'{\"legacy\":false,\"name\":\"com_redirect\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"COM_REDIRECT_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',0,0),(25,'com_users','component','com_users','',1,1,0,1,'{\"legacy\":false,\"name\":\"com_users\",\"type\":\"component\",\"creationDate\":\"April 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"COM_USERS_XML_DESCRIPTION\",\"group\":\"\"}','{\"allowUserRegistration\":\"1\",\"new_usertype\":\"2\",\"useractivation\":\"1\",\"frontend_userparams\":\"1\",\"mailSubjectPrefix\":\"\",\"mailBodySuffix\":\"\"}','','',0,'0000-00-00 00:00:00',0,0),(27,'com_finder','component','com_finder','',1,1,0,0,'{\"legacy\":false,\"name\":\"com_finder\",\"type\":\"component\",\"creationDate\":\"August 2011\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"COM_FINDER_XML_DESCRIPTION\",\"group\":\"\"}','{\"show_description\":\"1\",\"description_length\":255,\"allow_empty_query\":\"0\",\"show_url\":\"1\",\"show_advanced\":\"1\",\"expand_advanced\":\"0\",\"show_date_filters\":\"0\",\"highlight_terms\":\"1\",\"opensearch_name\":\"\",\"opensearch_description\":\"\",\"batch_size\":\"50\",\"memory_table_limit\":30000,\"title_multiplier\":\"1.7\",\"text_multiplier\":\"0.7\",\"meta_multiplier\":\"1.2\",\"path_multiplier\":\"2.0\",\"misc_multiplier\":\"0.3\",\"stemmer\":\"snowball\"}','','',0,'0000-00-00 00:00:00',0,0),(28,'com_joomlaupdate','component','com_joomlaupdate','',1,1,0,1,'{\"legacy\":false,\"name\":\"com_joomlaupdate\",\"type\":\"component\",\"creationDate\":\"February 2012\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"COM_JOOMLAUPDATE_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',0,0),(100,'PHPMailer','library','phpmailer','',0,1,1,1,'{\"legacy\":false,\"name\":\"PHPMailer\",\"type\":\"library\",\"creationDate\":\"2001\",\"author\":\"PHPMailer\",\"copyright\":\"(c) 2001-2003, Brent R. Matzelle, (c) 2004-2009, Andy Prevost. All Rights Reserved., (c) 2010-2011, Jim Jagielski. All Rights Reserved.\",\"authorEmail\":\"jimjag@gmail.com\",\"authorUrl\":\"https:\\/\\/code.google.com\\/a\\/apache-extras.org\\/p\\/phpmailer\\/\",\"version\":\"5.2\",\"description\":\"LIB_PHPMAILER_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0),(101,'SimplePie','library','simplepie','',0,1,1,1,'{\"legacy\":false,\"name\":\"SimplePie\",\"type\":\"library\",\"creationDate\":\"2004\",\"author\":\"SimplePie\",\"copyright\":\"Copyright (c) 2004-2009, Ryan Parman and Geoffrey Sneddon\",\"authorEmail\":\"\",\"authorUrl\":\"http:\\/\\/simplepie.org\\/\",\"version\":\"1.2\",\"description\":\"LIB_SIMPLEPIE_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0),(102,'phputf8','library','phputf8','',0,1,1,1,'{\"legacy\":false,\"name\":\"phputf8\",\"type\":\"library\",\"creationDate\":\"2006\",\"author\":\"Harry Fuecks\",\"copyright\":\"Copyright various authors\",\"authorEmail\":\"hfuecks@gmail.com\",\"authorUrl\":\"http:\\/\\/sourceforge.net\\/projects\\/phputf8\",\"version\":\"0.5\",\"description\":\"LIB_PHPUTF8_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0),(103,'Joomla! Platform','library','joomla','',0,1,1,1,'{\"legacy\":false,\"name\":\"Joomla! Platform\",\"type\":\"library\",\"creationDate\":\"2008\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"http:\\/\\/www.joomla.org\",\"version\":\"11.4\",\"description\":\"LIB_JOOMLA_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',0,0),(200,'mod_articles_archive','module','mod_articles_archive','',0,1,1,1,'{\"legacy\":false,\"name\":\"mod_articles_archive\",\"type\":\"module\",\"creationDate\":\"July 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters.\\n\\t\\tAll rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_ARTICLES_ARCHIVE_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0),(201,'mod_articles_latest','module','mod_articles_latest','',0,1,1,1,'{\"legacy\":false,\"name\":\"mod_articles_latest\",\"type\":\"module\",\"creationDate\":\"July 2004\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_LATEST_NEWS_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0),(202,'mod_articles_popular','module','mod_articles_popular','',0,1,1,0,'{\"legacy\":false,\"name\":\"mod_articles_popular\",\"type\":\"module\",\"creationDate\":\"July 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_POPULAR_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0),(203,'mod_banners','module','mod_banners','',0,1,1,0,'{\"legacy\":false,\"name\":\"mod_banners\",\"type\":\"module\",\"creationDate\":\"July 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_BANNERS_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0),(204,'mod_breadcrumbs','module','mod_breadcrumbs','',0,1,1,1,'{\"legacy\":false,\"name\":\"mod_breadcrumbs\",\"type\":\"module\",\"creationDate\":\"July 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_BREADCRUMBS_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0),(205,'mod_custom','module','mod_custom','',0,1,1,1,'{\"legacy\":false,\"name\":\"mod_custom\",\"type\":\"module\",\"creationDate\":\"July 2004\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_CUSTOM_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0),(206,'mod_feed','module','mod_feed','',0,1,1,1,'{\"legacy\":false,\"name\":\"mod_feed\",\"type\":\"module\",\"creationDate\":\"July 2005\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_FEED_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0),(207,'mod_footer','module','mod_footer','',0,1,1,1,'{\"legacy\":false,\"name\":\"mod_footer\",\"type\":\"module\",\"creationDate\":\"July 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_FOOTER_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0),(208,'mod_login','module','mod_login','',0,1,1,1,'{\"legacy\":false,\"name\":\"mod_login\",\"type\":\"module\",\"creationDate\":\"July 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_LOGIN_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0),(209,'mod_menu','module','mod_menu','',0,1,1,1,'{\"legacy\":false,\"name\":\"mod_menu\",\"type\":\"module\",\"creationDate\":\"July 2004\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_MENU_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0),(210,'mod_articles_news','module','mod_articles_news','',0,1,1,0,'{\"legacy\":false,\"name\":\"mod_articles_news\",\"type\":\"module\",\"creationDate\":\"July 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_ARTICLES_NEWS_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0),(211,'mod_random_image','module','mod_random_image','',0,1,1,0,'{\"legacy\":false,\"name\":\"mod_random_image\",\"type\":\"module\",\"creationDate\":\"July 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_RANDOM_IMAGE_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0),(212,'mod_related_items','module','mod_related_items','',0,1,1,0,'{\"legacy\":false,\"name\":\"mod_related_items\",\"type\":\"module\",\"creationDate\":\"July 2004\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_RELATED_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0),(213,'mod_search','module','mod_search','',0,1,1,0,'{\"legacy\":false,\"name\":\"mod_search\",\"type\":\"module\",\"creationDate\":\"July 2004\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_SEARCH_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0),(214,'mod_stats','module','mod_stats','',0,1,1,0,'{\"legacy\":false,\"name\":\"mod_stats\",\"type\":\"module\",\"creationDate\":\"July 2004\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_STATS_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0),(215,'mod_syndicate','module','mod_syndicate','',0,1,1,1,'{\"legacy\":false,\"name\":\"mod_syndicate\",\"type\":\"module\",\"creationDate\":\"May 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_SYNDICATE_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0),(216,'mod_users_latest','module','mod_users_latest','',0,1,1,1,'{\"legacy\":false,\"name\":\"mod_users_latest\",\"type\":\"module\",\"creationDate\":\"December 2009\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_USERS_LATEST_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0),(217,'mod_weblinks','module','mod_weblinks','',0,1,1,0,'{\"legacy\":false,\"name\":\"mod_weblinks\",\"type\":\"module\",\"creationDate\":\"July 2009\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_WEBLINKS_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0),(218,'mod_whosonline','module','mod_whosonline','',0,1,1,0,'{\"legacy\":false,\"name\":\"mod_whosonline\",\"type\":\"module\",\"creationDate\":\"July 2004\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_WHOSONLINE_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0),(219,'mod_wrapper','module','mod_wrapper','',0,1,1,0,'{\"legacy\":false,\"name\":\"mod_wrapper\",\"type\":\"module\",\"creationDate\":\"October 2004\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_WRAPPER_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0),(220,'mod_articles_category','module','mod_articles_category','',0,1,1,1,'{\"legacy\":false,\"name\":\"mod_articles_category\",\"type\":\"module\",\"creationDate\":\"February 2010\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_ARTICLES_CATEGORY_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0),(221,'mod_articles_categories','module','mod_articles_categories','',0,1,1,1,'{\"legacy\":false,\"name\":\"mod_articles_categories\",\"type\":\"module\",\"creationDate\":\"February 2010\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_ARTICLES_CATEGORIES_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0),(222,'mod_languages','module','mod_languages','',0,1,1,1,'{\"legacy\":false,\"name\":\"mod_languages\",\"type\":\"module\",\"creationDate\":\"February 2010\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_LANGUAGES_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0),(223,'mod_finder','module','mod_finder','',0,1,0,0,'{\"legacy\":false,\"name\":\"mod_finder\",\"type\":\"module\",\"creationDate\":\"August 2011\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_FINDER_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0),(300,'mod_custom','module','mod_custom','',1,1,1,1,'{\"legacy\":false,\"name\":\"mod_custom\",\"type\":\"module\",\"creationDate\":\"July 2004\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_CUSTOM_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0),(301,'mod_feed','module','mod_feed','',1,1,1,0,'{\"legacy\":false,\"name\":\"mod_feed\",\"type\":\"module\",\"creationDate\":\"July 2005\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_FEED_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0),(302,'mod_latest','module','mod_latest','',1,1,1,0,'{\"legacy\":false,\"name\":\"mod_latest\",\"type\":\"module\",\"creationDate\":\"July 2004\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_LATEST_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0),(303,'mod_logged','module','mod_logged','',1,1,1,0,'{\"legacy\":false,\"name\":\"mod_logged\",\"type\":\"module\",\"creationDate\":\"January 2005\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_LOGGED_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0),(304,'mod_login','module','mod_login','',1,1,1,1,'{\"legacy\":false,\"name\":\"mod_login\",\"type\":\"module\",\"creationDate\":\"March 2005\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_LOGIN_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0),(305,'mod_menu','module','mod_menu','',1,1,1,0,'{\"legacy\":false,\"name\":\"mod_menu\",\"type\":\"module\",\"creationDate\":\"March 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_MENU_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0),(307,'mod_popular','module','mod_popular','',1,1,1,0,'{\"legacy\":false,\"name\":\"mod_popular\",\"type\":\"module\",\"creationDate\":\"July 2004\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_POPULAR_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0),(308,'mod_quickicon','module','mod_quickicon','',1,1,1,1,'{\"legacy\":false,\"name\":\"mod_quickicon\",\"type\":\"module\",\"creationDate\":\"Nov 2005\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_QUICKICON_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0),(309,'mod_status','module','mod_status','',1,1,1,0,'{\"legacy\":false,\"name\":\"mod_status\",\"type\":\"module\",\"creationDate\":\"Feb 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_STATUS_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0),(310,'mod_submenu','module','mod_submenu','',1,1,1,0,'{\"legacy\":false,\"name\":\"mod_submenu\",\"type\":\"module\",\"creationDate\":\"Feb 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_SUBMENU_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0),(311,'mod_title','module','mod_title','',1,1,1,0,'{\"legacy\":false,\"name\":\"mod_title\",\"type\":\"module\",\"creationDate\":\"Nov 2005\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_TITLE_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0),(312,'mod_toolbar','module','mod_toolbar','',1,1,1,1,'{\"legacy\":false,\"name\":\"mod_toolbar\",\"type\":\"module\",\"creationDate\":\"Nov 2005\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_TOOLBAR_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0),(313,'mod_multilangstatus','module','mod_multilangstatus','',1,1,1,0,'{\"legacy\":false,\"name\":\"mod_multilangstatus\",\"type\":\"module\",\"creationDate\":\"September 2011\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_MULTILANGSTATUS_XML_DESCRIPTION\",\"group\":\"\"}','{\"cache\":\"0\"}','','',0,'0000-00-00 00:00:00',0,0),(314,'mod_version','module','mod_version','',1,1,1,0,'{\"legacy\":false,\"name\":\"mod_version\",\"type\":\"module\",\"creationDate\":\"January 2012\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"MOD_VERSION_XML_DESCRIPTION\",\"group\":\"\"}','{\"format\":\"short\",\"product\":\"1\",\"cache\":\"0\"}','','',0,'0000-00-00 00:00:00',0,0),(400,'plg_authentication_gmail','plugin','gmail','authentication',0,0,1,0,'{\"legacy\":false,\"name\":\"plg_authentication_gmail\",\"type\":\"plugin\",\"creationDate\":\"February 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_GMAIL_XML_DESCRIPTION\",\"group\":\"\"}','{\"applysuffix\":\"0\",\"suffix\":\"\",\"verifypeer\":\"1\",\"user_blacklist\":\"\"}','','',0,'0000-00-00 00:00:00',1,0),(401,'plg_authentication_joomla','plugin','joomla','authentication',0,1,1,1,'{\"legacy\":false,\"name\":\"plg_authentication_joomla\",\"type\":\"plugin\",\"creationDate\":\"November 2005\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_AUTH_JOOMLA_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',0,0),(402,'plg_authentication_ldap','plugin','ldap','authentication',0,0,1,0,'{\"legacy\":false,\"name\":\"plg_authentication_ldap\",\"type\":\"plugin\",\"creationDate\":\"November 2005\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_LDAP_XML_DESCRIPTION\",\"group\":\"\"}','{\"host\":\"\",\"port\":\"389\",\"use_ldapV3\":\"0\",\"negotiate_tls\":\"0\",\"no_referrals\":\"0\",\"auth_method\":\"bind\",\"base_dn\":\"\",\"search_string\":\"\",\"users_dn\":\"\",\"username\":\"admin\",\"password\":\"bobby7\",\"ldap_fullname\":\"fullName\",\"ldap_email\":\"mail\",\"ldap_uid\":\"uid\"}','','',0,'0000-00-00 00:00:00',3,0),(404,'plg_content_emailcloak','plugin','emailcloak','content',0,1,1,0,'{\"legacy\":false,\"name\":\"plg_content_emailcloak\",\"type\":\"plugin\",\"creationDate\":\"November 2005\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_CONTENT_EMAILCLOAK_XML_DESCRIPTION\",\"group\":\"\"}','{\"mode\":\"1\"}','','',0,'0000-00-00 00:00:00',1,0),(405,'plg_content_geshi','plugin','geshi','content',0,0,1,0,'{\"legacy\":false,\"name\":\"plg_content_geshi\",\"type\":\"plugin\",\"creationDate\":\"November 2005\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"\",\"authorUrl\":\"qbnz.com\\/highlighter\",\"version\":\"2.5.0\",\"description\":\"PLG_CONTENT_GESHI_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',2,0),(406,'plg_content_loadmodule','plugin','loadmodule','content',0,1,1,0,'{\"legacy\":false,\"name\":\"plg_content_loadmodule\",\"type\":\"plugin\",\"creationDate\":\"November 2005\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_LOADMODULE_XML_DESCRIPTION\",\"group\":\"\"}','{\"style\":\"xhtml\"}','','',0,'2011-09-18 15:22:50',0,0),(407,'plg_content_pagebreak','plugin','pagebreak','content',0,1,1,1,'{\"legacy\":false,\"name\":\"plg_content_pagebreak\",\"type\":\"plugin\",\"creationDate\":\"November 2005\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_CONTENT_PAGEBREAK_XML_DESCRIPTION\",\"group\":\"\"}','{\"title\":\"1\",\"multipage_toc\":\"1\",\"showall\":\"1\"}','','',0,'0000-00-00 00:00:00',4,0),(408,'plg_content_pagenavigation','plugin','pagenavigation','content',0,1,1,1,'{\"legacy\":false,\"name\":\"plg_content_pagenavigation\",\"type\":\"plugin\",\"creationDate\":\"January 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_PAGENAVIGATION_XML_DESCRIPTION\",\"group\":\"\"}','{\"position\":\"1\"}','','',0,'0000-00-00 00:00:00',5,0),(409,'plg_content_vote','plugin','vote','content',0,1,1,1,'{\"legacy\":false,\"name\":\"plg_content_vote\",\"type\":\"plugin\",\"creationDate\":\"November 2005\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_VOTE_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',6,0),(410,'plg_editors_codemirror','plugin','codemirror','editors',0,1,1,1,'{\"legacy\":false,\"name\":\"plg_editors_codemirror\",\"type\":\"plugin\",\"creationDate\":\"28 March 2011\",\"author\":\"Marijn Haverbeke\",\"copyright\":\"\",\"authorEmail\":\"N\\/A\",\"authorUrl\":\"\",\"version\":\"1.0\",\"description\":\"PLG_CODEMIRROR_XML_DESCRIPTION\",\"group\":\"\"}','{\"linenumbers\":\"0\",\"tabmode\":\"indent\"}','','',0,'0000-00-00 00:00:00',1,0),(411,'plg_editors_none','plugin','none','editors',0,1,1,1,'{\"legacy\":false,\"name\":\"plg_editors_none\",\"type\":\"plugin\",\"creationDate\":\"August 2004\",\"author\":\"Unknown\",\"copyright\":\"\",\"authorEmail\":\"N\\/A\",\"authorUrl\":\"\",\"version\":\"2.5.0\",\"description\":\"PLG_NONE_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',2,0),(412,'plg_editors_tinymce','plugin','tinymce','editors',0,1,1,1,'{\"legacy\":false,\"name\":\"plg_editors_tinymce\",\"type\":\"plugin\",\"creationDate\":\"2005-2013\",\"author\":\"Moxiecode Systems AB\",\"copyright\":\"Moxiecode Systems AB\",\"authorEmail\":\"N\\/A\",\"authorUrl\":\"tinymce.moxiecode.com\\/\",\"version\":\"3.5.4.1\",\"description\":\"PLG_TINY_XML_DESCRIPTION\",\"group\":\"\"}','{\"mode\":\"1\",\"skin\":\"0\",\"entity_encoding\":\"raw\",\"lang_mode\":\"0\",\"lang_code\":\"en\",\"text_direction\":\"ltr\",\"content_css\":\"1\",\"content_css_custom\":\"\",\"relative_urls\":\"1\",\"newlines\":\"0\",\"invalid_elements\":\"script,applet,iframe\",\"extended_elements\":\"\",\"toolbar\":\"top\",\"toolbar_align\":\"left\",\"html_height\":\"550\",\"html_width\":\"750\",\"resizing\":\"true\",\"resize_horizontal\":\"false\",\"element_path\":\"1\",\"fonts\":\"1\",\"paste\":\"1\",\"searchreplace\":\"1\",\"insertdate\":\"1\",\"format_date\":\"%Y-%m-%d\",\"inserttime\":\"1\",\"format_time\":\"%H:%M:%S\",\"colors\":\"1\",\"table\":\"1\",\"smilies\":\"1\",\"media\":\"1\",\"hr\":\"1\",\"directionality\":\"1\",\"fullscreen\":\"1\",\"style\":\"1\",\"layer\":\"1\",\"xhtmlxtras\":\"1\",\"visualchars\":\"1\",\"nonbreaking\":\"1\",\"template\":\"1\",\"blockquote\":\"1\",\"wordcount\":\"1\",\"advimage\":\"1\",\"advlink\":\"1\",\"advlist\":\"1\",\"autosave\":\"1\",\"contextmenu\":\"1\",\"inlinepopups\":\"1\",\"custom_plugin\":\"\",\"custom_button\":\"\"}','','',0,'0000-00-00 00:00:00',3,0),(413,'plg_editors-xtd_article','plugin','article','editors-xtd',0,1,1,1,'{\"legacy\":false,\"name\":\"plg_editors-xtd_article\",\"type\":\"plugin\",\"creationDate\":\"October 2009\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_ARTICLE_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',1,0),(414,'plg_editors-xtd_image','plugin','image','editors-xtd',0,1,1,0,'{\"legacy\":false,\"name\":\"plg_editors-xtd_image\",\"type\":\"plugin\",\"creationDate\":\"August 2004\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_IMAGE_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',2,0),(415,'plg_editors-xtd_pagebreak','plugin','pagebreak','editors-xtd',0,1,1,0,'{\"legacy\":false,\"name\":\"plg_editors-xtd_pagebreak\",\"type\":\"plugin\",\"creationDate\":\"August 2004\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_EDITORSXTD_PAGEBREAK_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',3,0),(416,'plg_editors-xtd_readmore','plugin','readmore','editors-xtd',0,1,1,0,'{\"legacy\":false,\"name\":\"plg_editors-xtd_readmore\",\"type\":\"plugin\",\"creationDate\":\"March 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_READMORE_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',4,0),(417,'plg_search_categories','plugin','categories','search',0,1,1,0,'{\"legacy\":false,\"name\":\"plg_search_categories\",\"type\":\"plugin\",\"creationDate\":\"November 2005\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_SEARCH_CATEGORIES_XML_DESCRIPTION\",\"group\":\"\"}','{\"search_limit\":\"50\",\"search_content\":\"1\",\"search_archived\":\"1\"}','','',0,'0000-00-00 00:00:00',0,0),(418,'plg_search_contacts','plugin','contacts','search',0,1,1,0,'{\"legacy\":false,\"name\":\"plg_search_contacts\",\"type\":\"plugin\",\"creationDate\":\"November 2005\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_SEARCH_CONTACTS_XML_DESCRIPTION\",\"group\":\"\"}','{\"search_limit\":\"50\",\"search_content\":\"1\",\"search_archived\":\"1\"}','','',0,'0000-00-00 00:00:00',0,0),(419,'plg_search_content','plugin','content','search',0,1,1,0,'{\"legacy\":false,\"name\":\"plg_search_content\",\"type\":\"plugin\",\"creationDate\":\"November 2005\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_SEARCH_CONTENT_XML_DESCRIPTION\",\"group\":\"\"}','{\"search_limit\":\"50\",\"search_content\":\"1\",\"search_archived\":\"1\"}','','',0,'0000-00-00 00:00:00',0,0),(420,'plg_search_newsfeeds','plugin','newsfeeds','search',0,1,1,0,'{\"legacy\":false,\"name\":\"plg_search_newsfeeds\",\"type\":\"plugin\",\"creationDate\":\"November 2005\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_SEARCH_NEWSFEEDS_XML_DESCRIPTION\",\"group\":\"\"}','{\"search_limit\":\"50\",\"search_content\":\"1\",\"search_archived\":\"1\"}','','',0,'0000-00-00 00:00:00',0,0),(421,'plg_search_weblinks','plugin','weblinks','search',0,1,1,0,'{\"legacy\":false,\"name\":\"plg_search_weblinks\",\"type\":\"plugin\",\"creationDate\":\"November 2005\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_SEARCH_WEBLINKS_XML_DESCRIPTION\",\"group\":\"\"}','{\"search_limit\":\"50\",\"search_content\":\"1\",\"search_archived\":\"1\"}','','',0,'0000-00-00 00:00:00',0,0),(422,'plg_system_languagefilter','plugin','languagefilter','system',0,0,1,1,'{\"legacy\":false,\"name\":\"plg_system_languagefilter\",\"type\":\"plugin\",\"creationDate\":\"July 2010\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_SYSTEM_LANGUAGEFILTER_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',1,0),(423,'plg_system_p3p','plugin','p3p','system',0,1,1,1,'{\"legacy\":false,\"name\":\"plg_system_p3p\",\"type\":\"plugin\",\"creationDate\":\"September 2010\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_P3P_XML_DESCRIPTION\",\"group\":\"\"}','{\"headers\":\"NOI ADM DEV PSAi COM NAV OUR OTRo STP IND DEM\"}','','',0,'0000-00-00 00:00:00',2,0),(424,'plg_system_cache','plugin','cache','system',0,0,1,1,'{\"legacy\":false,\"name\":\"plg_system_cache\",\"type\":\"plugin\",\"creationDate\":\"February 2007\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_CACHE_XML_DESCRIPTION\",\"group\":\"\"}','{\"browsercache\":\"0\",\"cachetime\":\"15\"}','','',0,'0000-00-00 00:00:00',9,0),(425,'plg_system_debug','plugin','debug','system',0,1,1,0,'{\"legacy\":false,\"name\":\"plg_system_debug\",\"type\":\"plugin\",\"creationDate\":\"December 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_DEBUG_XML_DESCRIPTION\",\"group\":\"\"}','{\"profile\":\"1\",\"queries\":\"1\",\"memory\":\"1\",\"language_files\":\"1\",\"language_strings\":\"1\",\"strip-first\":\"1\",\"strip-prefix\":\"\",\"strip-suffix\":\"\"}','','',0,'0000-00-00 00:00:00',4,0),(426,'plg_system_log','plugin','log','system',0,1,1,1,'{\"legacy\":false,\"name\":\"plg_system_log\",\"type\":\"plugin\",\"creationDate\":\"April 2007\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_LOG_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',5,0),(427,'plg_system_redirect','plugin','redirect','system',0,1,1,1,'{\"legacy\":false,\"name\":\"plg_system_redirect\",\"type\":\"plugin\",\"creationDate\":\"April 2009\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_REDIRECT_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',6,0),(428,'plg_system_remember','plugin','remember','system',0,1,1,1,'{\"legacy\":false,\"name\":\"plg_system_remember\",\"type\":\"plugin\",\"creationDate\":\"April 2007\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_REMEMBER_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',7,0),(429,'plg_system_sef','plugin','sef','system',0,1,1,0,'{\"legacy\":false,\"name\":\"plg_system_sef\",\"type\":\"plugin\",\"creationDate\":\"December 2007\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_SEF_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',8,0),(430,'plg_system_logout','plugin','logout','system',0,1,1,1,'{\"legacy\":false,\"name\":\"plg_system_logout\",\"type\":\"plugin\",\"creationDate\":\"April 2009\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_SYSTEM_LOGOUT_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',3,0),(431,'plg_user_contactcreator','plugin','contactcreator','user',0,0,1,1,'{\"legacy\":false,\"name\":\"plg_user_contactcreator\",\"type\":\"plugin\",\"creationDate\":\"August 2009\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_CONTACTCREATOR_XML_DESCRIPTION\",\"group\":\"\"}','{\"autowebpage\":\"\",\"category\":\"34\",\"autopublish\":\"0\"}','','',0,'0000-00-00 00:00:00',1,0),(432,'plg_user_joomla','plugin','joomla','user',0,1,1,0,'{\"legacy\":false,\"name\":\"plg_user_joomla\",\"type\":\"plugin\",\"creationDate\":\"December 2006\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2009 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_USER_JOOMLA_XML_DESCRIPTION\",\"group\":\"\"}','{\"autoregister\":\"1\"}','','',0,'0000-00-00 00:00:00',2,0),(433,'plg_user_profile','plugin','profile','user',0,0,1,1,'{\"legacy\":false,\"name\":\"plg_user_profile\",\"type\":\"plugin\",\"creationDate\":\"January 2008\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_USER_PROFILE_XML_DESCRIPTION\",\"group\":\"\"}','{\"register-require_address1\":\"1\",\"register-require_address2\":\"1\",\"register-require_city\":\"1\",\"register-require_region\":\"1\",\"register-require_country\":\"1\",\"register-require_postal_code\":\"1\",\"register-require_phone\":\"1\",\"register-require_website\":\"1\",\"register-require_favoritebook\":\"1\",\"register-require_aboutme\":\"1\",\"register-require_tos\":\"1\",\"register-require_dob\":\"1\",\"profile-require_address1\":\"1\",\"profile-require_address2\":\"1\",\"profile-require_city\":\"1\",\"profile-require_region\":\"1\",\"profile-require_country\":\"1\",\"profile-require_postal_code\":\"1\",\"profile-require_phone\":\"1\",\"profile-require_website\":\"1\",\"profile-require_favoritebook\":\"1\",\"profile-require_aboutme\":\"1\",\"profile-require_tos\":\"1\",\"profile-require_dob\":\"1\"}','','',0,'0000-00-00 00:00:00',0,0),(434,'plg_extension_joomla','plugin','joomla','extension',0,1,1,1,'{\"legacy\":false,\"name\":\"plg_extension_joomla\",\"type\":\"plugin\",\"creationDate\":\"May 2010\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_EXTENSION_JOOMLA_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',1,0),(435,'plg_content_joomla','plugin','joomla','content',0,1,1,0,'{\"legacy\":false,\"name\":\"plg_content_joomla\",\"type\":\"plugin\",\"creationDate\":\"November 2010\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_CONTENT_JOOMLA_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',0,0),(436,'plg_system_languagecode','plugin','languagecode','system',0,0,1,0,'{\"legacy\":false,\"name\":\"plg_system_languagecode\",\"type\":\"plugin\",\"creationDate\":\"November 2011\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_SYSTEM_LANGUAGECODE_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',10,0),(437,'plg_quickicon_joomlaupdate','plugin','joomlaupdate','quickicon',0,1,1,1,'{\"legacy\":false,\"name\":\"plg_quickicon_joomlaupdate\",\"type\":\"plugin\",\"creationDate\":\"August 2011\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_QUICKICON_JOOMLAUPDATE_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',0,0),(438,'plg_quickicon_extensionupdate','plugin','extensionupdate','quickicon',0,1,1,1,'{\"legacy\":false,\"name\":\"plg_quickicon_extensionupdate\",\"type\":\"plugin\",\"creationDate\":\"August 2011\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_QUICKICON_EXTENSIONUPDATE_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',0,0),(439,'plg_captcha_recaptcha','plugin','recaptcha','captcha',0,1,1,0,'{\"legacy\":false,\"name\":\"plg_captcha_recaptcha\",\"type\":\"plugin\",\"creationDate\":\"December 2011\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_CAPTCHA_RECAPTCHA_XML_DESCRIPTION\",\"group\":\"\"}','{\"public_key\":\"\",\"private_key\":\"\",\"theme\":\"clean\"}','','',0,'0000-00-00 00:00:00',0,0),(440,'plg_system_highlight','plugin','highlight','system',0,1,1,0,'{\"legacy\":false,\"name\":\"plg_system_highlight\",\"type\":\"plugin\",\"creationDate\":\"August 2011\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_SYSTEM_HIGHLIGHT_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',7,0),(441,'plg_content_finder','plugin','finder','content',0,0,1,0,'{\"legacy\":false,\"name\":\"plg_content_finder\",\"type\":\"plugin\",\"creationDate\":\"December 2011\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_CONTENT_FINDER_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',0,0),(442,'plg_finder_categories','plugin','categories','finder',0,1,1,0,'{\"legacy\":false,\"name\":\"plg_finder_categories\",\"type\":\"plugin\",\"creationDate\":\"August 2011\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_FINDER_CATEGORIES_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',1,0),(443,'plg_finder_contacts','plugin','contacts','finder',0,1,1,0,'{\"legacy\":false,\"name\":\"plg_finder_contacts\",\"type\":\"plugin\",\"creationDate\":\"August 2011\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_FINDER_CONTACTS_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',2,0),(444,'plg_finder_content','plugin','content','finder',0,1,1,0,'{\"legacy\":false,\"name\":\"plg_finder_content\",\"type\":\"plugin\",\"creationDate\":\"August 2011\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_FINDER_CONTENT_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',3,0),(445,'plg_finder_newsfeeds','plugin','newsfeeds','finder',0,1,1,0,'{\"legacy\":false,\"name\":\"plg_finder_newsfeeds\",\"type\":\"plugin\",\"creationDate\":\"August 2011\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_FINDER_NEWSFEEDS_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',4,0),(446,'plg_finder_weblinks','plugin','weblinks','finder',0,1,1,0,'{\"legacy\":false,\"name\":\"plg_finder_weblinks\",\"type\":\"plugin\",\"creationDate\":\"August 2011\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PLG_FINDER_WEBLINKS_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',5,0),(500,'atomic','template','atomic','',0,1,1,0,'{\"legacy\":false,\"name\":\"atomic\",\"type\":\"template\",\"creationDate\":\"10\\/10\\/09\",\"author\":\"Ron Severdia\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.\",\"authorEmail\":\"contact@kontentdesign.com\",\"authorUrl\":\"http:\\/\\/www.kontentdesign.com\",\"version\":\"2.5.0\",\"description\":\"TPL_ATOMIC_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',0,0),(502,'bluestork','template','bluestork','',1,1,1,0,'{\"legacy\":false,\"name\":\"bluestork\",\"type\":\"template\",\"creationDate\":\"07\\/02\\/09\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"TPL_BLUESTORK_XML_DESCRIPTION\",\"group\":\"\"}','{\"useRoundedCorners\":\"1\",\"showSiteName\":\"0\",\"textBig\":\"0\",\"highContrast\":\"0\"}','','',0,'0000-00-00 00:00:00',0,0),(503,'beez_20','template','beez_20','',0,1,1,0,'{\"legacy\":false,\"name\":\"beez_20\",\"type\":\"template\",\"creationDate\":\"25 November 2009\",\"author\":\"Angie Radtke\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.\",\"authorEmail\":\"a.radtke@derauftritt.de\",\"authorUrl\":\"http:\\/\\/www.der-auftritt.de\",\"version\":\"2.5.0\",\"description\":\"TPL_BEEZ2_XML_DESCRIPTION\",\"group\":\"\"}','{\"wrapperSmall\":\"53\",\"wrapperLarge\":\"72\",\"sitetitle\":\"\",\"sitedescription\":\"\",\"navposition\":\"center\",\"templatecolor\":\"nature\"}','','',0,'0000-00-00 00:00:00',0,0),(504,'hathor','template','hathor','',1,1,1,0,'{\"legacy\":false,\"name\":\"hathor\",\"type\":\"template\",\"creationDate\":\"May 2010\",\"author\":\"Andrea Tarr\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.\",\"authorEmail\":\"hathor@tarrconsulting.com\",\"authorUrl\":\"http:\\/\\/www.tarrconsulting.com\",\"version\":\"2.5.0\",\"description\":\"TPL_HATHOR_XML_DESCRIPTION\",\"group\":\"\"}','{\"showSiteName\":\"0\",\"colourChoice\":\"0\",\"boldText\":\"0\"}','','',0,'0000-00-00 00:00:00',0,0),(505,'beez5','template','beez5','',0,1,1,0,'{\"legacy\":false,\"name\":\"beez5\",\"type\":\"template\",\"creationDate\":\"21 May 2010\",\"author\":\"Angie Radtke\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.\",\"authorEmail\":\"a.radtke@derauftritt.de\",\"authorUrl\":\"http:\\/\\/www.der-auftritt.de\",\"version\":\"2.5.0\",\"description\":\"TPL_BEEZ5_XML_DESCRIPTION\",\"group\":\"\"}','{\"wrapperSmall\":\"53\",\"wrapperLarge\":\"72\",\"sitetitle\":\"\",\"sitedescription\":\"\",\"navposition\":\"center\",\"html5\":\"0\"}','','',0,'0000-00-00 00:00:00',0,0),(600,'English (United Kingdom)','language','en-GB','',0,1,1,1,'{\"legacy\":false,\"name\":\"English (United Kingdom)\",\"type\":\"language\",\"creationDate\":\"2008-03-15\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.10\",\"description\":\"en-GB site language\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0),(601,'English (United Kingdom)','language','en-GB','',1,1,1,1,'{\"legacy\":false,\"name\":\"English (United Kingdom)\",\"type\":\"language\",\"creationDate\":\"2008-03-15\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.10\",\"description\":\"en-GB administrator language\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0),(700,'files_joomla','file','joomla','',0,1,1,1,'{\"legacy\":false,\"name\":\"files_joomla\",\"type\":\"file\",\"creationDate\":\"April 2013\",\"author\":\"Joomla! Project\",\"copyright\":\"(C) 2005 - 2013 Open Source Matters. All rights reserved\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"www.joomla.org\",\"version\":\"2.5.11\",\"description\":\"FILES_JOOMLA_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0),(800,'PKG_JOOMLA','package','pkg_joomla','',0,1,1,1,'{\"legacy\":false,\"name\":\"PKG_JOOMLA\",\"type\":\"package\",\"creationDate\":\"2006\",\"author\":\"Joomla! Project\",\"copyright\":\"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.\",\"authorEmail\":\"admin@joomla.org\",\"authorUrl\":\"http:\\/\\/www.joomla.org\",\"version\":\"2.5.0\",\"description\":\"PKG_JOOMLA_XML_DESCRIPTION\",\"group\":\"\"}','','','',0,'0000-00-00 00:00:00',0,0),(10000,'plg_editors_jce','plugin','jce','editors',0,1,1,0,'{\"legacy\":false,\"name\":\"plg_editors_jce\",\"type\":\"plugin\",\"creationDate\":\"27 March 2013\",\"author\":\"Ryan Demmer\",\"copyright\":\"2006-2010 Ryan Demmer\",\"authorEmail\":\"info@joomlacontenteditor.net\",\"authorUrl\":\"http:\\/\\/www.joomlacontenteditor.net\",\"version\":\"2.3.2.4\",\"description\":\"WF_EDITOR_PLUGIN_DESC\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',0,0),(10001,'plg_quickicon_jcefilebrowser','plugin','jcefilebrowser','quickicon',0,1,1,0,'{\"legacy\":false,\"name\":\"plg_quickicon_jcefilebrowser\",\"type\":\"plugin\",\"creationDate\":\"27 March 2013\",\"author\":\"Ryan Demmer\",\"copyright\":\"Copyright (C) 2006 - 2013 Ryan Demmer. All rights reserved\",\"authorEmail\":\"@@email@@\",\"authorUrl\":\"www.joomalcontenteditor.net\",\"version\":\"2.3.2.4\",\"description\":\"PLG_QUICKICON_JCEFILEBROWSER_XML_DESCRIPTION\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',0,0),(10002,'jce','component','com_jce','',1,1,0,0,'{\"legacy\":false,\"name\":\"JCE\",\"type\":\"component\",\"creationDate\":\"27 March 2013\",\"author\":\"Ryan Demmer\",\"copyright\":\"Copyright (C) 2006 - 2013 Ryan Demmer. All rights reserved\",\"authorEmail\":\"info@joomlacontenteditor.net\",\"authorUrl\":\"www.joomlacontenteditor.net\",\"version\":\"2.3.2.4\",\"description\":\"WF_ADMIN_DESC\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',0,0),(10003,'js_wright','template','js_wright','',0,1,1,0,'{\"legacy\":false,\"name\":\"js_wright\",\"type\":\"template\",\"creationDate\":\"April 2013\",\"author\":\"Joomlashack\",\"copyright\":\"Copyright Joomlashack 2013. All rights reserved\",\"authorEmail\":\"support@joomlashack.com\",\"authorUrl\":\"http:\\/\\/www.joomlashack.com\",\"version\":\"3.0.22\",\"description\":\"TPL_JS_WRIGHT_XML_DESCRIPTION\",\"group\":\"\"}','{\"rebrand\":\"no\",\"style\":\"theme1\",\"mootools\":\"1\",\"jquery\":\"1\",\"javascriptBottom\":\"1\",\"logo\":\"template\",\"logowidth\":\"4\",\"body_font\":\"default\",\"header_font\":\"default\",\"columns\":\"sidebar1:3;main:6;sidebar2:3\",\"bs_rowmode\":\"row\",\"responsive\":\"1\",\"stickyFooter\":\"1\",\"wright_bootstrap_images\":\"\"}','','',0,'0000-00-00 00:00:00',0,0),(10004,'com_jcomments','component','com_jcomments','',1,1,0,0,'{\"legacy\":true,\"name\":\"JComments\",\"type\":\"component\",\"creationDate\":\"20\\/02\\/2012\",\"author\":\"smart\",\"copyright\":\"Copyright 2006-2012 JoomlaTune.ru All rights reserved!\",\"authorEmail\":\"smart@joomlatune.ru\",\"authorUrl\":\"http:\\/\\/www.joomlatune.ru\",\"version\":\"2.3.0\",\"description\":\"JComments lets your users comment on content items.\",\"group\":\"\"}','{}','','',0,'0000-00-00 00:00:00',0,0),(10005,'plg_content_jcomments','plugin','jcomments','content',0,1,1,0,'','','','',0,'0000-00-00 00:00:00',7,0),(10006,'plg_search_jcomments','plugin','jcomments','search',0,1,1,0,'','','','',0,'0000-00-00 00:00:00',1,0),(10007,'plg_system_jcomments','plugin','jcomments','system',0,1,1,0,'','','','',0,'0000-00-00 00:00:00',11,0),(10008,'plg_editors-xtd_jcommentson','plugin','jcommentson','editors-xtd',0,1,1,0,'','','','',0,'0000-00-00 00:00:00',5,0),(10009,'plg_editors-xtd_jcommentsoff','plugin','jcommentsoff','editors-xtd',0,1,1,0,'','','','',0,'0000-00-00 00:00:00',5,0),(10010,'plg_user_jcomments','plugin','jcomments','user',0,1,1,0,'','','','',0,'0000-00-00 00:00:00',3,0),(10011,'vnsoftskills','template','vnsoftskills','',0,1,1,0,'{\"legacy\":false,\"name\":\"vnsoftskills\",\"type\":\"template\",\"creationDate\":\"April 2013\",\"author\":\"Ngoc Nha\",\"copyright\":\"Copyright VN Soft Skills 2013. All rights reserved\",\"authorEmail\":\"info@vnsoftskills.com\",\"authorUrl\":\"http:\\/\\/www.vnsoftskills.com\",\"version\":\"3.0.22\",\"description\":\"TPL_JS_WRIGHT_XML_DESCRIPTION\",\"group\":\"\"}','{\"rebrand\":\"no\",\"style\":\"theme1\",\"mootools\":\"1\",\"jquery\":\"1\",\"javascriptBottom\":\"1\",\"logo\":\"template\",\"logowidth\":\"4\",\"body_font\":\"default\",\"header_font\":\"default\",\"columns\":\"sidebar1:3;main:6;sidebar2:3\",\"bs_rowmode\":\"row\",\"responsive\":\"1\",\"stickyFooter\":\"1\",\"wright_bootstrap_images\":\"\"}','','',0,'0000-00-00 00:00:00',0,0);
/*!40000 ALTER TABLE `d3sgo_extensions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_finder_filters`
--

DROP TABLE IF EXISTS `d3sgo_finder_filters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_finder_filters` (
  `filter_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL,
  `created_by_alias` varchar(255) NOT NULL,
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `map_count` int(10) unsigned NOT NULL DEFAULT '0',
  `data` text NOT NULL,
  `params` mediumtext,
  PRIMARY KEY (`filter_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_finder_filters`
--

LOCK TABLES `d3sgo_finder_filters` WRITE;
/*!40000 ALTER TABLE `d3sgo_finder_filters` DISABLE KEYS */;
/*!40000 ALTER TABLE `d3sgo_finder_filters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_finder_links`
--

DROP TABLE IF EXISTS `d3sgo_finder_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_finder_links` (
  `link_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `route` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `indexdate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `md5sum` varchar(32) DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `state` int(5) DEFAULT '1',
  `access` int(5) DEFAULT '0',
  `language` varchar(8) NOT NULL,
  `publish_start_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_end_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `start_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `end_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `list_price` double unsigned NOT NULL DEFAULT '0',
  `sale_price` double unsigned NOT NULL DEFAULT '0',
  `type_id` int(11) NOT NULL,
  `object` mediumblob NOT NULL,
  PRIMARY KEY (`link_id`),
  KEY `idx_type` (`type_id`),
  KEY `idx_title` (`title`),
  KEY `idx_md5` (`md5sum`),
  KEY `idx_url` (`url`(75)),
  KEY `idx_published_list` (`published`,`state`,`access`,`publish_start_date`,`publish_end_date`,`list_price`),
  KEY `idx_published_sale` (`published`,`state`,`access`,`publish_start_date`,`publish_end_date`,`sale_price`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_finder_links`
--

LOCK TABLES `d3sgo_finder_links` WRITE;
/*!40000 ALTER TABLE `d3sgo_finder_links` DISABLE KEYS */;
/*!40000 ALTER TABLE `d3sgo_finder_links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_finder_links_terms0`
--

DROP TABLE IF EXISTS `d3sgo_finder_links_terms0`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_finder_links_terms0` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_finder_links_terms0`
--

LOCK TABLES `d3sgo_finder_links_terms0` WRITE;
/*!40000 ALTER TABLE `d3sgo_finder_links_terms0` DISABLE KEYS */;
/*!40000 ALTER TABLE `d3sgo_finder_links_terms0` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_finder_links_terms1`
--

DROP TABLE IF EXISTS `d3sgo_finder_links_terms1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_finder_links_terms1` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_finder_links_terms1`
--

LOCK TABLES `d3sgo_finder_links_terms1` WRITE;
/*!40000 ALTER TABLE `d3sgo_finder_links_terms1` DISABLE KEYS */;
/*!40000 ALTER TABLE `d3sgo_finder_links_terms1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_finder_links_terms2`
--

DROP TABLE IF EXISTS `d3sgo_finder_links_terms2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_finder_links_terms2` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_finder_links_terms2`
--

LOCK TABLES `d3sgo_finder_links_terms2` WRITE;
/*!40000 ALTER TABLE `d3sgo_finder_links_terms2` DISABLE KEYS */;
/*!40000 ALTER TABLE `d3sgo_finder_links_terms2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_finder_links_terms3`
--

DROP TABLE IF EXISTS `d3sgo_finder_links_terms3`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_finder_links_terms3` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_finder_links_terms3`
--

LOCK TABLES `d3sgo_finder_links_terms3` WRITE;
/*!40000 ALTER TABLE `d3sgo_finder_links_terms3` DISABLE KEYS */;
/*!40000 ALTER TABLE `d3sgo_finder_links_terms3` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_finder_links_terms4`
--

DROP TABLE IF EXISTS `d3sgo_finder_links_terms4`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_finder_links_terms4` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_finder_links_terms4`
--

LOCK TABLES `d3sgo_finder_links_terms4` WRITE;
/*!40000 ALTER TABLE `d3sgo_finder_links_terms4` DISABLE KEYS */;
/*!40000 ALTER TABLE `d3sgo_finder_links_terms4` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_finder_links_terms5`
--

DROP TABLE IF EXISTS `d3sgo_finder_links_terms5`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_finder_links_terms5` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_finder_links_terms5`
--

LOCK TABLES `d3sgo_finder_links_terms5` WRITE;
/*!40000 ALTER TABLE `d3sgo_finder_links_terms5` DISABLE KEYS */;
/*!40000 ALTER TABLE `d3sgo_finder_links_terms5` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_finder_links_terms6`
--

DROP TABLE IF EXISTS `d3sgo_finder_links_terms6`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_finder_links_terms6` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_finder_links_terms6`
--

LOCK TABLES `d3sgo_finder_links_terms6` WRITE;
/*!40000 ALTER TABLE `d3sgo_finder_links_terms6` DISABLE KEYS */;
/*!40000 ALTER TABLE `d3sgo_finder_links_terms6` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_finder_links_terms7`
--

DROP TABLE IF EXISTS `d3sgo_finder_links_terms7`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_finder_links_terms7` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_finder_links_terms7`
--

LOCK TABLES `d3sgo_finder_links_terms7` WRITE;
/*!40000 ALTER TABLE `d3sgo_finder_links_terms7` DISABLE KEYS */;
/*!40000 ALTER TABLE `d3sgo_finder_links_terms7` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_finder_links_terms8`
--

DROP TABLE IF EXISTS `d3sgo_finder_links_terms8`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_finder_links_terms8` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_finder_links_terms8`
--

LOCK TABLES `d3sgo_finder_links_terms8` WRITE;
/*!40000 ALTER TABLE `d3sgo_finder_links_terms8` DISABLE KEYS */;
/*!40000 ALTER TABLE `d3sgo_finder_links_terms8` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_finder_links_terms9`
--

DROP TABLE IF EXISTS `d3sgo_finder_links_terms9`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_finder_links_terms9` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_finder_links_terms9`
--

LOCK TABLES `d3sgo_finder_links_terms9` WRITE;
/*!40000 ALTER TABLE `d3sgo_finder_links_terms9` DISABLE KEYS */;
/*!40000 ALTER TABLE `d3sgo_finder_links_terms9` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_finder_links_termsa`
--

DROP TABLE IF EXISTS `d3sgo_finder_links_termsa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_finder_links_termsa` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_finder_links_termsa`
--

LOCK TABLES `d3sgo_finder_links_termsa` WRITE;
/*!40000 ALTER TABLE `d3sgo_finder_links_termsa` DISABLE KEYS */;
/*!40000 ALTER TABLE `d3sgo_finder_links_termsa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_finder_links_termsb`
--

DROP TABLE IF EXISTS `d3sgo_finder_links_termsb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_finder_links_termsb` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_finder_links_termsb`
--

LOCK TABLES `d3sgo_finder_links_termsb` WRITE;
/*!40000 ALTER TABLE `d3sgo_finder_links_termsb` DISABLE KEYS */;
/*!40000 ALTER TABLE `d3sgo_finder_links_termsb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_finder_links_termsc`
--

DROP TABLE IF EXISTS `d3sgo_finder_links_termsc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_finder_links_termsc` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_finder_links_termsc`
--

LOCK TABLES `d3sgo_finder_links_termsc` WRITE;
/*!40000 ALTER TABLE `d3sgo_finder_links_termsc` DISABLE KEYS */;
/*!40000 ALTER TABLE `d3sgo_finder_links_termsc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_finder_links_termsd`
--

DROP TABLE IF EXISTS `d3sgo_finder_links_termsd`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_finder_links_termsd` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_finder_links_termsd`
--

LOCK TABLES `d3sgo_finder_links_termsd` WRITE;
/*!40000 ALTER TABLE `d3sgo_finder_links_termsd` DISABLE KEYS */;
/*!40000 ALTER TABLE `d3sgo_finder_links_termsd` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_finder_links_termse`
--

DROP TABLE IF EXISTS `d3sgo_finder_links_termse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_finder_links_termse` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_finder_links_termse`
--

LOCK TABLES `d3sgo_finder_links_termse` WRITE;
/*!40000 ALTER TABLE `d3sgo_finder_links_termse` DISABLE KEYS */;
/*!40000 ALTER TABLE `d3sgo_finder_links_termse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_finder_links_termsf`
--

DROP TABLE IF EXISTS `d3sgo_finder_links_termsf`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_finder_links_termsf` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_finder_links_termsf`
--

LOCK TABLES `d3sgo_finder_links_termsf` WRITE;
/*!40000 ALTER TABLE `d3sgo_finder_links_termsf` DISABLE KEYS */;
/*!40000 ALTER TABLE `d3sgo_finder_links_termsf` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_finder_taxonomy`
--

DROP TABLE IF EXISTS `d3sgo_finder_taxonomy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_finder_taxonomy` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `state` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `access` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ordering` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  KEY `state` (`state`),
  KEY `ordering` (`ordering`),
  KEY `access` (`access`),
  KEY `idx_parent_published` (`parent_id`,`state`,`access`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_finder_taxonomy`
--

LOCK TABLES `d3sgo_finder_taxonomy` WRITE;
/*!40000 ALTER TABLE `d3sgo_finder_taxonomy` DISABLE KEYS */;
INSERT INTO `d3sgo_finder_taxonomy` VALUES (1,0,'ROOT',0,0,0);
/*!40000 ALTER TABLE `d3sgo_finder_taxonomy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_finder_taxonomy_map`
--

DROP TABLE IF EXISTS `d3sgo_finder_taxonomy_map`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_finder_taxonomy_map` (
  `link_id` int(10) unsigned NOT NULL,
  `node_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`node_id`),
  KEY `link_id` (`link_id`),
  KEY `node_id` (`node_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_finder_taxonomy_map`
--

LOCK TABLES `d3sgo_finder_taxonomy_map` WRITE;
/*!40000 ALTER TABLE `d3sgo_finder_taxonomy_map` DISABLE KEYS */;
/*!40000 ALTER TABLE `d3sgo_finder_taxonomy_map` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_finder_terms`
--

DROP TABLE IF EXISTS `d3sgo_finder_terms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_finder_terms` (
  `term_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `term` varchar(75) NOT NULL,
  `stem` varchar(75) NOT NULL,
  `common` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `phrase` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `weight` float unsigned NOT NULL DEFAULT '0',
  `soundex` varchar(75) NOT NULL,
  `links` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_id`),
  UNIQUE KEY `idx_term` (`term`),
  KEY `idx_term_phrase` (`term`,`phrase`),
  KEY `idx_stem_phrase` (`stem`,`phrase`),
  KEY `idx_soundex_phrase` (`soundex`,`phrase`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_finder_terms`
--

LOCK TABLES `d3sgo_finder_terms` WRITE;
/*!40000 ALTER TABLE `d3sgo_finder_terms` DISABLE KEYS */;
/*!40000 ALTER TABLE `d3sgo_finder_terms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_finder_terms_common`
--

DROP TABLE IF EXISTS `d3sgo_finder_terms_common`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_finder_terms_common` (
  `term` varchar(75) NOT NULL,
  `language` varchar(3) NOT NULL,
  KEY `idx_word_lang` (`term`,`language`),
  KEY `idx_lang` (`language`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_finder_terms_common`
--

LOCK TABLES `d3sgo_finder_terms_common` WRITE;
/*!40000 ALTER TABLE `d3sgo_finder_terms_common` DISABLE KEYS */;
INSERT INTO `d3sgo_finder_terms_common` VALUES ('a','en'),('about','en'),('after','en'),('ago','en'),('all','en'),('am','en'),('an','en'),('and','en'),('ani','en'),('any','en'),('are','en'),('aren\'t','en'),('as','en'),('at','en'),('be','en'),('but','en'),('by','en'),('for','en'),('from','en'),('get','en'),('go','en'),('how','en'),('if','en'),('in','en'),('into','en'),('is','en'),('isn\'t','en'),('it','en'),('its','en'),('me','en'),('more','en'),('most','en'),('must','en'),('my','en'),('new','en'),('no','en'),('none','en'),('not','en'),('noth','en'),('nothing','en'),('of','en'),('off','en'),('often','en'),('old','en'),('on','en'),('onc','en'),('once','en'),('onli','en'),('only','en'),('or','en'),('other','en'),('our','en'),('ours','en'),('out','en'),('over','en'),('page','en'),('she','en'),('should','en'),('small','en'),('so','en'),('some','en'),('than','en'),('thank','en'),('that','en'),('the','en'),('their','en'),('theirs','en'),('them','en'),('then','en'),('there','en'),('these','en'),('they','en'),('this','en'),('those','en'),('thus','en'),('time','en'),('times','en'),('to','en'),('too','en'),('true','en'),('under','en'),('until','en'),('up','en'),('upon','en'),('use','en'),('user','en'),('users','en'),('veri','en'),('version','en'),('very','en'),('via','en'),('want','en'),('was','en'),('way','en'),('were','en'),('what','en'),('when','en'),('where','en'),('whi','en'),('which','en'),('who','en'),('whom','en'),('whose','en'),('why','en'),('wide','en'),('will','en'),('with','en'),('within','en'),('without','en'),('would','en'),('yes','en'),('yet','en'),('you','en'),('your','en'),('yours','en');
/*!40000 ALTER TABLE `d3sgo_finder_terms_common` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_finder_tokens`
--

DROP TABLE IF EXISTS `d3sgo_finder_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_finder_tokens` (
  `term` varchar(75) NOT NULL,
  `stem` varchar(75) NOT NULL,
  `common` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `phrase` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `weight` float unsigned NOT NULL DEFAULT '1',
  `context` tinyint(1) unsigned NOT NULL DEFAULT '2',
  KEY `idx_word` (`term`),
  KEY `idx_context` (`context`)
) ENGINE=MEMORY DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_finder_tokens`
--

LOCK TABLES `d3sgo_finder_tokens` WRITE;
/*!40000 ALTER TABLE `d3sgo_finder_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `d3sgo_finder_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_finder_tokens_aggregate`
--

DROP TABLE IF EXISTS `d3sgo_finder_tokens_aggregate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_finder_tokens_aggregate` (
  `term_id` int(10) unsigned NOT NULL,
  `map_suffix` char(1) NOT NULL,
  `term` varchar(75) NOT NULL,
  `stem` varchar(75) NOT NULL,
  `common` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `phrase` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `term_weight` float unsigned NOT NULL,
  `context` tinyint(1) unsigned NOT NULL DEFAULT '2',
  `context_weight` float unsigned NOT NULL,
  `total_weight` float unsigned NOT NULL,
  KEY `token` (`term`),
  KEY `keyword_id` (`term_id`)
) ENGINE=MEMORY DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_finder_tokens_aggregate`
--

LOCK TABLES `d3sgo_finder_tokens_aggregate` WRITE;
/*!40000 ALTER TABLE `d3sgo_finder_tokens_aggregate` DISABLE KEYS */;
/*!40000 ALTER TABLE `d3sgo_finder_tokens_aggregate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_finder_types`
--

DROP TABLE IF EXISTS `d3sgo_finder_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_finder_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `mime` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_finder_types`
--

LOCK TABLES `d3sgo_finder_types` WRITE;
/*!40000 ALTER TABLE `d3sgo_finder_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `d3sgo_finder_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_jcomments`
--

DROP TABLE IF EXISTS `d3sgo_jcomments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_jcomments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `parent` int(11) unsigned NOT NULL DEFAULT '0',
  `thread_id` int(11) unsigned NOT NULL DEFAULT '0',
  `path` varchar(255) NOT NULL DEFAULT '',
  `level` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `object_id` int(11) unsigned NOT NULL DEFAULT '0',
  `object_group` varchar(255) NOT NULL DEFAULT '',
  `object_params` text NOT NULL,
  `lang` varchar(255) NOT NULL DEFAULT '',
  `userid` int(11) unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `username` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `homepage` varchar(255) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `comment` text NOT NULL,
  `ip` varchar(39) NOT NULL DEFAULT '',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `isgood` smallint(5) NOT NULL DEFAULT '0',
  `ispoor` smallint(5) NOT NULL DEFAULT '0',
  `published` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `deleted` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `subscribe` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `source` varchar(255) NOT NULL DEFAULT '',
  `source_id` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `editor` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_userid` (`userid`),
  KEY `idx_source` (`source`),
  KEY `idx_email` (`email`),
  KEY `idx_lang` (`lang`),
  KEY `idx_subscribe` (`subscribe`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_object` (`object_id`,`object_group`,`published`,`date`),
  KEY `idx_path` (`path`,`level`),
  KEY `idx_thread` (`thread_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_jcomments`
--

LOCK TABLES `d3sgo_jcomments` WRITE;
/*!40000 ALTER TABLE `d3sgo_jcomments` DISABLE KEYS */;
INSERT INTO `d3sgo_jcomments` VALUES (1,0,0,'0',0,1,'com_content','','en-GB',0,'Test','Test','bngnha@gmail.com.vn','','','Hay qua,...cam on admin','::1','2013-05-18 14:32:21',0,0,1,0,0,'',0,732,'2013-05-18 15:10:04',''),(2,0,0,'0',0,1,'com_content','','en-GB',0,'Test','Test','bngnha@gmail.com.vn','','','[quote name=\"Test\"]Hay qua,...cam on admin[/quote]<br />Test comment thoi...','::1','2013-05-18 14:33:20',0,0,1,0,0,'',0,0,'0000-00-00 00:00:00','');
/*!40000 ALTER TABLE `d3sgo_jcomments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_jcomments_blacklist`
--

DROP TABLE IF EXISTS `d3sgo_jcomments_blacklist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_jcomments_blacklist` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(39) NOT NULL DEFAULT '',
  `userid` int(11) unsigned NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) unsigned NOT NULL DEFAULT '0',
  `expire` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `reason` tinytext NOT NULL,
  `notes` tinytext NOT NULL,
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `editor` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_ip` (`ip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_jcomments_blacklist`
--

LOCK TABLES `d3sgo_jcomments_blacklist` WRITE;
/*!40000 ALTER TABLE `d3sgo_jcomments_blacklist` DISABLE KEYS */;
/*!40000 ALTER TABLE `d3sgo_jcomments_blacklist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_jcomments_custom_bbcodes`
--

DROP TABLE IF EXISTS `d3sgo_jcomments_custom_bbcodes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_jcomments_custom_bbcodes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL DEFAULT '',
  `simple_pattern` varchar(255) NOT NULL DEFAULT '',
  `simple_replacement_html` text NOT NULL,
  `simple_replacement_text` text NOT NULL,
  `pattern` varchar(255) NOT NULL DEFAULT '',
  `replacement_html` text NOT NULL,
  `replacement_text` text NOT NULL,
  `button_acl` text NOT NULL,
  `button_open_tag` varchar(16) NOT NULL DEFAULT '',
  `button_close_tag` varchar(16) NOT NULL DEFAULT '',
  `button_title` varchar(255) NOT NULL DEFAULT '',
  `button_prompt` varchar(255) NOT NULL DEFAULT '',
  `button_image` varchar(255) NOT NULL DEFAULT '',
  `button_css` varchar(255) NOT NULL DEFAULT '',
  `button_enabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ordering` int(11) unsigned NOT NULL DEFAULT '0',
  `published` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_jcomments_custom_bbcodes`
--

LOCK TABLES `d3sgo_jcomments_custom_bbcodes` WRITE;
/*!40000 ALTER TABLE `d3sgo_jcomments_custom_bbcodes` DISABLE KEYS */;
INSERT INTO `d3sgo_jcomments_custom_bbcodes` VALUES (1,'YouTube Video','[youtube]http://www.youtube.com/watch?v={IDENTIFIER}[/youtube]','<object width=\"425\" height=\"350\"><param name=\"movie\" value=\"http://www.youtube.com/v/{IDENTIFIER}\"></param><param name=\"wmode\" value=\"transparent\"></param><embed src=\"http://www.youtube.com/v/{IDENTIFIER}\" type=\"application/x-shockwave-flash\" wmode=\"transparent\" width=\"425\" height=\"350\"></embed></object>','http://www.youtube.com/watch?v={IDENTIFIER}','\\[youtube\\]http\\:\\/\\/www\\.youtube\\.com\\/watch\\?v\\=([A-Za-z0-9-_]+)([A-Za-z0-9\\%\\&\\=\\#]*?)\\[\\/youtube\\]','<object width=\"425\" height=\"350\"><param name=\"movie\" value=\"http://www.youtube.com/v/${1}\"></param><param name=\"wmode\" value=\"transparent\"></param><embed src=\"http://www.youtube.com/v/${1}\" type=\"application/x-shockwave-flash\" wmode=\"transparent\" width=\"425\" height=\"350\"></embed></object>','http://www.youtube.com/watch?v=${1}','1,2,3,4,5,6,7,8','[youtube]','[/youtube]','YouTube Video','','','bbcode-youtube',1,1,1),(2,'YouTube Video (short syntax)','[youtube]{IDENTIFIER}[/youtube]','<object width=\"425\" height=\"350\"><param name=\"movie\" value=\"http://www.youtube.com/v/{IDENTIFIER}\"></param><param name=\"wmode\" value=\"transparent\"></param><embed src=\"http://www.youtube.com/v/{IDENTIFIER}\" type=\"application/x-shockwave-flash\" wmode=\"transparent\" width=\"425\" height=\"350\"></embed></object>','http://www.youtube.com/watch?v={IDENTIFIER}','\\[youtube\\]([A-Za-z0-9-_]+)([A-Za-z0-9\\%\\&\\=\\#]*?)\\[\\/youtube\\]','<object width=\"425\" height=\"350\"><param name=\"movie\" value=\"http://www.youtube.com/v/${1}\"></param><param name=\"wmode\" value=\"transparent\"></param><embed src=\"http://www.youtube.com/v/${1}\" type=\"application/x-shockwave-flash\" wmode=\"transparent\" width=\"425\" height=\"350\"></embed></object>','http://www.youtube.com/watch?v=${1}','1,2,3,4,5,6,7,8','','','','','','',0,2,1),(3,'YouTube Video (full syntax)','[youtube]http://www.youtube.com/watch?v={IDENTIFIER}{TEXT}[/youtube]','<object width=\"425\" height=\"350\"><param name=\"movie\" value=\"http://www.youtube.com/v/{IDENTIFIER}\"></param><param name=\"wmode\" value=\"transparent\"></param><embed src=\"http://www.youtube.com/v/{IDENTIFIER}\" type=\"application/x-shockwave-flash\" wmode=\"transparent\" width=\"425\" height=\"350\"></embed></object>','http://www.youtube.com/watch?v={IDENTIFIER}','\\[youtube\\]http\\:\\/\\/www\\.youtube\\.com\\/watch\\?v\\=([A-Za-z0-9-_]+)([\\w0-9-\\+\\=\\!\\?\\(\\)\\[\\]\\{\\}\\&\\%\\*\\#\\.,_ ]+)\\[\\/youtube\\]','<object width=\"425\" height=\"350\"><param name=\"movie\" value=\"http://www.youtube.com/v/${1}\"></param><param name=\"wmode\" value=\"transparent\"></param><embed src=\"http://www.youtube.com/v/${1}\" type=\"application/x-shockwave-flash\" wmode=\"transparent\" width=\"425\" height=\"350\"></embed></object>','http://www.youtube.com/watch?v=${1}','1,2,3,4,5,6,7,8','[youtube]','[/youtube]','YouTube Video','','','',0,3,1),(4,'Google Video','[google]http://video.google.com/videoplay?docid={IDENTIFIER}[/google]','<embed style=\"width:425px; height:350px;\" id=\"VideoPlayback\" type=\"application/x-shockwave-flash\" src=\"http://video.google.com/googleplayer.swf?docId={IDENTIFIER}\" flashvars=\"\"></embed>','http://video.google.com/videoplay?docid={IDENTIFIER}','\\[google\\]http\\:\\/\\/video\\.google\\.com\\/videoplay\\?docid\\=([A-Za-z0-9-_]+)([A-Za-z0-9\\%\\&\\=\\#]*?)\\[\\/google\\]','<embed style=\"width:425px; height:350px;\" id=\"VideoPlayback\" type=\"application/x-shockwave-flash\" src=\"http://video.google.com/googleplayer.swf?docId=${1}\" flashvars=\"\"></embed>','http://video.google.com/videoplay?docid=${1}','1,2,3,4,5,6,7,8','[google]','[/google]','Google Video','','','bbcode-google',1,4,1),(5,'Google Video (short syntax)','[google]{IDENTIFIER}[/google]','<embed style=\"width:425px; height:350px;\" id=\"VideoPlayback\" type=\"application/x-shockwave-flash\" src=\"http://video.google.com/googleplayer.swf?docId={IDENTIFIER}\" flashvars=\"\"></embed>','http://video.google.com/videoplay?docid={IDENTIFIER}','\\[google\\]([A-Za-z0-9-_]+)([A-Za-z0-9\\%\\&\\=\\#]*?)\\[\\/google\\]','<embed style=\"width:425px; height:350px;\" id=\"VideoPlayback\" type=\"application/x-shockwave-flash\" src=\"http://video.google.com/googleplayer.swf?docId=${1}\" flashvars=\"\"></embed>','http://video.google.com/videoplay?docid=${1}','1,2,3,4,5,6,7,8','','','','','','',0,5,1),(6,'Google Video (alternate syntax)','[gv]http://video.google.com/videoplay?docid={IDENTIFIER}[/gv]','<embed style=\"width:425px; height:350px;\" id=\"VideoPlayback\" type=\"application/x-shockwave-flash\" src=\"http://video.google.com/googleplayer.swf?docId={IDENTIFIER}\" flashvars=\"\"></embed>','http://video.google.com/videoplay?docid={IDENTIFIER}','\\[gv\\]http\\:\\/\\/video\\.google\\.com\\/videoplay\\?docid\\=([A-Za-z0-9-_]+)([A-Za-z0-9\\%\\&\\=\\#]*?)\\[\\/gv\\]','<embed style=\"width:425px; height:350px;\" id=\"VideoPlayback\" type=\"application/x-shockwave-flash\" src=\"http://video.google.com/googleplayer.swf?docId=${1}\" flashvars=\"\"></embed>','http://video.google.com/videoplay?docid=${1}','1,2,3,4,5,6,7,8','','','','','','',0,6,1),(7,'Google Video (alternate syntax)','[googlevideo]http://video.google.com/videoplay?docid={IDENTIFIER}[/googlevideo]','<embed style=\"width:425px; height:350px;\" id=\"VideoPlayback\" type=\"application/x-shockwave-flash\" src=\"http://video.google.com/googleplayer.swf?docId={IDENTIFIER}\" flashvars=\"\"></embed>','http://video.google.com/videoplay?docid={IDENTIFIER}','\\[googlevideo\\]http\\:\\/\\/video\\.google\\.com\\/videoplay\\?docid\\=([A-Za-z0-9-_]+)([A-Za-z0-9\\%\\&\\=\\#]*?)\\[\\/googlevideo\\]','<embed style=\"width:425px; height:350px;\" id=\"VideoPlayback\" type=\"application/x-shockwave-flash\" src=\"http://video.google.com/googleplayer.swf?docId=${1}\" flashvars=\"\"></embed>','http://video.google.com/videoplay?docid=${1}','1,2,3,4,5,6,7,8','','','','','','',0,7,1),(8,'Facebook Video','[fv]http://www.facebook.com/video/video.php?v={IDENTIFIER}[/fv]','<object width=\"425\" height=\"350\"><param name=\"movie\" value=\"http://www.facebook.com/v/{IDENTIFIER}\"></param><param name=\"wmode\" value=\"transparent\"></param><embed src=\"http://www.facebook.com/v/{IDENTIFIER}\" type=\"application/x-shockwave-flash\" wmode=\"transparent\" width=\"425\" height=\"350\"></embed></object>','http://www.facebook.com/video/video.php?v={IDENTIFIER}','\\[fv\\]http\\:\\/\\/www\\.facebook\\.com\\/video\\/video\\.php\\?v\\=([A-Za-z0-9-_]+)([A-Za-z0-9\\%\\&\\=\\#]*?)\\[\\/fv\\]','<object width=\"425\" height=\"350\"><param name=\"movie\" value=\"http://www.facebook.com/v/${1}\"></param><param name=\"wmode\" value=\"transparent\"></param><embed src=\"http://www.facebook.com/v/${1}\" type=\"application/x-shockwave-flash\" wmode=\"transparent\" width=\"425\" height=\"350\"></embed></object>','http://www.facebook.com/video/video.php?v=${1}','1,2,3,4,5,6,7,8','[fv]','[/fv]','Facebook Video','','','bbcode-facebook',1,8,1),(9,'Facebook Video (short syntax)','[fv]{IDENTIFIER}[/fv]','<object width=\"425\" height=\"350\"><param name=\"movie\" value=\"http://www.facebook.com/v/{IDENTIFIER}\"></param><param name=\"wmode\" value=\"transparent\"></param><embed src=\"http://www.facebook.com/v/{IDENTIFIER}\" type=\"application/x-shockwave-flash\" wmode=\"transparent\" width=\"425\" height=\"350\"></embed></object>','http://www.facebook.com/video/video.php?v={IDENTIFIER}','\\[fv\\]([A-Za-z0-9-_]+)([A-Za-z0-9\\%\\&\\=\\#]*?)\\[\\/fv\\]','<object width=\"425\" height=\"350\"><param name=\"movie\" value=\"http://www.facebook.com/v/${1}\"></param><param name=\"wmode\" value=\"transparent\"></param><embed src=\"http://www.facebook.com/v/${1}\" type=\"application/x-shockwave-flash\" wmode=\"transparent\" width=\"425\" height=\"350\"></embed></object>','http://www.facebook.com/video/video.php?v=${1}','1,2,3,4,5,6,7,8','','','','','','',0,9,1),(10,'Wiki','[wiki]{SIMPLETEXT}[/wiki]','<a href=\"http://www.wikipedia.org/wiki/{SIMPLETEXT}\" title=\"{SIMPLETEXT}\" target=\"_blank\">{SIMPLETEXT}</a>','{SIMPLETEXT}','\\[wiki\\]([A-Za-z0-9\\-\\+\\.,_ ]+)\\[\\/wiki\\]','<a href=\"http://www.wikipedia.org/wiki/${1}\" title=\"${1}\" target=\"_blank\">${1}</a>','${1}','1,2,3,4,5,6,7,8','[wiki]','[/wiki]','Wikipedia','','','bbcode-wiki',1,10,1);
/*!40000 ALTER TABLE `d3sgo_jcomments_custom_bbcodes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_jcomments_objects`
--

DROP TABLE IF EXISTS `d3sgo_jcomments_objects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_jcomments_objects` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `object_id` int(11) unsigned NOT NULL DEFAULT '0',
  `object_group` varchar(255) NOT NULL DEFAULT '',
  `lang` varchar(20) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `link` varchar(255) NOT NULL DEFAULT '',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `userid` int(11) unsigned NOT NULL DEFAULT '0',
  `expired` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `idx_object` (`object_id`,`object_group`,`lang`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_jcomments_objects`
--

LOCK TABLES `d3sgo_jcomments_objects` WRITE;
/*!40000 ALTER TABLE `d3sgo_jcomments_objects` DISABLE KEYS */;
INSERT INTO `d3sgo_jcomments_objects` VALUES (1,1,'com_content','en-GB','Kỹ năng mềm là gì?','/vnsoftskills/index.php/ca-nhan/quan-ly-thoi-gian',1,732,0,'2013-05-18 14:33:20'),(2,2,'com_content','en-GB','Kỹ năng giải quyêt vấn đề','/vnsoftskills/index.php/ca-nhan/giai-quyet-van-de',1,732,0,'2013-05-18 14:09:30'),(3,4,'com_content','en-GB','Marketing Online','/vnsoftskills/index.php/doanh-nghiep/marketing-online',1,732,0,'2013-05-18 15:45:37'),(4,5,'com_content','en-GB','Tiết kiệm 10% thu nhập mỗi tháng','/vnsoftskills/index.php/lam-giau/tu-duy-lam-giau',1,732,0,'2013-05-18 15:46:40'),(5,3,'com_content','en-GB','Bí quyết sáng tạo Đột phá','/vnsoftskills/index.php/truong-hoc/tu-duy-sang-tao',1,732,0,'2013-05-18 15:52:24');
/*!40000 ALTER TABLE `d3sgo_jcomments_objects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_jcomments_reports`
--

DROP TABLE IF EXISTS `d3sgo_jcomments_reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_jcomments_reports` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `commentid` int(11) unsigned NOT NULL DEFAULT '0',
  `userid` int(11) unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `ip` varchar(39) NOT NULL DEFAULT '',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `reason` tinytext NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_jcomments_reports`
--

LOCK TABLES `d3sgo_jcomments_reports` WRITE;
/*!40000 ALTER TABLE `d3sgo_jcomments_reports` DISABLE KEYS */;
/*!40000 ALTER TABLE `d3sgo_jcomments_reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_jcomments_settings`
--

DROP TABLE IF EXISTS `d3sgo_jcomments_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_jcomments_settings` (
  `component` varchar(50) NOT NULL DEFAULT '',
  `lang` varchar(20) NOT NULL DEFAULT '',
  `name` varchar(50) NOT NULL DEFAULT '',
  `value` text NOT NULL,
  PRIMARY KEY (`component`,`lang`,`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_jcomments_settings`
--

LOCK TABLES `d3sgo_jcomments_settings` WRITE;
/*!40000 ALTER TABLE `d3sgo_jcomments_settings` DISABLE KEYS */;
INSERT INTO `d3sgo_jcomments_settings` VALUES ('','','author_email','2'),('','','author_homepage','1'),('','','author_name','2'),('','','autolinkurls','6,7,2,3,4,5,8'),('','','autopublish','6,7,2,3,4,5,8'),('','','badwords',''),('','','can_ban','7,8'),('','','can_comment','1,6,7,2,3,4,5,8'),('','','can_delete','6,7,8'),('','','can_delete_for_my_object',''),('','','can_delete_own','6,7,8'),('','','can_edit','6,7,8'),('','','can_edit_for_my_object',''),('','','can_edit_own','6,7,2,3,4,5,8'),('','','can_publish','6,7,5,8'),('','','can_publish_for_my_object',''),('','','can_reply','1,6,7,2,3,4,5,8'),('','','can_report',''),('','','can_view_email','6,7,8'),('','','can_view_homepage','6,7,2,3,4,5,8'),('','','can_view_ip','7,8'),('','','can_vote','6,7,2,3,4,5,8'),('','','captcha_engine','kcaptcha'),('','','censor_replace_word','[censored]'),('','','comments_order','DESC'),('','','comments_page_limit','15'),('','','comments_pagination','both'),('','','comments_per_page','10'),('','','comment_maxlength','1000'),('','','comment_minlength','0'),('','','comment_title','0'),('','','delete_mode','0'),('','','display_author','name'),('','','emailprotection','1'),('','','enable_autocensor','1'),('','','enable_bbcode_b','6,7,2,3,4,5,8'),('','','enable_bbcode_code',''),('','','enable_bbcode_hide','6,7,2,3,4,5,8'),('','','enable_bbcode_i','6,7,2,3,4,5,8'),('','','enable_bbcode_img','6,7,2,3,4,5,8'),('','','enable_bbcode_list','6,7,2,3,4,5,8'),('','','enable_bbcode_quote','1,6,7,2,3,4,5,8'),('','','enable_bbcode_s','6,7,2,3,4,5,8'),('','','enable_bbcode_u','6,7,2,3,4,5,8'),('','','enable_bbcode_url','6,7,2,3,4,5,8'),('','','enable_blacklist','0'),('','','enable_captcha','1'),('','','enable_categories','2'),('','','enable_comment_length_check','1,2'),('','','enable_comment_maxlength_check',''),('','','enable_custom_bbcode','0'),('','','enable_geshi','0'),('','','enable_gravatar',''),('','','enable_mambots','1'),('','','enable_nested_quotes','1'),('','','enable_notification','0'),('','','enable_quick_moderation','0'),('','','enable_reports','0'),('','','enable_rss','0'),('','','enable_smiles','1'),('','','enable_subscribe','1,6,7,2,3,4,5,8'),('','','enable_username_check','1'),('','','enable_voting','1'),('','','feed_limit','100'),('','','floodprotection','1,2,3,4'),('','','flood_time','30'),('','','forbidden_names','administrator,moderator'),('','','form_position','0'),('','','form_show','1'),('','','link_maxlength','30'),('','','load_cached_comments','0'),('','','max_comments_per_object','0'),('','','merge_time','0'),('','','message_banned',''),('','','message_locked','Comments are now closed for this entry'),('','','message_policy_post',''),('','','message_policy_whocancomment','You have no rights to post comments'),('','','notification_email',''),('','','notification_type','1,2'),('','','reports_before_unpublish','0'),('','','reports_per_comment','0'),('','','report_reason_required','1'),('','','show_commentlength','1'),('','','show_policy','1,2'),('','','smiles',':D	laugh.gif\n:lol:	lol.gif\n:-)	smile.gif\n;-)	wink.gif\n8)	cool.gif\n:-|	normal.gif\n:-*	whistling.gif\n:oops:	redface.gif\n:sad:	sad.gif\n:cry:	cry.gif\n:o	surprised.gif\n:-?	confused.gif\n:-x	sick.gif\n:eek:	shocked.gif\n:zzz	sleeping.gif\n:P	tongue.gif\n:roll:	rolleyes.gif\n:sigh:	unsure.gif'),('','','smiles_path','/components/com_jcomments/images/smiles/'),('','','template','default'),('','','template_view','list'),('','','tree_order','0'),('','','username_maxlength','20'),('','','word_maxlength','15');
/*!40000 ALTER TABLE `d3sgo_jcomments_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_jcomments_subscriptions`
--

DROP TABLE IF EXISTS `d3sgo_jcomments_subscriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_jcomments_subscriptions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `object_id` int(11) unsigned NOT NULL DEFAULT '0',
  `object_group` varchar(255) NOT NULL DEFAULT '',
  `lang` varchar(255) NOT NULL DEFAULT '',
  `userid` int(11) unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `hash` varchar(255) NOT NULL DEFAULT '',
  `published` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `source` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `idx_object` (`object_id`,`object_group`),
  KEY `idx_lang` (`lang`),
  KEY `idx_source` (`source`),
  KEY `idx_hash` (`hash`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_jcomments_subscriptions`
--

LOCK TABLES `d3sgo_jcomments_subscriptions` WRITE;
/*!40000 ALTER TABLE `d3sgo_jcomments_subscriptions` DISABLE KEYS */;
/*!40000 ALTER TABLE `d3sgo_jcomments_subscriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_jcomments_version`
--

DROP TABLE IF EXISTS `d3sgo_jcomments_version`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_jcomments_version` (
  `version` varchar(16) NOT NULL DEFAULT '',
  `previous` varchar(16) NOT NULL DEFAULT '',
  `installed` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_jcomments_version`
--

LOCK TABLES `d3sgo_jcomments_version` WRITE;
/*!40000 ALTER TABLE `d3sgo_jcomments_version` DISABLE KEYS */;
INSERT INTO `d3sgo_jcomments_version` VALUES ('2.3.0','','2013-05-17 17:57:14','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `d3sgo_jcomments_version` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_jcomments_votes`
--

DROP TABLE IF EXISTS `d3sgo_jcomments_votes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_jcomments_votes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `commentid` int(11) unsigned NOT NULL DEFAULT '0',
  `userid` int(11) unsigned NOT NULL DEFAULT '0',
  `ip` varchar(39) NOT NULL DEFAULT '',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `value` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_comment` (`commentid`,`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_jcomments_votes`
--

LOCK TABLES `d3sgo_jcomments_votes` WRITE;
/*!40000 ALTER TABLE `d3sgo_jcomments_votes` DISABLE KEYS */;
/*!40000 ALTER TABLE `d3sgo_jcomments_votes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_languages`
--

DROP TABLE IF EXISTS `d3sgo_languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_languages` (
  `lang_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `lang_code` char(7) NOT NULL,
  `title` varchar(50) NOT NULL,
  `title_native` varchar(50) NOT NULL,
  `sef` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `description` varchar(512) NOT NULL,
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `sitename` varchar(1024) NOT NULL DEFAULT '',
  `published` int(11) NOT NULL DEFAULT '0',
  `access` int(10) unsigned NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`lang_id`),
  UNIQUE KEY `idx_sef` (`sef`),
  UNIQUE KEY `idx_image` (`image`),
  UNIQUE KEY `idx_langcode` (`lang_code`),
  KEY `idx_access` (`access`),
  KEY `idx_ordering` (`ordering`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_languages`
--

LOCK TABLES `d3sgo_languages` WRITE;
/*!40000 ALTER TABLE `d3sgo_languages` DISABLE KEYS */;
INSERT INTO `d3sgo_languages` VALUES (1,'en-GB','English (UK)','English (UK)','en','en','','','','',1,0,1);
/*!40000 ALTER TABLE `d3sgo_languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_menu`
--

DROP TABLE IF EXISTS `d3sgo_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menutype` varchar(24) NOT NULL COMMENT 'The type of menu this item belongs to. FK to #__menu_types.menutype',
  `title` varchar(255) NOT NULL COMMENT 'The display title of the menu item.',
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'The SEF alias of the menu item.',
  `note` varchar(255) NOT NULL DEFAULT '',
  `path` varchar(1024) NOT NULL COMMENT 'The computed path of the menu item based on the alias field.',
  `link` varchar(1024) NOT NULL COMMENT 'The actually link the menu item refers to.',
  `type` varchar(16) NOT NULL COMMENT 'The type of link: Component, URL, Alias, Separator',
  `published` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'The published state of the menu link.',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '1' COMMENT 'The parent menu item in the menu tree.',
  `level` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'The relative level in the tree.',
  `component_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'FK to #__extensions.id',
  `ordering` int(11) NOT NULL DEFAULT '0' COMMENT 'The relative ordering of the menu item in the tree.',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'FK to #__users.id',
  `checked_out_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'The time the menu item was checked out.',
  `browserNav` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'The click behaviour of the link.',
  `access` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'The access level required to view the menu item.',
  `img` varchar(255) NOT NULL COMMENT 'The image of the menu item.',
  `template_style_id` int(10) unsigned NOT NULL DEFAULT '0',
  `params` text NOT NULL COMMENT 'JSON encoded data for the menu item.',
  `lft` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set lft.',
  `rgt` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set rgt.',
  `home` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Indicates if this menu item is the home or default page.',
  `language` char(7) NOT NULL DEFAULT '',
  `client_id` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_client_id_parent_id_alias_language` (`client_id`,`parent_id`,`alias`,`language`),
  KEY `idx_componentid` (`component_id`,`menutype`,`published`,`access`),
  KEY `idx_menutype` (`menutype`),
  KEY `idx_left_right` (`lft`,`rgt`),
  KEY `idx_alias` (`alias`),
  KEY `idx_path` (`path`(255)),
  KEY `idx_language` (`language`)
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_menu`
--

LOCK TABLES `d3sgo_menu` WRITE;
/*!40000 ALTER TABLE `d3sgo_menu` DISABLE KEYS */;
INSERT INTO `d3sgo_menu` VALUES (1,'','Menu_Item_Root','root','','','','',1,0,0,0,0,0,'0000-00-00 00:00:00',0,0,'',0,'',0,89,0,'*',0),(2,'menu','com_banners','Banners','','Banners','index.php?option=com_banners','component',0,1,1,4,0,0,'0000-00-00 00:00:00',0,0,'class:banners',0,'',1,10,0,'*',1),(3,'menu','com_banners','Banners','','Banners/Banners','index.php?option=com_banners','component',0,2,2,4,0,0,'0000-00-00 00:00:00',0,0,'class:banners',0,'',2,3,0,'*',1),(4,'menu','com_banners_categories','Categories','','Banners/Categories','index.php?option=com_categories&extension=com_banners','component',0,2,2,6,0,0,'0000-00-00 00:00:00',0,0,'class:banners-cat',0,'',4,5,0,'*',1),(5,'menu','com_banners_clients','Clients','','Banners/Clients','index.php?option=com_banners&view=clients','component',0,2,2,4,0,0,'0000-00-00 00:00:00',0,0,'class:banners-clients',0,'',6,7,0,'*',1),(6,'menu','com_banners_tracks','Tracks','','Banners/Tracks','index.php?option=com_banners&view=tracks','component',0,2,2,4,0,0,'0000-00-00 00:00:00',0,0,'class:banners-tracks',0,'',8,9,0,'*',1),(7,'menu','com_contact','Contacts','','Contacts','index.php?option=com_contact','component',0,1,1,8,0,0,'0000-00-00 00:00:00',0,0,'class:contact',0,'',11,16,0,'*',1),(8,'menu','com_contact','Contacts','','Contacts/Contacts','index.php?option=com_contact','component',0,7,2,8,0,0,'0000-00-00 00:00:00',0,0,'class:contact',0,'',12,13,0,'*',1),(9,'menu','com_contact_categories','Categories','','Contacts/Categories','index.php?option=com_categories&extension=com_contact','component',0,7,2,6,0,0,'0000-00-00 00:00:00',0,0,'class:contact-cat',0,'',14,15,0,'*',1),(10,'menu','com_messages','Messaging','','Messaging','index.php?option=com_messages','component',0,1,1,15,0,0,'0000-00-00 00:00:00',0,0,'class:messages',0,'',17,22,0,'*',1),(11,'menu','com_messages_add','New Private Message','','Messaging/New Private Message','index.php?option=com_messages&task=message.add','component',0,10,2,15,0,0,'0000-00-00 00:00:00',0,0,'class:messages-add',0,'',18,19,0,'*',1),(12,'menu','com_messages_read','Read Private Message','','Messaging/Read Private Message','index.php?option=com_messages','component',0,10,2,15,0,0,'0000-00-00 00:00:00',0,0,'class:messages-read',0,'',20,21,0,'*',1),(13,'menu','com_newsfeeds','News Feeds','','News Feeds','index.php?option=com_newsfeeds','component',0,1,1,17,0,0,'0000-00-00 00:00:00',0,0,'class:newsfeeds',0,'',23,28,0,'*',1),(14,'menu','com_newsfeeds_feeds','Feeds','','News Feeds/Feeds','index.php?option=com_newsfeeds','component',0,13,2,17,0,0,'0000-00-00 00:00:00',0,0,'class:newsfeeds',0,'',24,25,0,'*',1),(15,'menu','com_newsfeeds_categories','Categories','','News Feeds/Categories','index.php?option=com_categories&extension=com_newsfeeds','component',0,13,2,6,0,0,'0000-00-00 00:00:00',0,0,'class:newsfeeds-cat',0,'',26,27,0,'*',1),(16,'menu','com_redirect','Redirect','','Redirect','index.php?option=com_redirect','component',0,1,1,24,0,0,'0000-00-00 00:00:00',0,0,'class:redirect',0,'',41,42,0,'*',1),(17,'menu','com_search','Basic Search','','Basic Search','index.php?option=com_search','component',0,1,1,19,0,0,'0000-00-00 00:00:00',0,0,'class:search',0,'',33,34,0,'*',1),(18,'menu','com_weblinks','Weblinks','','Weblinks','index.php?option=com_weblinks','component',0,1,1,21,0,0,'0000-00-00 00:00:00',0,0,'class:weblinks',0,'',35,40,0,'*',1),(19,'menu','com_weblinks_links','Links','','Weblinks/Links','index.php?option=com_weblinks','component',0,18,2,21,0,0,'0000-00-00 00:00:00',0,0,'class:weblinks',0,'',36,37,0,'*',1),(20,'menu','com_weblinks_categories','Categories','','Weblinks/Categories','index.php?option=com_categories&extension=com_weblinks','component',0,18,2,6,0,0,'0000-00-00 00:00:00',0,0,'class:weblinks-cat',0,'',38,39,0,'*',1),(21,'menu','com_finder','Smart Search','','Smart Search','index.php?option=com_finder','component',0,1,1,27,0,0,'0000-00-00 00:00:00',0,0,'class:finder',0,'',31,32,0,'*',1),(22,'menu','com_joomlaupdate','Joomla! Update','','Joomla! Update','index.php?option=com_joomlaupdate','component',0,1,1,28,0,0,'0000-00-00 00:00:00',0,0,'class:joomlaupdate',0,'',41,42,0,'*',1),(101,'mainmenu','Trang chủ','trang-chu','','trang-chu','index.php?option=com_content&view=article&id=1','component',1,1,1,22,0,0,'0000-00-00 00:00:00',0,1,'',0,'{\"show_title\":\"\",\"link_titles\":\"\",\"show_intro\":\"\",\"show_category\":\"\",\"link_category\":\"\",\"show_parent_category\":\"\",\"link_parent_category\":\"\",\"show_author\":\"\",\"link_author\":\"\",\"show_create_date\":\"\",\"show_modify_date\":\"\",\"show_publish_date\":\"\",\"show_item_navigation\":\"\",\"show_vote\":\"\",\"show_icons\":\"\",\"show_print_icon\":\"\",\"show_email_icon\":\"\",\"show_hits\":\"\",\"show_noauth\":\"\",\"urls_position\":\"\",\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"page_title\":\"\",\"show_page_heading\":1,\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',29,30,1,'*',0),(102,'main','JCE','jce','','jce','index.php?option=com_jce','component',0,1,1,10002,0,0,'0000-00-00 00:00:00',0,1,'components/com_jce/media/img/menu/logo.png',0,'',43,52,0,'',1),(103,'main','WF_MENU_CPANEL','wf-menu-cpanel','','jce/wf-menu-cpanel','index.php?option=com_jce','component',0,102,2,10002,0,0,'0000-00-00 00:00:00',0,1,'components/com_jce/media/img/menu/jce-cpanel.png',0,'',44,45,0,'',1),(104,'main','WF_MENU_CONFIG','wf-menu-config','','jce/wf-menu-config','index.php?option=com_jce&view=config','component',0,102,2,10002,0,0,'0000-00-00 00:00:00',0,1,'components/com_jce/media/img/menu/jce-config.png',0,'',46,47,0,'',1),(105,'main','WF_MENU_PROFILES','wf-menu-profiles','','jce/wf-menu-profiles','index.php?option=com_jce&view=profiles','component',0,102,2,10002,0,0,'0000-00-00 00:00:00',0,1,'components/com_jce/media/img/menu/jce-profiles.png',0,'',48,49,0,'',1),(106,'main','WF_MENU_INSTALL','wf-menu-install','','jce/wf-menu-install','index.php?option=com_jce&view=installer','component',0,102,2,10002,0,0,'0000-00-00 00:00:00',0,1,'components/com_jce/media/img/menu/jce-install.png',0,'',50,51,0,'',1),(107,'mainmenu','Cá nhân','ca-nhan','','ca-nhan','index.php?Itemid=','alias',1,1,1,0,0,0,'0000-00-00 00:00:00',0,1,'',0,'{\"aliasoptions\":\"112\",\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1}',53,58,0,'*',0),(108,'mainmenu','Trường học','truong-hoc','','truong-hoc','index.php?Itemid=','alias',1,1,1,0,0,0,'0000-00-00 00:00:00',0,1,'',0,'{\"aliasoptions\":\"122\",\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1}',59,62,0,'*',0),(109,'mainmenu','Doanh nghiệp','doanh-nghiep','','doanh-nghiep','index.php?Itemid=','alias',1,1,1,0,0,0,'0000-00-00 00:00:00',0,1,'',0,'{\"aliasoptions\":\"123\",\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1}',63,66,0,'*',0),(110,'mainmenu','Làm giàu','lam-giau','','lam-giau','index.php?Itemid=','alias',1,1,1,0,0,0,'0000-00-00 00:00:00',0,1,'',0,'{\"aliasoptions\":\"124\",\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1}',67,70,0,'*',0),(111,'mainmenu','Quản lý thời gian','quan-ly-thoi-gian','','ca-nhan/quan-ly-thoi-gian','index.php?option=com_content&view=article&id=1','component',1,107,2,22,0,0,'0000-00-00 00:00:00',0,1,'',0,'{\"show_title\":\"\",\"link_titles\":\"\",\"show_intro\":\"\",\"show_category\":\"\",\"link_category\":\"\",\"show_parent_category\":\"\",\"link_parent_category\":\"\",\"show_author\":\"\",\"link_author\":\"\",\"show_create_date\":\"\",\"show_modify_date\":\"\",\"show_publish_date\":\"\",\"show_item_navigation\":\"\",\"show_vote\":\"\",\"show_icons\":\"\",\"show_print_icon\":\"\",\"show_email_icon\":\"\",\"show_hits\":\"\",\"show_noauth\":\"\",\"urls_position\":\"\",\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"page_title\":\"\",\"show_page_heading\":0,\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',54,55,0,'*',0),(112,'mainmenu','Giải quyết vấn đề','giai-quyet-van-de','','ca-nhan/giai-quyet-van-de','index.php?option=com_content&view=article&id=2','component',1,107,2,22,0,0,'0000-00-00 00:00:00',0,1,'',0,'{\"show_title\":\"\",\"link_titles\":\"\",\"show_intro\":\"\",\"show_category\":\"\",\"link_category\":\"\",\"show_parent_category\":\"\",\"link_parent_category\":\"\",\"show_author\":\"\",\"link_author\":\"\",\"show_create_date\":\"\",\"show_modify_date\":\"\",\"show_publish_date\":\"\",\"show_item_navigation\":\"\",\"show_vote\":\"\",\"show_icons\":\"\",\"show_print_icon\":\"\",\"show_email_icon\":\"\",\"show_hits\":\"\",\"show_noauth\":\"\",\"urls_position\":\"\",\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"page_title\":\"\",\"show_page_heading\":0,\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',56,57,0,'*',0),(113,'main','COM_JCOMMENTS','JComments','','JComments','index.php?option=com_jcomments','component',0,1,1,10004,0,0,'0000-00-00 00:00:00',0,1,'components/com_jcomments/assets/icon-16-jcomments.png',0,'',71,88,0,'',1),(114,'main','COM_JCOMMENTS_COMMENTS','Comments','','JComments/Comments','index.php?option=com_jcomments&task=comments','component',0,113,2,10004,0,0,'0000-00-00 00:00:00',0,1,'components/com_jcomments/assets/icon-16-comments.png',0,'',72,73,0,'',1),(115,'main','COM_JCOMMENTS_SETTINGS','Settings','','JComments/Settings','index.php?option=com_jcomments&task=settings','component',0,113,2,10004,0,0,'0000-00-00 00:00:00',0,1,'components/com_jcomments/assets/icon-16-settings.png',0,'',74,75,0,'',1),(116,'main','COM_JCOMMENTS_SMILES','Smiles','','JComments/Smiles','index.php?option=com_jcomments&task=smiles','component',0,113,2,10004,0,0,'0000-00-00 00:00:00',0,1,'components/com_jcomments/assets/icon-16-smiles.png',0,'',76,77,0,'',1),(117,'main','COM_JCOMMENTS_SUBSCRIPTIONS','Subscriptions','','JComments/Subscriptions','index.php?option=com_jcomments&task=subscriptions','component',0,113,2,10004,0,0,'0000-00-00 00:00:00',0,1,'components/com_jcomments/assets/icon-16-subscriptions.png',0,'',78,79,0,'',1),(118,'main','COM_JCOMMENTS_CUSTOM_BBCODE','Custom BBCode','','JComments/Custom BBCode','index.php?option=com_jcomments&task=custombbcodes','component',0,113,2,10004,0,0,'0000-00-00 00:00:00',0,1,'components/com_jcomments/assets/icon-16-custombbcodes.png',0,'',80,81,0,'',1),(119,'main','COM_JCOMMENTS_BLACKLIST','Blacklist','','JComments/Blacklist','index.php?option=com_jcomments&task=blacklist','component',0,113,2,10004,0,0,'0000-00-00 00:00:00',0,1,'components/com_jcomments/assets/icon-16-blacklist.png',0,'',82,83,0,'',1),(120,'main','COM_JCOMMENTS_IMPORT','Import','','JComments/Import','index.php?option=com_jcomments&task=import','component',0,113,2,10004,0,0,'0000-00-00 00:00:00',0,1,'components/com_jcomments/assets/icon-16-import.png',0,'',84,85,0,'',1),(121,'main','COM_JCOMMENTS_ABOUT','About JComments','','JComments/About JComments','index.php?option=com_jcomments&task=about','component',0,113,2,10004,0,0,'0000-00-00 00:00:00',0,1,'components/com_jcomments/assets/icon-16-jcomments.png',0,'',86,87,0,'',1),(122,'mainmenu','Tư duy sáng tạo','tu-duy-sang-tao','','truong-hoc/tu-duy-sang-tao','index.php?option=com_content&view=article&id=3','component',1,108,2,22,0,0,'0000-00-00 00:00:00',0,1,'',0,'{\"show_title\":\"\",\"link_titles\":\"\",\"show_intro\":\"\",\"show_category\":\"\",\"link_category\":\"\",\"show_parent_category\":\"\",\"link_parent_category\":\"\",\"show_author\":\"\",\"link_author\":\"\",\"show_create_date\":\"\",\"show_modify_date\":\"\",\"show_publish_date\":\"\",\"show_item_navigation\":\"\",\"show_vote\":\"\",\"show_icons\":\"\",\"show_print_icon\":\"\",\"show_email_icon\":\"\",\"show_hits\":\"\",\"show_noauth\":\"\",\"urls_position\":\"\",\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"page_title\":\"\",\"show_page_heading\":0,\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',60,61,0,'*',0),(123,'mainmenu','Marketing Online','marketing-online','','doanh-nghiep/marketing-online','index.php?option=com_content&view=article&id=4','component',1,109,2,22,0,0,'0000-00-00 00:00:00',0,1,'',0,'{\"show_title\":\"\",\"link_titles\":\"\",\"show_intro\":\"\",\"show_category\":\"\",\"link_category\":\"\",\"show_parent_category\":\"\",\"link_parent_category\":\"\",\"show_author\":\"\",\"link_author\":\"\",\"show_create_date\":\"\",\"show_modify_date\":\"\",\"show_publish_date\":\"\",\"show_item_navigation\":\"\",\"show_vote\":\"\",\"show_icons\":\"\",\"show_print_icon\":\"\",\"show_email_icon\":\"\",\"show_hits\":\"\",\"show_noauth\":\"\",\"urls_position\":\"\",\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"page_title\":\"\",\"show_page_heading\":0,\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',64,65,0,'*',0),(124,'mainmenu','Tư duy làm giàu','tu-duy-lam-giau','','lam-giau/tu-duy-lam-giau','index.php?option=com_content&view=article&id=5','component',1,110,2,22,0,0,'0000-00-00 00:00:00',0,1,'',0,'{\"show_title\":\"\",\"link_titles\":\"\",\"show_intro\":\"\",\"show_category\":\"\",\"link_category\":\"\",\"show_parent_category\":\"\",\"link_parent_category\":\"\",\"show_author\":\"\",\"link_author\":\"\",\"show_create_date\":\"\",\"show_modify_date\":\"\",\"show_publish_date\":\"\",\"show_item_navigation\":\"\",\"show_vote\":\"\",\"show_icons\":\"\",\"show_print_icon\":\"\",\"show_email_icon\":\"\",\"show_hits\":\"\",\"show_noauth\":\"\",\"urls_position\":\"\",\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"page_title\":\"\",\"show_page_heading\":0,\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',68,69,0,'*',0);
/*!40000 ALTER TABLE `d3sgo_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_menu_types`
--

DROP TABLE IF EXISTS `d3sgo_menu_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_menu_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menutype` varchar(24) NOT NULL,
  `title` varchar(48) NOT NULL,
  `description` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_menutype` (`menutype`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_menu_types`
--

LOCK TABLES `d3sgo_menu_types` WRITE;
/*!40000 ALTER TABLE `d3sgo_menu_types` DISABLE KEYS */;
INSERT INTO `d3sgo_menu_types` VALUES (1,'mainmenu','Main Menu','The main menu for the site');
/*!40000 ALTER TABLE `d3sgo_menu_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_messages`
--

DROP TABLE IF EXISTS `d3sgo_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_messages` (
  `message_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id_from` int(10) unsigned NOT NULL DEFAULT '0',
  `user_id_to` int(10) unsigned NOT NULL DEFAULT '0',
  `folder_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `state` tinyint(1) NOT NULL DEFAULT '0',
  `priority` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `subject` varchar(255) NOT NULL DEFAULT '',
  `message` text NOT NULL,
  PRIMARY KEY (`message_id`),
  KEY `useridto_state` (`user_id_to`,`state`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_messages`
--

LOCK TABLES `d3sgo_messages` WRITE;
/*!40000 ALTER TABLE `d3sgo_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `d3sgo_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_messages_cfg`
--

DROP TABLE IF EXISTS `d3sgo_messages_cfg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_messages_cfg` (
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `cfg_name` varchar(100) NOT NULL DEFAULT '',
  `cfg_value` varchar(255) NOT NULL DEFAULT '',
  UNIQUE KEY `idx_user_var_name` (`user_id`,`cfg_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_messages_cfg`
--

LOCK TABLES `d3sgo_messages_cfg` WRITE;
/*!40000 ALTER TABLE `d3sgo_messages_cfg` DISABLE KEYS */;
/*!40000 ALTER TABLE `d3sgo_messages_cfg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_modules`
--

DROP TABLE IF EXISTS `d3sgo_modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL DEFAULT '',
  `note` varchar(255) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `position` varchar(50) NOT NULL DEFAULT '',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `module` varchar(50) DEFAULT NULL,
  `access` int(10) unsigned NOT NULL DEFAULT '0',
  `showtitle` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `params` text NOT NULL,
  `client_id` tinyint(4) NOT NULL DEFAULT '0',
  `language` char(7) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `published` (`published`,`access`),
  KEY `newsfeeds` (`module`,`published`),
  KEY `idx_language` (`language`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_modules`
--

LOCK TABLES `d3sgo_modules` WRITE;
/*!40000 ALTER TABLE `d3sgo_modules` DISABLE KEYS */;
INSERT INTO `d3sgo_modules` VALUES (1,'Main Menu','','',1,'menu',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',1,'mod_menu',1,1,'{\"menutype\":\"mainmenu\",\"startLevel\":\"1\",\"endLevel\":\"0\",\"showAllChildren\":\"0\",\"tag_id\":\"\",\"class_sfx\":\"\",\"window_open\":\"\",\"layout\":\"_:default\",\"moduleclass_sfx\":\"_menu\",\"cache\":\"1\",\"cache_time\":\"900\",\"cachemode\":\"itemid\"}',0,'*'),(2,'Login','','',1,'login',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',1,'mod_login',1,1,'',1,'*'),(3,'Popular Articles','','',3,'cpanel',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',1,'mod_popular',3,1,'{\"count\":\"5\",\"catid\":\"\",\"user_id\":\"0\",\"layout\":\"_:default\",\"moduleclass_sfx\":\"\",\"cache\":\"0\",\"automatic_title\":\"1\"}',1,'*'),(4,'Recently Added Articles','','',4,'cpanel',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',1,'mod_latest',3,1,'{\"count\":\"5\",\"ordering\":\"c_dsc\",\"catid\":\"\",\"user_id\":\"0\",\"layout\":\"_:default\",\"moduleclass_sfx\":\"\",\"cache\":\"0\",\"automatic_title\":\"1\"}',1,'*'),(8,'Toolbar','','',1,'toolbar',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',1,'mod_toolbar',3,1,'',1,'*'),(9,'Quick Icons','','',1,'icon',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',1,'mod_quickicon',3,1,'',1,'*'),(10,'Logged-in Users','','',2,'cpanel',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',1,'mod_logged',3,1,'{\"count\":\"5\",\"name\":\"1\",\"layout\":\"_:default\",\"moduleclass_sfx\":\"\",\"cache\":\"0\",\"automatic_title\":\"1\"}',1,'*'),(12,'Admin Menu','','',1,'menu',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',1,'mod_menu',3,1,'{\"layout\":\"\",\"moduleclass_sfx\":\"\",\"shownew\":\"1\",\"showhelp\":\"1\",\"cache\":\"0\"}',1,'*'),(13,'Admin Submenu','','',1,'submenu',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',1,'mod_submenu',3,1,'',1,'*'),(14,'User Status','','',2,'status',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',1,'mod_status',3,1,'',1,'*'),(15,'Title','','',1,'title',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',1,'mod_title',3,1,'',1,'*'),(16,'Login Form','','',7,'position-7',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',1,'mod_login',1,1,'{\"greeting\":\"1\",\"name\":\"0\"}',0,'*'),(17,'Breadcrumbs','','',1,'position-2',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',1,'mod_breadcrumbs',1,1,'{\"moduleclass_sfx\":\"\",\"showHome\":\"1\",\"homeText\":\"Home\",\"showComponent\":\"1\",\"separator\":\"\",\"cache\":\"1\",\"cache_time\":\"900\",\"cachemode\":\"itemid\"}',0,'*'),(79,'Multilanguage status','','',1,'status',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'mod_multilangstatus',3,1,'{\"layout\":\"_:default\",\"moduleclass_sfx\":\"\",\"cache\":\"0\"}',1,'*'),(86,'Joomla Version','','',1,'footer',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',1,'mod_version',3,1,'{\"format\":\"short\",\"product\":\"1\",\"layout\":\"_:default\",\"moduleclass_sfx\":\"\",\"cache\":\"0\"}',1,'*');
/*!40000 ALTER TABLE `d3sgo_modules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_modules_menu`
--

DROP TABLE IF EXISTS `d3sgo_modules_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_modules_menu` (
  `moduleid` int(11) NOT NULL DEFAULT '0',
  `menuid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`moduleid`,`menuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_modules_menu`
--

LOCK TABLES `d3sgo_modules_menu` WRITE;
/*!40000 ALTER TABLE `d3sgo_modules_menu` DISABLE KEYS */;
INSERT INTO `d3sgo_modules_menu` VALUES (1,0),(2,0),(3,0),(4,0),(6,0),(7,0),(8,0),(9,0),(10,0),(12,0),(13,0),(14,0),(15,0),(16,0),(17,0),(79,0),(86,0);
/*!40000 ALTER TABLE `d3sgo_modules_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_newsfeeds`
--

DROP TABLE IF EXISTS `d3sgo_newsfeeds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_newsfeeds` (
  `catid` int(11) NOT NULL DEFAULT '0',
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `link` varchar(200) NOT NULL DEFAULT '',
  `filename` varchar(200) DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `numarticles` int(10) unsigned NOT NULL DEFAULT '1',
  `cache_time` int(10) unsigned NOT NULL DEFAULT '3600',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `rtl` tinyint(4) NOT NULL DEFAULT '0',
  `access` int(10) unsigned NOT NULL DEFAULT '0',
  `language` char(7) NOT NULL DEFAULT '',
  `params` text NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `metadata` text NOT NULL,
  `xreference` varchar(50) NOT NULL COMMENT 'A reference to enable linkages to external data sets.',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_state` (`published`),
  KEY `idx_catid` (`catid`),
  KEY `idx_createdby` (`created_by`),
  KEY `idx_language` (`language`),
  KEY `idx_xreference` (`xreference`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_newsfeeds`
--

LOCK TABLES `d3sgo_newsfeeds` WRITE;
/*!40000 ALTER TABLE `d3sgo_newsfeeds` DISABLE KEYS */;
/*!40000 ALTER TABLE `d3sgo_newsfeeds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_overrider`
--

DROP TABLE IF EXISTS `d3sgo_overrider`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_overrider` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `constant` varchar(255) NOT NULL,
  `string` text NOT NULL,
  `file` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_overrider`
--

LOCK TABLES `d3sgo_overrider` WRITE;
/*!40000 ALTER TABLE `d3sgo_overrider` DISABLE KEYS */;
/*!40000 ALTER TABLE `d3sgo_overrider` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_redirect_links`
--

DROP TABLE IF EXISTS `d3sgo_redirect_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_redirect_links` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `old_url` varchar(255) NOT NULL,
  `new_url` varchar(255) NOT NULL,
  `referer` varchar(150) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `published` tinyint(4) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_link_old` (`old_url`),
  KEY `idx_link_modifed` (`modified_date`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_redirect_links`
--

LOCK TABLES `d3sgo_redirect_links` WRITE;
/*!40000 ALTER TABLE `d3sgo_redirect_links` DISABLE KEYS */;
INSERT INTO `d3sgo_redirect_links` VALUES (1,'http://localhost/vnsoftskills/','','','',1,0,'2013-05-17 15:23:17','0000-00-00 00:00:00'),(2,'http://localhost/vnsoftskills/index.php','','http://localhost/vnsoftskills/','',1,0,'2013-05-17 15:23:54','0000-00-00 00:00:00'),(3,'http://localhost/vnsoftskills/index.php/ca-nhan/','','','',1,0,'2013-05-18 15:16:21','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `d3sgo_redirect_links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_schemas`
--

DROP TABLE IF EXISTS `d3sgo_schemas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_schemas` (
  `extension_id` int(11) NOT NULL,
  `version_id` varchar(20) NOT NULL,
  PRIMARY KEY (`extension_id`,`version_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_schemas`
--

LOCK TABLES `d3sgo_schemas` WRITE;
/*!40000 ALTER TABLE `d3sgo_schemas` DISABLE KEYS */;
INSERT INTO `d3sgo_schemas` VALUES (700,'2.5.11');
/*!40000 ALTER TABLE `d3sgo_schemas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_session`
--

DROP TABLE IF EXISTS `d3sgo_session`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_session` (
  `session_id` varchar(200) NOT NULL DEFAULT '',
  `client_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `guest` tinyint(4) unsigned DEFAULT '1',
  `time` varchar(14) DEFAULT '',
  `data` mediumtext,
  `userid` int(11) DEFAULT '0',
  `username` varchar(150) DEFAULT '',
  `usertype` varchar(50) DEFAULT '',
  PRIMARY KEY (`session_id`),
  KEY `whosonline` (`guest`,`usertype`),
  KEY `userid` (`userid`),
  KEY `time` (`time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_session`
--

LOCK TABLES `d3sgo_session` WRITE;
/*!40000 ALTER TABLE `d3sgo_session` DISABLE KEYS */;
INSERT INTO `d3sgo_session` VALUES ('140572dace39d0c3fafc439f88f4ea24',0,1,'1368982530','__default|a:9:{s:15:\"session.counter\";i:4;s:19:\"session.timer.start\";i:1368982491;s:18:\"session.timer.last\";i:1368982526;s:17:\"session.timer.now\";i:1368982528;s:22:\"session.client.browser\";s:72:\"Mozilla/5.0 (Windows NT 6.2; WOW64; rv:20.0) Gecko/20100101 Firefox/20.0\";s:8:\"registry\";O:9:\"JRegistry\":1:{s:7:\"\0*\0data\";O:8:\"stdClass\":0:{}}s:4:\"user\";O:5:\"JUser\":25:{s:9:\"\0*\0isRoot\";b:0;s:2:\"id\";i:0;s:4:\"name\";N;s:8:\"username\";N;s:5:\"email\";N;s:8:\"password\";N;s:14:\"password_clear\";s:0:\"\";s:8:\"usertype\";N;s:5:\"block\";N;s:9:\"sendEmail\";i:0;s:12:\"registerDate\";N;s:13:\"lastvisitDate\";N;s:10:\"activation\";N;s:6:\"params\";N;s:6:\"groups\";a:0:{}s:5:\"guest\";i:1;s:13:\"lastResetTime\";N;s:10:\"resetCount\";N;s:10:\"\0*\0_params\";O:9:\"JRegistry\":1:{s:7:\"\0*\0data\";O:8:\"stdClass\":0:{}}s:14:\"\0*\0_authGroups\";a:1:{i:0;i:1;}s:14:\"\0*\0_authLevels\";a:2:{i:0;i:1;i:1;i:1;}s:15:\"\0*\0_authActions\";N;s:12:\"\0*\0_errorMsg\";N;s:10:\"\0*\0_errors\";a:0:{}s:3:\"aid\";i:0;}s:16:\"com_mailto.links\";a:1:{s:40:\"45be22d06444f738cf7cf183b598c01e1aafb37a\";O:8:\"stdClass\":2:{s:4:\"link\";s:65:\"http://localhost/vnsoftskills/index.php/ca-nhan/giai-quyet-van-de\";s:6:\"expiry\";i:1368982526;}}s:13:\"session.token\";s:32:\"3bd1959db9dce853c07e345b7af6726d\";}comments-captcha-code|s:5:\"v669y\";',0,'',''),('911ef6ebade3801e9141f9619355197f',1,0,'1368982553','__default|a:8:{s:22:\"session.client.browser\";s:72:\"Mozilla/5.0 (Windows NT 6.2; WOW64; rv:20.0) Gecko/20100101 Firefox/20.0\";s:15:\"session.counter\";i:17;s:8:\"registry\";O:9:\"JRegistry\":1:{s:7:\"\0*\0data\";O:8:\"stdClass\":3:{s:11:\"application\";O:8:\"stdClass\":1:{s:4:\"lang\";s:0:\"\";}s:13:\"com_templates\";O:8:\"stdClass\":2:{s:6:\"styles\";O:8:\"stdClass\":1:{s:10:\"limitstart\";i:0;}s:4:\"edit\";O:8:\"stdClass\":1:{s:5:\"style\";O:8:\"stdClass\":2:{s:2:\"id\";a:1:{i:0;i:8;}s:4:\"data\";N;}}}s:13:\"com_installer\";O:8:\"stdClass\":2:{s:7:\"message\";s:0:\"\";s:17:\"extension_message\";s:0:\"\";}}}s:4:\"user\";O:5:\"JUser\":25:{s:9:\"\0*\0isRoot\";b:1;s:2:\"id\";s:3:\"732\";s:4:\"name\";s:5:\"admin\";s:8:\"username\";s:5:\"admin\";s:5:\"email\";s:16:\"bngnha@gmail.com\";s:8:\"password\";s:65:\"d4d224ef798c88fdcdf7339e08512818:n9CfIcBHvJ0gu15amhNLVJCGqyCGouqO\";s:14:\"password_clear\";s:0:\"\";s:8:\"usertype\";s:10:\"deprecated\";s:5:\"block\";s:1:\"0\";s:9:\"sendEmail\";s:1:\"1\";s:12:\"registerDate\";s:19:\"2013-05-17 14:45:32\";s:13:\"lastvisitDate\";s:19:\"2013-05-19 16:25:04\";s:10:\"activation\";s:1:\"0\";s:6:\"params\";s:92:\"{\"admin_style\":\"\",\"admin_language\":\"\",\"language\":\"\",\"editor\":\"\",\"helpsite\":\"\",\"timezone\":\"\"}\";s:6:\"groups\";a:1:{i:8;s:1:\"8\";}s:5:\"guest\";i:0;s:13:\"lastResetTime\";s:19:\"0000-00-00 00:00:00\";s:10:\"resetCount\";s:1:\"0\";s:10:\"\0*\0_params\";O:9:\"JRegistry\":1:{s:7:\"\0*\0data\";O:8:\"stdClass\":6:{s:11:\"admin_style\";s:0:\"\";s:14:\"admin_language\";s:0:\"\";s:8:\"language\";s:0:\"\";s:6:\"editor\";s:0:\"\";s:8:\"helpsite\";s:0:\"\";s:8:\"timezone\";s:0:\"\";}}s:14:\"\0*\0_authGroups\";a:2:{i:0;i:1;i:1;i:8;}s:14:\"\0*\0_authLevels\";a:4:{i:0;i:1;i:1;i:1;i:2;i:2;i:3;i:3;}s:15:\"\0*\0_authActions\";N;s:12:\"\0*\0_errorMsg\";N;s:10:\"\0*\0_errors\";a:0:{}s:3:\"aid\";i:0;}s:13:\"session.token\";s:32:\"94c4ddcea7ee99cb5eaec1f5d2a2bf3f\";s:19:\"session.timer.start\";i:1368982289;s:18:\"session.timer.last\";i:1368982550;s:17:\"session.timer.now\";i:1368982551;}',732,'admin','');
/*!40000 ALTER TABLE `d3sgo_session` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_template_styles`
--

DROP TABLE IF EXISTS `d3sgo_template_styles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_template_styles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `template` varchar(50) NOT NULL DEFAULT '',
  `client_id` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `home` char(7) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_template` (`template`),
  KEY `idx_home` (`home`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_template_styles`
--

LOCK TABLES `d3sgo_template_styles` WRITE;
/*!40000 ALTER TABLE `d3sgo_template_styles` DISABLE KEYS */;
INSERT INTO `d3sgo_template_styles` VALUES (2,'bluestork',1,'1','Bluestork - Default','{\"useRoundedCorners\":\"1\",\"showSiteName\":\"0\"}'),(3,'atomic',0,'0','Atomic - Default','{}'),(4,'beez_20',0,'0','Beez2 - Default','{\"wrapperSmall\":\"53\",\"wrapperLarge\":\"72\",\"logo\":\"images\\/joomla_black.gif\",\"sitetitle\":\"Joomla!\",\"sitedescription\":\"Open Source Content Management\",\"navposition\":\"left\",\"templatecolor\":\"personal\",\"html5\":\"0\"}'),(5,'hathor',1,'0','Hathor - Default','{\"showSiteName\":\"0\",\"colourChoice\":\"\",\"boldText\":\"0\"}'),(6,'beez5',0,'0','Beez5 - Default','{\"wrapperSmall\":\"53\",\"wrapperLarge\":\"72\",\"logo\":\"images\\/sampledata\\/fruitshop\\/fruits.gif\",\"sitetitle\":\"Joomla!\",\"sitedescription\":\"Open Source Content Management\",\"navposition\":\"left\",\"html5\":\"0\"}'),(8,'vnsoftskills',0,'1','vnsoftskills - Default','{\"rebrand\":\"no\",\"style\":\"theme1\",\"mootools\":\"1\",\"jquery\":\"1\",\"javascriptBottom\":\"1\",\"logo\":\"template\",\"logowidth\":\"4\",\"body_font\":\"default\",\"header_font\":\"default\",\"columns\":\"sidebar1:3;main:6;sidebar2:3\",\"bs_rowmode\":\"row\",\"responsive\":\"1\",\"stickyFooter\":\"1\",\"wright_bootstrap_images\":\"\"}');
/*!40000 ALTER TABLE `d3sgo_template_styles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_update_categories`
--

DROP TABLE IF EXISTS `d3sgo_update_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_update_categories` (
  `categoryid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT '',
  `description` text NOT NULL,
  `parent` int(11) DEFAULT '0',
  `updatesite` int(11) DEFAULT '0',
  PRIMARY KEY (`categoryid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Update Categories';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_update_categories`
--

LOCK TABLES `d3sgo_update_categories` WRITE;
/*!40000 ALTER TABLE `d3sgo_update_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `d3sgo_update_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_update_sites`
--

DROP TABLE IF EXISTS `d3sgo_update_sites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_update_sites` (
  `update_site_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT '',
  `type` varchar(20) DEFAULT '',
  `location` text NOT NULL,
  `enabled` int(11) DEFAULT '0',
  `last_check_timestamp` bigint(20) DEFAULT '0',
  PRIMARY KEY (`update_site_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='Update Sites';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_update_sites`
--

LOCK TABLES `d3sgo_update_sites` WRITE;
/*!40000 ALTER TABLE `d3sgo_update_sites` DISABLE KEYS */;
INSERT INTO `d3sgo_update_sites` VALUES (1,'Joomla Core','collection','http://update.joomla.org/core/list.xml',1,1368979010),(2,'Joomla Extension Directory','collection','http://update.joomla.org/jed/list.xml',1,1368979010),(3,'Accredited Joomla! Translations','collection','http://update.joomla.org/language/translationlist.xml',1,1368979012),(4,'JCE Editor Updates','extension','https://www.joomlacontenteditor.net/index.php?option=com_updates&view=update&format=xml&id=1',0,1368806183),(5,'JComments Update Site','extension','http://www.joomlatune.ru/updates/jcomments.xml',1,1368979012);
/*!40000 ALTER TABLE `d3sgo_update_sites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_update_sites_extensions`
--

DROP TABLE IF EXISTS `d3sgo_update_sites_extensions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_update_sites_extensions` (
  `update_site_id` int(11) NOT NULL DEFAULT '0',
  `extension_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`update_site_id`,`extension_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Links extensions to update sites';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_update_sites_extensions`
--

LOCK TABLES `d3sgo_update_sites_extensions` WRITE;
/*!40000 ALTER TABLE `d3sgo_update_sites_extensions` DISABLE KEYS */;
INSERT INTO `d3sgo_update_sites_extensions` VALUES (1,700),(2,700),(3,600),(4,10002),(5,10004);
/*!40000 ALTER TABLE `d3sgo_update_sites_extensions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_updates`
--

DROP TABLE IF EXISTS `d3sgo_updates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_updates` (
  `update_id` int(11) NOT NULL AUTO_INCREMENT,
  `update_site_id` int(11) DEFAULT '0',
  `extension_id` int(11) DEFAULT '0',
  `categoryid` int(11) DEFAULT '0',
  `name` varchar(100) DEFAULT '',
  `description` text NOT NULL,
  `element` varchar(100) DEFAULT '',
  `type` varchar(20) DEFAULT '',
  `folder` varchar(20) DEFAULT '',
  `client_id` tinyint(3) DEFAULT '0',
  `version` varchar(10) DEFAULT '',
  `data` text NOT NULL,
  `detailsurl` text NOT NULL,
  `infourl` text NOT NULL,
  PRIMARY KEY (`update_id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8 COMMENT='Available Updates';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_updates`
--

LOCK TABLES `d3sgo_updates` WRITE;
/*!40000 ALTER TABLE `d3sgo_updates` DISABLE KEYS */;
INSERT INTO `d3sgo_updates` VALUES (1,3,0,0,'Armenian','','pkg_hy-AM','package','',0,'2.5.8.1','','http://update.joomla.org/language/details/hy-AM_details.xml',''),(2,3,0,0,'Bahasa Indonesia','','pkg_id-ID','package','',0,'2.5.10.1','','http://update.joomla.org/language/details/id-ID_details.xml',''),(3,3,0,0,'Danish','','pkg_da-DK','package','',0,'2.5.11.1','','http://update.joomla.org/language/details/da-DK_details.xml',''),(4,3,0,0,'Khmer','','pkg_km-KH','package','',0,'2.5.7.1','','http://update.joomla.org/language/details/km-KH_details.xml',''),(5,3,0,0,'Swedish','','pkg_sv-SE','package','',0,'2.5.10.1','','http://update.joomla.org/language/details/sv-SE_details.xml',''),(6,3,0,0,'Hungarian','','pkg_hu-HU','package','',0,'2.5.8.1','','http://update.joomla.org/language/details/hu-HU_details.xml',''),(7,3,0,0,'Bulgarian','','pkg_bg-BG','package','',0,'2.5.7.1','','http://update.joomla.org/language/details/bg-BG_details.xml',''),(8,3,0,0,'French','','pkg_fr-FR','package','',0,'2.5.11.1','','http://update.joomla.org/language/details/fr-FR_details.xml',''),(9,3,0,0,'Italian','','pkg_it-IT','package','',0,'2.5.11.1','','http://update.joomla.org/language/details/it-IT_details.xml',''),(10,3,0,0,'Spanish','','pkg_es-ES','package','',0,'2.5.10.1','','http://update.joomla.org/language/details/es-ES_details.xml',''),(11,3,0,0,'Dutch','','pkg_nl-NL','package','',0,'2.5.11.1','','http://update.joomla.org/language/details/nl-NL_details.xml',''),(12,3,0,0,'Turkish','','pkg_tr-TR','package','',0,'2.5.10.1','','http://update.joomla.org/language/details/tr-TR_details.xml',''),(13,3,0,0,'Ukrainian','','pkg_uk-UA','package','',0,'2.5.7.2','','http://update.joomla.org/language/details/uk-UA_details.xml',''),(14,3,0,0,'Slovak','','pkg_sk-SK','package','',0,'2.5.10.1','','http://update.joomla.org/language/details/sk-SK_details.xml',''),(15,3,0,0,'Belarusian','','pkg_be-BY','package','',0,'2.5.8.1','','http://update.joomla.org/language/details/be-BY_details.xml',''),(16,3,0,0,'Latvian','','pkg_lv-LV','package','',0,'2.5.10.1','','http://update.joomla.org/language/details/lv-LV_details.xml',''),(17,3,0,0,'Estonian','','pkg_et-EE','package','',0,'2.5.7.1','','http://update.joomla.org/language/details/et-EE_details.xml',''),(18,3,0,0,'Romanian','','pkg_ro-RO','package','',0,'2.5.11.1','','http://update.joomla.org/language/details/ro-RO_details.xml',''),(19,3,0,0,'Flemish','','pkg_nl-BE','package','',0,'2.5.11.1','','http://update.joomla.org/language/details/nl-BE_details.xml',''),(20,3,0,0,'Macedonian','','pkg_mk-MK','package','',0,'2.5.10.1','','http://update.joomla.org/language/details/mk-MK_details.xml',''),(21,3,0,0,'Japanese','','pkg_ja-JP','package','',0,'2.5.11.1','','http://update.joomla.org/language/details/ja-JP_details.xml',''),(22,3,0,0,'Serbian Latin','','pkg_sr-YU','package','',0,'2.5.10.1','','http://update.joomla.org/language/details/sr-YU_details.xml',''),(23,3,0,0,'Arabic Unitag','','pkg_ar-AA','package','',0,'2.5.11.1','','http://update.joomla.org/language/details/ar-AA_details.xml',''),(24,3,0,0,'German','','pkg_de-DE','package','',0,'2.5.11.1','','http://update.joomla.org/language/details/de-DE_details.xml',''),(25,3,0,0,'Norwegian Bokmal','','pkg_nb-NO','package','',0,'2.5.9.2','','http://update.joomla.org/language/details/nb-NO_details.xml',''),(26,3,0,0,'English AU','','pkg_en-AU','package','',0,'2.5.10.1','','http://update.joomla.org/language/details/en-AU_details.xml',''),(27,3,0,0,'English US','','pkg_en-US','package','',0,'2.5.10.1','','http://update.joomla.org/language/details/en-US_details.xml',''),(28,3,0,0,'Serbian Cyrillic','','pkg_sr-RS','package','',0,'2.5.10.1','','http://update.joomla.org/language/details/sr-RS_details.xml',''),(29,3,0,0,'Lithuanian','','pkg_lt-LT','package','',0,'2.5.7.1','','http://update.joomla.org/language/details/lt-LT_details.xml',''),(30,3,0,0,'Albanian','','pkg_sq-AL','package','',0,'2.5.1.5','','http://update.joomla.org/language/details/sq-AL_details.xml',''),(31,3,0,0,'Persian','','pkg_fa-IR','package','',0,'2.5.11.1','','http://update.joomla.org/language/details/fa-IR_details.xml',''),(32,3,0,0,'Galician','','pkg_gl-ES','package','',0,'2.5.7.4','','http://update.joomla.org/language/details/gl-ES_details.xml',''),(33,3,0,0,'Polish','','pkg_pl-PL','package','',0,'2.5.10.1','','http://update.joomla.org/language/details/pl-PL_details.xml',''),(34,3,0,0,'Syriac','','pkg_sy-IQ','package','',0,'2.5.10.1','','http://update.joomla.org/language/details/sy-IQ_details.xml',''),(35,3,0,0,'Portuguese','','pkg_pt-PT','package','',0,'2.5.8.1','','http://update.joomla.org/language/details/pt-PT_details.xml',''),(36,3,0,0,'Russian','','pkg_ru-RU','package','',0,'2.5.11.1','','http://update.joomla.org/language/details/ru-RU_details.xml',''),(37,3,0,0,'Hebrew','','pkg_he-IL','package','',0,'2.5.7.1','','http://update.joomla.org/language/details/he-IL_details.xml',''),(38,3,0,0,'Catalan','','pkg_ca-ES','package','',0,'2.5.10.1','','http://update.joomla.org/language/details/ca-ES_details.xml',''),(39,3,0,0,'Laotian','','pkg_lo-LA','package','',0,'2.5.6.1','','http://update.joomla.org/language/details/lo-LA_details.xml',''),(40,3,0,0,'Afrikaans','','pkg_af-ZA','package','',0,'2.5.11.1','','http://update.joomla.org/language/details/af-ZA_details.xml',''),(41,3,0,0,'Chinese Simplified','','pkg_zh-CN','package','',0,'2.5.11.1','','http://update.joomla.org/language/details/zh-CN_details.xml',''),(42,3,0,0,'Greek','','pkg_el-GR','package','',0,'2.5.6.1','','http://update.joomla.org/language/details/el-GR_details.xml',''),(43,3,0,0,'Esperanto','','pkg_eo-XX','package','',0,'2.5.6.1','','http://update.joomla.org/language/details/eo-XX_details.xml',''),(44,3,0,0,'Finnish','','pkg_fi-FI','package','',0,'2.5.10.1','','http://update.joomla.org/language/details/fi-FI_details.xml',''),(45,3,0,0,'Portuguese Brazil','','pkg_pt-BR','package','',0,'2.5.9.1','','http://update.joomla.org/language/details/pt-BR_details.xml',''),(46,3,0,0,'Chinese Traditional','','pkg_zh-TW','package','',0,'2.5.10.1','','http://update.joomla.org/language/details/zh-TW_details.xml',''),(47,3,0,0,'Vietnamese','','pkg_vi-VN','package','',0,'2.5.8.1','','http://update.joomla.org/language/details/vi-VN_details.xml',''),(48,3,0,0,'Kurdish Sorani','','pkg_ckb-IQ','package','',0,'2.5.9.1','','http://update.joomla.org/language/details/ckb-IQ_details.xml',''),(49,3,0,0,'Bosnian','','pkg_bs-BA','package','',0,'2.5.10.1','','http://update.joomla.org/language/details/bs-BA_details.xml',''),(50,3,0,0,'Croatian','','pkg_hr-HR','package','',0,'2.5.9.1','','http://update.joomla.org/language/details/hr-HR_details.xml',''),(51,3,0,0,'Azeri','','pkg_az-AZ','package','',0,'2.5.7.1','','http://update.joomla.org/language/details/az-AZ_details.xml',''),(52,3,0,0,'Norwegian Nynorsk','','pkg_nn-NO','package','',0,'2.5.8.1','','http://update.joomla.org/language/details/nn-NO_details.xml',''),(53,3,0,0,'Tamil India','','pkg_ta-IN','package','',0,'2.5.11.1','','http://update.joomla.org/language/details/ta-IN_details.xml',''),(54,3,0,0,'Scottish Gaelic','','pkg_gd-GB','package','',0,'2.5.7.1','','http://update.joomla.org/language/details/gd-GB_details.xml',''),(55,3,0,0,'Thai','','pkg_th-TH','package','',0,'2.5.8.1','','http://update.joomla.org/language/details/th-TH_details.xml',''),(56,3,0,0,'Basque','','pkg_eu-ES','package','',0,'1.7.0.1','','http://update.joomla.org/language/details/eu-ES_details.xml',''),(57,3,0,0,'Uyghur','','pkg_ug-CN','package','',0,'2.5.7.2','','http://update.joomla.org/language/details/ug-CN_details.xml',''),(58,3,0,0,'Korean','','pkg_ko-KR','package','',0,'2.5.10.1','','http://update.joomla.org/language/details/ko-KR_details.xml',''),(59,3,0,0,'Hindi','','pkg_hi-IN','package','',0,'2.5.6.1','','http://update.joomla.org/language/details/hi-IN_details.xml',''),(60,3,0,0,'Welsh','','pkg_cy-GB','package','',0,'2.5.6.1','','http://update.joomla.org/language/details/cy-GB_details.xml',''),(61,3,0,0,'Swahili','','pkg_sw-KE','package','',0,'2.5.10.1','','http://update.joomla.org/language/details/sw-KE_details.xml','');
/*!40000 ALTER TABLE `d3sgo_updates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_user_notes`
--

DROP TABLE IF EXISTS `d3sgo_user_notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_user_notes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `catid` int(10) unsigned NOT NULL DEFAULT '0',
  `subject` varchar(100) NOT NULL DEFAULT '',
  `body` text NOT NULL,
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `created_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_user_id` int(10) unsigned NOT NULL,
  `modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `review_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `idx_user_id` (`user_id`),
  KEY `idx_category_id` (`catid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_user_notes`
--

LOCK TABLES `d3sgo_user_notes` WRITE;
/*!40000 ALTER TABLE `d3sgo_user_notes` DISABLE KEYS */;
/*!40000 ALTER TABLE `d3sgo_user_notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_user_profiles`
--

DROP TABLE IF EXISTS `d3sgo_user_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_user_profiles` (
  `user_id` int(11) NOT NULL,
  `profile_key` varchar(100) NOT NULL,
  `profile_value` varchar(255) NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `idx_user_id_profile_key` (`user_id`,`profile_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Simple user profile storage table';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_user_profiles`
--

LOCK TABLES `d3sgo_user_profiles` WRITE;
/*!40000 ALTER TABLE `d3sgo_user_profiles` DISABLE KEYS */;
/*!40000 ALTER TABLE `d3sgo_user_profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_user_usergroup_map`
--

DROP TABLE IF EXISTS `d3sgo_user_usergroup_map`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_user_usergroup_map` (
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Foreign Key to #__users.id',
  `group_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Foreign Key to #__usergroups.id',
  PRIMARY KEY (`user_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_user_usergroup_map`
--

LOCK TABLES `d3sgo_user_usergroup_map` WRITE;
/*!40000 ALTER TABLE `d3sgo_user_usergroup_map` DISABLE KEYS */;
INSERT INTO `d3sgo_user_usergroup_map` VALUES (732,8),(733,4),(733,7);
/*!40000 ALTER TABLE `d3sgo_user_usergroup_map` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_usergroups`
--

DROP TABLE IF EXISTS `d3sgo_usergroups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_usergroups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Adjacency List Reference Id',
  `lft` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set lft.',
  `rgt` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set rgt.',
  `title` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_usergroup_parent_title_lookup` (`parent_id`,`title`),
  KEY `idx_usergroup_title_lookup` (`title`),
  KEY `idx_usergroup_adjacency_lookup` (`parent_id`),
  KEY `idx_usergroup_nested_set_lookup` (`lft`,`rgt`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_usergroups`
--

LOCK TABLES `d3sgo_usergroups` WRITE;
/*!40000 ALTER TABLE `d3sgo_usergroups` DISABLE KEYS */;
INSERT INTO `d3sgo_usergroups` VALUES (1,0,1,20,'Public'),(2,1,6,17,'Registered'),(3,2,7,14,'Author'),(4,3,8,11,'Editor'),(5,4,9,10,'Publisher'),(6,1,2,5,'Manager'),(7,6,3,4,'Administrator'),(8,1,18,19,'Super Users');
/*!40000 ALTER TABLE `d3sgo_usergroups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_users`
--

DROP TABLE IF EXISTS `d3sgo_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `username` varchar(150) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL DEFAULT '',
  `usertype` varchar(25) NOT NULL DEFAULT '',
  `block` tinyint(4) NOT NULL DEFAULT '0',
  `sendEmail` tinyint(4) DEFAULT '0',
  `registerDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lastvisitDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `activation` varchar(100) NOT NULL DEFAULT '',
  `params` text NOT NULL,
  `lastResetTime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Date of last password reset',
  `resetCount` int(11) NOT NULL DEFAULT '0' COMMENT 'Count of password resets since lastResetTime',
  PRIMARY KEY (`id`),
  KEY `usertype` (`usertype`),
  KEY `idx_name` (`name`),
  KEY `idx_block` (`block`),
  KEY `username` (`username`),
  KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=734 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_users`
--

LOCK TABLES `d3sgo_users` WRITE;
/*!40000 ALTER TABLE `d3sgo_users` DISABLE KEYS */;
INSERT INTO `d3sgo_users` VALUES (732,'admin','admin','bngnha@gmail.com','d4d224ef798c88fdcdf7339e08512818:n9CfIcBHvJ0gu15amhNLVJCGqyCGouqO','deprecated',0,1,'2013-05-17 14:45:32','2013-05-19 16:51:30','0','{\"admin_style\":\"\",\"admin_language\":\"\",\"language\":\"\",\"editor\":\"\",\"helpsite\":\"\",\"timezone\":\"\"}','0000-00-00 00:00:00',0),(733,'Hong Phuong','hongphuong','nthphuong_89@gmail.com','de4b97515fc9e2b5a99993f8084ff194:RBnn2hjP3CtrKH02LESovqRubioitaRF','',0,0,'2013-05-18 15:57:20','0000-00-00 00:00:00','','{\"admin_style\":\"\",\"admin_language\":\"\",\"language\":\"\",\"editor\":\"\",\"helpsite\":\"\",\"timezone\":\"\"}','0000-00-00 00:00:00',0);
/*!40000 ALTER TABLE `d3sgo_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_viewlevels`
--

DROP TABLE IF EXISTS `d3sgo_viewlevels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_viewlevels` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `title` varchar(100) NOT NULL DEFAULT '',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `rules` varchar(5120) NOT NULL COMMENT 'JSON encoded access control.',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_assetgroup_title_lookup` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_viewlevels`
--

LOCK TABLES `d3sgo_viewlevels` WRITE;
/*!40000 ALTER TABLE `d3sgo_viewlevels` DISABLE KEYS */;
INSERT INTO `d3sgo_viewlevels` VALUES (1,'Public',0,'[1]'),(2,'Registered',1,'[6,2,8]'),(3,'Special',2,'[6,3,8]');
/*!40000 ALTER TABLE `d3sgo_viewlevels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_weblinks`
--

DROP TABLE IF EXISTS `d3sgo_weblinks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_weblinks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `catid` int(11) NOT NULL DEFAULT '0',
  `sid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(250) NOT NULL DEFAULT '',
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `url` varchar(250) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `hits` int(11) NOT NULL DEFAULT '0',
  `state` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `archived` tinyint(1) NOT NULL DEFAULT '0',
  `approved` tinyint(1) NOT NULL DEFAULT '1',
  `access` int(11) NOT NULL DEFAULT '1',
  `params` text NOT NULL,
  `language` char(7) NOT NULL DEFAULT '',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `metadata` text NOT NULL,
  `featured` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Set if link is featured.',
  `xreference` varchar(50) NOT NULL COMMENT 'A reference to enable linkages to external data sets.',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_state` (`state`),
  KEY `idx_catid` (`catid`),
  KEY `idx_createdby` (`created_by`),
  KEY `idx_featured_catid` (`featured`,`catid`),
  KEY `idx_language` (`language`),
  KEY `idx_xreference` (`xreference`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_weblinks`
--

LOCK TABLES `d3sgo_weblinks` WRITE;
/*!40000 ALTER TABLE `d3sgo_weblinks` DISABLE KEYS */;
/*!40000 ALTER TABLE `d3sgo_weblinks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d3sgo_wf_profiles`
--

DROP TABLE IF EXISTS `d3sgo_wf_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d3sgo_wf_profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `users` text NOT NULL,
  `types` text NOT NULL,
  `components` text NOT NULL,
  `area` tinyint(3) NOT NULL,
  `device` varchar(255) NOT NULL,
  `rows` text NOT NULL,
  `plugins` text NOT NULL,
  `published` tinyint(3) NOT NULL,
  `ordering` int(11) NOT NULL,
  `checked_out` tinyint(3) NOT NULL,
  `checked_out_time` datetime NOT NULL,
  `params` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d3sgo_wf_profiles`
--

LOCK TABLES `d3sgo_wf_profiles` WRITE;
/*!40000 ALTER TABLE `d3sgo_wf_profiles` DISABLE KEYS */;
INSERT INTO `d3sgo_wf_profiles` VALUES (1,'Default','Default Profile for all users','','3,4,5,6,8,7','',0,'desktop,tablet,phone','help,newdocument,undo,redo,spacer,bold,italic,underline,strikethrough,justifyfull,justifycenter,justifyleft,justifyright,spacer,blockquote,formatselect,styleselect,removeformat,cleanup;fontselect,fontsizeselect,forecolor,backcolor,spacer,clipboard,indent,outdent,lists,sub,sup,textcase,charmap,hr;directionality,fullscreen,preview,source,print,searchreplace,spacer,table;visualaid,visualchars,visualblocks,nonbreaking,style,xhtmlxtras,anchor,unlink,link,imgmanager,spellchecker,article','charmap,contextmenu,browser,inlinepopups,media,help,clipboard,searchreplace,directionality,fullscreen,preview,source,table,textcase,print,style,nonbreaking,visualchars,visualblocks,xhtmlxtras,imgmanager,anchor,link,spellchecker,article,lists',1,1,0,'0000-00-00 00:00:00',''),(2,'Front End','Sample Front-end Profile','','3,4,5','',1,'desktop,tablet,phone','help,newdocument,undo,redo,spacer,bold,italic,underline,strikethrough,justifyfull,justifycenter,justifyleft,justifyright,spacer,formatselect,styleselect;clipboard,searchreplace,indent,outdent,lists,cleanup,charmap,removeformat,hr,sub,sup,textcase,nonbreaking,visualchars,visualblocks;fullscreen,preview,print,visualaid,style,xhtmlxtras,anchor,unlink,link,imgmanager,spellchecker,article','charmap,contextmenu,inlinepopups,help,clipboard,searchreplace,fullscreen,preview,print,style,textcase,nonbreaking,visualchars,visualblocks,xhtmlxtras,imgmanager,anchor,link,spellchecker,article,lists',0,2,0,'0000-00-00 00:00:00',''),(3,'Blogger','Simple Blogging Profile','','3,4,5,6,8,7','',0,'desktop,tablet,phone','bold,italic,strikethrough,lists,blockquote,spacer,justifyleft,justifycenter,justifyright,spacer,link,unlink,imgmanager,article,spellchecker,fullscreen,kitchensink;formatselect,underline,justifyfull,forecolor,clipboard,removeformat,charmap,indent,outdent,undo,redo,help','link,imgmanager,article,spellchecker,fullscreen,kitchensink,clipboard,contextmenu,inlinepopups,lists',0,3,0,'0000-00-00 00:00:00','{\"editor\":{\"toggle\":\"0\"}}'),(4,'Mobile','Sample Mobile Profile','','3,4,5,6,8,7','',0,'tablet,phone','undo,redo,spacer,bold,italic,underline,formatselect,spacer,justifyleft,justifycenter,justifyfull,justifyright,spacer,fullscreen,kitchensink;styleselect,lists,spellchecker,article,link,unlink','fullscreen,kitchensink,spellchecker,article,link,inlinepopups,lists',0,4,0,'0000-00-00 00:00:00','{\"editor\":{\"toolbar_theme\":\"mobile\",\"resizing\":\"0\",\"resize_horizontal\":\"0\",\"resizing_use_cookie\":\"0\",\"toggle\":\"0\",\"links\":{\"popups\":{\"default\":\"\",\"jcemediabox\":{\"enable\":\"0\"},\"window\":{\"enable\":\"0\"}}}}}');
/*!40000 ALTER TABLE `d3sgo_wf_profiles` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-05-20  0:01:35
