DROP TABLE IF EXISTS `#__openhrm_countries`;
CREATE TABLE IF NOT EXISTS `#__openhrm_countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `iso_code_2` varchar(2) NOT NULL,
  `iso_code_3` varchar(3) NOT NULL,
  `address_format` text NOT NULL,
  `postcode_required` tinyint(1) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `#__openhrm_states`;
CREATE TABLE IF NOT EXISTS `#__openhrm_states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `code` varchar(32) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `#__openhrm_timezones`;
CREATE TABLE IF NOT EXISTS `#__openhrm_timezones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timezone_value` float(3,1) NOT NULL DEFAULT '0.0',
  `timezone_text` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `#__openhrm_organization_infos`;
CREATE TABLE IF NOT EXISTS `#__openhrm_organization_infos` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `tax_code` varchar(30) DEFAULT NULL,
  `registration_number` varchar(30) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `fax` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `country` varchar(30) DEFAULT NULL,
  `province` varchar(30) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `zip_code` varchar(30) DEFAULT NULL,
  `street1` varchar(100) DEFAULT NULL,
  `street2` varchar(100) DEFAULT NULL,
  `logo` varchar(30) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `#__openhrm_marital_states`;
CREATE TABLE IF NOT EXISTS `#__openhrm_marital_states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `#__openhrm_usergroups`;
CREATE TABLE IF NOT EXISTS `#__openhrm_usergroups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `parent_id` int(10) unsigned NOT NULL DEFAULT 0 COMMENT 'Adjacency List Reference Id',
  `lft` int(11) NOT NULL DEFAULT 0 COMMENT 'Nested set lft.',
  `rgt` int(11) NOT NULL DEFAULT 0 COMMENT 'Nested set rgt.',
  `title` varchar(255) DEFAULT '',
  `alias` varchar(255) DEFAULT '',
  `description` text,
  `ordering` int(11) NOT NULL DEFAULT 0,
  `created` datetime DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `modified` datetime DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `deleted` datetime DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `deleted_flg` tinyint(1) unsigned DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_openhrm_usergroup_parent_title_lookup` (`parent_id`,`title`),
  KEY `idx_openhrm_usergroup_title_lookup` (`title`),
  KEY `idx_openhrm_usergroup_adjacency_lookup` (`parent_id`),
  KEY `idx_openhrm_usergroup_nested_set_lookup` (`lft`,`rgt`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;



-- ------------------------------------------------------------------------------------
DROP TABLE IF EXISTS `#__ec_books`;
CREATE TABLE IF NOT EXISTS `#__ec_books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT '',
  `alias` varchar(255) DEFAULT '',
  `img_url` varchar(100) DEFAULT '',
  `description` text,
  `ordering` int(11) NOT NULL DEFAULT 0,
  `checked_out` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `checked_out_time` datetime DEFAULT '0000-00-00 00:00:00',
  `published` tinyint(4) DEFAULT 0,
  `publish_up` datetime DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime DEFAULT '0000-00-00 00:00:00',
  `created` datetime DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `modified` datetime DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `deleted` datetime DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `deleted_flg` tinyint(1) unsigned DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 PACK_KEYS=0;

DROP TABLE IF EXISTS `#__ec_categories`;
CREATE TABLE IF NOT EXISTS `#__ec_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT '',
  `alias` varchar(255) DEFAULT '',
  `description` text,
  `ordering` int(11) NOT NULL DEFAULT 0,
  `checked_out` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `checked_out_time` datetime DEFAULT '0000-00-00 00:00:00',
  `published` tinyint(4) DEFAULT 0,
  `publish_up` datetime DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime DEFAULT '0000-00-00 00:00:00',
  `created` datetime DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `modified` datetime DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `deleted` datetime DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `deleted_flg` tinyint(1) unsigned DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 PACK_KEYS=0;

DROP TABLE IF EXISTS `#__ec_levels`;
CREATE TABLE IF NOT EXISTS `#__ec_levels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `alias` varchar(255) DEFAULT '',
  `description` text,
  `ordering` int(11) NOT NULL DEFAULT 0,
  `checked_out` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `checked_out_time` datetime DEFAULT '0000-00-00 00:00:00',
  `published` tinyint(4) DEFAULT 0,
  `publish_up` datetime DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime DEFAULT '0000-00-00 00:00:00',
  `created` datetime DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `modified` datetime DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `deleted` datetime DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `deleted_flg` tinyint(1) unsigned DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 PACK_KEYS=0;

DROP TABLE IF EXISTS `#__ec_lessons`;
CREATE TABLE IF NOT EXISTS `#__ec_lessons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `lesson_no` int(11) NOT NULL,
  `name` varchar(255) DEFAULT '',
  `alias` varchar(255) DEFAULT '',
  `description` text,
  `title` text,
  `title_trans` text,
  `audio_url` varchar(100) DEFAULT '',
  `audio_url_hash` varchar(100) DEFAULT '',
  `text` text,
  `text_trans` text,
  `ordering` int(11) NOT NULL DEFAULT 0,
  `checked_out` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `checked_out_time` datetime DEFAULT '0000-00-00 00:00:00',
  `published` tinyint(4) DEFAULT 0,
  `publish_up` datetime DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime DEFAULT '0000-00-00 00:00:00',
  `created` datetime DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `modified` datetime DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `deleted` datetime DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `deleted_flg` tinyint(1) unsigned DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 PACK_KEYS=0;

DROP TABLE IF EXISTS `#__ec_lessons_comprehensions`;
CREATE TABLE IF NOT EXISTS `#__ec_lessons_comprehensions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lesson_id` int(11) NOT NULL ,
  `description` text,
  `ordering` int(11) NOT NULL DEFAULT 0,
  `checked_out` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `checked_out_time` datetime DEFAULT '0000-00-00 00:00:00',
  `published` tinyint(4) DEFAULT 0,
  `publish_up` datetime DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime DEFAULT '0000-00-00 00:00:00',
  `created` datetime DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `modified` datetime DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `deleted` datetime DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `deleted_flg` tinyint(1) unsigned DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 PACK_KEYS=0;

DROP TABLE IF EXISTS `#__ec_lessons_comprehensions_questions`;
CREATE TABLE IF NOT EXISTS `#__ec_lessons_comprehensions_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comprehension_id` int(11) NOT NULL ,
  `description` text,
  `question` text,
  `question_trans` text,
  `answer` text,
  `answer_trans` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 PACK_KEYS=0;

DROP TABLE IF EXISTS `#__ec_lessons_compositions`;
CREATE TABLE IF NOT EXISTS `#__ec_lessons_compositions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lesson_id` int(11) NOT NULL ,
  `description` text,
  `question` text,
  `question_trans` text,
  `answer` text,
  `answer_trans` text,
  `published` tinyint(4) DEFAULT 0,
  `created` datetime DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `modified` datetime DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `deleted` datetime DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `deleted_flg` tinyint(1) unsigned DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 PACK_KEYS=0;

DROP TABLE IF EXISTS `#__ec_lessons_precises`;
CREATE TABLE IF NOT EXISTS `#__ec_lessons_precises` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lesson_id` int(11) NOT NULL ,
  `description` text,
  `question` text,
  `question_trans` text,
  `answer` text,
  `answer_trans` text,
  `published` tinyint(4) DEFAULT 0,
  `created` datetime DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `modified` datetime DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `deleted` datetime DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `deleted_flg` tinyint(1) unsigned DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 PACK_KEYS=0;

DROP TABLE IF EXISTS `#__ec_lessons_grammars`;
CREATE TABLE IF NOT EXISTS `#__ec_lessons_grammars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lesson_id` int(11) NOT NULL,
  `title` text,
  `description` text,
  `text` text,
  `text_explain` text,
  `text_trans` text,
  `keystruct_no` varchar (50) NOT NULL DEFAULT 0 COMMENT 'key structure number of lesson',
  `keystruct_no_ref` varchar (50) NOT NULL DEFAULT 0 COMMENT 'related key structure number of lesson',
  `published` tinyint(4) DEFAULT 0,
  `created` datetime DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `modified` datetime DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `deleted` datetime DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `deleted_flg` tinyint(1) unsigned DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 PACK_KEYS=0;

DROP TABLE IF EXISTS `#__ec_lessons_grammars_exercises`;
CREATE TABLE IF NOT EXISTS `#__ec_lessons_grammars_exercises` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grammar_id` int(11) NOT NULL,
  `title` text,
  `exercise_text` text,
  `exercise_text_explain` text,
  `exercise_text_trans` text,
  `created` datetime DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `modified` datetime DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `deleted` datetime DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `deleted_flg` tinyint(1) unsigned DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 PACK_KEYS=0;

DROP TABLE IF EXISTS `#__ec_lessons_grammars_exercises_questions`;
CREATE TABLE IF NOT EXISTS `#__ec_lessons_grammars_exercises_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exercise_id` int(11) NOT NULL,
  `question` text,
  `question_trans` text,
  `created` datetime DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `modified` datetime DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `deleted` datetime DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `deleted_flg` tinyint(1) unsigned DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 PACK_KEYS=0;

DROP TABLE IF EXISTS `#__ec_lessons_usages`;
CREATE TABLE IF NOT EXISTS `#__ec_lessons_usages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lesson_id` int(11) NOT NULL,
  `title` text,
  `description` text,
  `text` text,
  `text_trans` text,
  `text_explain` text,
  `diffspecial_no` varchar (50) NOT NULL DEFAULT 0 COMMENT 'different special of lesson',
  `diffspecial_no_ref` varchar (50) NOT NULL DEFAULT 0 COMMENT 'related different special of lesson',
  `published` tinyint(4) DEFAULT 0,
  `created` datetime DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `modified` datetime DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `deleted` datetime DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `deleted_flg` tinyint(1) unsigned DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 PACK_KEYS=0;

DROP TABLE IF EXISTS `#__ec_lessons_usages_exercises`;
CREATE TABLE IF NOT EXISTS `#__ec_lessons_usages_exercises` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usage_id` int(11) NOT NULL,
  `title` text,
  `exercise_text` text,
  `exercise_text_explain` text,
  `exercise_text_trans` text,
  `created` datetime DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `modified` datetime DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `deleted` datetime DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `deleted_flg` tinyint(1) unsigned DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 PACK_KEYS=0;

DROP TABLE IF EXISTS `#__ec_lessons_usages_exercises_questions`;
CREATE TABLE IF NOT EXISTS `#__ec_lessons_usages_exercises_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exercise_id` int(11) NOT NULL,
  `question` text,
  `question_trans` text,
  `created` datetime DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `modified` datetime DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `deleted` datetime DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `deleted_flg` tinyint(1) unsigned DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 PACK_KEYS=0;

DROP TABLE IF EXISTS `#__ec_lessons_exercises`;
CREATE TABLE IF NOT EXISTS `#__ec_lessons_exercises` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lesson_id` int(11) NOT NULL,
  `description` text,
  `title` VARCHAR(255) DEFAULT '',
  `published` tinyint(4) DEFAULT 0,
  `created` datetime DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `modified` datetime DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `deleted` datetime DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `deleted_flg` tinyint(1) unsigned DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 PACK_KEYS=0;

DROP TABLE IF EXISTS `#__ec_questions`;
CREATE TABLE IF NOT EXISTS `#__ec_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lesson_id` int(11) NOT NULL,
  `description` text,
  `title` VARCHAR(255) DEFAULT '',
  `published` tinyint(4) DEFAULT 0,
  `created` datetime DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `modified` datetime DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `deleted` datetime DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `deleted_flg` tinyint(1) unsigned DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 PACK_KEYS=0;

DROP TABLE IF EXISTS `#__ec_settings`;
CREATE TABLE IF NOT EXISTS `#__ec_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lesson_id` int(11) NOT NULL,
  `description` text,
  `text` text,
  `text_trans` text,
  `text_explain` text,
  `created` datetime DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `modified` datetime DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `deleted` datetime DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `deleted_flg` tinyint(1) unsigned DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 PACK_KEYS=0;
