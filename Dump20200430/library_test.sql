-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: library
-- ------------------------------------------------------
-- Server version	5.7.29-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `test`
--

DROP TABLE IF EXISTS `test`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `cap` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `date` date NOT NULL,
  `author` varchar(255) NOT NULL,
  `category` varchar(50) NOT NULL,
  `image` varchar(45) NOT NULL,
  `eval` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test`
--

LOCK TABLES `test` WRITE;
/*!40000 ALTER TABLE `test` DISABLE KEYS */;
INSERT INTO `test` VALUES (101,'The New Jim Crow: Mass Incarceration in the Age of Colorblindness','',41,'2012-10-18','Michelle Alexander','Law&Social','law101','4.5'),(102,'America\'s Constitution: A Biography','',28,'2016-09-23','Akhil Reed Amar','Law&Social','law102','4.5'),(103,'Carnal Crimes: Sexual Assault Law in Canada, 1900-1975','',32,'2016-02-22','Constance Backhouse','Law&Social','law103','4.5'),(104,'Forcing the Spring: Inside the Fight for Marriage Equality','',45,'2018-02-25','Jo Becker','Law&Social','law104','4.5'),(105,'The Common Legal Past of Europe, 1000-1800 (Studies in Medieval and Early Modern Canon Law)','',45,'2016-02-24','Manlio Bellomo','Law&Social','law105','4.5'),(106,'Transgender Employment Experiences: Gendered Perceptions and the Law','',35,'2013-10-01','Kyla Bender-Baird','Law&Social','law106','4.5'),(107,'Policing the National Body: Race, Gender and Criminalization in the United States','',40,'2012-12-01','Anannya Bhattacharjee , Jael Silliman','Law&Social','law107','4.5'),(108,'Madisonâ€™s Hand: Revising the Constitutional Convention','',28,'2012-11-26','Mary Sarah Bilder','Law&Social','law108','4.5'),(109,'Trying Leviathan: The Nineteenth-Century New York Court Case That Put the Whale on Trial and Challenged the Order of Nature','',43,'2012-02-13','D. Graham Burnett','Law&Social','law109','4.5'),(110,'Let\'s Get Free: A Hip-Hop Theory of Justice','',28,'2016-01-13','Paul Butler','Law&Social','law110','4.5'),(111,'Policing the Planet: Why the Policing Crisis Led to Black Lives Matter','',43,'2013-04-15','Jordan T. Camp','Law&Social','law111','4.5'),(112,'Misconceptions: Unmarried Motherhood and the Ontario Children of Unmarried Parents Act, 1921-1969 (Osgoode Society for Canadian Legal History)','',46,'2012-12-20','Lori Chambers','Law&Social','law112','4.5'),(113,'The Case Against the Supreme Court','',37,'2013-02-23','Erwin Chemerinsky','Law&Social','law113','4.5'),(114,'King John: And the Road to Magna Carta','',44,'2016-02-29','Stephen Church','Law&Social','law114','4.5'),(115,'Between the World and Me','',34,'2014-04-26','Ta-Nehisi Coates','Law&Social','law115','4.5'),(116,'Sisters in the Struggle : African-American Women in the Civil Rights-Black Power Movement','',35,'2018-10-09','Bettye Collier-Thomas , V.P. Franklin','Law&Social','law116','4.5'),(117,'Long, Lingering Shadow: Slavery, Race, and Law in the American Hemisphere (Studies in the Legal History of the South Ser.)','',20,'2018-08-21','Robert J. Cottrol','Law&Social','law117','4.5'),(118,'Freedom Is a Constant Struggle: Ferguson, Palestine, and the Foundations of a Movement','',41,'2012-08-05','Angela Y. Davis','Law&Social','law118','4.5'),(119,'Governing Immigration Through Crime: A Reade','',40,'2018-09-08','Julie Dowling','Law&Social','law119','4.5'),(120,'You Have the Right to Remain Innocent','',34,'2017-05-01','James Duane','Law&Social','law120','4.5'),(121,'A Legal History of the Civil War and Reconstruction (New Histories of American Law)','',43,'2016-02-01','Laura F. Edwards','Law&Social','law121','4.5'),(122,'The Informant: A True Story','',46,'2016-01-10','Kurt Eichenwald','Law&Social','law122','4.5'),(123,'Scorpions: The Battles and Triumphs of FDR\'s Great Supreme Court Justices','',46,'2012-11-13','Noah Feldman','Law&Social','law123','4.5'),(124,'Ballot Battles: The History of Disputed Elections in the United States','',38,'2016-08-24','Edward Foley','Law&Social','law124','4.5'),(125,'Discipline & Punish: The Birth of the Prison','',36,'2018-04-27','Michel Foucault','Law&Social','law125','4.5'),(126,'Herculine Barbin (Being the Recently Discovered Memoirs of a Nineteenth Century French Hermaphrodite)','',27,'2012-05-21','Michel Foucault','Law&Social','law126','4.5'),(127,'Law and the Gay Rights Story: The Long Search for Equal Justice in a Divided Democracy','',22,'2012-07-09','Walter Frank','Law&Social','law127','4.5'),(128,'Law in America: A Short History (Modern Library Chronicles)','',37,'2017-07-03','Lawrence M. Friedman','Law&Social','law128','4.5'),(129,'The Legal Ideology of Removal: The Southern Judiciary and the Sovereignty of Native American Nations','',50,'2012-09-26','Tim Alan Garrison','Law&Social','law129','4.5'),(130,'Civil Rights Stories (Law Stories)','',30,'2016-04-04','Myriam Gilles , Risa Goluboff ','Law&Social','law130','4.5'),(131,'My Own Words','',24,'2018-04-07','Ruth Bader Ginsburg','Law&Social','law131','4.5'),(132,'Lawyers and Legal Culture in British North America: Beamish Murdoch of Halifax (Osgoode Society for Canadian Legal History)','',42,'2014-12-06','Philip Girard','Law&Social','law132','4.5'),(133,'Unequal Freedom: How Race and Gender Shaped American Citizenship and Labor','',45,'2014-06-29','Evelyn Nakano Glenn','Law&Social','law133','4.5'),(134,'Storming the Court: How a Band of Law Students Fought the President--and Won','',50,'2015-05-18','Brandt Goldstein','Law&Social','law134','4.5'),(135,'Inherently Unequal: The Betrayal of Equal Rights by the Supreme Court, 1865-1903','',49,'2018-10-14','Lawrence Goldstone','Law&Social','law135','4.5'),(136,'Vagrant Nation: Police Power, Constitutional Change, and the Making of the 1960s','',23,'2017-03-30','Risa Goluboff','Law&Social','law136','4.5'),(137,'The Burger Court and the Rise of the Judicial Right','',49,'2012-06-30','Michael J. Graetz','Law&Social','law137','4.5'),(138,'BECOMING JUSTICE BLACKMUN','',47,'2013-05-28','LINDA GREENHOUSE','Law&Social','law138','4.5'),(139,'The Massey Murder: A Maid, Her Master And The Trial That Shocked','',50,'2016-10-21','Charlotte Gray','Law&Social','law139','4.5'),(140,'A Civil Action','',38,'2016-11-02','Jonathan Harr','Law&Social','law140','4.5');
/*!40000 ALTER TABLE `test` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-04-30 12:56:43
