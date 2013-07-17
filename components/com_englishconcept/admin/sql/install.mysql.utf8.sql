DROP TABLE IF EXISTS `#__lesson`;
CREATE TABLE IF NOT EXISTS `#__lesson` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) DEFAULT NULL,
  `book_name` varchar(250) DEFAULT NULL,
  `script_flg` tinyint(1) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `introduction` text,
  `reg_date` datetime DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `reg_ip` varchar(20) DEFAULT NULL,
  `upd_date` datetime DEFAULT NULL,
  `upd_ip` varchar(50) DEFAULT NULL,
  `del_date` datetime DEFAULT NULL,
  `del_flg` tinyint(4) unsigned zerofill DEFAULT NULL,
  `del_ip` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 PACK_KEYS=0;
INSERT INTO `#__lesson` VALUES (1,NULL,'Practice Progress',1,'Private Conversation',NULL,'2012-12-06 13:24:03',1,NULL,'2013-04-03 21:43:22',NULL,NULL,0000,NULL),(2,NULL,'',NULL,'',NULL,'2012-12-06 14:57:18',1,NULL,NULL,NULL,NULL,0000,NULL);

DROP TABLE IF EXISTS `#__lesson_script`;
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
INSERT INTO `#__lesson_script` VALUES (1,1,'','Private Conversation','Cu?c nói chuy?n riêng','<p style=\"margin-left: 40px;\">\r\n	<span>Last week I went to the threatre. I had a very good seat. The play was very interesting. I did not enjoy it. A young man and a young woman were sitting behind me. </span></p>\r\n<p>\r\n	<span>They were talking loudly. I got very angry. I could not hear the actors. I turned round. I looked at the man and the woman angrily. </span></p>\r\n<p>\r\n	<span>They did not pay any attention. In the end, I could not bear it. I turned round again. \"I can\'t hear a word!\" I said angrily. </span></p>\r\n<p style=\"margin-left: 40px;\">\r\n	<span>\"It\'s none of your bussiness,\" the young man said rudely. \"This is a private conversation!\"</span></p>\r\n','<p style=\"margin-left: 40px;\">\r\n	<span>Last week I went to the threatre. I had a very good seat. The play was very interesting. I did not enjoy it. A young man and a young woman were sitting behind me. </span></p>\r\n<p>\r\n	<span>They were talking loudly. I got very angry. I could not hear the actors. I turned round. I looked at the man and the woman angrily. </span></p>\r\n<p>\r\n	<span>They did not pay any attention. In the end, I could not bear it. I turned round again. \"I can\'t hear a word!\" I said angrily. </span></p>\r\n<p style=\"margin-left: 40px;\">\r\n	<span>\"It\'s none of your bussiness,\" the young man said rudely. \"This is a private conversation!\"</span></p>\r\n'),(2,2,NULL,'','','','');


DROP TABLE IF EXISTS `#__lesson_key_structures`;
CREATE TABLE IF NOT EXISTS `#__lesson_key_structures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lesson_id` int(11) DEFAULT NULL,
  `text` text,
  `text_explain` text,
  `text_trans` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 PACK_KEYS=0;
