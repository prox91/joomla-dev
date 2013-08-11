DROP TABLE IF EXISTS `#__lessons`;
CREATE TABLE IF NOT EXISTS `#__lessons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) DEFAULT NULL,
  `book_name` varchar(250) DEFAULT NULL,
  `script_id` tinyint(1) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `published` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'The published state of the lesson.',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `language` char(7) NOT NULL DEFAULT '',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  `deleted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_by` varchar(50) DEFAULT NULL,
  `deleted_flg` tinyint(1) unsigned DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 PACK_KEYS=0;

DROP TABLE IF EXISTS `#__lessons_script`;
CREATE TABLE IF NOT EXISTS `#__lesson_script` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lesson_id` int(11) DEFAULT NULL,
  `script_file_name` varchar(50) DEFAULT NULL,
  `script_title` text,
  `script_title_trans` text,
  `script_text` text,
  `script_text_trans` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 PACK_KEYS=0;

DROP TABLE IF EXISTS `#__lessons_key_structures`;
CREATE TABLE IF NOT EXISTS `#__lesson_key_structures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lesson_id` int(11) DEFAULT NULL,
  `text` text,
  `text_explain` text,
  `text_trans` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 PACK_KEYS=0;

DROP TABLE IF EXISTS `#__lessons_comprehension`;
CREATE TABLE IF NOT EXISTS `#__lesson_comprehension` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lesson_id` int(11) DEFAULT NULL,
  `question_no` int(11) DEFAULT NULL,
  `question` text,
  `question_trans` text,
  `answer` text,
  `answer_trans` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 PACK_KEYS=0;

DROP TABLE IF EXISTS `#__lesson_special_difficulties`;
CREATE TABLE IF NOT EXISTS `#__lesson_special_difficulties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lesson_id` int(11) DEFAULT NULL,
  `text` text,
  `text_trans` text,
  `text_explain` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 PACK_KEYS=0;

DROP TABLE IF EXISTS `#__lessons_exercises`;
CREATE TABLE IF NOT EXISTS `#__lesson_exercises` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lesson_id` int(11) DEFAULT NULL,
  `question_no` int(11) DEFAULT NULL,
  `question` text,
  `question_trans` text,
  `answer` text,
  `answer_trans` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 PACK_KEYS=0;
