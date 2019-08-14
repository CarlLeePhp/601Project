

DROP TABLE IF EXISTS `Candidate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Candidate` (
  `CandidateID` int(11) NOT NULL AUTO_INCREMENT,
  `jobInterest` varchar(64) DEFAULT NULL,
  `jobType` varchar(64) DEFAULT NULL,
  `jobCV` varchar(64) DEFAULT NULL,
  `transportation` varchar(64) DEFAULT NULL,
  `LicenseNumber` varchar(64) DEFAULT NULL,
  `classLicense` varchar(64) DEFAULT NULL,
  `endorsement` varchar(64) DEFAULT NULL,
  `citizenship` varchar(64) DEFAULT NULL,
  `nationality` varchar(64) DEFAULT NULL,
  `passportCountry` varchar(64) DEFAULT NULL,
  `passportNumber` varchar(64) DEFAULT NULL,
  `compensationInjury` varchar(64) DEFAULT NULL,
  `compensationDateFrom` varchar(64) DEFAULT NULL,
  `compensationDateTo` varchar(64) DEFAULT NULL,
  `asthma` varchar(8) DEFAULT NULL,
  `blackOut` varchar(8) DEFAULT NULL,
  `diabetes` varchar(8) DEFAULT NULL,
  `bronchitis` varchar(8) DEFAULT NULL,
  `backInjury` varchar(8) DEFAULT NULL,
  `deafness` varchar(8) DEFAULT NULL,
  `dermatitis` varchar(8) DEFAULT NULL,
  `skinInfection` varchar(8) DEFAULT NULL,
  `allergies` varchar(8) DEFAULT NULL,
  `hernia` varchar(8) DEFAULT NULL,
  `highBloodPressure` varchar(8) DEFAULT NULL,
  `heartProblems` varchar(8) DEFAULT NULL,
  `usingDrugs` varchar(8) DEFAULT NULL,
  `usingContactLenses` varchar(8) DEFAULT NULL,
  `RSI` varchar(8) DEFAULT NULL,
  `dependants` varchar(8) DEFAULT NULL,
  `smoke` varchar(8) DEFAULT NULL,
  `conviction` varchar(8) DEFAULT NULL,
  `convictionDetails` varchar(64) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `JobID` int(11) DEFAULT NULL,
  PRIMARY KEY (`CandidateID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Candidate`
--

LOCK TABLES `Candidate` WRITE;
/*!40000 ALTER TABLE `Candidate` DISABLE KEYS */;
INSERT INTO `Candidate` VALUES (1,'Web Development','Full Time',NULL,'Train','TR007','TR','anything','Australia','Australia','Australia','AU123','Yes','2019-04-10','2019-05-09','true','false','false','false','true','false','false','true','false','false','false','false','false','false','true','false','true','true','I punched a dog last week.',65,NULL);
INSERT INTO `Candidate` VALUES (2,'Java Development','Full Time',NULL,'Train','TR007','TR','anything','Australia','Australia','Australia','AU123','Yes','2019-04-10','2019-05-09','true','false','false','false','true','false','false','true','false','false','false','false','false','false','true','false','true','true','I punched a dog last week.',65,NULL);
INSERT INTO `Candidate` VALUES (3,'Python Development','Full Time',NULL,'Train','TR007','TR','anything','Australia','Australia','Australia','AU123','Yes','2019-04-10','2019-05-09','true','false','false','false','true','false','false','true','false','false','false','false','false','false','true','false','true','true','I punched a dog last week.',65,NULL);
INSERT INTO `Candidate` VALUES (4,'C Sharp Development','Full Time',NULL,'Train','TR007','TR','anything','Australia','Australia','Australia','AU123','Yes','2019-04-10','2019-05-09','true','false','false','false','true','false','false','true','false','false','false','false','false','false','true','false','true','true','I punched a dog last week.',65,NULL);
INSERT INTO `Candidate` VALUES (5,'C Development','Full Time',NULL,'Train','TR007','TR','anything','Australia','Australia','Australia','AU123','Yes','2019-04-10','2019-05-09','true','false','false','false','true','false','false','true','false','false','false','false','false','false','true','false','true','true','I punched a dog last week.',65,NULL);


/*!40000 ALTER TABLE `Candidate` ENABLE KEYS */;
UNLOCK TABLES;
