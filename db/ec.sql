-- CREATE DATABASE  IF NOT EXISTS `englishconcept` /*!40100 DEFAULT CHARACTER SET latin1 */;
-- USE `englishconcept`;
-- MySQL dump 10.13  Distrib 5.5.16, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: englishconcept
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
-- Table structure for table `job_ec_lessons`
--

DROP TABLE IF EXISTS `job_ec_lessons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_ec_lessons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `lesson_no` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT '',
  `alias` varchar(255) DEFAULT '',
  `description` text,
  `title` text,
  `title_trans` text,
  `audio_url` varchar(100) DEFAULT '',
  `audio_url_hash` varchar(100) DEFAULT '',
  `text` text,
  `text_trans` text,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime DEFAULT '0000-00-00 00:00:00',
  `published` tinyint(4) DEFAULT '0',
  `publish_up` datetime DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime DEFAULT '0000-00-00 00:00:00',
  `created` datetime DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified` datetime DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `deleted` datetime DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) unsigned NOT NULL DEFAULT '0',
  `deleted_flg` tinyint(1) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 PACK_KEYS=0;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_ec_lessons`
--

LOCK TABLES `job_ec_lessons` WRITE;
/*!40000 ALTER TABLE `job_ec_lessons` DISABLE KEYS */;
INSERT INTO `job_ec_lessons` VALUES (1,1,1,1,1,'Lesson 1','Lesson 1','Lesson 1','Private Conversation','Private Conversation','lesson1.mp3','85f932f2aa4e7f58818a5f2bcd13a189.mp3','<p>&nbsp;&nbsp; Last week I went to the theatre. I had a good seat. The play was very interesting. I did not enjoy it. A young man and a young woman were sitting behind me. They were talking loudly. I got very angry. I could not hear the actors. I turned round. I looked at the man and the woman angrily. They did not pay any attention. In the end, I could not bear it. I turned round again. \"I can\'t hear a word!\" I said angrily.</p>\r\n<p>&nbsp;&nbsp; \"It\'s none of your business,\" the young man said rudely. \"This is a private conversation!\"</p>','',0,818,'2013-12-02 14:41:27',1,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'2013-11-18 13:39:55',818,'0000-00-00 00:00:00',0,0),(2,1,1,1,2,'Lesson 2','Lesson 2','Lesson 2','Breakfast or Lunch','Breakfast or Lunch','lesson2.mp3','74fe88dc65afc0d4453264f81eb2e45f.mp3','<p>&nbsp;&nbsp; It was Sunday, I never get up early on Sundays. I sometimes stay in bed until lunch time. Last Sunday I got up very late. I looked out of the window. It was dark outside. \"What a day!\" I thought. \"It\'s raining again.\" Just then, the telephone rang. It was my aunt Lucy. \"I\'ve just arrived by train,\" she said. \"I\'m coming to see you.\"</p>\r\n<p style=\"margin-left: 30px;\">\"But I\'m still having breakfast,\" I said.</p>\r\n<p style=\"margin-left: 30px;\">\"What are you doing?\" she asked.</p>\r\n<p style=\"margin-left: 30px;\">\"I\'m having breakfast,\" I repeated.</p>\r\n<p style=\"margin-left: 30px;\">\"Dear me,\" she said. \"Do you always get up so late? It\'s one o\'clock!\"</p>','',0,0,'0000-00-00 00:00:00',1,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'2013-12-02 01:45:30',818,'0000-00-00 00:00:00',0,0),(3,1,1,1,3,'Lesson 3','Lesson 3','Lesson 3','Please Send Me a Card','','lesson3.mp3','88617ceb44be9fc29920e4981a346aed.mp3','<p>&nbsp;&nbsp; Postcards always spoil my holidays. Last summer, I went to Italy. I visited musiums and sat in public gardens. A friendly waiter taught me few words of Italian. Then he lent me a book. I read a few lines, but I did not understand a word! Every day I thought about postcards. My holidays passed quickly, but I did not send any cards to my friends. On last day I made a big decision. I got up early and bought thirty-seven cards. I spent the whole day in my room, but I did not write a single card!</p>','',0,0,'0000-00-00 00:00:00',1,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'2013-12-02 01:44:47',818,'0000-00-00 00:00:00',0,0),(4,1,1,1,4,'Lesson 4','Lesson 4','Lesson 4','An Exciting Trip','','lesson4.mp3','b2e4764bdc39a17734a2a76348f7fce0.mp3','<p>&nbsp;&nbsp; I have just received a letter from my brother, Tim. He is in Australia. He has been there for six months. Tim is an engineer. He is working for a big firm and he has already visited a great number of different places in Australia. He has just bought an Australian car and has gone to Alice Springs, a small town in the centre of Australia. He will soon visit Darwin. From there, he will fly to Perth. My brother has ever been abroad before, so he is finding this trip very exciting.</p>','',0,0,'0000-00-00 00:00:00',1,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'2013-12-02 01:44:27',818,'0000-00-00 00:00:00',0,0),(5,1,1,1,5,'Lesson 5','Lesson 5','Lesson 5','No Wrong Numbers','','lesson5.mp3','34b7070d27cafc4332c313fefe83f155.mp3','<p>&nbsp;&nbsp; Mr James Scott has a garage in Silbury and now he has just bought another garage in Pinhurst. Pinhurst is only five miles from Silbury, but Mr Scott cannot get a telephone for his new garage, so he has just bought twelve pigeons. Yesterday, a pigeon carried the first message from Pinhurst to Silbury. The bird covered the distance in three minutes. Up to now, Mr Scott has sent a great many requests for spare parts and other urgent messages from one garage to the other. In this way, he has begun his own privete \'telephone\' service.</p>','',0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'2013-12-02 01:44:08',818,'0000-00-00 00:00:00',0,0),(6,1,1,1,6,'Lesson 6','Lesson 6','Lesson 6','Percy Buttons','','lesson6.mp3','6217bd660bef515a52f52582b11cb4bc.mp3','<p>&nbsp;&nbsp; I have just moved to a house in Bridge Street. Yesterday a beggar knocked at my door. He asked me for a meal and a glass of beer. In return for this, the beggar stood on his head and sang songs. I gave him a meal. He ate the food and drank the beer. Then he put a piece of cheese in his pocket and went away. Later a neighbour told me about him. Everybody knows him. His name is Percy Buttons. He calls at every house in the street once a month and always asks for a meal and a glass of beer.</p>','',0,0,'0000-00-00 00:00:00',1,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'2013-12-02 01:43:48',818,'0000-00-00 00:00:00',0,0),(7,1,1,1,7,'Lesson 7','Lesson 7','Lesson 7','Too Late','','lesson7.mp3','130218792b7314d18e677e7292903787.mp3','<p>&nbsp;&nbsp; The plane was late and detectives were waiting at the airport all mornings. They were expecting a valuable parcel of diamonds from South Africa. A few hours earlier, someone had told the police that thieves would try to steal the diamonds. When the plane arrived, some of the detectives were waiting inside the main building while others were waiting on the airfield. Two men took the parcel off the plane and carried it into the Customs House. While two detectives were keeping guard at the door, two others opened the parcel. To their surprise, the precious parcel was full of stones and sand!</p>','',0,0,'0000-00-00 00:00:00',1,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'2013-12-02 01:43:17',818,'0000-00-00 00:00:00',0,0),(8,1,1,1,8,'Lesson 8','Lesson 8','Lesson 8','The Best and the Worst','','lesson8.mp3','14f7cfa359e3a1d87d30a058e55f3416.mp3','<p>&nbsp;&nbsp; Joe Sanders has the most beautiful garden in our town. Nearly everybody enters for \"The Nicest Garden Competition\" each year, but Joe wins every time. Bill Frith\'s garden is large the Joe\'s. Bill works harder then Joe and grows more flowers and vegetables, but Joe\'s garden is more interesting. He has made neat paths and has built a wooden brigde over a pool. I like gardens too, but I do not like hard work. Every year I enter for the garden competition too and I always win a little prize for the worst garden in the town!</p>','',0,0,'0000-00-00 00:00:00',1,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'2013-12-02 01:42:42',818,'0000-00-00 00:00:00',0,0),(9,1,1,1,9,'Lesson 9','Lesson 9','Lesson 9','A Cold Welcome','','lesson9.mp3','91503e06a896f852a5369e2b62546680.mp3','<p>&nbsp;&nbsp; On Wednesday evening, we went to the Twon Hall. It was the last day of the year and a large crowd of people had gathered under the Town Hall clock. It would strike twelve in twenty minutes\' time. Fifteen minutes passed and then at five to twelve, the clock stopped. The big minute hand did not move. We waited and waited, but nothing happend. Suddenly someone shouted, \"It\'s two minutes past twelve! The clock has stopped!\". I looked at my watch. It was true. The big clock refused to welcome the New Year. At that moment, everybody began to laugh and sing.</p>','',0,0,'0000-00-00 00:00:00',1,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'2013-12-02 01:42:21',818,'0000-00-00 00:00:00',0,0),(10,1,1,1,10,'Lesson 10','Lesson 10','Lesson 10','Not For Jazz','','lesson10.mp3','f618072af755ed615f12a83d6f63197b.mp3','<p>&nbsp;&nbsp; We have an old musical instrument. It is called a clavichord. It was made in Germany in 1681. Our clavichord is kept in the living-room. It has belonged to our family for a long time. The instrument was bought by my grandfather many years ago. Recently it was damaged by a visitor. She tried to play jazz on it! She struck the keys too hard and two of the strings were broken. My father was shocked. Now we are not allowed to touch it. It is being repaired by a friend of my father\'s.</p>','',0,0,'0000-00-00 00:00:00',1,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'2013-12-02 01:42:02',818,'0000-00-00 00:00:00',0,0),(11,1,1,1,11,'Lesson 11','Lesson 11','Lesson 11','One Good Turn Deserves Another','','lesson11.mp3','68720b339f72affb96411f965f328131.mp3','<p>&nbsp;&nbsp; I was having dinner at a restaurant when Harry Steele came in. Harry worked in a lawyer\'s office years ago, but he is now working at a bank. He gets a good salary, but he always borrows money from his friends and never pays it back. Harry saw me and came and sat at the same table. He has never borrowed money from me. While he was eating, I asked him to lend me £2. To my surprise, he gave me the money immediately. \"I have never borrowed any money from you,\" Harry said, \"so now you can pay for my dinner!\"</p>','',0,0,'0000-00-00 00:00:00',1,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'2013-12-02 01:41:23',818,'0000-00-00 00:00:00',0,0),(12,1,1,1,12,'Lesson 12','Lesson 12','Lesson 12','Goodbye and Good Luck','','lesson12.mp3','6bdb2a0328f9fcc96112adace4751186.mp3','<p>&nbsp;&nbsp; Our neighbour, Captian Charles Alison, will sail from Portsmouth tomorrow. We shall meet him at the harbour early in the morning. He will be in his small boat, <em>Topsail. Topsail </em>is a famous little boat. It has sailed across the Atlantic many times. Captain Alison will set out at eight o\'clock, so we shall have plenty of time. We shall see his boat and then we shall say goodbye to him. He will be away for two months. We are very proud of him. He will take part in an important race across the Atlantic.</p>','',0,0,'0000-00-00 00:00:00',1,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'2013-12-02 01:41:01',818,'0000-00-00 00:00:00',0,0),(13,1,1,1,13,'Lesson 13','Lesson 13','Lesson 13','The Greenwood Boys','','lesson13.mp3','25e7a808c0578c52922866253191271e.mp3','<p>&nbsp;&nbsp; The Greenwood Boys are a group of popular singers. At present, they are visiting all parts of the country. They will be arriving here tomorrow. They will be coming by train and most of the young people in the town will be meeting him at the station. Tomorrow evening they will be singing at the Workers\' Club. The Greendwood Boys will be staying for five days. During this time, they will give five performances. As usual, the police will have a difficult time. They will be trying to keep order. It is always the same on these occasions.</p>','',0,0,'0000-00-00 00:00:00',1,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'2013-12-02 01:40:40',818,'0000-00-00 00:00:00',0,0),(14,1,1,1,14,'Lesson 14','Lesson 14','Lesson 14','Do You Speak English?','','lesson14.mp3','8ef3f8ed43b10ee7ad4cbbcaf15be4d1.mp3','<p>&nbsp;&nbsp; I had an amusing experience last year. After I had left a small village in the south of France, I drove on to the next town. On the way, a young man waved to me. I stopped and he asked me for a lift. As soon as he had got into the car, I said good morning to him in French and he replied in the same language. Apart from a few words, I do nit know any French at all. Neither of us spoke during the journey. I had nearly reached the town, when the young man suddenly said, very slowly, \"Do you speak English?\" As I soon learnt, he was English himself!</p>','',0,0,'0000-00-00 00:00:00',1,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'2013-12-02 01:40:09',818,'0000-00-00 00:00:00',0,0),(15,1,1,1,15,'Lesson 15','Lesson 15','Lesson 15','Good News','','lesson15.mp3','69c9de9e97fe51c197178c1ea0334c4d.mp3','<p>&nbsp;&nbsp; The secretary told me that Mr Harmsworth would see me. I felt very nervous when I went to his office. He did not look up from his desk when I entered. After I had sat down, he said that business was very bad. He told me that the firm could not afford to pay such large salaries. Twenty people had already left. I knew that my turn had come.</p>\r\n<p>&nbsp;&nbsp; \"Mr Hamsworth,\" I said in a weak voice.</p>\r\n<p>&nbsp;&nbsp; \"Don\'t interrupt,\" he said.</p>\r\n<p>Then he smiled and told me I would received an extra £100 a year!</p>','',0,0,'0000-00-00 00:00:00',1,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'2013-12-02 01:39:51',818,'0000-00-00 00:00:00',0,0);
/*!40000 ALTER TABLE `job_ec_lessons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_ec_lessons_usages_exercises_questions`
--

DROP TABLE IF EXISTS `job_ec_lessons_usages_exercises_questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_ec_lessons_usages_exercises_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exercise_id` int(11) NOT NULL,
  `question` text,
  `question_trans` text,
  `created` datetime DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified` datetime DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `deleted` datetime DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) unsigned NOT NULL DEFAULT '0',
  `deleted_flg` tinyint(1) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8 PACK_KEYS=0;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_ec_lessons_usages_exercises_questions`
--

LOCK TABLES `job_ec_lessons_usages_exercises_questions` WRITE;
/*!40000 ALTER TABLE `job_ec_lessons_usages_exercises_questions` DISABLE KEYS */;
INSERT INTO `job_ec_lessons_usages_exercises_questions` VALUES (1,3,'He paid the shop-keeper some money.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(2,3,'He handed me the prize',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(3,3,'The waiter brought a bottle of beer to the man.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(4,3,'He sold all his books to me.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(5,3,'The shop-assistant chose some curtain material for me.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(6,3,'He did me a big favour.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(7,3,'She showed her husband her new hat.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(8,3,'She promised a reward to the finder.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(9,3,'He gave his son some advice.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(10,3,'His uncle left him some money.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(11,3,'He is teaching English to us.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(12,3,'I bought this bunch of flowers for you.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(13,3,'Bring that book to me please.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(14,3,'He offered me a cigarette.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(15,3,'Read me the first paragraph.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(16,3,'I\'ve ordered some soup for you.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(17,3,'I owe him a lot of money.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(18,3,'Pass the mustard to your father.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(19,2,'This is a wonderful garden!',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(20,2,'This is a surprise!',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(21,2,'He is causing a lot of trouble!',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(22,2,'They are wonderful actors!',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(23,2,'She is a hard-working woman!',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(24,2,'It is a tall building!',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(25,2,'It\'s a terrible film!',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(26,2,'You are a clever boy!',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(27,2,'She is a pretty girl!',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(28,2,'He is a strange fellow!',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(29,4,'Yesterday I (took) (received) a present from Aunt Jane.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(30,4,'Have you (taken) (received) a letter from him yet?',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(31,4,'I (took) (received) the letter with me.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(32,4,'He has (taken) (received) some flowers to her.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(33,4,'Why did you (received) (taken) this book off the shelf?',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(34,5,'...from Athens to London, the plane stopped at Rome.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(35,5,'I cooked this...you showed me.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(36,5,'...,where is my coat?',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(37,5,'Yes,...he has been very successful.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(38,5,'Children get...during the holidays.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(39,6,'There is an extra wheel in the back of the car.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(40,6,'I always go on excursions in my free time.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(41,6,'\"Have you any old clothes that you do not want?\" he asked.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(42,6,'The guest slept in the room we do not use.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(43,6,'\"Do not kill me!\" begged the prisoner.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(44,7,'He did not know how to fight, but he knocked...the boxer.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(45,7,'This flower-pot is broken. Who knocked it...?',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(46,7,'I knocked...early yesterday and went to a football match.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(47,7,'Listen! Someone is knocking...the window!',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(48,8,'The old lady hit the thief over the head which a candlestick and more he is unconscious.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(49,8,'At what time do you finish work every day?',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(50,8,'The shop-keeper reduced the price of all his goods by 20%',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(51,9,'He gave <em>away</em> all his books.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(52,9,'She woke <em>up</em> the children early this morning.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(53,9,'He is looking <em>for</em> his umbrella.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(54,9,'They cut <em>off</em> the king\'s head.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(55,9,'Put <em>on</em> your hat and coat.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(56,9,'Give it <em>back</em> your brother.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(57,9,'Help me to lift <em>up</em> this table.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(58,9,'Take <em>off</em> your shoes and put <em>on</em> your slippers.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(59,9,'He is looking <em>at</em> the picture.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(60,9,'Send her <em>away</em> or she will cause trouble.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(61,9,'They have pulled <em>down</em> the old building.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(62,9,'Make <em>up</em> your mind.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(63,9,'He asked <em>for</em> permission to leave.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(64,9,'She threw <em>away</em> all those old newspapers.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(65,10,'Everybody (believe) (believes) he will win.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(66,10,'I heard a noise and went downstairs. I found that everything (were) (was) in order.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(67,10,'Everyone (try) (tries) to earn more and work less.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(68,11,'He is very ill. No one is allowed to enter...his room.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(69,11,'Will you enter...this week\'s crossword competition?',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(70,11,'Many athletes have entered...the Olympic Games this year.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(71,11,'No one saw the thief when he entered...the building.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(72,11,'I have entered...the examination but I don\'t want to take it.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(73,12,'Have you any money?',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(74,12,'Did you go anywhere in the holidays?',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(75,12,'Did you buy anything this morning?',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(76,12,'Was there anybody present when the accident happened?',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(77,13,'He hasn\'t any hobbies.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(78,13,'He does not go anywhere.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(79,13,'He does not see anybody.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(80,13,'He is not interested in anything-except food!',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(81,14,'Is your watch made...gold?',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(82,14,'hese knives were made...Sheffield.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(83,14,'This cake was made...sugar, flour, butter and eggs.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(84,15,'He borrowed <em>one of my records</em>.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(85,15,'She showed me <em>one of John\'s pictures</em>.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(86,15,'It was <em>one of her ideas.</em>',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(87,15,'<em>One of your letters</em> was found on my desk.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(88,15,'<em>Some of their friends</em> came to see me.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0);
/*!40000 ALTER TABLE `job_ec_lessons_usages_exercises_questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_ec_lessons_precises`
--

DROP TABLE IF EXISTS `job_ec_lessons_precises`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_ec_lessons_precises` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lesson_id` int(11) NOT NULL,
  `description` text,
  `question` text,
  `question_trans` text,
  `answer` text,
  `answer_trans` text,
  `published` tinyint(4) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified` datetime DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `deleted` datetime DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) unsigned NOT NULL DEFAULT '0',
  `deleted_flg` tinyint(1) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_ec_lessons_precises`
--

LOCK TABLES `job_ec_lessons_precises` WRITE;
/*!40000 ALTER TABLE `job_ec_lessons_precises` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_ec_lessons_precises` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_ec_books`
--

DROP TABLE IF EXISTS `job_ec_books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_ec_books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT '',
  `alias` varchar(255) DEFAULT '',
  `img_url` varchar(100) DEFAULT '',
  `description` text,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime DEFAULT '0000-00-00 00:00:00',
  `published` tinyint(4) DEFAULT '0',
  `publish_up` datetime DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime DEFAULT '0000-00-00 00:00:00',
  `created` datetime DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified` datetime DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `deleted` datetime DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) unsigned NOT NULL DEFAULT '0',
  `deleted_flg` tinyint(1) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 PACK_KEYS=0;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_ec_books`
