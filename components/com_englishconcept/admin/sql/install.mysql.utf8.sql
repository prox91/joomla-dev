DROP TABLE IF EXISTS `#__ec_books`;
CREATE TABLE IF NOT EXISTS `#__ec_books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT '',
  `alias` varchar(255) DEFAULT '',
  `img_url` varchar(100) DEFAULT '',
  `description` text DEFAULT '',
  `ordering` int(11) NOT NULL DEFAULT 0,
  `checked_out` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `checked_out_time` datetime DEFAULT '0000-00-00 00:00:00',
  `published` tinyint(4) DEFAULT 0,
  `publish_up` datetime DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime DEFAULT '0000-00-00 00:00:00',
  `created` datetime DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
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
  `description` text DEFAULT '',
  `ordering` int(11) NOT NULL DEFAULT 0,
  `checked_out` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `checked_out_time` datetime DEFAULT '0000-00-00 00:00:00',
  `published` tinyint(4) DEFAULT 0,
  `publish_up` datetime DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime DEFAULT '0000-00-00 00:00:00',
  `created` datetime DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
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
  `description` text DEFAULT '',
  `ordering` int(11) NOT NULL DEFAULT 0,
  `checked_out` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `checked_out_time` datetime DEFAULT '0000-00-00 00:00:00',
  `published` tinyint(4) DEFAULT 0,
  `publish_up` datetime DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime DEFAULT '0000-00-00 00:00:00',
  `created` datetime DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
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
  `name` varchar(255) DEFAULT '',
  `alias` varchar(255) DEFAULT '',
  `description` text DEFAULT '',
  `ordering` int(11) NOT NULL DEFAULT 0,
  `checked_out` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `checked_out_time` datetime DEFAULT '0000-00-00 00:00:00',
  `published` tinyint(4) DEFAULT 0,
  `publish_up` datetime DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime DEFAULT '0000-00-00 00:00:00',
  `created` datetime DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `modified` datetime DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `deleted` datetime DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `deleted_flg` tinyint(1) unsigned DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 PACK_KEYS=0;

DROP TABLE IF EXISTS `#__ec_lesson_scripts`;
CREATE TABLE IF NOT EXISTS `#__ec_lesson_scripts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lesson_id` int(11) NOT NULL,
  `title` text DEFAULT '',
  `title_trans` text DEFAULT '',
  `audio_url` varchar(100) DEFAULT '',
  `text` text DEFAULT '',
  `text_trans` text DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 PACK_KEYS=0;

DROP TABLE IF EXISTS `#__ec_lesson_comprehensions`;
CREATE TABLE IF NOT EXISTS `#__ec_lesson_comprehensions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lesson_id` int(11) NOT NULL ,
  `question` text DEFAULT '',
  `question_trans` text DEFAULT '',
  `answer` text DEFAULT '',
  `answer_trans` text DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 PACK_KEYS=0;

DROP TABLE IF EXISTS `#__ec_lesson_key_structures`;
CREATE TABLE IF NOT EXISTS `#__ec_lesson_key_structures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lesson_id` int(11) NOT NULL,
  `text` text DEFAULT '',
  `text_explain` text DEFAULT '',
  `text_trans` text DEFAULT '',
  `page_num` int (11) NOT NULL DEFAULT 0 COMMENT 'page number of book',
  `page_ref` int (11) NOT NULL DEFAULT 0 COMMENT 'related to the page number of book',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 PACK_KEYS=0;

DROP TABLE IF EXISTS `#__ec_lesson_special_difficulties`;
CREATE TABLE IF NOT EXISTS `#__ec_lesson_special_difficulties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lesson_id` int(11) NOT NULL,
  `text` text DEFAULT '',
  `text_trans` text DEFAULT '',
  `text_explain` text DEFAULT '',
  `page_num` int (11) NOT NULL DEFAULT 0 COMMENT 'page number of book',
  `page_ref` int (11) NOT NULL DEFAULT 0 COMMENT 'related to the page number of book',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 PACK_KEYS=0;

DROP TABLE IF EXISTS `#__ec_lessons_exercises`;
CREATE TABLE IF NOT EXISTS `#__ec_lesson_exercises` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lesson_id` int(11) NOT NULL,
  `title` VARCHAR(255) DEFAULT '',
  `description` text DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 PACK_KEYS=0;
