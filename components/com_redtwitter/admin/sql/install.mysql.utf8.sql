CREATE TABLE IF NOT EXISTS `#__redtwitter_followed_profiles` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
`name` VARCHAR(255)  NOT NULL ,
`twitterusername` VARCHAR(255)  NOT NULL ,
`twitterpassword` VARCHAR(255)  NOT NULL ,
`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL DEFAULT '1',
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
`created_by` INT(11)  NOT NULL ,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT COLLATE=utf8_general_ci;

DROP TABLE IF EXISTS `#__redtwitter_oauth_info`;
CREATE TABLE IF NOT EXISTS `#__redtwitter_oauth_info` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
`consumer_key` VARCHAR(100)  NOT NULL ,
`consumer_secret` VARCHAR(100)  NOT NULL ,
`access_token` VARCHAR(100)  NOT NULL ,
`access_token_secret` VARCHAR(100)  NOT NULL ,
`ordering` INT(11)  NOT NULL DEFAULT  0 ,
`state` TINYINT(1)  NOT NULL DEFAULT  1 ,
`checked_out` INT(11)  NOT NULL DEFAULT 0 ,
`checked_out_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
`created_by` INT(11)  NOT NULL ,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT COLLATE=utf8_general_ci;

INSERT INTO `#__redtwitter_oauth_info` (`id`, `consumer_key`, `consumer_secret`, `access_token`, `access_token_secret`) VALUES
(1, '8ErgG8KfoEStRltpo76fw', 'ztACDEIm1oYNGpuDR4JXJZMBrvDia5TIhV93nFJmFIo', '631697128-8P0RyekbyWDPeOrODTgNNP9ZSdalzaqmJqPtwMij', 'VGrNtcVFXcVq72qs26z3GDI1ClcVijmSotFwZtucSbg');