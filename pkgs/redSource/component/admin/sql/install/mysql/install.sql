SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE IF NOT EXISTS `#__redsource_category` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`parent_id` int(10) unsigned NOT NULL DEFAULT '0',
	`lft` int(11) NOT NULL DEFAULT '0',
	`rgt` int(11) NOT NULL DEFAULT '0',
	`level` int(10) unsigned NOT NULL DEFAULT '0',
	`path` varchar(255) NOT NULL DEFAULT '',
	`name` varchar(255) NOT NULL,
	`alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
	`description` varchar(255) NOT NULL,
	`state` tinyint(1) NULL,
	`access` int(10) unsigned NOT NULL DEFAULT '0',
	`checked_out` int(11) NULL,
	`checked_out_time` datetime NULL,
	`created_by` int(11) NULL,
	`created_date` datetime NULL,
	`modified_by` int(11) NULL,
	`modified_date` datetime NULL,
	`language` char(7) NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `rs_category_access` (`access`),
	INDEX `rs_category_checked_out` (`checked_out`),
	INDEX `rs_category_created_by` (`created_by`),
	INDEX `rs_category_modified_by` (`modified_by`),
	INDEX `rs_category_left_right` (`lft`,`rgt`),
	INDEX `rs_category_language` (`language`),
	CONSTRAINT `rs_category_checked_out` FOREIGN KEY (`checked_out`) REFERENCES `#__users` (`id`)
		ON DELETE SET NULL
		ON UPDATE CASCADE,
	CONSTRAINT `rs_category_created_by` FOREIGN KEY (`created_by`) REFERENCES `#__users` (`id`)
		ON DELETE SET NULL
		ON UPDATE CASCADE,
	CONSTRAINT `rs_category_modified_by` FOREIGN KEY (`modified_by`) REFERENCES `#__users` (`id`)
		ON DELETE SET NULL
		ON UPDATE CASCADE
)
ENGINE = InnoDB
DEFAULT CHARSET = utf8;

INSERT IGNORE INTO `#__redsource_category` SET `id` = 1, `name` = 'ROOT', `alias` = 'root', `state` = 1, `language` = '*', `lft` = 0, `rgt` = 1;

