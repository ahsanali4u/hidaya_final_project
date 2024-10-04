/*
SQLyog Ultimate
MySQL - 10.4.27-MariaDB : Database - 22829_ahsan_ali
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`22829_ahsan_ali` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `22829_ahsan_ali`;

/*Table structure for table `blog` */

DROP TABLE IF EXISTS `blog`;

CREATE TABLE `blog` (
  `blog_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `blog_title` varchar(200) DEFAULT NULL,
  `post_per_page` int(11) DEFAULT NULL,
  `blog_background_image` text DEFAULT NULL,
  `blog_status` enum('Active','InActive') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`blog_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `blog_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `blog` */

LOCK TABLES `blog` WRITE;

insert  into `blog`(`blog_id`,`user_id`,`blog_title`,`post_per_page`,`blog_background_image`,`blog_status`,`created_at`,`updated_at`) values 
(1,2,'Climate Change',3,'Images/6.jpg','Active','2024-09-24 22:06:37','2024-09-24 22:06:37'),
(2,2,'Pakistan Sports Zone',2,'Images/b.jpg','Active','2024-09-25 10:49:10','2024-09-25 10:48:45'),
(3,1,'Academic Oppression In Pakistan',2,'Images/17.jpg','Active','2024-09-25 10:36:33','2024-09-25 10:36:33'),
(4,1,'Pakistan Stock Exchange',3,'Images/4.jpg','Active','2024-09-25 10:36:10','2024-09-25 10:36:00');

UNLOCK TABLES;

/*Table structure for table `category` */

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_title` varchar(100) DEFAULT NULL,
  `category_description` text DEFAULT NULL,
  `category_status` enum('Active','InActive') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `category` */

LOCK TABLES `category` WRITE;

insert  into `category`(`category_id`,`category_title`,`category_description`,`category_status`,`created_at`,`updated_at`) values 
(1,'Politics',' Latest News About Politics','Active','2024-09-24 22:08:57','2024-09-24 22:08:57'),
(2,'National','National security, defense, and foreign affairs news.\r\n','Active','2024-09-24 22:10:48',NULL),
(3,'Bussiness','Pakistan&#039;s economy, finance, and market trends.','Active','2024-09-24 22:11:31',NULL),
(4,'Sports','Cricket, football, hockey, and sports updates.\r\n','Active','2024-09-24 22:11:48',NULL),
(5,'Entertainment','Pakistani movies, music, and showbiz news.\r\n\r\n ','Active','2024-09-24 22:12:28',NULL),
(6,'Technology','IT, telecom, startups, and innovation news.\r\n','Active','2024-09-24 22:13:00',NULL),
(7,'Education','Schools, universities, policies, reforms, and learning resources.\r\n','Active','2024-09-24 22:15:49',NULL),
(8,'International','Global news, geopolitics, and international relations affecting Pakistan.\r\n','Active','2024-09-24 22:17:22',NULL),
(9,'Climate','Environmental issues, weather, and climate updates.\r\n ','Active','2024-09-24 22:20:15','2024-09-24 22:20:15'),
(10,'Lifestyle','Health, fashion, travel, food, wellness, and culture.\r\n','Active','2024-09-25 10:46:43',NULL);

UNLOCK TABLES;

/*Table structure for table `following_blog` */

DROP TABLE IF EXISTS `following_blog`;

CREATE TABLE `following_blog` (
  `follow_id` int(11) NOT NULL AUTO_INCREMENT,
  `follower_id` int(11) DEFAULT NULL,
  `blog_following_id` int(11) DEFAULT NULL,
  `status` enum('Followed','Unfollowed') DEFAULT 'Followed',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`follow_id`),
  KEY `blog_following_id` (`blog_following_id`),
  KEY `follower_id` (`follower_id`),
  CONSTRAINT `following_blog_ibfk_1` FOREIGN KEY (`blog_following_id`) REFERENCES `blog` (`blog_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `following_blog_ibfk_2` FOREIGN KEY (`follower_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `following_blog` */

LOCK TABLES `following_blog` WRITE;

insert  into `following_blog`(`follow_id`,`follower_id`,`blog_following_id`,`status`,`created_at`,`updated_at`) values 
(1,1,4,'Unfollowed','2024-09-25 09:52:22','2024-09-25 09:52:22'),
(2,1,3,'Followed','2024-09-25 09:44:48',NULL),
(3,1,2,'Followed','2024-09-25 09:44:50',NULL),
(4,1,1,'Followed','2024-09-25 09:44:54',NULL),
(5,4,4,'Followed','2024-09-25 09:45:15',NULL),
(6,4,3,'Followed','2024-09-25 09:45:16',NULL),
(7,4,2,'Followed','2024-09-25 09:45:17',NULL),
(8,3,4,'Followed','2024-09-25 09:45:30',NULL),
(9,3,3,'Followed','2024-09-25 09:45:31',NULL),
(10,3,1,'Followed','2024-09-25 09:45:32',NULL),
(11,9,4,'Followed','2024-09-25 09:46:57',NULL),
(12,9,3,'Followed','2024-09-25 09:46:58',NULL),
(13,9,2,'Followed','2024-09-25 09:46:59',NULL),
(14,9,1,'Followed','2024-09-25 09:47:00',NULL),
(15,10,4,'Followed','2024-09-25 09:47:26',NULL),
(16,10,3,'Followed','2024-09-25 09:47:27',NULL),
(17,10,2,'Followed','2024-09-25 09:47:28',NULL),
(18,10,1,'Followed','2024-09-25 09:47:29',NULL),
(19,12,4,'Followed','2024-09-25 09:47:54',NULL),
(20,12,3,'Unfollowed','2024-09-25 09:47:59','2024-09-25 09:47:59'),
(21,12,2,'Followed','2024-09-25 09:47:57',NULL),
(22,12,1,'Followed','2024-09-25 09:47:58',NULL),
(23,14,3,'Followed','2024-09-25 09:48:28',NULL),
(24,14,2,'Followed','2024-09-25 09:48:29',NULL),
(25,14,4,'Followed','2024-09-25 09:48:30',NULL),
(26,18,4,'Followed','2024-09-25 09:49:29',NULL),
(27,18,1,'Followed','2024-09-25 09:49:30',NULL),
(28,18,3,'Followed','2024-09-25 09:49:32',NULL),
(29,21,4,'Followed','2024-09-25 09:50:09',NULL),
(30,21,3,'Followed','2024-09-25 09:50:11',NULL),
(31,21,2,'Followed','2024-09-25 09:50:12',NULL),
(32,20,4,'Followed','2024-09-25 09:52:58',NULL),
(33,20,2,'Followed','2024-09-25 09:53:08','2024-09-25 09:53:08'),
(34,19,4,'Followed','2024-09-25 09:53:41',NULL),
(35,19,2,'Followed','2024-09-25 09:53:44',NULL),
(36,19,1,'Followed','2024-09-25 09:53:48',NULL);

UNLOCK TABLES;

/*Table structure for table `post` */

DROP TABLE IF EXISTS `post`;

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_id` int(11) DEFAULT NULL,
  `post_title` varchar(200) NOT NULL,
  `post_summary` text NOT NULL,
  `post_description` longtext NOT NULL,
  `featured_image` text DEFAULT NULL,
  `post_status` enum('Active','InActive') DEFAULT NULL,
  `is_comment_allowed` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`post_id`),
  KEY `blog_id` (`blog_id`),
  CONSTRAINT `post_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `blog` (`blog_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `post` */

LOCK TABLES `post` WRITE;

insert  into `post`(`post_id`,`blog_id`,`post_title`,`post_summary`,`post_description`,`featured_image`,`post_status`,`is_comment_allowed`,`created_at`,`updated_at`) values 
(1,1,'Pakistan&#039;s Climate Crisis','Discover the major climate change impacts affecting Pakistan, from melting glaciers to devastating heatwaves.','Pakistan ranks among the world&#039;s top 10 countries vulnerable to climate change. Explore the key challenges and potential solutions for a sustainable future.','Images/10.jpg','Active',0,'2024-09-24 22:33:12',NULL),
(2,1,'Pakistan&#039;s Renewable Energy Future',' Explore Pakistan&#039;s shift towards renewable energy sources and the potential for a sustainable tomorrow.','Discover how Pakistan can reduce its reliance on fossil fuels and leverage solar, wind, and hydro energy to meet its growing power demands','Images/11.jpg','Active',1,'2024-09-24 22:43:23',NULL),
(3,1,'Pakistan&#039;s Water Crisis','Explore the devastating effects of climate change on Pakistan&#039;s water resources and potential solutions.','Discover how climate change affects Pakistan&#039;s water availability, agriculture, and human health. Learn about innovative solutions for water conservation and management.','Images/12.jpg','Active',0,'2024-09-24 22:49:12',NULL),
(4,1,'Heatwave Havoc in Pakistan','Understand the impact of heatwaves on Pakistan&#039;s health, economy, and environment.','Explore the causes, consequences, and solutions to Pakistan&#039;s heatwave crisis, and learn how to stay safe during extreme heat.','Images/7.jpg','Active',1,'2024-09-24 22:58:59',NULL),
(5,2,'Pakistan Cricket Team&#039;s Rise to Glory','Relive Pakistan&#039;s most iconic cricket moments and explore the team&#039;s journey to becoming a cricket powerhouse.','Discover how Pakistan&#039;s cricket success reflects national pride, resilience, and climate resilience. Learn about the team&#039;s environmental initiatives and sustainable practices.','Images/13.jpg','Active',1,'2024-09-24 23:08:05',NULL),
(6,2,'Eco-Friendly Stadiums','Explore Pakistan&#039;s potential for sustainable sports stadiums, reducing carbon footprint and promoting eco-friendly practices.','Discover innovative designs, green technologies, and best practices for environmentally conscious sports infrastructure in Pakistan.','Images/14.jpg','Active',1,'2024-09-24 23:15:58',NULL),
(7,2,'Pakistan&#039;s Football Revival',' Explore Pakistan&#039;s football potential, challenges, and success stories.','Discover the rise of Pakistani football, its impact on youth development, and efforts to promote the sport nationwide.','Images/15.jpg','Active',1,'2024-09-24 23:19:37',NULL),
(8,2,'Fitness Trends in Pakistan','Explore the latest fitness trends sweeping Pakistan, from workouts to wellness. and expert advice for a healthier lifestyle. Its good to go with healthy mind and body','Discover the growing fitness culture in Pakistan, popular exercises, and expert advice for a healthier lifestyle. and reliable to go to gym regularly and take a rest of little bit and do excercise. ','Images/16.jpg','Active',1,'2024-09-25 10:55:31','2024-09-25 10:55:31'),
(9,3,'A Tragicomedy Of Academic Oppression',' Now, before you start clutching your pearls and gasping about how ungrateful I sound, let me tell you the background.',' After getting through highly reputed western academic platforms where you spend the best part of your life in labs, seminars, and workshops satisfying all the criteria to achieve highest academic standards.','Images/2.jpg','Active',1,'2024-09-25 09:24:31',NULL),
(10,3,'A tool for justice or a muzzle on free speech.',' Supporters of the Defamation Bill argue that it is a necessary tool to protect individuals and organizations.','They contend that in an era of rampant misinformation and social media cruelty, stringent defamation laws are essential. Proponents highlight cases where false allegations have ruined careers and personal lives.','Images/6.jpg','Active',1,'2024-09-25 09:29:40',NULL),
(11,3,'Can the 2024 Budget stabilise Pakistan&#039;s economy?',' Inflation in Pakistan has been alarmingly high, with recent reports.','Down from a peak of 29.2% the previous year. The steep rise in prices, particularly for essential goods, has eroded the purchasing power of ordinary Pakistanis, leading to widespread public discontent.','Images/9.jpg','Active',1,'2024-09-25 10:53:03','2024-09-25 10:53:03'),
(12,3,'The future of Pak-Iran relations',' Economically, the relationship between Pakistan and Iran is characterised by both potential and pitfalls. ','The Iran-Pakistan Gas Pipeline, a flagship project intended to address Pakistan’s energy shortfall, symbolises the economic interdependence the two countries have sought to cultivate.','Images/a.jpg','Active',1,'2024-09-25 09:33:29',NULL),
(13,4,'PSX’s Contribution to Financial Literacy','  Pakistan Stock Exchange regularly holds Investor Awareness Sessions for the general public including students.','The Investor Awareness Sessions also align with the ‘S’ element of Environmental, Social and Governance considerations. These sessions help promote financial awareness in the society as a whole, and individuals in particular.','Images/18.jpg','Active',0,'2024-09-25 10:01:29','2024-09-25 10:01:29'),
(14,4,'Protect your Rights as an Investor',' When investing in the market subsequent to opening an account with a securities broker.','Investors must be cognizant of their rights regarding investment in the market. From account opening and maintenance, investment process and procedures.','Images/19.jpg','Active',0,'2024-09-25 09:42:34',NULL),
(15,4,'Advantages of becoming a TREC Holder','Becoming a Trading Right Entitlement Certificate (TREC) Holder at Pakistan Stock Exchange.','The TREC Holders or securities brokers have the advantage of trading for themselves or for their clients. Infact, holding a TRE Certificate enables a securities broker to have more than just the license to trade on PSX.','Images/20.jpg','Active',1,'2024-09-25 10:52:01','2024-09-25 10:52:01'),
(16,4,'Pakistan Stock Exchange closes on flat note','  The benchmark hit the day&#039;s high at 40,742 points in the first few minutes of the session.','A market report from the JS Global attributed bearish sentiments at the bourse to ongoing political developments in the country. ','Images/4.jpg','Active',0,'2024-09-25 10:52:21','2024-09-25 10:52:21');

UNLOCK TABLES;

/*Table structure for table `post_atachment` */

DROP TABLE IF EXISTS `post_atachment`;

CREATE TABLE `post_atachment` (
  `post_atachment_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `post_attachment_title` varchar(200) DEFAULT NULL,
  `post_attachment_path` text DEFAULT NULL,
  `is_active` enum('Active','InActive') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`post_atachment_id`),
  KEY `fk1` (`post_id`),
  CONSTRAINT `fk1` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `post_atachment` */

LOCK TABLES `post_atachment` WRITE;

insert  into `post_atachment`(`post_atachment_id`,`post_id`,`post_attachment_title`,`post_attachment_path`,`is_active`,`created_at`,`updated_at`) values 
(1,1,'PDF File','attachments/file3.pdf','Active','2024-09-24 22:33:13',NULL),
(2,1,'Word Document','attachments/files1.docx','Active','2024-09-24 22:33:13',NULL),
(3,2,'PPTX File','attachments/file4.pptx','Active','2024-09-24 22:43:23',NULL),
(4,3,'TXT File','attachments/files2.txt','Active','2024-09-24 22:49:12',NULL),
(5,3,'JPG Image','attachments/1.jpg','Active','2024-09-24 22:49:12',NULL),
(6,5,'PDF File','attachments/file3.pdf','Active','2024-09-24 23:08:05',NULL),
(7,5,'PPTX File','attachments/file4.pptx','Active','2024-09-24 23:08:05',NULL),
(8,8,'TXT File','attachments/files2.txt','Active','2024-09-25 10:56:13',NULL),
(9,10,'Word Document','attachments/files1.docx','Active','2024-09-25 09:29:41',NULL),
(10,10,'PPTX File','attachments/file4.pptx','Active','2024-09-25 09:29:41',NULL),
(11,11,'PDF File','attachments/file3.pdf','Active','2024-09-25 09:31:23',NULL),
(12,13,'Word Document','attachments/files1.docx','Active','2024-09-25 09:39:55',NULL),
(13,13,'TXT File','attachments/files2.txt','Active','2024-09-25 09:39:55',NULL),
(14,14,'PDF File','attachments/file3.pdf','Active','2024-09-25 09:42:34',NULL),
(15,14,'JPG Image','attachments/3.jpg','Active','2024-09-25 09:42:34',NULL),
(16,15,'TXT File Updated','attachments/files2.txt','Active','2024-09-25 10:39:36','2024-09-25 10:37:39');

UNLOCK TABLES;

/*Table structure for table `post_category` */

DROP TABLE IF EXISTS `post_category`;

CREATE TABLE `post_category` (
  `post_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`post_category_id`),
  KEY `post_id` (`post_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `post_category_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `post_category_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `post_category` */

LOCK TABLES `post_category` WRITE;

insert  into `post_category`(`post_category_id`,`post_id`,`category_id`,`created_at`,`updated_at`) values 
(1,1,1,'2024-09-24 22:33:13',NULL),
(2,1,2,'2024-09-24 22:33:13',NULL),
(3,1,9,'2024-09-24 22:33:13',NULL),
(4,2,6,'2024-09-24 22:43:23',NULL),
(5,2,9,'2024-09-24 22:43:23',NULL),
(6,3,2,'2024-09-24 22:49:12',NULL),
(7,3,9,'2024-09-24 22:49:12',NULL),
(8,4,9,'2024-09-24 22:58:59',NULL),
(9,4,10,'2024-09-24 22:58:59',NULL),
(10,5,2,'2024-09-24 23:08:05',NULL),
(11,5,4,'2024-09-24 23:08:05',NULL),
(12,6,2,'2024-09-24 23:15:58',NULL),
(13,6,4,'2024-09-24 23:15:58',NULL),
(14,6,10,'2024-09-24 23:15:58',NULL),
(15,7,2,'2024-09-24 23:19:37',NULL),
(16,7,4,'2024-09-24 23:19:37',NULL),
(17,7,5,'2024-09-24 23:19:37',NULL),
(20,9,7,'2024-09-25 09:24:31',NULL),
(21,9,10,'2024-09-25 09:24:31',NULL),
(22,10,1,'2024-09-25 09:29:40',NULL),
(23,10,2,'2024-09-25 09:29:41',NULL),
(24,10,3,'2024-09-25 09:29:41',NULL),
(27,12,1,'2024-09-25 09:33:29',NULL),
(28,12,8,'2024-09-25 09:33:29',NULL),
(32,14,3,'2024-09-25 09:42:34',NULL),
(33,14,7,'2024-09-25 09:42:34',NULL),
(39,13,2,'2024-09-25 10:01:29','2024-09-25 10:01:29'),
(40,13,3,'2024-09-25 10:01:29','2024-09-25 10:01:29'),
(41,13,8,'2024-09-25 10:01:29','2024-09-25 10:01:29'),
(55,15,2,'2024-09-25 10:52:01','2024-09-25 10:52:01'),
(56,15,3,'2024-09-25 10:52:01','2024-09-25 10:52:01'),
(57,15,7,'2024-09-25 10:52:01','2024-09-25 10:52:01'),
(58,16,1,'2024-09-25 10:52:21','2024-09-25 10:52:21'),
(59,16,3,'2024-09-25 10:52:21','2024-09-25 10:52:21'),
(62,11,1,'2024-09-25 10:53:03','2024-09-25 10:53:03'),
(63,11,2,'2024-09-25 10:53:03','2024-09-25 10:53:03'),
(66,8,4,'2024-09-25 10:55:31','2024-09-25 10:55:31'),
(67,8,10,'2024-09-25 10:55:31','2024-09-25 10:55:31');

UNLOCK TABLES;

/*Table structure for table `post_comment` */

DROP TABLE IF EXISTS `post_comment`;

CREATE TABLE `post_comment` (
  `post_comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `is_active` enum('Active','InActive') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`post_comment_id`),
  KEY `user_id` (`user_id`),
  KEY `post_id` (`post_id`),
  CONSTRAINT `post_comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `post_comment_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `post_comment` */

LOCK TABLES `post_comment` WRITE;

insert  into `post_comment`(`post_comment_id`,`post_id`,`user_id`,`comment`,`is_active`,`created_at`) values 
(1,2,18,'Testing 1','Active','2024-09-25 09:58:09'),
(2,11,18,'The 2024 budget is a critical juncture for Pakistan.','Active','2024-09-25 10:01:53'),
(3,11,4,'Pakistan should explore other avenues of international aid and investment.','Active','2024-09-25 10:02:36'),
(4,11,4,'The stakes are high, and the margin for error is slim.','Active','2024-09-25 10:02:54'),
(5,11,3,'Tax reforms are another critical area. ','Active','2024-09-25 10:03:28'),
(6,11,19,'The role of the International Monetary Fund (IMF) cannot be understated in Pakistan’s economic scenario.','Active','2024-09-25 10:03:56'),
(7,15,19,'The general assumption about inflation is that it always has an adverse effect.','Active','2024-09-25 10:05:32'),
(8,15,9,'if you borrowed Rs 1000 from a relative last year and inflation for the year is recorded at 6%, this inflation reduces the cost of your loan by 6%. ','Active','2024-09-25 10:06:05'),
(9,15,3,'Deflation is either caused by a decline in demand or an increase in supply.','Active','2024-09-25 10:06:58'),
(10,15,3,'he State Bank of Pakistan is tasked to monitor inflation','Active','2024-09-25 10:07:14'),
(11,15,1,' A consumer price index measures the change in the price of a basket of consumer goods over time.','Active','2024-09-25 10:07:45'),
(12,12,1,'Geopolitically, Raisi’s Iran had a distinctive approach to regional politics that often intersected.','Active','2024-09-25 10:08:47'),
(13,12,2,'Geopolitically, Raisi’s Iran had a distinctive approach to regional politics that often intersected.','Active','2024-09-25 10:09:05'),
(14,12,9,'Both Iran and Pakistan have significant stakes in Afghanistan’s stability, yet their methods and allies within the country differ.','Active','2024-09-25 10:09:36'),
(15,12,20,'Pakistan-Iran relations. Historically, Pakistan has maintained a delicate balance, nurturing close ties with Saudi Arabia while engaging with Iran.','Active','2024-09-25 10:10:03'),
(16,12,21,'Both countries face the threat of terrorism and share a border prone to security challenges. Joint efforts to manage border security and combat terrorism have been crucial,','Active','2024-09-25 10:10:32'),
(17,10,21,'when you think you&#039;ve finally made it, when you can taste that sweet, sweet job security, the rug gets yanked out from under your feet. ','Active','2024-09-25 10:12:16'),
(18,10,10,'It&#039;s like the government thinks we can survive on a steady diet of compliments and academic prestige alone.','Active','2024-09-25 10:12:04'),
(19,10,18,'It&#039;s an open secret now that HEC&#039;s journal ranking policy is a money-making machine for those under their patronage.','Active','2024-09-25 10:13:01'),
(20,10,4,'I can understand, and I get it: Budgets are tight, and there are always competing priorities.','Active','2024-09-25 10:13:41'),
(21,10,9,'This is counterproductive for any meaningful change, particularly in the field of social science.','Active','2024-09-25 10:14:15'),
(22,9,9,'Apparently, it&#039;s like the HEC took a page straight out of George Orwell&#039;s \"Animal Farm,\"','Active','2024-09-25 10:15:16'),
(23,9,20,'The only way to measure our worth is by reducing our life&#039;s work to a series of numbers and rankings.','Active','2024-09-25 10:15:46'),
(24,9,20,' But let&#039;s be real here: how are we supposed to reach our full potential when we&#039;re constantly fighting against a system','Active','2024-09-25 10:16:00'),
(25,9,19,'Suddenly, you&#039;re stuck in a Kafkaesque limbo, where your hard-earned achievements count for nothing.','Active','2024-09-25 10:16:33'),
(26,9,18,'you spend years, nay, decades, slaving away in the hallowed halls of academia','Active','2024-09-25 10:16:59'),
(27,8,18,'A healthy body has a healthy mind From the beginning.','Active','2024-09-25 10:19:06'),
(28,8,19,'I love running and used to believe that it was the only method that would help me get in good shape','Active','2024-09-25 10:19:30'),
(29,8,19,'But the side effect appeared when I didn’t run. I would put on more body fat in less time.','Active','2024-09-25 10:19:37'),
(30,8,4,'So, running and jogging did give me a boost in achieving a healthy body, but they’re not the only options.','Active','2024-09-25 10:19:58'),
(31,8,3,'I find myself overweight once again. This time, however, I’ve decided to shift my focus more towards weight training rather than cardio.','Active','2024-09-25 10:20:18'),
(32,7,3,'it was mainly the financially sound teams, who managed to make foreign tours. ','Active','2024-09-25 10:21:02'),
(33,7,21,'Asian football was also quite inconsistent and while healthy competitions ','Active','2024-09-25 10:21:27'),
(34,7,21,'Football made its way through the streets of Quetta, Karachi, ','Active','2024-09-25 10:21:43'),
(35,7,20,'Karachi had a unique flavour in its football, which grew in the slum areas of Orangi, Landhi, Korangi, Malir, and Lyari. ','Active','2024-09-25 10:22:12'),
(36,7,10,'This was the decade that saw many foreign teams often tour Pakistan for unofficial friendly matches ','Active','2024-09-25 10:22:36'),
(37,6,10,'Pakistan is set to host the 2025 ICC Champions Trophy ','Active','2024-09-25 10:23:39'),
(38,6,10,'since his election as the board’s chief, has been vocal about the state of international cricket venues in the country not being according to the required standard.','Active','2024-09-25 10:23:55'),
(39,6,21,'since his election as the board’s chief, has been vocal about the state of international cricket venues in the country not being according to the required standard.','Active','2024-09-25 10:24:17'),
(40,6,3,'This time the body allotted 35 acres of land and demanded a 30 per cent share of all revenue generated from the activities held at the venue after it’s built.','Active','2024-09-25 10:24:41'),
(41,6,4,'the former Test captain had said the PCB was looking forward to building a “high-tech” stadium in the federal capital.','Active','2024-09-25 10:25:18'),
(42,5,4,'The win gives Pakistan a full trophy cabinet, as the green shirts have now won the ODI World Cup, the T20 World Cup and the Champions Trophy. ','Active','2024-09-25 10:26:13'),
(43,5,3,'Pakistan lift the Champions Trophy after a nail-biting final match against India at the Oval in London.','Active','2024-09-25 10:26:39'),
(44,5,20,'What a match that was absolutely best match.. !','Active','2024-09-25 10:27:30'),
(45,5,9,'The final moments before Pakistan claimed the Champions Trophy title for 2017\r\n','Active','2024-09-25 10:28:00'),
(46,5,12,'Fakhar Zaman celebrates his century, going on to score 114 runs before being caught out on a Hardik Pandya ball.','Active','2024-09-25 10:28:35'),
(47,4,12,'Pakistan is on the frontline of the climate crisis','Active','2024-09-25 10:29:04'),
(48,4,10,'Climate injustice is starkly visible, with its people facing disproportionately severe consequences,','Active','2024-09-25 10:29:26'),
(49,4,10,'Tackling a climate crisis of this scale requires global attention and action. Wealthier countries must make no mistake about the important role they play,','Active','2024-09-25 10:29:35'),
(50,4,20,'Without further delay, wealthier countries must demonstrate a decisive commitment to reduce emissions,','Active','2024-09-25 10:29:59'),
(51,2,20,'Solar and wind energy are cleaner, cheaper, and much faster to install and operationalise. ','Active','2024-09-25 10:30:41');

UNLOCK TABLES;

/*Table structure for table `role` */

DROP TABLE IF EXISTS `role`;

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_type` varchar(50) NOT NULL,
  `is_active` enum('Active','InActive') DEFAULT 'Active',
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `role` */

LOCK TABLES `role` WRITE;

insert  into `role`(`role_id`,`role_type`,`is_active`) values 
(1,'admin','Active'),
(2,'user','Active');

UNLOCK TABLES;

/*Table structure for table `setting` */

DROP TABLE IF EXISTS `setting`;

CREATE TABLE `setting` (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `setting_key` varchar(100) DEFAULT NULL,
  `setting_value` varchar(100) DEFAULT NULL,
  `setting_status` enum('Active','InActive') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`setting_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `setting_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `setting` */

LOCK TABLES `setting` WRITE;

UNLOCK TABLES;

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` text NOT NULL,
  `gender` enum('Male','Female') DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `user_image` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `is_approved` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `is_active` enum('Active','InActive') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `user` */

LOCK TABLES `user` WRITE;

insert  into `user`(`user_id`,`role_id`,`first_name`,`last_name`,`email`,`password`,`gender`,`date_of_birth`,`user_image`,`address`,`is_approved`,`is_active`,`created_at`,`updated_at`) values 
(1,1,'Ahsan','Ali','ahsanali4u9@gmail.com','1212','Male','2000-08-15','Images/i.jpg','House No 2/75 Hyderabad, Sindh','Approved','Active','2024-09-24 20:05:44',NULL),
(2,1,'Saad','Ali','saad@gmail.com','1212','Male','2007-12-05','Images/g.jpg',' House No 2/75 Hyderabad, Sindh','Pending','InActive','2024-09-24 20:07:16',NULL),
(3,2,'Bilal','Ghori','bilal@gmail.com','1212','Male','1999-05-05','Images/h.jpg',' House No 5/55 Hyderabad Sindh.','Approved','Active','2024-09-24 21:03:20',NULL),
(4,2,'Khuzaima','Ansari','khuzaima@gmail.com','1212','Male','2003-08-08','Images/f.jpg',' House No 3/33 Karachi, Sindh','Approved','Active','2024-09-24 21:03:34',NULL),
(5,2,'Hoorain','Fatima','hoorain@gmail.com','1212','Female','2006-04-07','Images/j.jpg',' House No 3/33 Jamshoro, Sindh.','Approved','InActive','2024-09-24 21:22:23',NULL),
(6,2,'Fahad','Ahmed','fahad@gmail.com','1212','Male','2001-05-05','Images/f.jpg',' House No 2/22 Jamshoro, Sindh.','Pending','InActive','2024-09-24 20:13:36',NULL),
(7,2,'Safdar','Chohan','safdar@gmail.com','1212','Male','2002-09-09','Images/i.jpg','House No 4/44 Hyderabad, Sindh','Rejected','InActive','2024-09-24 20:54:38',NULL),
(8,2,'Hunain','Ahmed','hunain@gmail.com','1212','Male','1997-07-07','Images/h.jpg','House No 7/99 Lahore, Punjab','Pending','InActive','2024-09-24 20:16:34',NULL),
(9,2,'Adeel','Ahmed','adeel@gmail.com','1212','Male','1995-07-07','Images/f.jpg','House No 2/67 Hyderabad Sindh','Approved','Active','2024-09-24 21:05:41',NULL),
(10,2,'Ayesha','Fatima','ayesha@gmail.com','1212','Female','2003-07-07','Images/k.jpg','House No 3/33 Hyderabad, Sindh','Approved','Active','2024-09-24 21:05:30',NULL),
(11,2,'Nabeel','Ahmed','nabeel@gmail.com','1212','Male','2008-07-07','Images/h.jpg','House No 4/44 Karachi, Sindh','Rejected','InActive','2024-09-24 20:57:07',NULL),
(12,2,'Samia','Yousufzai','samia@gmail.com','1212','Female','2007-07-07','Images/l.jpg','House No 3/33 Latifabad, Hyderabad, Sindh','Approved','Active','2024-09-24 21:05:13',NULL),
(13,2,'Hadi','Shaikh','hadi@gmail.com','1212','Male','2006-07-07','Images/g.jpg','House No 3/66 Hyderabad, Sindh','Pending','InActive','2024-09-24 20:48:25',NULL),
(14,2,'Faraz','Ahmed','faraz@gmail.com','1212','Male','1998-08-08','Images/h.jpg','House No 3/55 Jamshoro, Sindh','Approved','Active','2024-09-24 21:05:04',NULL),
(15,2,'Areesha','Khan','areesha@gmail.com','1212','Male','2003-07-07','Images/l.jpg','House No 4/33 Hyderabad, Sindh','Approved','InActive','2024-09-24 21:22:08',NULL),
(16,2,'Haris','Khan','haris@gmail.com','1212','Male','1999-08-08','Images/i.jpg',' House No 5/88 Karachi, Sindh','Pending','InActive','2024-09-24 21:10:52',NULL),
(17,2,'Rafay','Shaikh','rafay@gmail.com','1212','Male','1999-08-08','Images/g.jpg',' House No 1/11 Jamshoro, Sindh','Rejected','InActive','2024-09-24 21:22:34',NULL),
(18,2,'Hasnain','Shaikh','hasnain@gmail.com','1212','Male','2001-04-04','Images/h.jpg',' House No 4/44 Hyderabad, Sindh','Approved','Active','2024-09-24 21:24:01',NULL),
(19,2,'Taimoor','Rajput','taimoor@gmail.com','1212','Male','1999-08-08','Images/g.jpg',' House No 4/44 Hyderabad Sindh','Approved','Active','2024-09-25 09:53:25',NULL),
(20,2,'Zain','Chippa','zain@gmail.com','1212','Male','1999-07-07','Images/f.jpg',' House No 4/44 Karachi, Pakistan ','Approved','Active','2024-09-25 09:52:43',NULL),
(21,2,'Qasim','Moosani','qasim@gmail.com','1212','Male','2000-05-05','Images/f.jpg',' House No 3/33 Deira Dubai, UAE','Approved','Active','2024-09-25 10:33:12','2024-09-25 10:33:12'),
(22,2,'Moiz','Khan','moiz@gmail.com','1212','Male','1998-06-06','Images/g.jpg',' House No 3/33 Latifabad Hyderabad','Pending','InActive','2024-09-25 10:34:02',NULL);

UNLOCK TABLES;

/*Table structure for table `user_feedback` */

DROP TABLE IF EXISTS `user_feedback`;

CREATE TABLE `user_feedback` (
  `feedback_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `feedback` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`feedback_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_feedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `user_feedback` */

LOCK TABLES `user_feedback` WRITE;

insert  into `user_feedback`(`feedback_id`,`user_id`,`user_name`,`user_email`,`feedback`,`created_at`) values 
(1,NULL,'Shahzaib Khan','shahzaib@gmail.com','Feedback Testing 1','2024-09-24 19:56:33'),
(2,1,'Ahsan Ali','ahsanali4u9@gmail.com','Feedback From Admin Panel... &#039;Checking&#039;','2024-09-24 21:06:43'),
(3,NULL,'Farooq Ahmed','farooq345@gmail.com','Feedback Testing','2024-09-24 21:51:28'),
(4,18,'Hasnain Shaikh','hasnain@gmail.com','Testing 2','2024-09-24 21:53:35'),
(5,21,'Qasim Moosani','qasim@gmail.com','Your opinion pieces spark meaningful discussions. Thought-provoking and informative!\r\n','2024-09-24 21:55:53'),
(6,NULL,'Abdullah Khan','abdullah345@gmail.com','Well-structured and easy to read! Your writing style is engaging and clear.\r\n','2024-09-24 21:57:12'),
(7,NULL,'Shahid Hussain','shahid@gmail.com','Good effort! Keep pushing boundaries.','2024-09-24 21:58:11'),
(8,9,'Adeel Ahmed','adeel@gmail.com','Impressive creativity! Fresh ideas abound.','2024-09-24 22:00:15'),
(9,12,'Samia Yousufzai','samia@gmail.com','Innovative thinking! Inspiring new perspectives.\r\n','2024-09-24 22:01:14'),
(10,2,'Saad Ali','saad@gmail.com','Impressive social media integration. Stay connected and informed across platforms.','2024-09-24 22:03:57');

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
