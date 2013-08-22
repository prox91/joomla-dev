--
-- Structure `redsocialstream_settings`
--
CREATE TABLE IF NOT EXISTS `#__redsocialstream_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datalabel` varchar(255) DEFAULT NULL,
  `dataname` varchar(20) DEFAULT NULL,
  `datatype` varchar(20) DEFAULT NULL,
  `data` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Data `redsocialstream_settings`
--
INSERT INTO `#__redsocialstream_settings` (`id`, `datalabel`, `dataname`, `datatype`, `data`) VALUES
(null, 'COM_REDSOCIALSTREAM_INTROTEXT','introtext', 'html', ''),
(null, 'COM_REDSOCIALSTREAM_FACEBOOK_APPLICATION_ID','app_id', 'text', ''),
(null, 'COM_REDSOCIALSTREAM_FACEBOOK_APPLICATION_SECRET', 'app_secret', 'text', ''),
(null, 'COM_REDSOCIALSTREAM_TWITTER_CONSUMER_KEY', 'twitter_consumer_key', 'text', ''),
(null, 'COM_REDSOCIALSTREAM_TWITTER_CONSUMER_SECRET', 'twitter_consumer_sec', 'text', ''),
(null, 'COM_REDSOCIALSTREAM_LINKEDIN_API_KEY', 'linked_api_key', 'text', ''),
(null, 'COM_REDSOCIALSTREAM_LINKEDIN_SECRET_KEY', 'linked_secret_key', 'text', '');

--
-- Structure `redsocialstream_profiletype`
--
CREATE TABLE IF NOT EXISTS `#__redsocialstream_profiletype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT NULL,
  `img` varchar(200) DEFAULT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `linkprefix` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Data `redsocialstream_profiletype`
--
INSERT INTO `#__redsocialstream_profiletype` (`id`, `title`, `img`, `ordering`, `linkprefix`) VALUES
(1, 'facebook', 'facebook.jpg', 1, 'http://facebook.com/'),
(2, 'twitter', 'twitter.jpg', 2, 'http://twitter.com/'),
(3, 'linkedin', 'linkedin.jpg', 3, 'http://linkedin.com/'),
(4, 'youtube', 'youtube.jpg', 4, 'http://youtube.com/');


--
-- Structure `redsocialstream_profilereference`
--
CREATE TABLE IF NOT EXISTS `#__redsocialstream_profilereference` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profiletypeid` int(11) DEFAULT NULL,
  `profilename` varchar(200) DEFAULT NULL,
  `title` varchar(200) NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `groupid` int(11) NOT NULL DEFAULT '0',
  `update_time` timestamp NULL DEFAULT NULL,
  `published` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Structure `redsocialstream_group`
--
CREATE TABLE IF NOT EXISTS `#__redsocialstream_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `subtitle` text NOT NULL,
  `introtitle` varchar(200) NOT NULL DEFAULT '',
  `groupsociallink` varchar(200) NOT NULL,
  `ordering` int(11) DEFAULT '0',
  `published` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Structure `redsocialstream_posts`
--
CREATE TABLE IF NOT EXISTS `#__redsocialstream_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(11) NOT NULL,
  `ext_profile_id` varchar(256) NOT NULL,
  `ext_post_id` varchar(256) NOT NULL,
  `ext_post_name` varchar(256) NOT NULL,
  `title` varchar(256) NOT NULL,
  `thumb_uri` varchar(256) NOT NULL,
  `message` varchar(518) NOT NULL,
  `source_link` varchar(518) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `duration` varchar(518) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `published` int(11) NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2024 ;

--
-- Structure `redsocialstream_postfeeds`
--
CREATE TABLE IF NOT EXISTS `#__redsocialstream_postfeeds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `facebook` int(11) NOT NULL,
  `twitter` int(11) NOT NULL,
  `linkedin` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6;


--
-- Structure `redsocialstream_settings`
--
CREATE TABLE IF NOT EXISTS `#__redsocialstream_facebook_accesstoken` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profile_id` int(11) DEFAULT NULL,
  `access_token` text DEFAULT NULL,
  `created` text DEFAULT NULL,
  `updated` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Structure `redsocialstream_settings`
--
CREATE TABLE IF NOT EXISTS `#__redsocialstream_twitter_accesstoken` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profile_id` int(11) DEFAULT NULL,
  `access_token` text DEFAULT NULL,
  `created` text DEFAULT NULL,
  `updated` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Structure `redsocialstream_settings`
--
CREATE TABLE IF NOT EXISTS `#__redsocialstream_linkedin_accesstoken` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profile_id` int(11) DEFAULT 0,
  `access_token` text DEFAULT '',
  `created` text DEFAULT NULL,
  `updated` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Structure `redsocialstream_linkedin_connections`
--
CREATE TABLE IF NOT EXISTS `#__redsocialstream_linkedin_connections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profile_id` int(11) NOT NULL,
  `linkedin_access_oauth_token` varchar(50) NOT NULL,
  `linkedin_access_oauth_token_secret` varchar(50) NOT NULL,
  `linkedin_oauth_verifier` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
