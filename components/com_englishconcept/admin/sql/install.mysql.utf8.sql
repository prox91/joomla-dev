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
  `description` text,
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
  `description` text,
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
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `modified` datetime DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `deleted` datetime DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `deleted_flg` tinyint(1) unsigned DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 PACK_KEYS=0;

DROP TABLE IF EXISTS `#__ec_lesson_comprehensions`;
CREATE TABLE IF NOT EXISTS `#__ec_lesson_comprehensions` (
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
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `modified` datetime DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `deleted` datetime DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `deleted_flg` tinyint(1) unsigned DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 PACK_KEYS=0;

DROP TABLE IF EXISTS `#__ec_lesson_comprehensions_questions`;
CREATE TABLE IF NOT EXISTS `#__ec_lesson_comprehensions_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comprehension_id` int(11) NOT NULL ,
  `description` text,
  `question` text,
  `question_trans` text,
  `answer` text,
  `answer_trans` text,
  `published` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 PACK_KEYS=0;

DROP TABLE IF EXISTS `#__ec_lesson_compositions`;
CREATE TABLE IF NOT EXISTS `#__ec_lesson_compositions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lesson_id` int(11) NOT NULL ,
  `description` text,
  `question` text,
  `question_trans` text,
  `answer` text,
  `answer_trans` text,
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

DROP TABLE IF EXISTS `#__ec_lesson_precises`;
CREATE TABLE IF NOT EXISTS `#__ec_lesson_precises` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lesson_id` int(11) NOT NULL ,
  `description` text,
  `question` text,
  `question_trans` text,
  `answer` text,
  `answer_trans` text,
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

DROP TABLE IF EXISTS `#__ec_lesson_grammars`;
CREATE TABLE IF NOT EXISTS `#__ec_lesson_grammars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lesson_id` int(11) NOT NULL,
  `title` text,
  `description` text,
  `text` text,
  `text_explain` text,
  `text_trans` text,
  `page_num` int (11) NOT NULL DEFAULT 0 COMMENT 'page number of book',
  `page_ref` int (11) NOT NULL DEFAULT 0 COMMENT 'related to the page number of book',
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

DROP TABLE IF EXISTS `#__ec_lesson_grammars_exercises`;
CREATE TABLE IF NOT EXISTS `#__ec_lesson_grammars_exercises` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grammar_id` int(11) NOT NULL,
  `title` text,
  `exercise_text` text,
  `exercise_text_explain` text,
  `exercise_text_trans` text,
  `page_num` int (11) NOT NULL DEFAULT 0 COMMENT 'page number of book',
  `page_ref` int (11) NOT NULL DEFAULT 0 COMMENT 'related to the page number of book',
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

DROP TABLE IF EXISTS `#__ec_lesson_grammars_exercises_questions`;
CREATE TABLE IF NOT EXISTS `#__ec_lesson_grammars_exercises_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exercise_id` int(11) NOT NULL,
  `question` text,
  `question_trans` text,
  `page_num` int (11) NOT NULL DEFAULT 0 COMMENT 'page number of book',
  `page_ref` int (11) NOT NULL DEFAULT 0 COMMENT 'related to the page number of book',
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

DROP TABLE IF EXISTS `#__ec_lesson_usages`;
CREATE TABLE IF NOT EXISTS `#__ec_lesson_usages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lesson_id` int(11) NOT NULL,
  `description` text,
  `text` text,
  `text_trans` text,
  `text_explain` text,
  `page_num` int (11) NOT NULL DEFAULT 0 COMMENT 'page number of book',
  `page_ref` int (11) NOT NULL DEFAULT 0 COMMENT 'related to the page number of book',
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

DROP TABLE IF EXISTS `#__ec_lesson_usages_exercises`;
CREATE TABLE IF NOT EXISTS `#__ec_lesson_usages_exercises` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usage_id` int(11) NOT NULL,
  `exercise_text` text,
  `exercise_text_explain` text,
  `exercise_text_trans` text,
  `page_num` int (11) NOT NULL DEFAULT 0 COMMENT 'page number of book',
  `page_ref` int (11) NOT NULL DEFAULT 0 COMMENT 'related to the page number of book',
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

DROP TABLE IF EXISTS `#__ec_lesson_usages_exercises_questions`;
CREATE TABLE IF NOT EXISTS `#__ec_lesson_usages_exercises_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exercise_id` int(11) NOT NULL,
  `question` text,
  `question_trans` text,
  `page_num` int (11) NOT NULL DEFAULT 0 COMMENT 'page number of book',
  `page_ref` int (11) NOT NULL DEFAULT 0 COMMENT 'related to the page number of book',
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

DROP TABLE IF EXISTS `#__ec_lesson_exercises`;
CREATE TABLE IF NOT EXISTS `#__ec_lesson_exercises` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lesson_id` int(11) NOT NULL,
  `description` text,
  `title` VARCHAR(255) DEFAULT '',
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

DROP TABLE IF EXISTS `#__ec_questions`;
CREATE TABLE IF NOT EXISTS `#__ec_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lesson_id` int(11) NOT NULL,
  `description` text,
  `title` VARCHAR(255) DEFAULT '',
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

DROP TABLE IF EXISTS `#__ec_settings`;
CREATE TABLE IF NOT EXISTS `#__ec_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lesson_id` int(11) NOT NULL,
  `description` text,
  `text` text,
  `text_trans` text,
  `text_explain` text,
  `page_num` int (11) NOT NULL DEFAULT 0 COMMENT 'page number of book',
  `page_ref` int (11) NOT NULL DEFAULT 0 COMMENT 'related to the page number of book',
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