INSERT INTO `#__lesson_key_structures` VALUES (1,1,'<div style=\"padding-bottom: 10px; font-size: 12px; line-height: 18px; padding-left: 2px;\">\r\n	<p>\r\n		<span style=\"font-size:14px;\"><span style=\"color: rgb(128, 0, 128);\"><strong>Word Order In Simple Statements</strong></span></span></p>\r\n	<p>\r\n		<em>a.</em> A statement tells us about something. All the sentences in the passage are statements. Each of these statements contains one idea. Each statement tells us about <em>one thing</em>.&nbsp; A statement that tells us about one thing is a <em>simple statement</em>.</p>\r\n	<p>\r\n		<em>b</em>. The order of the words in a statement is very important. Look at these two statements. They both contain the same words but they do not mean the same thing:</p>\r\n	<p style=\"margin-left: 40px;\">\r\n		<span style=\"background-color:#00ff00;\">The policeman arrested the thief.</span></p>\r\n	<p style=\"margin-left: 40px;\">\r\n		<span style=\"background-color:#00ff00;\">The thief arrested the policeman.</span></p>\r\n	<p>\r\n		<em>c</em>. A simple statement can have six parts, but it does not always have so many. Study the order of the words in the columns on page 14. Note that column 6(When?) can be at the beginning or at the end of a statement.</p>\r\n</div>\r\n<p>\r\n	&nbsp;</p>\r\n','<div style=\"padding-bottom: 10px; font-size: 12px; line-height: 18px; padding-left: 2px;\">\r\n	<p>\r\n		<span style=\"font-size:14px;\"><span style=\"color: rgb(128, 0, 128);\"><strong>Word Order In Simple Statements</strong></span></span></p>\r\n	<p>\r\n		<em>a.</em> A statement tells us about something. All the sentences in the passage are statements. Each of these statements contains one idea. Each statement tells us about <em>one thing</em>.&nbsp; A statement that tells us about one thing is a <em>simple statement</em>.</p>\r\n	<p>\r\n		<em>b</em>. The order of the words in a statement is very important. Look at these two statements. They both contain the same words but they do not mean the same thing:</p>\r\n	<p style=\"margin-left: 40px;\">\r\n		<span style=\"background-color:#00ff00;\">The policeman arrested the thief.</span></p>\r\n	<p style=\"margin-left: 40px;\">\r\n		<span style=\"background-color:#00ff00;\">The thief arrested the policeman.</span></p>\r\n	<p>\r\n		<em>c</em>. A simple statement can have six parts, but it does not always have so many. Study the order of the words in the columns on page 14. Note that column 6(When?) can be at the beginning or at the end of a statement.</p>\r\n</div>\r\n<p>\r\n	&nbsp;</p>\r\n','<div style=\"padding-bottom: 10px; font-size: 12px; line-height: 18px; padding-left: 2px;\">\r\n	<p>\r\n		<span style=\"font-size:14px;\"><span style=\"color: rgb(128, 0, 128);\"><strong>Word Order In Simple Statements</strong></span></span></p>\r\n	<p>\r\n		<em>a.</em> A statement tells us about something. All the sentences in the passage are statements. Each of these statements contains one idea. Each statement tells us about <em>one thing</em>.&nbsp; A statement that tells us about one thing is a <em>simple statement</em>.</p>\r\n	<p>\r\n		<em>b</em>. The order of the words in a statement is very important. Look at these two statements. They both contain the same words but they do not mean the same thing:</p>\r\n	<p style=\"margin-left: 40px;\">\r\n		<span style=\"background-color:#00ff00;\">The policeman arrested the thief.</span></p>\r\n	<p style=\"margin-left: 40px;\">\r\n		<span style=\"background-color:#00ff00;\">The thief arrested the policeman.</span></p>\r\n	<p>\r\n		<em>c</em>. A simple statement can have six parts, but it does not always have so many. Study the order of the words in the columns on page 14. Note that column 6(When?) can be at the beginning or at the end of a statement.</p>\r\n</div>\r\n<p>\r\n	&nbsp;</p>\r\n'),(2,2,'','','');

DROP TABLE IF EXISTS `#__lesson_comprehension`;
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
INSERT INTO `#__lesson_comprehension` VALUES (12,1,1,'Where did the write go last week?','Where did the write go last week?',NULL,NULL),(13,1,2,'Did he enjoy the play or not?','Did he enjoy the play or not?',NULL,NULL),(14,1,3,'Who was sitting behind him?','Who was sitting behind him?',NULL,NULL),(15,1,4,'Did the young man say, ','Did the young man say, ',NULL,NULL);

DROP TABLE IF EXISTS `#__lesson_special_difficulties`;
CREATE TABLE IF NOT EXISTS `#__lesson_special_difficulties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lesson_id` int(11) DEFAULT NULL,
  `text` text,
  `text_trans` text,
  `text_explain` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 PACK_KEYS=0;
