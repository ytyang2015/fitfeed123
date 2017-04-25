-- MySQL dump 10.15  Distrib 10.0.30-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: fitfeed123_FITFEED
-- ------------------------------------------------------
-- Server version	10.0.30-MariaDB

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
-- Table structure for table `Chatlog`
--

DROP TABLE IF EXISTS `Chatlog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Chatlog` (
  `sender` text NOT NULL,
  `receiver` text NOT NULL,
  `log` text NOT NULL,
  `timelog` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Chatlog`
--

LOCK TABLES `Chatlog` WRITE;
/*!40000 ALTER TABLE `Chatlog` DISABLE KEYS */;
/*!40000 ALTER TABLE `Chatlog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Product`
--

DROP TABLE IF EXISTS `Product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Product` (
  `user_name` text NOT NULL,
  `product_name` varchar(60) NOT NULL,
  `price` int(11) NOT NULL,
  `calories` int(11) NOT NULL,
  `sweet` int(11) NOT NULL DEFAULT '1',
  `image_name` varchar(10000) NOT NULL,
  `sour` int(11) NOT NULL DEFAULT '1',
  `spicy` int(11) NOT NULL DEFAULT '1',
  `salty` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Product`
--

LOCK TABLES `Product` WRITE;
/*!40000 ALTER TABLE `Product` DISABLE KEYS */;
INSERT INTO `Product` (`user_name`, `product_name`, `price`, `calories`, `sweet`, `image_name`, `sour`, `spicy`, `salty`) VALUES ('shabi','shit',1000,1000,0,'',1,1,1),('shabi','noodle',1000,1000,0,'',1,1,1),('restaurant1','',0,0,0,'',1,1,1),('yyt','',0,0,0,'',1,1,1),('yyt','',0,0,0,'',1,1,1),('restaurant1','',0,0,0,'',1,1,1),('restaurant1','',0,0,0,'',1,1,1),('restaurant1','',100,1000,0,'',1,1,1),('restaurant1','',100000,100,0,'',1,1,1),('restaurant1','',57,1000,0,'',1,1,1),('restaurant1','',123,123,0,'',1,1,1),('restaurant1','',0,0,0,'',1,1,1),('restaurant1','',0,0,0,'',1,1,1),('restaurant1','',0,0,0,'',1,1,1),('restaurant1','',0,0,0,'',1,1,1),('restaurant1','pasta',0,0,0,'',1,1,1),('restaurant1','',0,0,0,'',1,1,1),('restaurant1','bread',10,1000,0,'',1,1,1),('restaurant1','',0,0,0,'',1,1,1),('restaurant1','cake',20,2000,0,'',1,1,1),('restaurant1','cake',20,2000,0,'',1,1,1),('restaurant1','cake',20,2000,0,'',1,1,1),('1','Jintao',10,1000,0,'',1,1,1),('restaurant1','bread',10,1000,0,'',1,1,1),('restaurant1','bread',10,1000,0,'',1,1,1),('restaurant1','bread',10,1000,0,'',1,1,1),('restaurant1','potato salad',20,800,0,'',1,1,1),('restaurant1','411 salad',10,10,0,'',1,1,1),('restaurant2','hehe salad',1,1,0,'',1,1,1),('restaurant2','resturant2 salad',1,1,0,'',1,1,1),('restaurant2','',0,0,0,'',1,1,1),('restaurant2','testseen',1,1,0,'',1,1,1),('restaurant1','hehehehe pasta',1,1,0,'',1,1,1),('restaurant2','',0,0,0,'',1,1,1),('restaurant3','tamato salad',10,600,0,'',1,1,1),('restaurant3','tamato salad',10,600,0,'',1,1,1),('restaurant3','fried chicken',20,1000,0,'',1,1,1),('restaurant3','fried chicken',20,1000,0,'',1,1,1),('restaurant3','fried chicken',20,1000,0,'',1,1,1),('restaurant3','kentucky',5,799,0,'',1,1,1),('restaurant3','kentucky',5,799,0,'',1,1,1),('restaurant3','juice',4,200,0,'',1,1,1),('restaurant3','juice',4,200,0,'',1,1,1),('restaurant3','cake2',200,200,0,'',1,1,1),('restaurant3','cake2',200,200,0,'',1,1,1),('restaurant3','cake3',300,300,0,'',1,1,1),('restaurant3','cake3',300,300,0,'',1,1,1),('restaurant3','green tea cake',12,500,9,'',0,0,0),('restaurant3','green tea cake',12,500,9,'',0,0,0),('restaurant2','poop',1,1,1,'poop',1,1,1),('restaurant1','shit',1,1,1,'shit',1,1,1),('restaurant1','apple pie',20,400,9,'apple pie',7,0,2),('Miga','beef burger',18,650,3,'beef burger',3,3,5),('Miga','chicken pasta',30,1200,4,'chicken pasta',2,7,5),('feitianjitui3','pasta',1,1,1,'pasta',1,11,1),('feitianjitui3','Pork Belly',20,200,2,'Pork Belly',4,3,1),('restauranttest','bacon',20,300,0,'bacon',0,0,2),('restauranttest','Bacon Salad',10,400,0,'Bacon Salad',0,0,3);
/*!40000 ALTER TABLE `Product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article` (
  `article_url` text NOT NULL,
  `article_name` text NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article`
--

LOCK TABLES `article` WRITE;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
INSERT INTO `article` (`article_url`, `article_name`, `level`) VALUES ('http://www.nutritionist-resource.org.uk/articles/weight-gain.html','Weight gain\r\n',1),('http://www.medicinenet.com/script/main/art.asp?articlekey=52231','Healthy Ways to Gain Weight',1),('https://www.bodybuilding.com/content/how-to-gain-weight.html','How To Gain Weight',1),('http://well.wvu.edu/articles/help__i_m_gaining_weight','Help, I\'m Gaining Weight',1),('https://www.nhlbi.nih.gov/health/educational/lose_wt/','Maintain a Healthy Weight',2),('http://kidshealth.org/en/teens/weight-tips.html','5 Ways to Reach (and Maintain!) a Healthy Weight',2),('http://www.health.com/health/gallery/0,,20578117,00.html','Everyday Ways to Maintain Your Feel Great Weight',2),('http://www.webmd.com/diet/obesity/features/maintain-weight-loss#1','9 Secrets of Successful Weight Maintenance',2),('http://www.webmd.com/diet/features/is-fat-in-your-future#1','Is Fat in Your Future?',3),('http://therenegadepharmacist.com/lightly-cooking-foods-for-longevity/','Lightly Cooking Foods for Longevity',3),('https://www.pinterest.com/pin/58335757646935527/','Explore Lightly Slow, Cooks Lightly, and more!',3),('https://www.hsph.harvard.edu/obesity-prevention-source/obesity-causes/diet-and-weight/','Obesity Prevention Source -  Food and Eat',4),('https://www.ncbi.nlm.nih.gov/pmc/articles/PMC3222874/','Dietary Approaches to the Treatment of Obesity',4);
/*!40000 ALTER TABLE `article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chat_requests`
--

DROP TABLE IF EXISTS `chat_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chat_requests` (
  `initiator` text NOT NULL,
  `responder` text NOT NULL,
  `url` text NOT NULL,
  `status` text NOT NULL,
  `viewed` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat_requests`
--

LOCK TABLES `chat_requests` WRITE;
/*!40000 ALTER TABLE `chat_requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `chat_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `food`
--

DROP TABLE IF EXISTS `food`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `food` (
  `name` char(255) NOT NULL,
  `calories` double DEFAULT NULL,
  `fat` double DEFAULT NULL,
  `carbonhydrate` double DEFAULT NULL,
  `fibrin` double DEFAULT NULL,
  `protein` double DEFAULT NULL,
  `vitunmius` double DEFAULT NULL,
  `cheese` double NOT NULL,
  `pork` double NOT NULL,
  `oil` double NOT NULL,
  `salty` double NOT NULL,
  `beef` double NOT NULL,
  `sweet` double NOT NULL,
  `chicken` double NOT NULL,
  `sour` double NOT NULL,
  `fish` double NOT NULL,
  `hot` double NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `food`
--

LOCK TABLES `food` WRITE;
/*!40000 ALTER TABLE `food` DISABLE KEYS */;
INSERT INTO `food` (`name`, `calories`, `fat`, `carbonhydrate`, `fibrin`, `protein`, `vitunmius`, `cheese`, `pork`, `oil`, `salty`, `beef`, `sweet`, `chicken`, `sour`, `fish`, `hot`) VALUES ('Weight Watchers Barbacoa Beef',144,3,14,0,13,0,0,0,0,1,1,0,0,14,0,3.5),('waffle',120,6,13,1,3,0,0,0,1,0,0,3.75,0,0,0,0),('Turkey Burgers with Romaine and Carrot Slaw',376,19,25,2,27,0,0,0,0,1,1,0,0,0.25,0,1.25),('Trending Articles',200,14,0,0,18,0,0,0,1,0,0,0,0,0,0,0),('Tomato soup',98,1,23,2,2,0.44,0,0,1,0.5,0,0,1,1,0,0.5),('Tofu Tostadas',500,30,6,6,6,0.12,0,0,0,0,0,0,1,0,0,0),('Tangy Chicken Salad',246,12,11,0,26,0,0,0,0.25,0,0,2,0,0,2,0),('Summer Skillet Pasta',541,31,50,3,16,0.58,2,0,0,0.5,0,0,0,5,0,0.5),('Stuffed Chicken Divan',347,11,10,1,50,0,0.5,0,0,0.5,0,0,1,0,0,0.25),('Spinach Lasagna Rolls',225,5,32,3,13,0,0.5,0,0,0,0,1.5,0,22,0,1.25),('Spinach and Feta Pasta',230,7,35,0,9,0,4,0,2,0.5,0,0,0,4.25,0,1),('Spicy Rice and Bean Wraps',190,0,40,5,8,0.14,7,0,0,0,0,0,6,1.08,0,0),('Spicy Chicken Stew',403,5,56,4,35,0,0,0,2,0,0,2.5,0.25,3.6,8,0.92),('Spaghetti',50,0,24,2,4,0,0,0,0,0.5,1,2,0,14,0,1.5),('Southwestern Cobb Salad',540,33,28,8,39,0,0.75,0,0.5,0.5,0,0.5,3,2,0,0.63),('Southern Chicken and Corn Chowder',280,18,24,0,7,0.6,0,0,0,0,0,5,32,0,0,1),('Smoked Turkey Cobb Wraps',640,0,0,0,0,0,0.75,0,0,0.5,0,0,0,0,0,0.75),('Slow Cooker Turkey Breast',203,2,32,1,17,0.18,0,0,0,1,0,1,0,1,0,0.75),('Slow Cooker Skinny White Bean Chicken Chili',142,3,9,6,12,0,0,0,0,1,0,0,1,1,0,1),('Slow Cooker Skinny Buffalo Chicken Salad',305,12,24,8,26,0,0,0,0,0,0,0,1,4,0,1),('Slow Cooker Chicken Noodle Soup',149,2,14,2,11,0,0,2,1,0,0,0,1,1,0,0.25),('Slow Cooker Chicken and Broccoli',226,6,24,2,17,0,6,0,0,0.5,0,0,1,0,0,0.75),('Slow Cooker Busy Day Stew',220,8,25,6,15,0,0,0,0,0.75,0.75,0,0,0.25,0,1.75),('Slow Cooker Black Bean and Corn Salsa Chicken',334,0,0,0,0,0,0,0,0,0.25,0,0,0,1,0,1.5),('Slow Cooker Apricot Glazed Pork Loin',186,6,8,0,23,0,0,1,0,0.5,0,0.33,0,0,0,1),('Simple Southwest Salad',234,3,33,10,20,0,0,0,0,0,1,1.5,0,1,0,0.5),('Scrambled Egg',365,27,5,0,24,0.24,0,0,1,0.25,0,0,0,0,0,0.13),('Savory Yogurt Chicken Breasts',402,19,25,1,46,0.07,1,0,0,0.13,0,0,0.5,2,0,0.33),('Sausage and Potato Bake',320,15,31,5,11,0.53,1,0,1,0.25,0,2,1,2,0,2.25),('Roman-Style Chicken',266,13,8,2,28,1.9,0,0,0,0.5,0,2,0.5,1.33,0,1.75),('Roasted Sweet Corn and Tomato Soup',168,7,24,0,8,0,0,0,1,0,0,1,14,0,0,1.63),('Roast Chicken',147,4,0,0,26,0.02,0,0,0.25,1,0,1,4,2,0,1.25),('Ricotta Stuffed Shells',320,16,27,3,17,0.25,0,0,0,0.25,0,0.75,0,1,0,0.31),('Quick Italian Turkey Soup',120,5,0,0,8,0,0,0,0,0,0,0,2,0,0,0.25),('Pita Pizza',140,8,8,0,10,0.3,4,0,0,0,0,0,0.25,0,0,0),('Pineapple Teriyaki Grilled Chicken',130,0,6,0,14,0,0,0,1,0.75,0,0,1,2,0,0.75),('Pineapple Chicken Salad Pitas',471,16,49,7,37,0,0,0,1,0.13,0,1.25,2,0,0,1),('Pickle',7,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0),('Petite Lasagnas',124,5,8,1,11,0,1,0,0,0.25,0,0,0,0,0,0.13),('Penne with Balsamic Chicken and Roasted Asparagus',255,9,30,0,15,0,0,0,0,0.5,0,1.5,0.5,1.2,0,0.25),('Pasta',45,0,9,1,2,0,0,0,1,0,0,1,0,0,0,1.75),('Parmesan Sesame Chicken Strips',1090,35,159,6,40,0,0,0,0,0.75,2,0,1,0,0,1),('Pancake',55,1,10,0,1,0,0,0,0,0.5,0,1.33,0,0,0,0),('Minestrone Soup',56,1,11,2,2,0,0.33,0,2,74,0,0,6,73,0,0.75),('Mexican grill',180,7,0,1,32,0.02,0,0,0,0,0,0,1,18,0,3.42),('Melt In Your Mouth Broiled Salmon',531,40,4,1,36,0.33,0,0,0,0.13,0,2,0,0,0,0),('Mediterranean Flatbread Pizzas',570,25,74,4,13,0,0,0,0,0,0,0,0,0,0,0),('Mango Quinoa Salad',107,5,15,0,2,0,0,0,0,0,0,0,0,0,0,0),('Low Fat Tex Mex Chicken and Rice',280,10,28,2,20,6.38,0.5,0,1,0,0,0,2,1,0,3.25),('Lighter Sesame Chicken',367,12,36,1,31,0,0,0,0,0,0,0,0.5,0,0,0.06),('Light Taco Casserole',272,9,26,6,20,0,2,0,0,0,0,0.13,0,3.1,0,1.63),('Light Chicken Pot Pie',100,3,15,5,4,0.15,3,0,0,0.25,0,0,3,0,0,0.38),('Kimchi',10,0,1,0,0,0.2,0,0,1,0,0,2,1,0,0,0),('Ice cream',145,8,17,1,3,0.07,8,0,0,0,0,2,0,3,0,0),('Hot pot',290,12,25,0,21,0,0,0,0,1,8,0,0,0,0,0.5),('Honey Lime Grilled Chicken',286,9,7,0,34,0,0,0,0,0,0,1.58,4,2.07,0,2),('Honey Glazed Grilled Chicken',284,6,15,0,33,0,0,0,0,0,0,2.5,0,1.2,0,0.75),('Homemade Chicken Nuggets',48,3,3,0,3,0,0,0,0,0,0,0,1,0,0,0.06),('Heavenly Halibut',235,14,1,0,26,0,0,0,1,0,0,0,0,1,0,1.19),('Healthy Southwest Stuffed Peppers',143,0,0,0,0,0,1,0,2,0.13,0,0,0,0,0,4.5),('Healthy Egg Salad Sandwich',300,0,0,0,0,0,0.5,0,0,0,0,0,0,1,0,0),('Healthy Bean Burritos',373,9,41,7,27,0,1,0,1,0.5,0,0,0,0.75,0,0.13),('Healthy Asian Glazed Drumsticks',213,5,13,0,28,0,0,0,0,0,0,0.25,2,2,2,2),('Hawaiian Grilled Chicken',200,3,14,1,30,0.06,0,0,0,0.5,0,0,4,0,0,0.25),('Guiltless Chicken Alfredo',280,12,23,0,16,5.61,0.25,0,1,0.5,0,0,1,1,0,0.5),('Grilled Ratatouille Pasta Salad',622,17,108,13,12,0,0.25,0,0.25,0.5,0,2.75,0,1.2,0,2.5),('Grilled Malibu Chicken',400,25,11,0,22,0.05,0,0,0.33,2,0,0,3,0,0,0),('Grilled Island Chicken Kabobs',166,8,2,2,16,0.04,0,0,0,0,0,0,0,0,4,0),('Grilled Honey Mustard Chicken',260,9,27,1,16,0.04,0,0,0,0,0,0,12,0,0,0.5),('Grilled Cilantro Lime Shrimp Skewers',350,16,42,2,33,0,0,0,1,0,0,0,0,0,0,1.13),('Grilled Chicken Fajita Kabobs',250,8,9,2,33,1.14,3,0,0,14,0,0,2,17,0,4),('Grilled 7-Up Chicken',370,11,12,0,28,0,0,0,0,0,0,0,2,0,0,0),('Garlic Lime Marinated Pork Chops',224,6,2,1,38,0,4,4,1,0.25,0,9,0,0,0,0.5),('Frozen yogurt',221,6,38,4,5,0.05,0,0,0,0,0,0,0,0,0,0),('Fried Chicken',200,6,21,0,17,0.14,0,0,0,0,0,1.5,2,0,0,0),('French toast',151,4,22,2,8,0.06,1,0,1,0,0,0.48,0,0.12,0,0),('Fish Taco',335,21,16,1,16,0,0,0,0,0,0,0,0,0.25,0,0),('Feta Avocado Chicken Salad',320,6,9,0,12,0,0.25,0,0,0,0,0,2,4,0,0.31),('Egg Whites and Broccoli Rice Cups',56,2,4,1,6,0.38,0,0,0,0,0,0,0,0,0,0),('Double cooked pork',209,0,0,0,0,0,0.25,6,1,0.13,0,0,0,0,0,0.5),('Crunchy Black Bean Tacos',400,20,41,7,14,0.07,0.25,0,1,0,0,0,0,1,0,0.25),('Crunchy Baked Chicken',457,23,10,0,48,0,0,0,3,1,0,2.19,1,0,0,1.06),('Crock Pot Santa Fe Chicken',190,2,23,6,21,0,0,0,0,0,0,0,1,0.75,0,0.06),('Crock Pot Beef Stew',499,11,46,7,56,0,0,0,3,0,14,0,0,1,0,0.75),('Crock Pot Asian Pork with Mushrooms',224,9,11,0,25,0,0,0,1,0,16,2,0,0,0,1.25),('Crispy Honey Mustard Chicken',330,15,34,1,14,0.02,0,0,0,0.13,0,0.75,1,0,0,1.13),('Creamy Chicken Broccoli Casserole',277,12,15,3,29,0,0.5,0,0,0,0,0,2,0,0,0.13),('Chocolate',534,30,59,3,8,0,0,0,0,0,0,12.25,0,0,0,0),('Chicken Tortilla Soup',200,15,20,3,14,0,0,0,5,0,0,0,2,22,0,4.13),('Chicken Taco',769,41,59,6,41,0.79,0,0,0,0,0,0,0,1,0,0.13),('Chicken Pot Pie Soup',210,9,20,2,13,0,0,0,0,0.5,0,0,2,0,0,0.21),('Chicken Noodle Casserole',200,8,30,1,21,0.17,0,0,1,0.5,0,0,2,8,0,2.75),('Chicken Cacciatore',312,16,7,0,35,0,0,0,2,1,0,0,1,9,0,3.5),('Chicken and Hummus Pitas',750,32,71,9,45,0,7,0,0,0,0,0,6,1.08,0,0),('Chicken and Broccolini Stir Fry',351,13,26,6,34,0,0,0,2,0,1,3,0,0,0,2.75),('Chicken and Biscuit Pot Pie',462,14,52,4,32,0.31,0.25,0,0,0,0,0.75,0.5,0,0,0.25),('Chicken and Bacon Autumn Chopped Salad',493,37,43,0,8,0,0,0,0.5,0,0,2,4,2,0,2.13),('Caribbean Salad with Sweet Orange Vinaigrette',281,10,18,4,30,0,0,0,2,0.13,0,1.75,0,0.6,0,0.38),('Cake',400,18,35,0,0,0,0,0,0.5,0.25,0,1,0,0,0,0),('Cajun Chicken Pasta',1270,60,111,6,72,0,0,0,2,0,0,0,0.75,2,0,1.75),('Buritto',200,8,35,4,9,0.18,0,0,0,0,0,0,1,0,0,0.06),('Buffalo Turkey Burgers',467,17,42,0,35,0,0,0,1,0.5,0,0,1,0,0,0.31),('Braised Balsamic Chicken',196,7,8,1,24,0.23,0,0,1,0,0,0,4,0,0,0.25),('Boiled fish',189,2,0,0,41,0.05,0,0,0,2,0,0,0,0,0,0),('Black Bean Taco Soup',140,5,19,6,6,6,0,0,0,6.5,0,0,0,0,0,1.25),('Black Bean and Sweet Potato Tostadas',580,25,79,20,19,0,0,0,0,0,0,1.75,0,1,0,3),('Bibimbap',563,15,89,0,18,0,0,0,0,0,0,0,1,0,0,0.06),('Bean and Veggie Enchilada Lasagna',399,7,67,12,16,1.23,0,0,0,0,0.5,0,0,18,0,4.13),('Balsamic Grilled Pork Chops',196,5,8,1,26,0,0,4,1,0.25,0,0,0,0,0,0.5),('Baked Turkey',192,6,0,0,32,0,1,0,0,0.5,0,0,0,0,0,0.25),('Baked Crispy Coconut Chicken with Sweet Apricot Sauce',523,10,52,3,50,0.97,0,0,2,0.5,0,2,0,0,0,0),('Baked Chicken Parmesan',251,10,14,2,32,0,0.75,0,0,0.13,0,0,0.25,0,0,0.13),('Baked Chicken Fajitas',348,12,38,3,22,0,0,0,1,0.5,0,1,4,0.5,0,1.25),('Baked Chicken Chimichangas with Green Sauce',303,12,28,0,25,0,0,1,0,0,1,0,1,0,0,4),('Baked Chicken',300,19,1,0,30,0.12,0.25,0,0,0,0,0,4,1,0,0),('Bacon',80,7,0,0,5,0,3,0,1,0,0,0,0,0,0,0),('Asian Turkey Meatballs',140,7,6,1,14,0,0,0,1,0,0,1,1,0,0,1.5),('Asian Peanut Noodles with Chicken',338,5,51,4,21,0,0,0,1,0,0,0,0,0,0,0),('Asian Chicken Lettuce Wraps',100,2,7,1,10,1.36,0,0,1,0,0,0.5,6,0,0,1.75),('Asian Chicken Burgers',205,9,9,2,19,0,0,8,0,0,1,0,0,0,0,3),('Applebee Knock-Off Oriental Chicken Salad',1290,85,84,10,51,0,0,0,1,0,0,1.5,1,0,0,1.5),('Apple Pie',230,8,37,2,2,0.16,0,0,0,0,0,1,0,0,0,0),('Apple',80,0,21,4,0,0.1,0,0,0,0,0,0,0,0,0,0),('name',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),('Weight Watchers Salsa Roll-Ups',277,9,27,0,23,0,2,0,0,0,0,0,4,0,0,0),('yoghurt',49,2,5,0,0,0,0,0,0,0,0,0,1,0,0,0.06);
/*!40000 ALTER TABLE `food` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `restaurant`
--

DROP TABLE IF EXISTS `restaurant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `restaurant` (
  `name` char(255) NOT NULL,
  `category` char(255) NOT NULL,
  `address` char(255) NOT NULL,
  `phone` char(255) NOT NULL,
  `price` double NOT NULL,
  `review` int(11) NOT NULL,
  `food` char(225) NOT NULL,
  PRIMARY KEY (`food`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `restaurant`
--

LOCK TABLES `restaurant` WRITE;
/*!40000 ALTER TABLE `restaurant` DISABLE KEYS */;
INSERT INTO `restaurant` (`name`, `category`, `address`, `phone`, `price`, `review`, `food`) VALUES ('Original Pancake House','Breakfast & Brunch','1909 W Springfield Ave Champaign, IL','(217) 352-8866',20,108,'Weight Watchers Barbacoa Beef'),('Original Pancake House','Breakfast & Brunch','1909 W Springfield Ave Champaign, IL','(217) 352-8866',20,108,'waffle'),('Original Pancake House','Breakfast & Brunch','1909 W Springfield Ave\nChampaign, IL','(217) 352-8866',20,108,'Turkey Burgers with Romaine and Carrot Slaw'),('Original Pancake House','Breakfast & Brunch','1909 W Springfield Ave Champaign, IL','(217) 352-8866',20,108,'Trending Articles'),('Original Pancake House','Breakfast & Brunch','1909 W Springfield Ave Champaign, IL','(217) 352-8866',20,108,'Tomato soup'),('Original Pancake House','Breakfast & Brunch','1909 W Springfield Ave Champaign, IL','(217) 352-8866',20,108,'Tofu Tostadas'),('Original Pancake House','Breakfast & Brunch','1909 W Springfield Ave\nChampaign, IL','(217) 352-8866',20,108,'Tangy Chicken Salad'),('Original Pancake House','Breakfast & Brunch','1909 W Springfield Ave Champaign, IL','(217) 352-8866',20,108,'Summer Skillet Pasta'),(' Caribbean Grill Food Truck','Caribbean, Food Trucks','Champaign, IL','(217) 960-5375',10,50,'Stuffed Chicken Divan'),(' Caribbean Grill Food Truck','Caribbean, Food Trucks','Champaign, IL','(217) 960-5375',10,50,'Spinach Lasagna Rolls'),(' Caribbean Grill Food Truck','Caribbean, Food Trucks','Champaign, IL','(217) 960-5375',10,50,'Spinach and Feta Pasta'),(' Caribbean Grill Food Truck','Caribbean, Food Trucks','Champaign, IL','(217) 960-5375',10,50,'Spicy Rice and Bean Wraps'),(' Caribbean Grill Food Truck','Caribbean, Food Trucks','Champaign, IL','(217) 960-5375',10,50,'Spicy Chicken Stew'),(' Caribbean Grill Food Truck','Caribbean, Food Trucks','Champaign, IL','(217) 960-5375',10,50,'Spaghetti'),(' Caribbean Grill Food Truck','Caribbean, Food Trucks','Champaign, IL','(217) 960-5375',10,50,'Southwestern Cobb Salad'),(' Caribbean Grill Food Truck','Caribbean, Food Trucks','Champaign, IL','(217) 960-5375',10,50,'Southern Chicken and Corn Chowder'),(' Caribbean Grill Food Truck','Caribbean, Food Trucks','Champaign, IL','(217) 960-5375',10,50,'Smoked Turkey Cobb Wraps'),(' Caribbean Grill Food Truck','Caribbean, Food Trucks','Champaign, IL','(217) 960-5375',10,50,'Slow Cooker Turkey Breast'),(' Caribbean Grill Food Truck','Caribbean, Food Trucks','Champaign, IL','(217) 960-5375',10,50,'Slow Cooker Skinny White Bean Chicken Chili'),(' Caribbean Grill Food Truck','Caribbean, Food Trucks','Champaign, IL','(217) 960-5375',10,50,'Slow Cooker Skinny Buffalo Chicken Salad'),(' Caribbean Grill Food Truck','Caribbean, Food Trucks','Champaign, IL','(217) 960-5375',10,50,'Slow Cooker Chicken Noodle Soup'),(' Caribbean Grill Food Truck','Caribbean, Food Trucks','Champaign, IL','(217) 960-5375',10,50,'Slow Cooker Chicken and Broccoli'),('Miga',' American (New), Asian Fusion, Desserts','301 N Neil St Ste Champaign, IL','(217) 398-1020',40,32,'Slow Cooker Busy Day Stew'),('Miga',' American (New), Asian Fusion, Desserts','301 N Neil St Ste Champaign, IL','(217) 398-1020',40,32,'Slow Cooker Black Bean and Corn Salsa Chicken'),('Miga',' American (New), Asian Fusion, Desserts','301 N Neil St Ste Champaign, IL','(217) 398-1020',40,32,'Slow Cooker Apricot Glazed Pork Loin'),('Miga',' American (New), Asian Fusion, Desserts','301 N Neil St Ste Champaign, IL','(217) 398-1020',40,32,'Simple Southwest Salad'),('Miga',' American (New), Asian Fusion, Desserts','301 N Neil St Ste Champaign, IL','(217) 398-1020',40,32,'Scrambled Egg'),('Miga',' American (New), Asian Fusion, Desserts','301 N Neil St Ste Champaign, IL','(217) 398-1020',40,32,'Savory Yogurt Chicken Breasts'),('Miga',' American (New), Asian Fusion, Desserts','301 N Neil St Ste Champaign, IL','(217) 398-1020',40,32,'Sausage and Potato Bake'),('Miga',' American (New), Asian Fusion, Desserts','301 N Neil St Ste Champaign, IL','(217) 398-1020',40,32,'Roman-Style Chicken'),('Miga',' American (New), Asian Fusion, Desserts','301 N Neil St Ste Champaign, IL','(217) 398-1020',40,32,'Roasted Sweet Corn and Tomato Soup'),('Miga',' American (New), Asian Fusion, Desserts','301 N Neil St Ste Champaign, IL','(217) 398-1020',40,32,'Roast Chicken'),('Miga',' American (New), Asian Fusion, Desserts','301 N Neil St Ste Champaign, IL','(217) 398-1020',40,32,'Ricotta Stuffed Shells'),('Miga',' American (New), Asian Fusion, Desserts','301 N Neil St Ste Champaign, IL','(217) 398-1020',40,32,'Quick Italian Turkey Soup'),('Watson’s Shack & Rail','Bars, American (Traditional)','211 N Neil St Champaign, IL','(217) 607-0168',20,107,'Pita Pizza'),('Watson’s Shack & Rail','Bars, American (Traditional)','211 N Neil St Champaign, IL','(217) 607-0168',20,107,'Pineapple Teriyaki Grilled Chicken'),('Watson’s Shack & Rail','Bars, American (Traditional)','211 N Neil St Champaign, IL','(217) 607-0168',20,107,'Pineapple Chicken Salad Pitas'),('Watson’s Shack & Rail','Bars, American (Traditional)','211 N Neil St Champaign, IL','(217) 607-0168',20,107,'Pickle'),('Watson’s Shack & Rail','Bars, American (Traditional)','211 N Neil St Champaign, IL','(217) 607-0168',20,107,'Petite Lasagnas'),('Watson’s Shack & Rail','Bars, American (Traditional)','211 N Neil St Champaign, IL','(217) 607-0168',20,107,'Penne with Balsamic Chicken and Roasted Asparagus'),('Watson’s Shack & Rail','Bars, American (Traditional)','211 N Neil St Champaign, IL','(217) 607-0168',20,107,'Pasta'),('Watson’s Shack & Rail','Bars, American (Traditional)','211 N Neil St Champaign, IL','(217) 607-0168',20,107,'Parmesan Sesame Chicken Strips'),('Watson’s Shack & Rail','Bars, American (Traditional)','211 N Neil St Champaign, IL','(217) 607-0168',20,107,'Pancake'),('Watson’s Shack & Rail','Bars, American (Traditional)','211 N Neil St Champaign, IL','(217) 607-0168',20,107,'Minestrone Soup'),('Watson’s Shack & Rail','Bars, American (Traditional)','211 N Neil St Champaign, IL','(217) 607-0168',20,107,'Mexican grill'),('Watson’s Shack & Rail','Bars, American (Traditional)','211 N Neil St Champaign, IL','(217) 607-0168',20,107,'Melt In Your Mouth Broiled Salmon'),('Cracked the Egg Came First','Coffee & Tea','619 E Green St Champaign, IL','(217) 372-6866',10,88,'Mediterranean Flatbread Pizzas'),('Cracked the Egg Came First','Coffee & Tea','619 E Green St Champaign, IL','(217) 372-6866',10,88,'Mango Quinoa Salad'),('Cracked the Egg Came First','Coffee & Tea','619 E Green St Champaign, IL','(217) 372-6866',10,88,'Low Fat Tex Mex Chicken and Rice'),('Cracked the Egg Came First','Coffee & Tea','619 E Green St Champaign, IL','(217) 372-6866',10,88,'Lighter Sesame Chicken'),('Cracked the Egg Came First','Coffee & Tea','619 E Green St Champaign, IL','(217) 372-6866',10,88,'Light Taco Casserole'),('Cracked the Egg Came First','Coffee & Tea','619 E Green St Champaign, IL','(217) 372-6866',10,88,'Light Chicken Pot Pie'),('Cracked the Egg Came First','Coffee & Tea','619 E Green St Champaign, IL','(217) 372-6866',10,88,'Kimchi'),('Cracked the Egg Came First','Coffee & Tea','619 E Green St Champaign, IL','(217) 372-6866',10,88,'Ice cream'),('Cracked the Egg Came First','Coffee & Tea','619 E Green St Champaign, IL','(217) 372-6866',10,88,'Hot pot'),('Cracked the Egg Came First','Coffee & Tea','619 E Green St Champaign, IL','(217) 372-6866',10,88,'Honey Lime Grilled Chicken'),('Cracked the Egg Came First','Coffee & Tea','619 E Green St Champaign, IL','(217) 372-6866',10,88,'Honey Glazed Grilled Chicken'),('Cracked the Egg Came First','Coffee & Tea','619 E Green St Champaign, IL','(217) 372-6866',10,88,'Homemade Chicken Nuggets'),('Cracked the Egg Came First','Coffee & Tea','619 E Green St Champaign, IL','(217) 372-6866',10,88,'Heavenly Halibut'),('Esquire Lounge','Pizza, Pool Halls','106 N Walnut St Champaign, IL','(217) 398-5858',10,321,'Healthy Southwest Stuffed Peppers'),('Esquire Lounge','Pizza, Pool Halls','106 N Walnut St Champaign, IL','(217) 398-5858',10,321,'Healthy Egg Salad Sandwich'),('Esquire Lounge','Pizza, Pool Halls','106 N Walnut St Champaign, IL','(217) 398-5858',10,321,'Healthy Bean Burritos'),('Esquire Lounge','Pizza, Pool Halls','106 N Walnut St Champaign, IL','(217) 398-5858',10,321,'Healthy Asian Glazed Drumstick'),('Esquire Lounge','Pizza, Pool Halls','106 N Walnut St Champaign, IL','(217) 398-5858',10,321,'Hawaiian Grilled Chicken'),('Esquire Lounge','Pizza, Pool Halls','106 N Walnut St Champaign, IL','(217) 398-5858',10,321,'Guiltless Chicken Alfredo'),('Esquire Lounge','Pizza, Pool Halls','106 N Walnut St Champaign, IL','(217) 398-5858',10,321,'Grilled Ratatouille Pasta Salad'),('Esquire Lounge','Pizza, Pool Halls','106 N Walnut St Champaign, IL','(217) 398-5858',10,321,'Grilled Malibu Chicken'),('Esquire Lounge','Pizza, Pool Halls','106 N Walnut St Champaign, IL','(217) 398-5858',10,321,'Grilled Island Chicken Kabobs'),('Esquire Lounge','Pizza, Pool Halls','106 N Walnut St Champaign, IL','(217) 398-5858',10,321,'Grilled Honey Mustard Chicken'),('Esquire Lounge','Pizza, Pool Halls','106 N Walnut St Champaign, IL','(217) 398-5858',10,321,'Grilled Cilantro Lime Shrimp Skewers'),('Esquire Lounge','Pizza, Pool Halls','106 N Walnut St Champaign, IL','(217) 398-5858',10,321,'Grilled Chicken Fajita Kabobs'),('Esquire Lounge','Pizza, Pool Halls','106 N Walnut St Champaign, IL','(217) 398-5858',10,321,'Grilled 7-Up Chicken'),('Esquire Lounge','Pizza, Pool Halls','106 N Walnut St Champaign, IL','(217) 398-5858',10,321,'Garlic Lime Marinated Pork Chops'),('Esquire Lounge','Pizza, Pool Halls','106 N Walnut St Champaign, IL','(217) 398-5858',10,321,'Frozen yogurt'),('Esquire Lounge','Pizza, Pool Halls','106 N Walnut St Champaign, IL','(217) 398-5858',10,321,'Fried Chicken'),('Cheese and Crackers',' Chocolatiers & Shops, Delis, Seafood Markets','1715 W Kirby\nChampaign, IL','(217) 615-8531',20,52,'French toast'),('Cheese and Crackers',' Chocolatiers & Shops, Delis, Seafood Markets','1715 W Kirby\nChampaign, IL','(217) 615-8531',20,52,'Fish Taco'),('Cheese and Crackers',' Chocolatiers & Shops, Delis, Seafood Markets','1715 W Kirby\nChampaign, IL','(217) 615-8531',20,52,'Feta Avocado Chicken Salad'),('Cheese and Crackers',' Chocolatiers & Shops, Delis, Seafood Markets','1715 W Kirby\nChampaign, IL','(217) 615-8531',20,52,'Egg Whites and Broccoli Rice Cups'),('Cheese and Crackers',' Chocolatiers & Shops, Delis, Seafood Markets','1715 W Kirby\nChampaign, IL','(217) 615-8531',20,52,'Double cooked pork'),('Cheese and Crackers',' Chocolatiers & Shops, Delis, Seafood Markets','1715 W Kirby\nChampaign, IL','(217) 615-8531',20,52,'Crunchy Black Bean Tacos'),('Cheese and Crackers',' Chocolatiers & Shops, Delis, Seafood Markets','1715 W Kirby\nChampaign, IL','(217) 615-8531',20,52,'Crunchy Baked Chicken'),('Cheese and Crackers',' Chocolatiers & Shops, Delis, Seafood Markets','1715 W Kirby\nChampaign, IL','(217) 615-8531',20,52,'Crock Pot Santa Fe Chicken'),('Cheese and Crackers',' Chocolatiers & Shops, Delis, Seafood Markets','1715 W Kirby\nChampaign, IL','(217) 615-8531',20,52,'Crock Pot Beef Stew'),('Cheese and Crackers',' Chocolatiers & Shops, Delis, Seafood Markets','1715 W Kirby\nChampaign, IL','(217) 615-8531',20,52,'Crock Pot Asian Pork with Mushrooms'),('Cheese and Crackers',' Chocolatiers & Shops, Delis, Seafood Markets','1715 W Kirby\nChampaign, IL','(217) 615-8531',20,52,'Crispy Honey Mustard Chicken'),('Cheese and Crackers',' Chocolatiers & Shops, Delis, Seafood Markets','1715 W Kirby\nChampaign, IL','(217) 615-8531',20,52,'Creamy Chicken Broccoli Casserole'),('Black Dog Smoke & Ale House','Barbeque, Bars','320 N Chestnut St Champaign, IL','(217) 344-9334',20,77,'Chocolate'),('Black Dog Smoke & Ale House','Barbeque, Bars','320 N Chestnut St Champaign, IL','(217) 344-9334',20,77,'Chicken Tortilla Soup'),('Black Dog Smoke & Ale House','Barbeque, Bars','320 N Chestnut St Champaign, IL','(217) 344-9334',20,77,'Chicken Taco'),('Black Dog Smoke & Ale House','Barbeque, Bars','320 N Chestnut St Champaign, IL','(217) 344-9334',20,77,'Chicken Pot Pie Soup'),('Black Dog Smoke & Ale House','Barbeque, Bars','320 N Chestnut St Champaign, IL','(217) 344-9334',20,77,'Chicken Noodle Casserole'),('Black Dog Smoke & Ale House','Barbeque, Bars','320 N Chestnut St Champaign, IL','(217) 344-9334',20,77,'Chicken Cacciatore'),('Black Dog Smoke & Ale House','Barbeque, Bars','320 N Chestnut St Champaign, IL','(217) 344-9334',20,77,'Chicken and Hummus Pitas'),('Black Dog Smoke & Ale House','Barbeque, Bars','320 N Chestnut St Champaign, IL','(217) 344-9334',20,77,'Chicken and Broccolini Stir Fry'),('Black Dog Smoke & Ale House','Barbeque, Bars','320 N Chestnut St Champaign, IL','(217) 344-9334',20,77,'Chicken and Biscuit Pot Pie'),('Black Dog Smoke & Ale House','Barbeque, Bars','320 N Chestnut St Champaign, IL','(217) 344-9334',20,77,'Chicken and Bacon Autumn Chopped Salad'),('Black Dog Smoke & Ale House','Barbeque, Bars','320 N Chestnut St Champaign, IL','(217) 344-9334',20,77,'Caribbean Salad with Sweet Orange Vinaigrette'),('Black Dog Smoke & Ale House','Barbeque, Bars','320 N Chestnut St Champaign, IL','(217) 344-9334',20,77,'Cake'),('Black Dog Smoke & Ale House','Barbeque, Bars','320 N Chestnut St Champaign, IL','(217) 344-9334',20,77,'Cajun Chicken Pasta'),('Dos Reales','Mexican','1407 N Prospect Ave Champaign, IL','(217) 351-6879',10,211,'Buritto'),('Dos Reales','Mexican','1407 N Prospect Ave Champaign, IL','(217) 351-6879',10,211,'Buffalo Turkey Burgers'),('Dos Reales','Mexican','1407 N Prospect Ave Champaign, IL','(217) 351-6879',10,211,'Braised Balsamic Chicken'),('Dos Reales','Mexican','1407 N Prospect Ave Champaign, IL','(217) 351-6879',10,211,'Boiled fish'),('Dos Reales','Mexican','1407 N Prospect Ave Champaign, IL','(217) 351-6879',10,211,'Black Bean Taco Soup'),('Dos Reales','Mexican','1407 N Prospect Ave Champaign, IL','(217) 351-6879',10,211,'Black Bean and Sweet Potato Tostadas'),('Dos Reales','Mexican','1407 N Prospect Ave Champaign, IL','(217) 351-6879',10,211,'Bibimbap'),('Dos Reales','Mexican','1407 N Prospect Ave Champaign, IL','(217) 351-6879',10,211,'Bean and Veggie Enchilada Lasagna'),('Dos Reales','Mexican','1407 N Prospect Ave Champaign, IL','(217) 351-6879',10,211,'Balsamic Grilled Pork Chops'),('Dos Reales','Mexican','1407 N Prospect Ave Champaign, IL','(217) 351-6879',10,211,'Baked Turkey'),('Dos Reales','Mexican','1407 N Prospect Ave Champaign, IL','(217) 351-6879',10,211,'Baked Crispy Coconut Chicken with Sweet Apricot Sauce'),('Dos Reales','Mexican','1407 N Prospect Ave Champaign, IL','(217) 351-6879',10,211,'Baked Chicken Parmesan'),('Peking Garden Restaurant','Chinese','206 N Randolph St Champaign, IL','(217) 355-8888',20,123,'Baked Chicken Fajitas'),('Peking Garden Restaurant','Chinese','206 N Randolph St Champaign, IL','(217) 355-8888',20,123,'Baked Chicken Chimichangas with Green Sauce'),('Peking Garden Restaurant','Chinese','206 N Randolph St Champaign, IL','(217) 355-8888',20,123,'Baked Chicken'),('Peking Garden Restaurant','Chinese','206 N Randolph St Champaign, IL','(217) 355-8888',20,123,'Bacon'),('Peking Garden Restaurant','Chinese','206 N Randolph St Champaign, IL','(217) 355-8888',20,123,'Asian Turkey Meatballs'),('Peking Garden Restaurant','Chinese','206 N Randolph St Champaign, IL','(217) 355-8888',20,123,'Asian Peanut Noodles with Chicken'),('Peking Garden Restaurant','Chinese','206 N Randolph St Champaign, IL','(217) 355-8888',20,123,'Asian Chicken Lettuce Wraps'),('Peking Garden Restaurant','Chinese','206 N Randolph St Champaign, IL','(217) 355-8888',20,123,'Asian Chicken Burgers'),('Peking Garden Restaurant','Chinese','206 N Randolph St Champaign, IL','(217) 355-8888',20,123,'Applebee Knock-Off Oriental Chicken Salad'),('Peking Garden Restaurant','Chinese','206 N Randolph St Champaign, IL','(217) 355-8888',20,123,'Apple Pie'),('Peking Garden Restaurant','Chinese','206 N Randolph St Champaign, IL','(217) 355-8888',20,123,'Apple'),('Peking Garden Restaurant','Chinese','206 N Randolph St Champaign, IL','(217) 355-8888',20,123,'name'),('Peking Garden Restaurant','Chinese','206 N Randolph St Champaign, IL','(217) 355-8888',20,123,'Weight Watchers Salsa Roll-Ups'),('Peking Garden Restaurant','Chinese','206 N Randolph St Champaign, IL','(217) 355-8888',20,123,'yoghurt');
/*!40000 ALTER TABLE `restaurant` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `s_chat_messages`
--

DROP TABLE IF EXISTS `s_chat_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `s_chat_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `when` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `s_chat_messages`
--

LOCK TABLES `s_chat_messages` WRITE;
/*!40000 ALTER TABLE `s_chat_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `s_chat_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `theorder`
--

DROP TABLE IF EXISTS `theorder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `theorder` (
  `buyer` varchar(255) NOT NULL,
  `seller` varchar(255) NOT NULL,
  `item` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `seen` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `theorder`
--

LOCK TABLES `theorder` WRITE;
/*!40000 ALTER TABLE `theorder` DISABLE KEYS */;
INSERT INTO `theorder` (`buyer`, `seller`, `item`, `status`, `seen`) VALUES ('shit','shit','shit','incomplete',''),('shit','shit','shit','incomplete',''),('shit','shit','shit','incomplete',''),('','','','incomplete',''),('','','','incomplete',''),('','','','incomplete',''),('','','','incomplete',''),('shabi','shabi','shit','incomplete',''),('shabi','shabi','shit','incomplete',''),('shabi','shabi','shit','incomplete',''),('restaurant1','restaurant1','potato salad','complete',''),('restaurant1','restaurant1','411 salad','complete','seen'),('restaurant1','restaurant1','potato salad','complete',''),('restaurant2','restaurant2','hehe salad','incomplete','seen'),('restaurant2','restaurant2','resturant2 salad','incomplete','seen'),('restaurant2','restaurant2','testseen','incomplete','seen'),('restaurant1','restaurant1','potato salad','complete','unseen'),('restaurant1','restaurant1','potato salad','complete','unseen'),('restaurant1','restaurant1','potato salad','complete','unseen'),('restaurant1','restaurant1','potato salad','complete','unseen'),('restaurant1','restaurant1','potato salad','complete','unseen'),('restaurant1','restaurant1','potato salad','complete','unseen'),('restaurant1','restaurant1','potato salad','complete','unseen'),('restaurant1','restaurant1','potato salad','complete','unseen'),('restaurant1','restaurant1','potato salad','complete','unseen'),('restaurant1','restaurant1','potato salad','complete','unseen'),('restaurant1','restaurant1','potato salad','complete','unseen'),('restaurant1','restaurant1','potato salad','complete','unseen'),('restaurant1','restaurant1','potato salad','complete','unseen'),('restaurant1','restaurant1','potato salad','complete','unseen'),('restaurant1','restaurant1','potato salad','complete','unseen'),('restaurant1','restaurant1','potato salad','complete','unseen'),('restaurant1','restaurant1','potato salad','complete','unseen'),('restaurant1','restaurant1','potato salad','complete','unseen'),('restaurant1','restaurant1','potato salad','complete','unseen'),('restaurant1','restaurant1','potato salad','complete','unseen'),('restaurant1','restaurant1','potato salad','complete','unseen'),('restaurant1','restaurant1','potato salad','complete','unseen'),('restaurant1','restaurant1','potato salad','complete','unseen'),('restaurant1','restaurant1','potato salad','complete','unseen'),('restaurant1','restaurant1','potato salad','complete','unseen'),('restaurant1','restaurant1','potato salad','complete','unseen'),('restaurant1','restaurant1','potato salad','complete','unseen'),('restaurant1','restaurant1','potato salad','complete','unseen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','potato salad','complete','unseen'),('restaurant1','restaurant1','potato salad','complete','unseen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','potato salad','complete','unseen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant3','restaurant3','fried chicken','complete','unseen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant3','restaurant3','fried chicken','complete','unseen'),('restaurant3','restaurant3','fried chicken','complete','unseen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant3','restaurant3','tamato salad','complete','seen'),('restaurant3','restaurant3','cake3','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','green tea cake','incomplete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant1','restaurant1','hehehehe pasta','complete','seen'),('restaurant3','restaurant3','green tea cake','complete','seen'),('restaurant3','restaurant3','green tea cake','complete','seen'),('restaurant1','restaurant1','green tea cake','incomplete','seen'),('restaurant1','restaurant1','green tea cake','incomplete','seen'),('','','green tea cake','incomplete','unseen'),('','','green tea cake','incomplete','unseen'),('','','green tea cake','incomplete','unseen'),('','','green tea cake','incomplete','unseen'),('restaurant3','restaurant3','green tea cake','incomplete','seen'),('restaurant1','restaurant1','green tea cake','incomplete','seen'),('shabi','shabi','shit','incomplete','unseen'),('restaurant1','restaurant1','green tea cake','incomplete','seen'),('restaurant1','restaurant1','green tea cake','incomplete','seen'),('restaurant1','restaurant1','shit','complete','seen'),('restaurant1','restaurant1','potato salad','complete','seen'),('restaurant1','restaurant1','potato salad','complete','seen'),('restaurant1','restaurant1','potato salad','complete','seen'),('restaurant3','restaurant3','green tea cake','incomplete','seen'),('restaurant1','restaurant1','apple pie','complete','seen'),('Miga','Miga','chicken pasta','complete','seen'),('feitianjitui3','restaurant1','green tea cake','incomplete','seen'),('feitianjitui3','restaurant1','green tea cake','incomplete','seen'),('feitianjitui3','restaurant1','green tea cake','incomplete','seen'),('feitianjitui3','restaurant1','green tea cake','incomplete','seen'),('feitianjitui3','restaurant1','green tea cake','incomplete','seen'),('feitianjitui3','restaurant1','green tea cake','incomplete','seen'),('feitianjitui3','restaurant1','green tea cake','incomplete','seen'),('feitianjitui3','restaurant1','chicken pasta','incomplete','seen'),('feitianjitui3','restaurant1','chicken pasta','incomplete','seen'),('feitianjitui3','restaurant1','chicken pasta','incomplete','seen'),('feitianjitui3','restaurant1','chicken pasta','incomplete','seen'),('feitianjitui3','shabi','shit','incomplete','unseen'),('feitianjitui3','restaurant1','bread','incomplete','seen'),('feitianjitui3','restaurant1','chicken pasta','incomplete','seen'),('feitianjitui3','restaurant1','bread','incomplete','seen'),('feitianjitui3','Miga','beef burger','incomplete','seen'),('feitianjitui3','feitianjitui3','Pork Belly','incomplete','seen'),('Jackson','restauranttest','bacon','complete','seen'),('Jackson','restauranttest','bacon','complete','seen'),('Jackson','restauranttest','Bacon Salad','complete','seen'),('Jackson','restauranttest','Bacon Salad','incomplete','seen'),('Jackson','restauranttest','Bacon Salad','incomplete','seen'),('Jackson','restauranttest','Bacon Salad','incomplete','unseen'),('Jackson','restauranttest','Bacon Salad','incomplete','unseen'),('Jackson','restauranttest','Bacon Salad','incomplete','unseen'),('Jackson','restauranttest','Bacon Salad','incomplete','unseen'),('Jackson','restauranttest','Bacon Salad','incomplete','unseen');
/*!40000 ALTER TABLE `theorder` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `username` varchar(60) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL,
  `type` varchar(1) NOT NULL DEFAULT 'C',
  PRIMARY KEY (`username`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`username`, `password`, `type`) VALUES ('xl2','123','C'),('a4','123','C'),('a5','123','C'),('rhett','123456','C'),('hahaha','123456','C'),('lilili','123','C'),('abcd','123','C'),('test','123','R'),('xuli','123','R'),('111','11','C'),('321','321','C'),('1111','1234','C'),('rrrrrr','123456','C'),('yty','hahahaha','C'),('yyt','lol','C'),('feitianjitui','111111','C'),('panera','123','R'),('iiiiii','123456','C'),('feitianjitui3','123456','C'),('llll','123','C'),('restaurant1','123456','R'),('1','1','R'),('restaurant2','123456','R'),('tangwangchao','123','R'),('restaurant3','123456','R'),('Cheese and Crackers','123456','R'),('Esquire Lounge','123456','R'),('Cracked the Egg Came First','123456','R'),('Watson’s Shack & Rail','123456','R'),('Miga','123456','R'),(' Caribbean Grill Food Truck','123456','R'),('Original Pancake House','123456','R'),('Black Dog Smoke & Ale House','123456','R'),('Dos Reales','123456','R'),('Peking Garden Restaurant','123456','R'),('Jason','123456','C'),('Jackson','123456','C'),('mike','123456','C'),('mike1','password','C'),('restauranttest','123456','R');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_food`
--

DROP TABLE IF EXISTS `user_food`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_food` (
  `username` char(100) NOT NULL,
  `foodname` char(100) NOT NULL DEFAULT '',
  `oder` int(11) NOT NULL,
  PRIMARY KEY (`username`,`foodname`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_food`
--

LOCK TABLES `user_food` WRITE;
/*!40000 ALTER TABLE `user_food` DISABLE KEYS */;
INSERT INTO `user_food` (`username`, `foodname`, `oder`) VALUES ('xl2','Chicken Tortilla Soup',10),('xl2','Mexican grill',8),('xl2','Slow Cooker Chicken Noodle Soup',2),('xl2','Spicy Rice and Bean Wraps',6),('xl2','Tomato soup',5),('xl2','Crock Pot Santa Fe Chicken',0),('xl2','Spaghetti',7),('xl2','Pineapple Teriyaki Grilled Chicken',1),('xl2','Chicken Noodle Casserole',11),('xl2','Ice cream',9),('xl2','Weight Watchers Barbacoa Beef',4),('feitianjitui3','Chicken Tortilla Soup',12),('feitianjitui3','Crock Pot Santa Fe Chicken',11),('feitianjitui3','Weight Watchers Barbacoa Beef',0),('feitianjitui3','Ice cream',10),('feitianjitui3','Mexican grill',9),('feitianjitui3','Spicy Rice and Bean Wraps',4),('feitianjitui3','Spinach Lasagna Rolls',2),('feitianjitui3','Pineapple Teriyaki Grilled Chicken',8),('rrrrrr','Baked Turkey',5),('rrrrrr','Black Bean Taco Soup',4),('411project','Weight Watchers Salsa Roll-Ups',11),('411project','name',10),('411project','Apple',9),('411project','Asian Peanut Noodles with Chicken',8),('411project','Bacon',7),('411project','Egg Whites and Broccoli Rice Cups',6),('411project','Frozen yogurt',5),('411project','Grilled Island Chicken Kabobs',4),('411project','Mango Quinoa Salad',3),('411project','Pickle',2),('411project','Pita Pizza',1),('411project','Trending Articles',0),('feitianjitui3','Chicken Noodle Casserole',13),('yyt','Frozen yogurt',5),('yyt','Grilled Island Chicken Kabobs',4),('yyt','Mango Quinoa Salad',3),('yyt','name',9),('yyt','Apple',8),('yyt','Bacon',7),('yyt','Egg Whites and Broccoli Rice Cups',6),('yyt','Pickle',2),('yyt','Pita Pizza',1),('yyt','Trending Articles',0),('Jackson','Weight Watchers Salsa Roll-Ups',10),('Jackson','name',9),('Jackson','Apple',8),('Jackson','Bacon',7),('Jackson','Egg Whites and Broccoli Rice Cups',6),('Jackson','Frozen yogurt',5),('Jackson','Mango Quinoa Salad',4),('Jackson','Pickle',3),('Jackson','Pita Pizza',2),('Jackson','Trending Articles',1),('Jackson','Grilled Island Chicken Kabobs',0),('222222','name',9),('222222','Apple',8),('222222','Bacon',7),('222222','Egg Whites and Broccoli Rice Cups',6),('222222','Frozen yogurt',5),('222222','Mango Quinoa Salad',4),('222222','Pickle',3),('222222','Pita Pizza',2),('222222','Trending Articles',1),('222222','Grilled Island Chicken Kabobs',0),('feitianjitui3','Tomato soup',1),('feitianjitui3','Slow Cooker Chicken Noodle Soup',6),('feitianjitui3','Spaghetti',5),('feitianjitui3','Roast Chicken',7),('feitianjitui3','Spinach and Feta Pasta',3),('rrrrrr','Hawaiian Grilled Chicken',2),('rrrrrr','Petite Lasagnas',1),('rrrrrr','Boiled fish',0),('rrrrrr','Chicken Pot Pie Soup',3);
/*!40000 ALTER TABLE `user_food` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_info`
--

DROP TABLE IF EXISTS `user_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_info` (
  `username` varchar(60) NOT NULL,
  `age` int(11) NOT NULL,
  `height` double NOT NULL,
  `weight` double NOT NULL,
  `gender` char(64) NOT NULL,
  `activitylevel` int(1) NOT NULL,
  `calories` double NOT NULL,
  `sweet` int(11) DEFAULT NULL,
  `sour` int(11) NOT NULL,
  `hot` int(11) NOT NULL,
  `salty` int(11) NOT NULL,
  `Food` char(255) NOT NULL,
  PRIMARY KEY (`username`),
  FULLTEXT KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_info`
--

LOCK TABLES `user_info` WRITE;
/*!40000 ALTER TABLE `user_info` DISABLE KEYS */;
INSERT INTO `user_info` (`username`, `age`, `height`, `weight`, `gender`, `activitylevel`, `calories`, `sweet`, `sour`, `hot`, `salty`, `Food`) VALUES ('1',23,173,150,'m',0,0,0,0,0,16,''),('a2',28,174,150,'m',0,0,0,0,0,16,''),('a3',21,160,100,'f',0,0,0,0,0,16,''),('a4',30,180,190,'m',0,0,0,0,0,16,''),('a5',45,163,120,'f',0,0,0,0,0,16,''),('rhett',20,200,150,'f',0,0,0,0,0,16,''),('lilili',23,120,130,'f',0,0,0,0,0,16,''),('hahaha',25,165,100,'f',0,0,0,0,0,16,''),('test1',23,160,100,'f',0,0,0,0,0,16,''),('test2',23,175,140,'m',0,0,0,0,0,16,''),('111',21,185,72,'f',0,0,0,0,0,16,''),('xl2',24,174,75,'male',0,200,0,0,0,16,'beef'),('yty',20,172,55,'f',3,0,0,0,0,16,''),('rrrrrr',22,180,80,'f',1,248.6,0,0,0,16,''),('yyt',20,172,50,'f',3,253.8,0,0,0,16,''),('iiiiii',20,180,80,'f',1,0,0,0,0,16,''),('feitianjitui3',18,185,66,'f',1,237.9,0,0,0,16,''),('llll',20,175,80,'f',4,5000,0,0,0,16,''),('411project',25,190,80,'f',4,343.7,0,0,0,16,''),('222222',23,180,75,'f',2,270,0,0,0,16,''),('Jackson',20,190,90,'f',3,333.2,0,0,0,25,'');
/*!40000 ALTER TABLE `user_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_order`
--

DROP TABLE IF EXISTS `user_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_order` (
  `username` char(255) NOT NULL,
  `orderNum` int(11) NOT NULL,
  PRIMARY KEY (`username`,`orderNum`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_order`
--

LOCK TABLES `user_order` WRITE;
/*!40000 ALTER TABLE `user_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'fitfeed123_FITFEED'
--

--
-- Dumping routines for database 'fitfeed123_FITFEED'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-04-25  1:30:08