--

LOCK TABLES `job_ec_books` WRITE;
/*!40000 ALTER TABLE `job_ec_books` DISABLE KEYS */;
INSERT INTO `job_ec_books` VALUES (1,'Practice and Progress','Practice and Progress','','',0,818,'2013-11-18 13:24:23',1,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'2013-11-16 09:08:28',818,'0000-00-00 00:00:00',0,0);
/*!40000 ALTER TABLE `job_ec_books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_ec_lessons_compositions`
--

DROP TABLE IF EXISTS `job_ec_lessons_compositions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_ec_lessons_compositions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lesson_id` int(11) NOT NULL,
  `description` text,
  `question` text,
  `question_trans` text,
  `answer` text,
  `answer_trans` text,
  `published` tinyint(4) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified` datetime DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `deleted` datetime DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) unsigned NOT NULL DEFAULT '0',
  `deleted_flg` tinyint(1) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_ec_lessons_compositions`
--

LOCK TABLES `job_ec_lessons_compositions` WRITE;
/*!40000 ALTER TABLE `job_ec_lessons_compositions` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_ec_lessons_compositions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_ec_settings`
--

DROP TABLE IF EXISTS `job_ec_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_ec_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lesson_id` int(11) NOT NULL,
  `description` text,
  `text` text,
  `text_trans` text,
  `text_explain` text,
  `created` datetime DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified` datetime DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `deleted` datetime DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) unsigned NOT NULL DEFAULT '0',
  `deleted_flg` tinyint(1) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_ec_settings`
--

LOCK TABLES `job_ec_settings` WRITE;
/*!40000 ALTER TABLE `job_ec_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_ec_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_ec_lessons_usages`
--

DROP TABLE IF EXISTS `job_ec_lessons_usages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_ec_lessons_usages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lesson_id` int(11) NOT NULL,
  `title` text,
  `description` text,
  `text` text,
  `text_trans` text,
  `text_explain` text,
  `diffspecial_no` varchar(50) NOT NULL COMMENT 'different special of lesson',
  `diffspecial_ref` varchar(50) NOT NULL COMMENT 'related different special of lesson',
  `published` tinyint(4) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified` datetime DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `deleted` datetime DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) unsigned NOT NULL DEFAULT '0',
  `deleted_flg` tinyint(1) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 PACK_KEYS=0;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_ec_lessons_usages`
--

LOCK TABLES `job_ec_lessons_usages` WRITE;
/*!40000 ALTER TABLE `job_ec_lessons_usages` DISABLE KEYS */;
INSERT INTO `job_ec_lessons_usages` VALUES (2,2,'What a day! (1.5)','<p>What a day! (1.5)</p>\r\n<table style=\"height: 30%; ; width: 98%;\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<td><em>Instead of saying:</em></td>\r\n<td><em>We can say:</em></td>\r\n</tr>\r\n<tr>\r\n<td>It is a terrible day!</td>\r\n<td>What a terrible day!</td>\r\n</tr>\r\n<tr>\r\n<td>This is a beautiful picture!</td>\r\n<td>What a beautiful picture!</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>Or: What a beautiful picture this is!</td>\r\n</tr>\r\n</tbody>\r\n</table>',NULL,NULL,NULL,'DS.2','',1,'0000-00-00 00:00:00',0,'2013-11-21 16:21:31',818,'0000-00-00 00:00:00',0,0),(3,3,'He lent me a book. (1.5)','<p>He lent me a book. (1.5)</p>\r\n<table style=\"height: 30%; width: 98%;\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<td><em>Instead of saying:</em></td>\r\n<td><em>We can say:</em></td>\r\n</tr>\r\n<tr>\r\n<td>He lent me a book.</td>\r\n<td>He lent a book to me.</td>\r\n</tr>\r\n<tr>\r\n<td>He passed me the salt.</td>\r\n<td>He passed the salt to me.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;She bought me a tie.</td>\r\n<td>She bought a tie for me.</td>\r\n</tr>\r\n<tr>\r\n<td>She made me a cake.</td>\r\n<td>She made a cake for me.</td>\r\n</tr>\r\n</tbody>\r\n</table>',NULL,NULL,NULL,'DS.3','',1,'0000-00-00 00:00:00',0,'2013-11-28 14:50:42',818,'0000-00-00 00:00:00',0,0),(4,4,'Words often confused.','<p>Words often confused.</p>\r\n<p>Receive and Take.</p>\r\n<p><em>Receive</em>: I have just received a letter from my brother. (II. 1-2)</p>\r\n<p><em>Take</em>: Someone has taken my pen.</p>',NULL,NULL,NULL,'DS.4','',0,'0000-00-00 00:00:00',0,'2013-11-29 16:16:45',818,'0000-00-00 00:00:00',0,0),(5,5,'Words Often Confused or Misused.','<p>Words Often Confused or Misused</p>\r\n<p><em>a) </em>Phrases with the word \"way\". (In this way, he has begun his own private \"telephone\" service. II 13-14)</p>\r\n<p>In the way: Please move this chair. It is in the way.</p>\r\n<p style=\"margin-left: 60px;\">&nbsp; Do your work in the way I have shown you.</p>\r\n<p>On the way: On the way to the station, I bought some cigarettes.</p>\r\n<p>In this way: He saves old envelopes. In this way, he has collected a great many stamps.</p>\r\n<p>By the way: By the way, have you seen Harry recently?</p>\r\n<p>In a way: In a way, it is an important book.</p>\r\n<p>&nbsp;</p>\r\n<p>b) Spare and To spare. (\"spare parts\" I.11)</p>\r\n<p>Note the following:</p>\r\n<p>I cannot spare the time.</p>\r\n<p>I have no time to spare.</p>\r\n<p>I cannot buy spare parts for this car.</p>\r\n<p>There is a spare room in this house.</p>\r\n<p>Caligula spared the slave\'s life.</p>',NULL,NULL,NULL,'DS.5','',0,'0000-00-00 00:00:00',0,'2013-11-30 04:23:28',818,'0000-00-00 00:00:00',0,0),(6,6,'Some verbs change in meaning...','<p>Some verbs change in meaning when we put short words after them. Read these sentences. The verbs are in italics. Do you know what these verbs mean?</p>\r\n<p>I <em>put</em> your book on the shelf.</p>\r\n<p>I <em>put on</em> my hat and left the house.</p>\r\n<p>Who <em>took</em> my umbrella?</p>\r\n<p>It was very hot, so I <em>took off</em> my coat.</p>\r\n<p>Come and <em>look at</em> my photograph album.</p>\r\n<p>I am <em>looking for</em> my pen. I lost it this morning.</p>\r\n<p>Will you <em>look after</em> the children for me please?</p>\r\n<p>&nbsp;</p>\r\n<p>Read these sentences. Each one contains the verb <em>knock</em>. The verb has a different meaning in each sentence:</p>\r\n<p>A beggar <em>knocked at</em> my door.</p>\r\n<p>I <em>knocked</em> the vase <em>off</em> the table and broke it.</p>\r\n<p>He always <em>knocks off</em> at six o\'clock. (He finishes his work.)</p>\r\n<p>The shop-assistant <em>knocked</em> 10% <em>off</em> the bill. (He reduced the price.)</p>\r\n<p>A car <em>knocked</em> the boy <em>over</em>. (It hit him hard and made him fall.)</p>\r\n<p>In the fight, the thief <em>knocked out</em> the policeman. The policeman was unconscious for three minutes.</p>',NULL,NULL,NULL,'DS.6','',0,'0000-00-00 00:00:00',0,'2013-11-30 11:16:23',818,'0000-00-00 00:00:00',0,0),(7,7,'Two men took the parcel off the plane.','<p>Two men took the parcel off the plane.</p>\r\n<p>Do you remember these sentences?</p>\r\n<p>Come and <em>look at</em> my photograph album.</p>\r\n<p>I am <em>looking for</em> my pen. I lost it this morning.</p>\r\n<p>Will you <em>look after</em> the children for me please?</p>\r\n<p>Now read these sencetences:</p>\r\n<table style=\"height: 30%; width: 99%;\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<td><em>Instead of saying:</em></td>\r\n<td><em>We can say:<br /></em></td>\r\n</tr>\r\n<tr>\r\n<td>He took off his coat.</td>\r\n<td>He took his coat off.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>He took it off.</td>\r\n</tr>\r\n<tr>\r\n<td>He put out the fire.</td>\r\n<td>He put the fire out.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;He put it out.</td>\r\n</tr>\r\n<tr>\r\n<td>She put on her hat.</td>\r\n<td>She put her hat on.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>She put it on.</td>\r\n</tr>\r\n</tbody>\r\n</table>',NULL,NULL,NULL,'DS.7','',0,'0000-00-00 00:00:00',0,'2013-11-30 12:10:41',818,'0000-00-00 00:00:00',0,0),(8,8,'Everyone, everybody, everything.','<p><em>a</em>) Everyone, everybody, everything. Everybody enters for \"The Nicest Garden Competition.\"</p>\r\n<p>Read these sentences:</p>\r\n<p>Everything is ready.</p>\r\n<p>Everybody has come.</p>\r\n<p>Everyone likes ice-cream.</p>\r\n<p>&nbsp;</p>\r\n<p><em>b</em>) Enter. Everyody enters for the competition.</p>\r\n<p>Read these sentences:</p>\r\n<p>Everyone stood up when he entered the room.</p>\r\n<p>Did you enter for this examination?</p>\r\n<p>The lights went out just as we entered the cinema.</p>\r\n<p>How many people have entered for the race?</p>',NULL,NULL,NULL,'DS.8','',0,'0000-00-00 00:00:00',0,'2013-11-30 12:57:53',818,'0000-00-00 00:00:00',0,0),(9,9,'Any, Not...Any and No','<p>We can answer these questions in two ways. Both answers mean the same thing:</p>\r\n<table style=\"height: 30%; width: 99%;\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<td><em>Question</em></td>\r\n<td><em>Answer</em></td>\r\n</tr>\r\n<tr>\r\n<td>Is there any tea in the pot?</td>\r\n<td>There isn\'t any tea in the pot.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>There\'s no tea in the pot.</td>\r\n</tr>\r\n<tr>\r\n<td>Is there anyone at the door?</td>\r\n<td>There isn\'t anyone at the door.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>There\'s no one at the door.</td>\r\n</tr>\r\n<tr>\r\n<td>Is there anybody at the door?</td>\r\n<td>&nbsp;There isn\'t anybody at the door.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>There\'s nobody at the door.</td>\r\n</tr>\r\n<tr>\r\n<td>Is there anything in the box?</td>\r\n<td>There isn\'t anything in the box.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>There\'s nothing in the box.</td>\r\n</tr>\r\n<tr>\r\n<td>Did you go anywhere yesterday?</td>\r\n<td>I didn\'t go anywhere yesterday.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>I went nowhere yesterday.</td>\r\n</tr>\r\n</tbody>\r\n</table>',NULL,NULL,NULL,'DS.9','',0,'0000-00-00 00:00:00',0,'2013-12-02 00:15:57',818,'0000-00-00 00:00:00',0,0),(10,10,'Made in, made of, made from','<p><em>a</em>) Made in, made of, made from, made by.</p>\r\n<p><em>Made in</em> (a country): It was made in Germany.</p>\r\n<p><em>Made of</em> (a material): The tea-pot is made of silver.</p>\r\n<p><em>Made from</em> (a number of materials): Glass is made from sand and lime.</p>\r\n<p><em>Made by</em> (someone): This cake was made by my sister.</p>\r\n<p><em>b</em>) A friend of my father\'s.</p>\r\n<table border=\"0\">\r\n<tbody>\r\n<tr>\r\n<td><em>Instead of saying:</em></td>\r\n<td><em>We can say:</em></td>\r\n</tr>\r\n<tr>\r\n<td>He is one of my father\'s friends.</td>\r\n<td>He is a friend of my father\'s.</td>\r\n</tr>\r\n<tr>\r\n<td>Tom lent me one of his books.</td>\r\n<td>Tom lent me a book of his.</td>\r\n</tr>\r\n<tr>\r\n<td>He is one of my friends.</td>\r\n<td>He is a friend of mine.</td>\r\n</tr>\r\n</tbody>\r\n</table>',NULL,NULL,NULL,'DS.10','',0,'0000-00-00 00:00:00',0,'2013-12-02 00:40:54',818,'0000-00-00 00:00:00',0,0);
/*!40000 ALTER TABLE `job_ec_lessons_usages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_ec_categories`
--

DROP TABLE IF EXISTS `job_ec_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_ec_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT '',
  `alias` varchar(255) DEFAULT '',
  `description` text,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime DEFAULT '0000-00-00 00:00:00',
  `published` tinyint(4) DEFAULT '0',
  `publish_up` datetime DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime DEFAULT '0000-00-00 00:00:00',
  `created` datetime DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified` datetime DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `deleted` datetime DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) unsigned NOT NULL DEFAULT '0',
  `deleted_flg` tinyint(1) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 PACK_KEYS=0;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_ec_categories`
--

LOCK TABLES `job_ec_categories` WRITE;
/*!40000 ALTER TABLE `job_ec_categories` DISABLE KEYS */;
INSERT INTO `job_ec_categories` VALUES (1,'TOEIC','TOEIC','',0,0,'0000-00-00 00:00:00',1,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'2013-11-16 09:13:29',818,'0000-00-00 00:00:00',0,0);
/*!40000 ALTER TABLE `job_ec_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_ec_lessons_comprehensions`
--

DROP TABLE IF EXISTS `job_ec_lessons_comprehensions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_ec_lessons_comprehensions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lesson_id` int(11) NOT NULL,
  `description` text,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime DEFAULT '0000-00-00 00:00:00',
  `published` tinyint(4) DEFAULT '0',
  `publish_up` datetime DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime DEFAULT '0000-00-00 00:00:00',
  `created` datetime DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified` datetime DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `deleted` datetime DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) unsigned NOT NULL DEFAULT '0',
  `deleted_flg` tinyint(1) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 PACK_KEYS=0;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_ec_lessons_comprehensions`
--

LOCK TABLES `job_ec_lessons_comprehensions` WRITE;
/*!40000 ALTER TABLE `job_ec_lessons_comprehensions` DISABLE KEYS */;
INSERT INTO `job_ec_lessons_comprehensions` VALUES (1,1,'<p>Answer these questions <em>in not more than 55 words.</em></p>',0,0,'0000-00-00 00:00:00',1,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'2013-11-30 02:57:13',818,'0000-00-00 00:00:00',0,0),(2,2,'<p>Answer these questions <em>in not more than 50 words.</em></p>',0,0,'0000-00-00 00:00:00',1,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'2013-11-30 03:00:31',818,'0000-00-00 00:00:00',0,0),(3,3,'<p>Answer these questions <em>in not more than 50 words.</em></p>',0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'2013-11-30 03:03:16',818,'0000-00-00 00:00:00',0,0),(4,4,'<p>Answer these questions <em>in not more than 50 words.</em></p>',0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'2013-11-30 03:09:33',818,'0000-00-00 00:00:00',0,0),(5,5,'<p>Answer these questions <em>in not more than 50 words.</em></p>',0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'2013-11-30 03:11:17',818,'0000-00-00 00:00:00',0,0),(6,6,'<p>Answer these questions <em>in not more than 55 words.</em></p>',0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'2013-11-30 06:01:14',818,'0000-00-00 00:00:00',0,0),(7,7,'<p>Answer these questions <em>in not more than 50 words.</em></p>',0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'2013-11-30 06:03:43',818,'0000-00-00 00:00:00',0,0),(8,8,'<p>Answer these questions <em>in not more than 45 words.</em></p>',0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'2013-11-30 06:06:39',818,'0000-00-00 00:00:00',0,0),(9,9,'<p>Answer these questions <em>in not more than 50 words.</em></p>',0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'2013-11-30 06:09:49',818,'0000-00-00 00:00:00',0,0),(10,10,'<p>Answer these questions <em>in not more than 45 words.</em></p>',0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'2013-11-30 06:13:12',818,'0000-00-00 00:00:00',0,0),(11,11,'<p>Answer these questions <em>in not more than 50 words.</em></p>',0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'2013-11-30 11:21:17',818,'0000-00-00 00:00:00',0,0),(12,12,'<p>Answer these questions <em>in not more than 45 words.</em></p>',0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'2013-11-30 11:23:23',818,'0000-00-00 00:00:00',0,0),(13,13,'<p>Answer these questions <em>in not more than 50 words.</em></p>',0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'2013-11-30 11:26:20',818,'0000-00-00 00:00:00',0,0),(14,14,'<p>Answer these questions <em>in not more than 55 words.</em></p>',0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'2013-11-30 11:29:23',818,'0000-00-00 00:00:00',0,0),(15,15,'<p>Answer these questions <em>in not more than 55 words.</em></p>',0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'2013-11-30 11:34:38',818,'0000-00-00 00:00:00',0,0);
/*!40000 ALTER TABLE `job_ec_lessons_comprehensions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_ec_lessons_usages_exercises`
--

DROP TABLE IF EXISTS `job_ec_lessons_usages_exercises`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_ec_lessons_usages_exercises` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usage_id` int(11) NOT NULL,
  `title` text,
  `exercise_text` text,
  `exercise_text_explain` text,
  `exercise_text_trans` text,
  `created` datetime DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified` datetime DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `deleted` datetime DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) unsigned NOT NULL DEFAULT '0',
  `deleted_flg` tinyint(1) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 PACK_KEYS=0;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_ec_lessons_usages_exercises`
--

LOCK TABLES `job_ec_lessons_usages_exercises` WRITE;
/*!40000 ALTER TABLE `job_ec_lessons_usages_exercises` DISABLE KEYS */;
INSERT INTO `job_ec_lessons_usages_exercises` VALUES (2,2,'Write these sentences again.','<p>Write these sentences again. Each sentence must begin with <em>What.</em></p>',NULL,NULL,'0000-00-00 00:00:00',0,'2013-11-21 16:18:10',818,'0000-00-00 00:00:00',0,0),(3,3,'Write each of the following sentences in the different ways','<p>Write each of the following sentences in the different ways:</p>',NULL,NULL,'0000-00-00 00:00:00',0,'2013-11-28 14:44:13',818,'0000-00-00 00:00:00',0,0),(4,4,'Choose the correct words in the following','<p>Choose the correct words in the following:</p>',NULL,NULL,'0000-00-00 00:00:00',0,'2013-11-29 16:17:25',818,'0000-00-00 00:00:00',0,0),(5,5,'Supply the correct phrases with \"way\" in the following','<p>A. Supply the correct phrases with \"way\" in the following:</p>',NULL,NULL,'0000-00-00 00:00:00',0,'2013-11-30 04:20:50',818,'0000-00-00 00:00:00',0,0),(6,5,'Rewrite these sentences using...','<p>B. Rewrite these sentences using <em>spare</em> or <em>to spare </em>in place of the words or phrases in italics. Make any other necessary changes.</p>',NULL,NULL,'0000-00-00 00:00:00',0,'2013-11-30 04:46:02',818,'0000-00-00 00:00:00',0,0),(7,6,'Put in the right words','<p>A. Put in the right words:</p>',NULL,NULL,'0000-00-00 00:00:00',0,'2013-11-30 11:09:56',818,'0000-00-00 00:00:00',0,0),(8,6,'Rewrite the following sentences','<p>B. Rewrite the following sentences using the correct form of the verb <em>knock</em> in place of the words in italics:</p>',NULL,NULL,'0000-00-00 00:00:00',0,'2013-11-30 11:11:23',818,'0000-00-00 00:00:00',0,0),(9,7,'We can change the position of the words','<p>We can change the position of the words in italics in some of the sentences below. For instance, we can change the position of the word <em>out </em>in this sentence: He put <em>out</em> the fire. But we cannot change the position of the word for in this sentences: He is looking for his pen. Where possible, change the position of words in italics in the sentences belows:</p>',NULL,NULL,'0000-00-00 00:00:00',0,'2013-11-30 12:17:30',818,'0000-00-00 00:00:00',0,0),(10,8,'Choose the correct words in the following sentences:','<p>A. Choose the correct words in the following sentences:</p>',NULL,NULL,'0000-00-00 00:00:00',0,'2013-11-30 12:58:51',818,'0000-00-00 00:00:00',0,0),(11,8,'Put in the word for...','<p>B. Put in the word <em>for </em>where necessary:</p>',NULL,NULL,'0000-00-00 00:00:00',0,'2013-11-30 13:02:46',818,'0000-00-00 00:00:00',0,0),(12,9,'Write negative answers to these questions','<p>A. Write negative answers to these questions in two different ways:</p>',NULL,NULL,'0000-00-00 00:00:00',0,'2013-12-02 00:16:52',818,'0000-00-00 00:00:00',0,0),(13,9,'Change the form these sentences','<p>B. Change the form these sentences:</p>',NULL,NULL,'0000-00-00 00:00:00',0,'2013-12-02 00:17:55',818,'0000-00-00 00:00:00',0,0),(14,10,'Suppy the correct words in the following','<p>A. Suppy the correct words in the following:</p>',NULL,NULL,'0000-00-00 00:00:00',0,'2013-12-02 00:42:14',818,'0000-00-00 00:00:00',0,0),(15,10,'Change the form of the phrases in italics','<p>B. Change the form of the phrases in italics:</p>',NULL,NULL,'0000-00-00 00:00:00',0,'2013-12-02 00:42:44',818,'0000-00-00 00:00:00',0,0);
/*!40000 ALTER TABLE `job_ec_lessons_usages_exercises` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_ec_lessons_grammars`
--

DROP TABLE IF EXISTS `job_ec_lessons_grammars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_ec_lessons_grammars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lesson_id` int(11) NOT NULL,
  `title` text,
  `description` text,
  `text` text,
  `text_explain` text,
  `text_trans` text,
  `keystruct_no` varchar(50) NOT NULL COMMENT 'key structure number of lesson',
  `keystruct_ref` varchar(50) NOT NULL COMMENT 'related key structure number of lesson',
  `published` tinyint(4) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified` datetime DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `deleted` datetime DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) unsigned NOT NULL DEFAULT '0',
  `deleted_flg` tinyint(1) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 PACK_KEYS=0;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_ec_lessons_grammars`
--

LOCK TABLES `job_ec_lessons_grammars` WRITE;
/*!40000 ALTER TABLE `job_ec_lessons_grammars` DISABLE KEYS */;
INSERT INTO `job_ec_lessons_grammars` VALUES (1,1,'Word Order in Simple Statements.','<p>Word Order in Simple Statements.</p>\r\n<p><em>a)</em> A statement tells us about something. All the sentences in the passage are statements.&nbsp;Each of these statements contains one idea. Each statement tells us about <em>one thing</em>. A statement that tells us about one thing is a <em>simple statement</em>.</p>\r\n<p><em>b)</em> The order of the words in a statement is very important. Look at these two statements. They both contain the same words but they do not mean the same thing:</p>\r\n<p>&nbsp;&nbsp; The policeman arrested the thief.</p>\r\n<p>&nbsp;&nbsp; The thief arrested the policeman.</p>\r\n<p><em>c)</em> A simple statement can have six parts, but it does not always have so many. Study the order of the words in the columns on page next. Note that column 6 (When?) can be at the beginning or at the end of a statement.</p>',NULL,NULL,NULL,'KS.1','',1,'0000-00-00 00:00:00',0,'2013-11-17 14:55:21',818,'0000-00-00 00:00:00',0,0),(2,2,'Now, Often and Always.','<p>Now, Often and Always.</p>\r\n<p>Study these statements and questions:</p>\r\n<table style=\"height: 30%; width: 99%;\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<td><em>Now</em></td>\r\n<td><em>Often and Always</em></td>\r\n</tr>\r\n<tr>\r\n<td>These sentences are from the passages:</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>It\'s raining.</td>\r\n<td>I neve get up early on Sundays.</td>\r\n</tr>\r\n<tr>\r\n<td>I\'m&nbsp; still having breakfast.</td>\r\n<td>I sometimes stay in bed until lunch time.</td>\r\n</tr>\r\n<tr>\r\n<td>What are you doing?</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>Here are some more sentences:</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>He is still sleeping.</td>\r\n<td>He rarely gets up before 10 o\'clock.</td>\r\n</tr>\r\n<tr>\r\n<td>We are enjoying our lunch.</td>\r\n<td>We frequently have lunch at this restaurant.</td>\r\n</tr>\r\n<tr>\r\n<td>I am reading in bed.</td>\r\n<td>Do you ever read in bed?</td>\r\n</tr>\r\n</tbody>\r\n</table>',NULL,NULL,NULL,'KS.2','',1,'0000-00-00 00:00:00',0,'2013-11-21 16:24:31',818,'0000-00-00 00:00:00',0,0),(3,3,'What happened?','<p>Read this short conversation. Pay close attention to the verbs in italics. Each of these verbs tells us <em>what happened.</em></p>\r\n<p>POLICEMAN: Did you see the acident, sir?</p>\r\n<p>MAN: Yes, I did. The driver of that car <em>hit </em>that post over there.</p>\r\n<p>POLICEMAN: What happened?</p>\r\n<p>MAN: A dog <em>ran </em>across the road and the driver <em>tried to avoid</em> it. The car suddenly <em>came </em>towards me. It <em>climbed </em>on the pavement and <em>crashed </em>into the post.</p>\r\n<p>POLICEMAN: What did you do?</p>\r\n<p>MAN: I <em>ran </em>across the street after the dog.</p>\r\n<p>POLICEMAN: Why did you do that? Were you afraid of the car?</p>\r\n<p>MAN: I wasn\'t afraid of the car. I was afraid of the driver. The driver <em>got out </em>of the car and <em>began shouting </em>at me. He was very angry with me. You see, it was my dog.</p>',NULL,NULL,NULL,'KS.3','',1,'0000-00-00 00:00:00',0,'2013-11-28 14:38:36',818,'0000-00-00 00:00:00',0,0),(4,4,'What happened?','<p>What happened?</p>\r\n<p>These sentences are from the passage. Study the carefully. Pay close attention to the words in italics:</p>\r\n<p>I have <em>just</em> received a letter from my brother, Tim.</p>\r\n<p>He has been there <em>for six months.</em></p>\r\n<p>He has <em>already</em> visited a great number of different places.</p>\r\n<p>My brother has <em>never</em> been abroad before.</p>\r\n<p>&nbsp;</p>\r\n<p>Here are some more sentences:</p>\r\n<p>He has retired <em>now</em>.</p>\r\n<p>Have you <em>ever </em>been to Australia?</p>\r\n<p>Have you read any good books <em>lately</em>?</p>\r\n<p>I haven\'t been very successful <em>so far</em>.</p>\r\n<p>The train has not arrived <em>yet</em>.</p>',NULL,NULL,NULL,'KS.4','',0,'0000-00-00 00:00:00',0,'2013-11-28 15:06:09',818,'0000-00-00 00:00:00',0,0),(5,5,'What happened?','<p>What happened? What has happened?</p>\r\n<p>Study these sentences. Pay close attention to the words in italics.</p>\r\n<p><em>What happened</em>?</p>\r\n<p>I wrote to hime <em>last month</em>.</p>\r\n<p>I bought this car <em>last year</em>.</p>\r\n<p>He came to see me <em>this morning</em>.</p>\r\n<p>I saw him <em>ten minutes ago</em>.</p>\r\n<p><em>What has happened</em>?</p>\r\n<p>The train has just <em>left</em> the station.</p>\r\n<p>I\'ve <em>already</em> seen that film.</p>\r\n<p>He has been abroad <em>for six months</em>.</p>\r\n<p>Have you <em>ever</em> met him <em>before</em>?</p>\r\n<p>I have <em>never</em> met him <em>before</em>.</p>\r\n<p>I have not finished work <em>yet</em>.</p>\r\n<p>There have been a great number of accidents <em>lately</em>.</p>\r\n<p><em>Up till now</em> he has won five prizes.</p>',NULL,NULL,NULL,'KS.5','',0,'0000-00-00 00:00:00',0,'2013-11-29 16:51:39',818,'0000-00-00 00:00:00',0,0),(6,6,'The and Some','<p>A. The and Some</p>\r\n<p><em>a) </em>A and Some</p>\r\n<p>We can say: a pen, some pens; a book, some books; a picture, some pictures; a glass of milk, some milk; a bag of flour, some flour; a bar of soap, some soap. We can also use these words without <em>a</em> or <em>some</em>. Read these sentences carfully:</p>\r\n<p>Yesterday I bought <em>a book</em>. <em>Books</em> are not very expensive.</p>\r\n<p>I have just drunk <em>a glass of milk</em>. <em>Milk</em> is very refreshing.</p>\r\n<p>Mrs Jones bought <em>a bag of flour</em>, <em>a bag of sugar</em> and <em>some tea</em>.</p>\r\n<p>She always buys <em>flour</em>, <em>sugar</em> and <em>tea</em> at the grocer\'s.</p>\r\n<p><em>b</em>) A and The</p>\r\n<p>Read this paragraph. Pay close attention to words <em>a</em> and <em>the</em>.</p>\r\n<p><em>A</em> man is walking towards me. <em>The</em> man is carring <em>a</em> parcel. <em>The</em> parcel is full of meat. <em>The</em> man has just bought some meat. <em>A</em> dog is following <em>the</em> man. <em>The</em> dog is looking at <em>the</em> parcel.</p>\r\n<p><em>c</em>) Names</p>\r\n<p>We cannot put <em>a</em> or <em>the</em> in front of names:</p>\r\n<p>John lives in England. He has a house in London. His house is in Duke Street. Last year he went to Madrid. John likes Spain very much. He goes there very summer.</p>',NULL,NULL,NULL,'KS.6','',0,'0000-00-00 00:00:00',0,'2013-11-30 06:32:09',818,'0000-00-00 00:00:00',0,0),(7,7,'What were you doing when I telephoned?','<p>What were you doing when I telephoned?</p>\r\n<p>Study these sentences carefully. Pay close attention to the words in italics:</p>\r\n<p><em>When</em> I was watering the garden, it began to rain.</p>\r\n<p>I was having breakfast <em>when</em> the telephone rang.</p>\r\n<p><em>While</em> we were having a party, the lights went out.</p>\r\n<p>George was reading <em>while</em> his wife was listening to the radio.</p>\r\n<p><em>As</em> I was getting on the bus, I slipped and hurt my foot.</p>\r\n<p>Someone knocked at the door <em>just as</em> I was getting into the bath.</p>\r\n<p>The plane was late and detectives were waiting at the airport <em>all morning</em>.</p>',NULL,NULL,NULL,'KS.7','',0,'0000-00-00 00:00:00',0,'2013-11-30 11:43:00',818,'0000-00-00 00:00:00',0,0),(8,8,'The best and the worst','<p>The best and the worst</p>\r\n<p>I want to tell you something about three girls in our class. The girls\' name are Mary, Jane and Betty. Read these sentences carefully:</p>\r\n<p>&nbsp;&nbsp; Mary is tall, but Jane s taller. Jane is taller than Mary. Betty is very tall. She is the tallest girl in the class.</p>\r\n<p>&nbsp;&nbsp; Jane\'s handwriting is bad, but Mary\'s is worse. Betty\'s handwriting is very bad. It is the worst handwriting I have ever seen.</p>\r\n<p>&nbsp;&nbsp; The three girls collect photos of film starts. Mary hasn\'t many photos, but Jane has more. Jane has more photos than Mary. Betty has very many. She has the most.</p>\r\n<p>&nbsp;&nbsp; Mary\'s collection of photos is not very good. Jane\'s is better. Betty\'s collection is the best.</p>\r\n<p>&nbsp;&nbsp; Last week the three girls bought expensive dresses. Betty\'s dress was more expensive than Jane\'s. Mary\'s was more expensive than Betty\'s. Mary\'s dress was the most expensive.</p>',NULL,NULL,NULL,'KS.8','',0,'0000-00-00 00:00:00',0,'2013-11-30 12:33:36',818,'0000-00-00 00:00:00',0,0),(9,9,'When did you arrive?','<p>When did you arrive? I arrived at 10 o\'clock.</p>\r\n<p>Read these sentences carefully. Pay close attention to the phrase in italics. We can use phrases like these to answer questions beginning with <em>When</em>.</p>\r\n<p><em>a</em>) Phrases with <em>at</em>:</p>\r\n<p>I always leave home <em>at 8 o\'clock</em>. I begin work <em>at 9 o\'clock</em>. I work all day and often get home late <em>at night</em>.</p>\r\n<p><em>b</em>) Phrases with <em>in</em>:</p>\r\n<p>I\'m going out now. I\'ll be back <em>in ten minutes</em> or <em>in half an hour</em>.</p>\r\n<p>The second World War began <em>in 1939</em> and ended <em>in 1945</em>.</p>\r\n<p>Many tourists come here in summer. They usually come <em>in July</em> and <em>in August</em>. It is very quiet here <em>in winter</em>. The hotels are often empty <em>in January</em>, <em>February</em> and <em>in March</em>.</p>\r\n<p>I\'ll see you <em>in the morning</em>. I can\'t see you <em>in the afternoon</em> or <em>in the evening</em>.</p>\r\n<p><em>c</em>) Phrases with <em>on</em>:</p>\r\n<p>I shall see him on Webnesday. I\'m not free <em>on Tuesday</em> or <em>Thursday</em>.</p>\r\n<p>My brother will arrive from Germany <em>on April 27th</em>. He will return <em>on May 5th</em>.</p>\r\n<p><em>d</em>) Other phrases:</p>\r\n<p>The shops are open <em>from 9 till 5</em>.</p>\r\n<p>It rained heavily <em>during the night</em>.</p>\r\n<p>He will not arrive <em>until 10 o\'clock</em>.</p>',NULL,NULL,NULL,'KS.9','',0,'0000-00-00 00:00:00',0,'2013-11-30 14:02:40',818,'0000-00-00 00:00:00',0,0),(10,10,'It was made in Germany in 1681','<p>It was made in Germany in 1681.</p>\r\n<p><em>a</em>) Read these two questions and answers:</p>\r\n<p>Who built this bridge?</p>\r\n<p>Prisoners of war built this bridge in 1942.</p>\r\n<p>When was this bridge built?</p>\r\n<p>This bridge was built in 1942.</p>\r\n<p>In the first question we want to know <em>who </em>built the bridge. In the second question we want to learn about <em>the bridge</em>. We can still say <em>who </em>built it. We can say:</p>\r\n<p>This bridge was built by <em>prisoners of was</em> in 1942.</p>\r\n<p><em>b</em>) Now read these pairs of sentences carefully.</p>\r\n<p>The first sentence in each pair tells us about <em>a person</em>.(Who)</p>\r\n<p>The second tells us about <em>thing</em>.(What or Which)</p>\r\n<p><em>Workmen are building</em> a new road outside my house. (Who)</p>\r\n<p><em>A new road is being built</em> outside my house. (What)</p>\r\n<p><em>The newsagent delivers</em> our papers every morning. (Who)</p>\r\n<p><em>Our papers are delivered</em> every morning. (What)</p>\r\n<p><em>The postman delivered</em> a letter this morning. (Who)</p>\r\n<p><em>A letter was delivered</em> this morning. (What)</p>\r\n<p><em>c</em>) Now read these sentences:</p>\r\n<table border=\"0\">\r\n<tbody>\r\n<tr>\r\n<td><em>Instead of saying:</em></td>\r\n<td><em>We can say:</em></td>\r\n</tr>\r\n<tr>\r\n<td>The police arrested the thief.</td>\r\n<td>The thief was arrested (by the police).</td>\r\n</tr>\r\n<tr>\r\n<td>He gave me a present.</td>\r\n<td>I was given a present.</td>\r\n</tr>\r\n<tr>\r\n<td>The headmaster has punished the boy.</td>\r\n<td>The boy has been punished (by the headmaster).</td>\r\n</tr>\r\n</tbody>\r\n</table>',NULL,NULL,NULL,'KS.10','',0,'0000-00-00 00:00:00',0,'2013-12-02 01:31:45',818,'0000-00-00 00:00:00',0,0);
/*!40000 ALTER TABLE `job_ec_lessons_grammars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_ec_levels`
--

DROP TABLE IF EXISTS `job_ec_levels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_ec_levels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `alias` varchar(255) DEFAULT '',
  `description` text,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime DEFAULT '0000-00-00 00:00:00',
  `published` tinyint(4) DEFAULT '0',
  `publish_up` datetime DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime DEFAULT '0000-00-00 00:00:00',
  `created` datetime DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified` datetime DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `deleted` datetime DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) unsigned NOT NULL DEFAULT '0',
  `deleted_flg` tinyint(1) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 PACK_KEYS=0;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_ec_levels`
--

LOCK TABLES `job_ec_levels` WRITE;
/*!40000 ALTER TABLE `job_ec_levels` DISABLE KEYS */;
INSERT INTO `job_ec_levels` VALUES (1,'Elementery','Elementery','',0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'2013-11-16 09:14:06',818,'0000-00-00 00:00:00',0,0),(2,'Pre Elementery','Pre Intermediate','',0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'2013-11-16 09:15:22',818,'0000-00-00 00:00:00',0,0);
/*!40000 ALTER TABLE `job_ec_levels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_ec_lessons_exercises`
--

DROP TABLE IF EXISTS `job_ec_lessons_exercises`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_ec_lessons_exercises` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lesson_id` int(11) NOT NULL,
  `description` text,
  `title` varchar(255) DEFAULT '',
  `published` tinyint(4) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified` datetime DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `deleted` datetime DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) unsigned NOT NULL DEFAULT '0',
  `deleted_flg` tinyint(1) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_ec_lessons_exercises`
--

LOCK TABLES `job_ec_lessons_exercises` WRITE;
/*!40000 ALTER TABLE `job_ec_lessons_exercises` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_ec_lessons_exercises` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_ec_lessons_comprehensions_questions`
--

DROP TABLE IF EXISTS `job_ec_lessons_comprehensions_questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_ec_lessons_comprehensions_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comprehension_id` int(11) NOT NULL,
  `description` text,
  `question` text,
  `question_trans` text,
  `answer` text,
  `answer_trans` text,
  `published` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8 PACK_KEYS=0;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_ec_lessons_comprehensions_questions`
--

LOCK TABLES `job_ec_lessons_comprehensions_questions` WRITE;
/*!40000 ALTER TABLE `job_ec_lessons_comprehensions_questions` DISABLE KEYS */;
INSERT INTO `job_ec_lessons_comprehensions_questions` VALUES (1,1,NULL,'Where did the write go last week?',NULL,NULL,NULL,0),(2,1,NULL,'Did he enjoy the play or not?',NULL,NULL,NULL,0),(3,1,NULL,'Who was sitting behind him?',NULL,NULL,NULL,0),(4,1,NULL,'Were they talking loudly, or were they talking quitetly?',NULL,NULL,NULL,0),(5,1,NULL,'Could the writer hear the actors or not?',NULL,NULL,NULL,0),(6,1,NULL,'Did he turn round or not?',NULL,NULL,NULL,0),(7,1,NULL,'What did he say?',NULL,NULL,NULL,0),(8,1,NULL,'Did the young man say, \"The play is not interesting.\" or did he say, \"This is a private conversation!\"?',NULL,NULL,NULL,0),(9,2,NULL,'Does the writer always get up early on Sundays, or does he always get up late?',NULL,NULL,NULL,0),(10,2,NULL,'Did he get up early last Sunday, or did he get up late?',NULL,NULL,NULL,0),(11,2,NULL,'Who telephoned then?',NULL,NULL,NULL,0),(12,2,NULL,'Had she arrived by train, or had she come on foot?',NULL,NULL,NULL,0),(13,2,NULL,'Was she coming to see hi or not?',NULL,NULL,NULL,0),(14,2,NULL,'Did he say, \"I\'m still having breakfast\", or did he say, \"I am still in bed\"?',NULL,NULL,NULL,0),(15,2,NULL,'Was his aunt very surprised or not?',NULL,NULL,NULL,0),(16,2,NULL,'What was the time?',NULL,NULL,NULL,0),(17,3,NULL,'Do postcards always spoil the writer\'s holidays or not?',NULL,NULL,NULL,0),(18,3,NULL,'Where did he spend his holidays last summer?',NULL,NULL,NULL,0),(19,3,NULL,'What did he think about every day?',NULL,NULL,NULL,0),(20,3,NULL,'Did he send any cards to his friends or not?',NULL,NULL,NULL,0),(21,3,NULL,'How many cards did he buy on the last day?',NULL,NULL,NULL,0),(22,3,NULL,'Where did he stay all day?',NULL,NULL,NULL,0),(23,3,NULL,'Did he write any cards or not?',NULL,NULL,NULL,0),(24,4,NULL,'What has the writer just received from his brother, Tim?',NULL,NULL,NULL,0),(25,4,NULL,'Is Tim an engineer, or is he a doctor?',NULL,NULL,NULL,0),(26,4,NULL,'How long has he been is Australia?',NULL,NULL,NULL,0),(27,4,NULL,'Has he already visited many places or not?',NULL,NULL,NULL,0),(28,4,NULL,'Where is he now?',NULL,NULL,NULL,0),(29,4,NULL,'Has Time ever been abroad before or not?',NULL,NULL,NULL,0),(30,4,NULL,'Is he enjoying his trip very much or not?',NULL,NULL,NULL,0),(31,5,NULL,'Where has Mr Scott opened his second garage?',NULL,NULL,NULL,0),(32,5,NULL,'Where is his first garage?',NULL,NULL,NULL,0),(33,5,NULL,'How far away is Silbury?',NULL,NULL,NULL,0),(34,5,NULL,'Can Mr Scott get a telephone for his new garage or not?',NULL,NULL,NULL,0),(35,5,NULL,'What has he bought?',NULL,NULL,NULL,0),(36,5,NULL,'In how many minutes do they carry messages from one garage to the other?',NULL,NULL,NULL,0),(37,6,NULL,'Has the writer just moved to a house in Bridge Street or not?',NULL,NULL,NULL,0),(38,6,NULL,'Who knocked at her door yesterday?',NULL,NULL,NULL,0),(39,6,NULL,'Did he sing songs, or did he ask for money?',NULL,NULL,NULL,0),(40,6,NULL,'What did the writer give him in return for this?',NULL,NULL,NULL,0),(41,6,NULL,'What is the beggar\'s name?',NULL,NULL,NULL,0),(42,6,NULL,'Does he call at every house once a week or once a month?',NULL,NULL,NULL,0),(43,7,NULL,'How long were detectives waiting at the airport?',NULL,NULL,NULL,0),(44,7,NULL,'What were they expecting from South Africa?',NULL,NULL,NULL,0),(45,7,NULL,'Where did two men take the parcel after the arrival of the plane?',NULL,NULL,NULL,0),(46,7,NULL,'How many detectives opened it?',NULL,NULL,NULL,0),(47,7,NULL,'What was the parcel full of?',NULL,NULL,NULL,0),(48,8,NULL,'Who has the best garden in town?',NULL,NULL,NULL,0),(49,8,NULL,'What does he win each year?',NULL,NULL,NULL,0),(50,8,NULL,'Who else has a fine garden?',NULL,NULL,NULL,0),(51,8,NULL,'Is Joe\'s better or not?',NULL,NULL,NULL,0),(52,8,NULL,'Is the writer\'s garden beautiful, or is it terrible?',NULL,NULL,NULL,0),(53,8,NULL,'What does he always win a prize for?',NULL,NULL,NULL,0),(54,9,NULL,'Where did we go on New Year\'s Eve?',NULL,NULL,NULL,0),(55,9,NULL,'Were there many people there or not?',NULL,NULL,NULL,0),(56,9,NULL,'In how many minutes would the Town Hall clock strike twelve?',NULL,NULL,NULL,0),(57,9,NULL,'At what time did it stop?',NULL,NULL,NULL,0),(58,9,NULL,'Did it refuse to welcome the New Year or not?',NULL,NULL,NULL,0),(59,9,NULL,'What did the crowd do then?',NULL,NULL,NULL,0),(60,10,NULL,'Do we own an old clavichord, or do we own a new piano?',NULL,NULL,NULL,0),(61,10,NULL,'When was it made?',NULL,NULL,NULL,0),(62,10,NULL,'Who bought the instrument many years ago?',NULL,NULL,NULL,0),(63,10,NULL,'Who damaged it recently?',NULL,NULL,NULL,0),(64,10,NULL,'What did she try to do?',NULL,NULL,NULL,0),(65,10,NULL,'What did she break?',NULL,NULL,NULL,0),(66,10,NULL,'Who is repairing it now?',NULL,NULL,NULL,0),(67,11,NULL,'Where were you having dinner?',NULL,NULL,NULL,0),(68,11,NULL,'Did you see Harry Steele after a while or not?',NULL,NULL,NULL,0),(69,11,NULL,'What does he always borrow from his friends?',NULL,NULL,NULL,0),(70,11,NULL,'Did Harry sit at your table, or did he sit somewhere else?',NULL,NULL,NULL,0),(71,11,NULL,'How much did you ask him to lend you?',NULL,NULL,NULL,0),(72,11,NULL,'Did he give you the money at once or not?',NULL,NULL,NULL,0),(73,11,NULL,'What did he want you to do?',NULL,NULL,NULL,0),(74,12,NULL,'Whom shall we meet at Portmouth Harbour early tomorrow morning?',NULL,NULL,NULL,0),(75,12,NULL,'Where will he be?',NULL,NULL,NULL,0),(76,12,NULL,'At what time will he leave?',NULL,NULL,NULL,0),(77,12,NULL,'Shall we say goodbye to him, or shall we travel with him?',NULL,NULL,NULL,0),(78,12,NULL,'What will he take part in?',NULL,NULL,NULL,0),(79,13,NULL,'Are the Greenwood Boys popular singers, or are they popular dancers?',NULL,NULL,NULL,0),(80,13,NULL,'When will they be coming here?',NULL,NULL,NULL,0),(81,13,NULL,'Who will be meeting them at the station?',NULL,NULL,NULL,0),(82,13,NULL,'How many performances will they give?',NULL,NULL,NULL,0),(83,13,NULL,'What will the police be trying to do as usual?',NULL,NULL,NULL,0),(84,14,NULL,'Whom did the writer give a lift to in the south of France last year?',NULL,NULL,NULL,0),(85,14,NULL,'Did they greet each other in English or in French?',NULL,NULL,NULL,0),(86,14,NULL,'Does the writer speak any French or not?',NULL,NULL,NULL,0),(87,14,NULL,'Did they sit in silence, or did they talk to each other?',NULL,NULL,NULL,0),(88,14,NULL,'What did the young man say at the end of the journey?',NULL,NULL,NULL,0),(89,14,NULL,'Was he English himself, or was he French?',NULL,NULL,NULL,0),(98,15,NULL,'Who wanted to see you?',NULL,NULL,NULL,0),(99,15,NULL,'How did you feel about this?',NULL,NULL,NULL,0),(100,15,NULL,'Where did you go?',NULL,NULL,NULL,0),(101,15,NULL,'Did he say that business was bad, or did he say that it was good?',NULL,NULL,NULL,0),(102,15,NULL,'Could the firm pay such large salaries or not?',NULL,NULL,NULL,0),(103,15,NULL,'How many people had left already?',NULL,NULL,NULL,0),(104,15,NULL,'Did he ask you to leave as well or not?',NULL,NULL,NULL,0),(105,15,NULL,'What did he offer you?',NULL,NULL,NULL,0);
/*!40000 ALTER TABLE `job_ec_lessons_comprehensions_questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_ec_lessons_grammars_exercises`
--

DROP TABLE IF EXISTS `job_ec_lessons_grammars_exercises`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_ec_lessons_grammars_exercises` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grammar_id` int(11) NOT NULL,
  `title` text,
  `exercise_text` text,
  `exercise_text_explain` text,
  `exercise_text_trans` text,
  `created` datetime DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified` datetime DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `deleted` datetime DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) unsigned NOT NULL DEFAULT '0',
  `deleted_flg` tinyint(1) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 PACK_KEYS=0;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_ec_lessons_grammars_exercises`
--

LOCK TABLES `job_ec_lessons_grammars_exercises` WRITE;
/*!40000 ALTER TABLE `job_ec_lessons_grammars_exercises` DISABLE KEYS */;
INSERT INTO `job_ec_lessons_grammars_exercises` VALUES (1,1,'Rule seven columns on a double sheet of paper','<p>&nbsp;A. Rule seven columns on a double sheet of paper. At the top of each column, write the numbers and the words given in the Table. Copy out the rest of the passage. Put the words of each statement in the correct column in the way shown in the Table.</p>\r\n<table class=\"list\" style=\"width: 98%; height: 30%;\" border=\"1\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td>6</td>\r\n<td>1</td>\r\n<td>2</td>\r\n<td>3</td>\r\n<td>4</td>\r\n<td>5</td>\r\n<td>6</td>\r\n</tr>\r\n<tr>\r\n<td>When?</td>\r\n<td>\r\n<p>Who?</p>\r\n<p>Which?</p>\r\n<p>What?</p>\r\n</td>\r\n<td>Action</td>\r\n<td>\r\n<p>Who?</p>\r\n<p>Which?</p>\r\n<p>What?</p>\r\n</td>\r\n<td>How?</td>\r\n<td>Where?</td>\r\n<td>When?</td>\r\n</tr>\r\n<tr>\r\n<td>Last week</td>\r\n<td>\r\n<p>I</p>\r\n</td>\r\n<td>went</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>to the theatre.</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>\r\n<p>I</p>\r\n</td>\r\n<td>had</td>\r\n<td>a very good seat.</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>\r\n<p>The play</p>\r\n</td>\r\n<td>was</td>\r\n<td>very interesting.</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>\r\n<p>I</p>\r\n</td>\r\n<td>did not enjoy</td>\r\n<td>it.</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>\r\n<p>A young man and a young woman</p>\r\n</td>\r\n<td>were sitting</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>behind me.</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>\r\n<p>They</p>\r\n</td>\r\n<td>were talking</td>\r\n<td>&nbsp;</td>\r\n<td>loudly.</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>',NULL,NULL,'0000-00-00 00:00:00',0,'2013-11-28 14:12:32',818,'0000-00-00 00:00:00',0,0),(2,1,'You will use the seven columns again for this exercise.','<p>&nbsp;B. You will use the seven columns again for this exercise. There is a line under each word or goup of words in the statements below. The words are not in the right order. Arrange the correctly in the seven columns. Look at this example:</p>\r\n<p style=\"margin-left: 90px;\">I <span style=\"text-decoration: underline;\">last year</span> <span style=\"text-decoration: underline;\">to America</span> <span style=\"text-decoration: underline;\">went.</span></p>\r\n<p>The correctly order is: I(<em>who</em>) went(<em>action</em>) to America(<em>where</em>) last year.(<em>when</em>)</p>\r\n<p>Or: Last year I went to America.</p>\r\n<p>1. <span style=\"text-decoration: underline;\">The film</span> I <span style=\"text-decoration: underline;\">enjoyed</span> <span style=\"text-decoration: underline;\">yesterday</span><span style=\"text-decoration: underline;\">.</span></p>\r\n<p>2. <span style=\"text-decoration: underline;\">The news</span> <span style=\"text-decoration: underline;\">listened to</span> I <span style=\"text-decoration: underline;\">played.</span></p>\r\n<p>3. <span style=\"text-decoration: underline;\">Well</span> <span style=\"text-decoration: underline;\">the man</span> <span style=\"text-decoration: underline;\">the piano</span> <span style=\"text-decoration: underline;\">played.</span></p>\r\n<p>4. <span style=\"text-decoration: underline;\">Games</span> <span style=\"text-decoration: underline;\">played</span> <span style=\"text-decoration: underline;\">yesterday</span> <span style=\"text-decoration: underline;\">in their room</span> <span style=\"text-decoration: underline;\">the children</span> <span style=\"text-decoration: underline;\">quietly.</span></p>\r\n<p>5. <span style=\"text-decoration: underline;\">Quietly</span> <span style=\"text-decoration: underline;\">the door</span> <span style=\"text-decoration: underline;\">he</span> <span style=\"text-decoration: underline;\">opened.</span></p>\r\n<p>6. <span style=\"text-decoration: underline;\">Immediately</span> <span style=\"text-decoration: underline;\">left</span> <span style=\"text-decoration: underline;\">he.</span></p>\r\n<p>7. <span style=\"text-decoration: underline;\">A tree</span> <span style=\"text-decoration: underline;\">in the corner of the garden</span> <span style=\"text-decoration: underline;\">he</span> <span style=\"text-decoration: underline;\">planted.</span></p>\r\n<p>8. <span style=\"text-decoration: underline;\">Before lunch</span> <span style=\"text-decoration: underline;\">the letter</span> <span style=\"text-decoration: underline;\">in his office</span> <span style=\"text-decoration: underline;\">quickly</span> <span style=\"text-decoration: underline;\">he</span> <span style=\"text-decoration: underline;\">read.</span></p>\r\n<p>9. <span style=\"text-decoration: underline;\">This morning</span> <span style=\"text-decoration: underline;\">a book</span> I <span style=\"text-decoration: underline;\">from the library</span> <span style=\"text-decoration: underline;\">borrowed.</span></p>\r\n<p>10. <span style=\"text-decoration: underline;\">The soup</span> <span style=\"text-decoration: underline;\">spoilt</span> <span style=\"text-decoration: underline;\">the cook.</span></p>\r\n<p>11. <span style=\"text-decoration: underline;\">We</span> <span style=\"text-decoration: underline;\">at home</span> <span style=\"text-decoration: underline;\">stay</span> <span style=\"text-decoration: underline;\">on Sundays.</span></p>\r\n<p>12. <span style=\"text-decoration: underline;\">There</span> <span style=\"text-decoration: underline;\">a lot of people</span> <span style=\"text-decoration: underline;\">are</span> <span style=\"text-decoration: underline;\">at the bus-stop.</span></p>\r\n<p>13. <span style=\"text-decoration: underline;\">The little boy</span> <span style=\"text-decoration: underline;\">an apple</span> <span style=\"text-decoration: underline;\">this morning</span> <span style=\"text-decoration: underline;\">ate</span> <span style=\"text-decoration: underline;\">greedily</span> <span style=\"text-decoration: underline;\">in the kitchen.</span></p>\r\n<p>14. <span style=\"text-decoration: underline;\">She</span> <span style=\"text-decoration: underline;\">beautifully</span> <span style=\"text-decoration: underline;\">draws.</span></p>\r\n<p>15. <span style=\"text-decoration: underline;\">Music</span> I <span style=\"text-decoration: underline;\">like</span> <span style=\"text-decoration: underline;\">very much.</span></p>\r\n<p>16. <span style=\"text-decoration: underline;\">A new school</span> <span style=\"text-decoration: underline;\">built</span> <span style=\"text-decoration: underline;\">they</span> <span style=\"text-decoration: underline;\">in our village</span> <span style=\"text-decoration: underline;\">last year.</span></p>\r\n<p>17. <span style=\"text-decoration: underline;\">The match</span> <span style=\"text-decoration: underline;\">at four o\'clock</span> <span style=\"text-decoration: underline;\">ended.</span></p>\r\n<p>18. <span style=\"text-decoration: underline;\">She</span> <span style=\"text-decoration: underline;\">a letter from her brother</span> <span style=\"text-decoration: underline;\">last week</span> <span style=\"text-decoration: underline;\">received.</span></p>',NULL,NULL,'0000-00-00 00:00:00',0,'2013-11-28 14:13:49',818,'0000-00-00 00:00:00',0,0),(3,2,'Write out these two paragraphs again.','<p>A. Write out these two paragraphs again. Give the right form of the words in brackets:</p>\r\n<p>1. I am looking out of my window. I can see some children in the street. The children (play) football. They always (play) football in the street. Now a little boy (kick) the ball. Another boy (run) after him but he cannot catch him.</p>\r\n<p>2. He carried my bags into the hall.</p>\r\n<p>&nbsp;&nbsp; \"What you (do)?\" my landlady asked.</p>\r\n<p>&nbsp;&nbsp; \"I (leave), Mrs Lynch,\" I answered.</p>\r\n<p>&nbsp;&nbsp; \"Why you (leave)?\" she asked. \"You have been there only a week.\"</p>\r\n<p>&nbsp;&nbsp; \"A week too long,\" I said. \"There are too many rules in this house. My friends never (come) to visit me. Dinner is always at seven o\'clock, so I frequently (go) to bed hungry. you don\'t like noise, so I rarely (listen) to the radio. The heating doesn\'t work, so I always (feel) cold. This is a terrible place for a man like me. Goodbye,&nbsp; Mrs Lynch.\"</p>',NULL,NULL,'0000-00-00 00:00:00',0,'2013-11-21 15:08:29',818,'0000-00-00 00:00:00',0,0),(4,2,'Note the position of the words in italics in these sentences:','<p>B. Note the position of the words in italics in these sentences:</p>\r\n<p>My friends <em>never</em> come to visit me.</p>\r\n<p>I <em>frequently</em> go to be hungry.</p>\r\n<p>I <em>rarely</em> listen to the radio.</p>\r\n<p>I <em>always</em> feel cold.</p>\r\n<p>I <em>never</em> get up early on Sundays.</p>\r\n<p>I <em>sometimes</em> stay in bed until lunch time.</p>\r\n<p>Write these sentences again. Put the words in brackets in the right place:</p>',NULL,NULL,'0000-00-00 00:00:00',0,'2013-11-27 14:21:08',818,'0000-00-00 00:00:00',0,0),(5,3,'Look at the passage \"Please Send Me A Card\"','<p>A. Look at the passage \"Please Send Me A Card\". Put a line under all the verds which tell us what happened to the writer when he was on holiday in Italy.</p>',NULL,NULL,'0000-00-00 00:00:00',0,'2013-11-28 14:25:45',818,'0000-00-00 00:00:00',0,0),(6,3,'Give the correct form of all the verds in brackets','<p>B. Give the correct form of all the verds in brackets. Do not refer to the passage until you finish the exercise:</p>\r\n<p>Last summer, I (go) to Italy. I (visit) museums and (sit) in public gardens. A friendly waiter (teach) me a few words of Italian. The he (lend) em a book. I (read) a few lines, but I (not understand) a word. Every day I (think) about postcards. My holidays (pass) quickly, but I (not send) any cards to my friends. On the last day, I (make) a big decision. I (get) up early and (buy) thirty-seven cards. I (spend) the whole day in my room, I (not write) a single card!</p>',NULL,NULL,'0000-00-00 00:00:00',0,'2013-11-28 14:32:30',818,'0000-00-00 00:00:00',0,0),(7,3,'Give the correct form of the verds in brackets','<p>C. Give the correct form of the verds in brackets in the passage below. Each verb must tell us <em>what happened</em>:</p>\r\n<p>My friend, Roy, (die) last year. He (leave) me his record player and his collection of gramophone records. Roy (spend) a lot of money on records. He (buy) one or two new records very week. He never (go) to the cinema or to the theatre. He (stay) at home every evening and (listen) to music. He often (lend) records to his friends. Sometimes they (keep) them. He (lose) many records in this way.</p>',NULL,NULL,'0000-00-00 00:00:00',0,'2013-11-28 14:37:59',818,'0000-00-00 00:00:00',0,0),(8,4,'Write these sentences again.','<p>A. Write these sentences again. Put the words in brackets in the right place:</p>',NULL,NULL,'0000-00-00 00:00:00',0,'2013-11-28 15:07:45',818,'0000-00-00 00:00:00',0,0),(9,4,'Give the correct form of the verds in brackets','<p>B. Give the correct form of the verds in brackets. Do not refer to the passage until you finish the exercises:</p>\r\n<p>I just (recieve) a letter from my brother, Tim. He is in Australia. He (be) there for six months. Tim is an engneer. He is working for a big firm and he already (visit) a great number of different places in Australia. He just (buy) an Australian car and (go) to Alice Springs. My brother never (be) abroad before, so he is finding this trip very exciting.</p>',NULL,NULL,'0000-00-00 00:00:00',0,'2013-11-28 15:15:47',818,'0000-00-00 00:00:00',0,0),(10,4,'What is happening?','<p>C. What is happening? What has happened?</p>\r\n<p>Read these two statements:</p>\r\n<p>The bell is rinning? -> The bell has just rung.</p>\r\n<p>Complete the following in the same way:</p>',NULL,NULL,'0000-00-00 00:00:00',0,'2013-11-29 16:04:53',818,'0000-00-00 00:00:00',0,0),(11,4,'Read these two statements:','<p>D. Read these two statements:</p>\r\n<p>He is still having breakfast. -> He hasn\'t had breakfast yet.</p>\r\n<p>Complete the following in the same way:</p>',NULL,NULL,'0000-00-00 00:00:00',0,'2013-11-28 15:22:45',818,'0000-00-00 00:00:00',0,0),(12,4,'Read these two sentences','<p>E. Read these two sentences:</p>\r\n<p>I\'ve already had lunch. -> Have you had lunch yet?</p>\r\n<p>Ask questions in the same way:</p>',NULL,NULL,'0000-00-00 00:00:00',0,'2013-11-29 16:08:45',818,'0000-00-00 00:00:00',0,0),(13,5,'Underline all the verds in the passage','<p>A. Underline all the verds in the passage which tell us <em>what happened</em> and <em>what has happened</em>.</p>',NULL,NULL,'0000-00-00 00:00:00',0,'2013-11-29 16:40:25',818,'0000-00-00 00:00:00',0,0),(14,5,'Give the correct form of the verds in brackets','<p>B. Give the correct form of the verds in brackets. Do not refer to the passage until you finish the exercies:</p>\r\n<p>Mr James Scott has a garage in Silbury and now he just (buy) another garage in Pinhurst. Pinhurst is only five miles from Silbury, but Mr Scott cannot get a telephone for his new garage, so he just (buy) twelve pigeons. Yesterday, a pigeon (carry) the first message from Pinhurst to Silbury. The bird (cover) the distance in three minutes. Up to now, Mr Scott (send) a great many requests for spare parts and other urgent messages from one garage to the other. In this way, he (begin) his own private \"telephone\" service.</p>',NULL,NULL,'0000-00-00 00:00:00',0,'2013-11-29 16:47:08',818,'0000-00-00 00:00:00',0,0),(15,5,'Give the correct form of the verds in brackets','<p>C. Give the correct form of the verds in brackets:</p>',NULL,NULL,'0000-00-00 00:00:00',0,'2013-11-29 16:47:51',818,'0000-00-00 00:00:00',0,0),(16,6,'Write these word again.','<p>A. Write these word again. Put in <em>a</em> or <em>some</em> in front of each one.</p>\r\n<p>meat, desk, tobaco, tin of tobaco, comb, city, cloth, oil, bottle of ink, word, student, sugar, rain, orange, rubber.</p>',NULL,NULL,'0000-00-00 00:00:00',0,'2013-11-30 06:35:24',818,'0000-00-00 00:00:00',0,0),(17,6,'Read the passage again','<p>B. Read the passage again. Put a line under the words <em>a</em> and <em>the</em></p>',NULL,NULL,'0000-00-00 00:00:00',0,'2013-11-30 06:36:30',818,'0000-00-00 00:00:00',0,0),(18,6,'Put in the words a or the','<p>C. Put in the words <em>a</em> or <em>the&nbsp;</em>where necessary. Do not refer to the passage until you finish the exercise:</p>\r\n<p>I have just moved to...house in...Bridge Street. Yesterday...beggar knocked at my door. He asked me for...meal and...glass of beer. In return for this,...beggar stood on his head and sang...songs. I gave him...meal. He ate...food and drank...beer. The he put...piece of cheese in his pocket and went away. Later...neighbour told me about him. Everybody knows him. His name is...Percy Buttons. He calls at every house in...street once...month and always asks for...meal and...glass of beer.</p>',NULL,NULL,'0000-00-00 00:00:00',0,'2013-11-30 07:05:10',818,'0000-00-00 00:00:00',0,0),(19,6,'Write sentecens using a, the or some','<p>D. Write sentecens using <em>a</em>, <em>the</em> or <em>some</em> with the following:</p>',NULL,NULL,'0000-00-00 00:00:00',0,'2013-11-30 07:06:58',818,'0000-00-00 00:00:00',0,0),(20,7,'Underline the verbs in the passage','<p>A. Underline the verbs in the passage which tell us what <em>was happening</em>.</p>',NULL,NULL,'0000-00-00 00:00:00',0,'2013-11-30 11:48:08',818,'0000-00-00 00:00:00',0,0),(21,7,'What was happening when...?','<p>B. What was happening when...?</p>\r\n<p>Read the passage again then answer thes questions. Write a complete sentence in answer to each question.</p>',NULL,NULL,'0000-00-00 00:00:00',0,'2013-11-30 11:49:29',818,'0000-00-00 00:00:00',0,0),(22,7,'Write sentences of your own...','<p>C. Write sentences of your own in answer to these questions. Each answer must begin with \"I was...\"</p>',NULL,NULL,'0000-00-00 00:00:00',0,'2013-11-30 11:52:25',818,'0000-00-00 00:00:00',0,0),(23,7,'What was happening?','<p>D. What was happening? What happened?</p>\r\n<p>Give the correct form of the verbs in brackets:</p>',NULL,NULL,'0000-00-00 00:00:00',0,'2013-11-30 11:54:47',818,'0000-00-00 00:00:00',0,0),(24,8,'How do they compare?','<p>A. How do they compare?</p>\r\n<p>These questions are about Mary, Jane and Betty. Answer each question with a complete sentence:</p>',NULL,NULL,'0000-00-00 00:00:00',0,'2013-11-30 12:36:03',818,'0000-00-00 00:00:00',0,0),(25,8,'In the passage...','<p>B. In the passage \"The Best and the Worst\" there seven comparisons. Can you find them?</p>',NULL,NULL,'0000-00-00 00:00:00',0,'2013-11-30 12:40:27',818,'0000-00-00 00:00:00',0,0),(26,8,'Give the correct form of the words...','<p>C. Give the correct form of the words in brackets and make other necessary changes. Do not refer to the passage until you finish the exercise:</p>\r\n<p>Joe Sanders has the (beautiful) garden in our town. Nearly everybody enters for \"The (Nice) Garden Competition\" each year, but Joe wins every time. Bill Firth\'s garden (large) Joe\'s. Bill works (hard) Joe and grows (many) flowers and vegetables, but Joe\'s garden is (interesting). He has made neat paths and has built a wooden bridge over a pool. I like garden too, but I do not like hard work. Every year I enter for the garden competition too and I always win a little prize for the (bad) garden in the town!</p>',NULL,NULL,'0000-00-00 00:00:00',0,'2013-11-30 12:46:37',818,'0000-00-00 00:00:00',0,0),(27,8,'Put in of or in:','<p>D. Put in <em>of</em> or <em>in</em>:</p>',NULL,NULL,'0000-00-00 00:00:00',0,'2013-11-30 12:48:20',818,'0000-00-00 00:00:00',0,0),(28,9,'Answer these questions','<p>A. Answer these questions on the passage:</p>',NULL,NULL,'0000-00-00 00:00:00',0,'2013-11-30 14:03:41',818,'0000-00-00 00:00:00',0,0),(29,9,'Supply the correct words...','<p>B. Supply the correct words in the following sentences:</p>',NULL,NULL,'0000-00-00 00:00:00',0,'2013-11-30 14:10:37',818,'0000-00-00 00:00:00',0,0),(30,9,'Write sentences using the following','<p>C. Write sentences using the following:</p>',NULL,NULL,'0000-00-00 00:00:00',0,'2013-11-30 14:11:59',818,'0000-00-00 00:00:00',0,0),(31,10,'Answer these questions on the passage.','<p>A. Answer these questions on the passage. Write a complete answer to each question:</p>',NULL,NULL,'0000-00-00 00:00:00',0,'2013-12-02 01:06:53',818,'0000-00-00 00:00:00',0,0),(32,10,'Change the form of the phrases in italics','<p>B. Change the form of the phrases in italics. Do not refer to the passage until you finish the exercise:</p>\r\n<p>We have an old musical instrument. <em>We call it a clavichord. Someone made it</em> in Germany in 1681. We <em>keep our clavichord</em> in the living-room. <em>My grandfather bought the instrument</em> many years ago. Recently <em>a</em> <em>visitor damaged it</em>. She struck the keys too hard and <em>broke two of the strings</em>. This <em>shocked my father. He does not allow us</em> to touch it. <em>A friend of my father\'s is repairing it</em>.</p>',NULL,NULL,'0000-00-00 00:00:00',0,'2013-12-02 01:13:47',818,'0000-00-00 00:00:00',0,0);
/*!40000 ALTER TABLE `job_ec_lessons_grammars_exercises` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_ec_questions`
--

DROP TABLE IF EXISTS `job_ec_questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_ec_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lesson_id` int(11) NOT NULL,
  `description` text,
  `title` varchar(255) DEFAULT '',
  `created` datetime DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified` datetime DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `deleted` datetime DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) unsigned NOT NULL DEFAULT '0',
  `deleted_flg` tinyint(1) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_ec_questions`
--

LOCK TABLES `job_ec_questions` WRITE;
/*!40000 ALTER TABLE `job_ec_questions` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_ec_questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_ec_lessons_grammars_exercises_questions`
--

DROP TABLE IF EXISTS `job_ec_lessons_grammars_exercises_questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_ec_lessons_grammars_exercises_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exercise_id` int(11) NOT NULL,
  `question` text,
  `question_trans` text,
  `created` datetime DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified` datetime DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `deleted` datetime DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) unsigned NOT NULL DEFAULT '0',
  `deleted_flg` tinyint(1) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8 PACK_KEYS=0;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_ec_lessons_grammars_exercises_questions`
--

LOCK TABLES `job_ec_lessons_grammars_exercises_questions` WRITE;
/*!40000 ALTER TABLE `job_ec_lessons_grammars_exercises_questions` DISABLE KEYS */;
INSERT INTO `job_ec_lessons_grammars_exercises_questions` VALUES (1,4,'She answers my letters. (rarely)',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(2,4,'We work after six o\'clock. (never)',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(3,4,'The shops close on Saturday afternoons. (always)',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(4,4,'Do you go to work by car? (always)',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(5,4,'Our teacher collects our copybooks. (frequently)',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(6,4,'We spend our holidays abroad. (sometimes)',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(7,4,'I buy gramophone records. (often)',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(8,4,'Do you by granmophone records? (ever)',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(9,8,'I have had breakfast. (just)',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(10,8,'He has been in prison. (for six months)',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(11,8,'The police have not caught the thief. (yet)',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(12,8,'You have asked that questions three times. (already)',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(13,8,'Have you been to Switzerland? (ever)',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(14,8,'I have been to Switzerland. (never)',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(15,8,'He is a wonderful runner. He has broken two records. (so far)',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(16,8,'I haven\'t  seen George. (lately)',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(17,10,'He is leaving the house.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(18,10,'He is having breakfast.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(19,10,'She is writing a letter.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(20,10,'My sister is turning on the radio.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(21,10,'My mother is making the bed.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(22,10,'She is buying a new hat.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(33,11,'She is still washing the dishes.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(34,11,'She is still making the beds.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(35,11,'He is still combing his hair.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(36,11,'She is still sweeping the carpet.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(37,11,'We are still reading \"Macbeth\".',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(38,12,'I\'ve already seen the new play at \'The Globe\'. Have you...',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(39,12,'I\'ve already taken my holidays.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(40,12,'I\'ve already read this book.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(41,12,'I\'ve already done my homework.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(42,12,'I\'ve already finished my work.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(43,15,'What...you (buy) yesterday?',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(44,15,'Up till now, he never (lend) me anything.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(45,15,'...you (burn) those old papers yet?',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(46,15,'He (fight) in Flanders in the first World War.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(47,15,'They already (leave).',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(48,15,'When...you (lose) your umbrella?',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(49,15,'...you (listen) to the correct last night?',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(50,15,'We just (win) the match.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(51,19,'found/coin/garden.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(52,19,'put/sugar/my tea.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(53,19,'cut/wood/fire.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(54,19,'bought/newspaper.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(55,19,'made/coffee.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(56,19,'like/curtains in this room.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(57,21,'What was happening when the plane arrived?',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(58,21,'What was happening when two of the detectives opened the percel?',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(59,22,'What were you doing when I telephoned you?',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(60,22,'What were you reading when I saw you in the library this morning?',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(61,22,'What were you saying when I interrupted you?',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(62,23,'As my father (leave) the house, the postman (arrive).',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(63,23,'Tom (work) in the garden while I (sit) in the sun.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(64,23,'As I (walk) down the street, I (meet) Charlie.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(65,23,'While he (read) the letter, he (hear) a knock at the door.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(66,23,'While mother (prepare) lunch, Janet (set) the table.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(67,23,'She droop the tray when I spoke to her.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(68,24,'How does Mary\'s handwriting compare with Jane\'s?',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(69,24,'How does Betty\'s handwriting compare with Mary\'s and Jane\'s?',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(70,24,'How does Betty\'s dress compare with Jane\'s?',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(71,24,'How does Mary\'s dress compare with Jane\'s and Betty\'s?',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(72,27,'Which is the longest river...the world?',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(73,27,'This is the finest picture...them all.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(74,27,'This radio is the most expensive...all the ones in the shop.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(75,27,'He is the best boxer...our town.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(76,28,'When did we go to the Town Hall?',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(77,28,'When would the clock strike twelve?',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(78,28,'When did the clock stop?',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(79,29,'He has gone abroad. He will return...two year\'s time.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(80,29,'...Saturdays I always go to the market.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(81,29,'I never got to the cimena...the week.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(82,29,'He ran a hundred metres...thirteen seconds.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(83,29,'I can\'t see him...the moment. I\'m busy.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(84,29,'My birthday is...November 7th. I was born...1984.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(85,29,'The days are very short...December.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(86,29,'We arrived at the village late...night. We left early...the morning.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(87,29,'I shall not hear from him...tomorrow.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(88,30,'begin/3 o\'clock.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(89,30,'bought/1960.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(90,30,'shop/from...till.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(91,30,'children/school/morning.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(92,30,'finish two years\' time.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(93,30,'go for a walk/evening.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(94,30,'went to church/Sunday.',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(95,31,'What is our old musical instrument called?',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(96,31,'Where was it made?',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(97,31,'Where is it kept?',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(98,31,'When was it bought?',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(99,31,'When was it damaged?',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(100,31,'How many strings were broken?',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(101,31,'How did my father feel about this?',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(102,31,'What aren\'t we allowed to do?',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0),(103,31,'What is being done to the clavichord?',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0);
/*!40000 ALTER TABLE `job_ec_lessons_grammars_exercises_questions` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-12-12  7:33:51
