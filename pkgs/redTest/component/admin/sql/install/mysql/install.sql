CREATE TABLE IF NOT EXISTS `#__jab_countries` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(128) NOT NULL,
	`iso_code` VARCHAR(3) NOT NULL,
	`has_states` TINYINT(1) NOT NULL DEFAULT '0',
	`needs_id_number` TINYINT(1) NOT NULL DEFAULT '0',
	`needs_zip_code` TINYINT(1) NOT NULL DEFAULT '1',
	`zip_code_format` VARCHAR(24) NOT NULL,
	`language` char(7) NOT NULL DEFAULT '*',
	`ordering` INT(11) NOT NULL DEFAULT '0',
	`published` TINYINT(1) NOT NULL DEFAULT '1',
	`checked_out`      INT(11) DEFAULT NULL,
	`checked_out_time` DATETIME         NOT NULL DEFAULT '0000-00-00 00:00:00',
	`created_by`       INT(11) DEFAULT NULL,
	`created_date`     DATETIME         NOT NULL DEFAULT '0000-00-00 00:00:00',
	`modified_by`      INT(11) DEFAULT NULL,
	`modified_date`    DATETIME         NOT NULL DEFAULT '0000-00-00 00:00:00',
	PRIMARY KEY (`id`)
) DEFAULT CHARACTER SET utf8;

CREATE TABLE IF NOT EXISTS `#__jab_speakers` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(150) NOT NULL,
	`state_id` INT(10) NULL DEFAULT NULL,
	`country_id` INT(10) NULL DEFAULT NULL,
	`language` char(7) NOT NULL DEFAULT '*',
	`ordering` INT(11) NOT NULL DEFAULT '0',
	`metadata` TEXT NULL DEFAULT NULL,
	`published` TINYINT(1) NOT NULL DEFAULT '1',
	`checked_out`      INT(11) DEFAULT NULL,
	`checked_out_time` DATETIME         NOT NULL DEFAULT '0000-00-00 00:00:00',
	`created_by`       INT(11) DEFAULT NULL,
	`created_date`     DATETIME         NOT NULL DEFAULT '0000-00-00 00:00:00',
	`modified_by`      INT(11) DEFAULT NULL,
	`modified_date`    DATETIME         NOT NULL DEFAULT '0000-00-00 00:00:00',
	PRIMARY KEY (`id`)
) DEFAULT CHARACTER SET utf8;

CREATE TABLE IF NOT EXISTS `#__jab_states` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(128) NOT NULL,
	`iso_code` VARCHAR(7) NOT NULL,
	`country_id` INT(10) NOT NULL,
	`language` char(7) NOT NULL DEFAULT '*',
	`ordering` INT(11) NOT NULL DEFAULT '0',
	`published` TINYINT(1) NOT NULL DEFAULT '1',
	`checked_out`      INT(11) DEFAULT NULL,
	`checked_out_time` DATETIME         NOT NULL DEFAULT '0000-00-00 00:00:00',
	`created_by`       INT(11) DEFAULT NULL,
	`created_date`     DATETIME         NOT NULL DEFAULT '0000-00-00 00:00:00',
	`modified_by`      INT(11) DEFAULT NULL,
	`modified_date`    DATETIME         NOT NULL DEFAULT '0000-00-00 00:00:00',
	PRIMARY KEY (`id`)
) DEFAULT CHARACTER SET utf8;