INSERT INTO `#__lesson_special_difficulties` VALUES (1,1,'<div style=\"padding-bottom: 10px; font-size: 12px; line-height: 18px; padding-left: 2px;\">\r\n	<p>\r\n		<span style=\"font-size:14px;\"><span style=\"color: rgb(128, 0, 128);\"><strong>Word Order In Simple Statements</strong></span></span></p>\r\n	<p>\r\n		<em>a.</em> A statement tells us about something. All the sentences in the passage are statements. Each of these statements contains one idea. Each statement tells us about <em>one thing</em>.&nbsp; A statement that tells us about one thing is a <em>simple statement</em>.</p>\r\n	<p>\r\n		<em>b</em>. The order of the words in a statement is very important. Look at these two statements. They both contain the same words but they do not mean the same thing:</p>\r\n	<p style=\"margin-left: 40px;\">\r\n		<span style=\"background-color:#00ff00;\">The policeman arrested the thief.</span></p>\r\n	<p style=\"margin-left: 40px;\">\r\n		<span style=\"background-color:#00ff00;\">The thief arrested the policeman.</span></p>\r\n	<p>\r\n		<em>c</em>. A simple statement can have six parts, but it does not always have so many. Study the order of the words in the columns on page 14. Note that column 6(When?) can be at the beginning or at the end of a statement.</p>\r\n</div>\r\n<p>\r\n	&nbsp;</p>\r\n','<div style=\"padding-bottom: 10px; font-size: 12px; line-height: 18px; padding-left: 2px;\">\r\n	<p>\r\n		<span style=\"font-size:14px;\"><span style=\"color: rgb(128, 0, 128);\"><strong>Word Order In Simple Statements</strong></span></span></p>\r\n	<p>\r\n		<em>a.</em> A statement tells us about something. All the sentences in the passage are statements. Each of these statements contains one idea. Each statement tells us about <em>one thing</em>.&nbsp; A statement that tells us about one thing is a <em>simple statement</em>.</p>\r\n	<p>\r\n		<em>b</em>. The order of the words in a statement is very important. Look at these two statements. They both contain the same words but they do not mean the same thing:</p>\r\n	<p style=\"margin-left: 40px;\">\r\n		<span style=\"background-color:#00ff00;\">The policeman arrested the thief.</span></p>\r\n	<p style=\"margin-left: 40px;\">\r\n		<span style=\"background-color:#00ff00;\">The thief arrested the policeman.</span></p>\r\n	<p>\r\n		<em>c</em>. A simple statement can have six parts, but it does not always have so many. Study the order of the words in the columns on page 14. Note that column 6(When?) can be at the beginning or at the end of a statement.</p>\r\n</div>\r\n<p>\r\n	&nbsp;</p>\r\n','<div style=\"padding-bottom: 10px; font-size: 12px; line-height: 18px; padding-left: 2px;\">\r\n	<p>\r\n		<span style=\"font-size:14px;\"><span style=\"color: rgb(128, 0, 128);\"><strong>Word Order In Simple Statements</strong></span></span></p>\r\n	<p>\r\n		<em>a.</em> A statement tells us about something. All the sentences in the passage are statements. Each of these statements contains one idea. Each statement tells us about <em>one thing</em>.&nbsp; A statement that tells us about one thing is a <em>simple statement</em>.</p>\r\n	<p>\r\n		<em>b</em>. The order of the words in a statement is very important. Look at these two statements. They both contain the same words but they do not mean the same thing:</p>\r\n	<p style=\"margin-left: 40px;\">\r\n		<span style=\"background-color:#00ff00;\">The policeman arrested the thief.</span></p>\r\n	<p style=\"margin-left: 40px;\">\r\n		<span style=\"background-color:#00ff00;\">The thief arrested the policeman.</span></p>\r\n	<p>\r\n		<em>c</em>. A simple statement can have six parts, but it does not always have so many. Study the order of the words in the columns on page 14. Note that column 6(When?) can be at the beginning or at the end of a statement.</p>\r\n</div>\r\n<p>\r\n	&nbsp;</p>\r\n'),(2,2,'','','');

DROP TABLE IF EXISTS `#__lesson_exercises`;
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
INSERT INTO `#__lesson_exercises` VALUES (12,1,1,'Who was sitting behind him?','Who was sitting behind him?',NULL,NULL),(13,1,2,'Did he enjoy the play or not?','Did he enjoy the play or not?',NULL,NULL),(14,1,3,'Did the young man say, ','Did the young man say, ',NULL,NULL);