CREATE TABLE IF NOT EXISTS `#__redsource_channel` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(255) NOT NULL,
	`description` varchar(255) NOT NULL,
	`type` varchar(64) NOT NULL,
	`state` tinyint(1) NULL,
	`ordering` INT(11) NOT NULL DEFAULT '0',
	`checked_out` int(11) NULL,
	`checked_out_time` datetime NULL,
	`created_by` int(11) NULL,
	`created_date` datetime NULL,
	`modified_by` int(11) NULL,
	`modified_date` datetime NULL,
	`channel_params` text NULL,
	PRIMARY KEY (`id`),
	INDEX `rs_channel_type` (`type`),
	INDEX `rs_channel_checked_out` (`checked_out`),
	INDEX `rs_channel_created_by` (`created_by`),
	INDEX `rs_channel_modified_by` (`modified_by`),
	CONSTRAINT `rs_channel_checked_out` FOREIGN KEY (`checked_out`) REFERENCES `#__users` (`id`)
		ON DELETE SET NULL
		ON UPDATE CASCADE,
	CONSTRAINT `rs_channel_created_by` FOREIGN KEY (`created_by`) REFERENCES `#__users` (`id`)
		ON DELETE SET NULL
		ON UPDATE CASCADE,
	CONSTRAINT `rs_channel_modified_by` FOREIGN KEY (`modified_by`) REFERENCES `#__users` (`id`)
		ON DELETE SET NULL
		ON UPDATE CASCADE
)
ENGINE = InnoDB
DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `#__redsource_content` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(255) NOT NULL,
	`state` tinyint(1) NULL,
	`checked_out` int(11) NULL,
	`checked_out_time` datetime NULL,
	`created_by` int(11) NULL,
	`created_date` datetime NULL,
	`modified_by` int(11) NULL,
	`modified_date` datetime NULL,
	PRIMARY KEY (`id`),
	INDEX `rs_content_checked_out` (`checked_out`),
	INDEX `rs_content_created_by` (`created_by`),
	INDEX `rs_content_modified_by` (`modified_by`),
	CONSTRAINT `rs_content_checked_out` FOREIGN KEY (`checked_out`) REFERENCES `#__users` (`id`)
		ON DELETE SET NULL
		ON UPDATE CASCADE,
	CONSTRAINT `rs_content_created_by` FOREIGN KEY (`created_by`) REFERENCES `#__users` (`id`)
		ON DELETE SET NULL
		ON UPDATE CASCADE,
	CONSTRAINT `rs_content_modified_by` FOREIGN KEY (`modified_by`) REFERENCES `#__users` (`id`)
		ON DELETE SET NULL
		ON UPDATE CASCADE
)
ENGINE = InnoDB
DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `#__redsource_ctype` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(255) NOT NULL,
	`state` tinyint(1) NULL,
	`checked_out` int(11) NULL,
	`checked_out_time` datetime NULL,
	`created_by` int(11) NULL,
	`created_date` datetime NULL,
	`modified_by` int(11) NULL,
	`modified_date` datetime NULL,
	PRIMARY KEY (`id`),
	INDEX `rs_ctype_checked_out` (`checked_out`),
	INDEX `rs_ctype_created_by` (`created_by`),
	INDEX `rs_ctype_modified_by` (`modified_by`),
	CONSTRAINT `rs_ctype_checked_out` FOREIGN KEY (`checked_out`) REFERENCES `#__users` (`id`)
		ON DELETE SET NULL
		ON UPDATE CASCADE,
	CONSTRAINT `rs_ctype_created_by` FOREIGN KEY (`created_by`) REFERENCES `#__users` (`id`)
		ON DELETE SET NULL
		ON UPDATE CASCADE,
	CONSTRAINT `rs_ctype_modified_by` FOREIGN KEY (`modified_by`) REFERENCES `#__users` (`id`)
		ON DELETE SET NULL
		ON UPDATE CASCADE
)
ENGINE = InnoDB
DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `#__redsource_field` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(255) NOT NULL,
	`field_type` varchar(128) NULL,
	`state` tinyint(1) NULL,
	`checked_out` int(11) NULL,
	`checked_out_time` datetime NULL,
	`created_by` int(11) NULL,
	`created_date` datetime NULL,
	`modified_by` int(11) NULL,
	`modified_date` datetime NULL,
	PRIMARY KEY (`id`),
	INDEX `rs_field_checked_out` (`checked_out`),
	INDEX `rs_field_created_by` (`created_by`),
	INDEX `rs_field_modified_by` (`modified_by`),
	CONSTRAINT `rs_field_checked_out` FOREIGN KEY (`checked_out`) REFERENCES `#__users` (`id`)
		ON DELETE SET NULL
		ON UPDATE CASCADE,
	CONSTRAINT `rs_field_created_by` FOREIGN KEY (`created_by`) REFERENCES `#__users` (`id`)
		ON DELETE SET NULL
		ON UPDATE CASCADE,
	CONSTRAINT `rs_field_modified_by` FOREIGN KEY (`modified_by`) REFERENCES `#__users` (`id`)
		ON DELETE SET NULL
		ON UPDATE CASCADE
)
ENGINE = InnoDB
DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `#__redsource_ctype_field_xref` (
	`ctype_id` int(11) NOT NULL,
	`ctype_field_id` int(11) NOT NULL,
	INDEX `ctype_field_ctype` (`ctype_id`),
	INDEX `ctype_field_field` (`ctype_field_id`),
	CONSTRAINT `ctype_field_ctype` FOREIGN KEY (`ctype_id`) REFERENCES `#__redsource_ctype` (`id`)
    	ON DELETE CASCADE
    	ON UPDATE CASCADE,
    CONSTRAINT `ctype_field_field` FOREIGN KEY (`ctype_field_id`) REFERENCES `#__redsource_field` (`id`)
    	ON DELETE CASCADE
    	ON UPDATE CASCADE
)
ENGINE = InnoDB
DEFAULT CHARSET = utf8;

SET FOREIGN_KEY_CHECKS = 1;
