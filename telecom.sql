--
-- Table structure for table `auth`
--

CREATE TABLE `auth` (
  `authID` smallint(5) unsigned NOT NULL auto_increment,
  `username` varchar(128) NOT NULL default '',
  `password` varchar(128) NOT NULL default '',
  `listen` char(1) NOT NULL default 'Y',
  `writable` char(1) NOT NULL default 'Y',
  `admin` char(1) NOT NULL default 'N',
  PRIMARY KEY (`authID`)
) DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth`
--

INSERT INTO `auth` VALUES (1,'root','63a9f0ea7bb98050796b649e85481845','Y','Y','Y');

--
-- Table structure for table `dlu`
--

CREATE TABLE `dlu` (
  `dluID` smallint(5) unsigned NOT NULL auto_increment,
  `sort` smallint(5) unsigned NOT NULL default '0',
  `name` varchar(128) NOT NULL default '',
  PRIMARY KEY (`dluID`)
) DEFAULT CHARSET=utf8;

--
-- Table structure for table `number`
--

CREATE TABLE `number` (
  `numberID` smallint(5) unsigned NOT NULL auto_increment,
  `telephone` varchar(16) NOT NULL default '',
  `serviceID` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY (`numberID`)
) DEFAULT CHARSET=utf8;

--
-- Table structure for table `para`
--

CREATE TABLE `para` (
  `paraID` smallint(5) unsigned NOT NULL auto_increment,
  `para` varchar(16) NOT NULL default '',
  `telephone` varchar(16) NOT NULL default '',
  `pult` varchar(16) NOT NULL default '',
  `sign` varchar(16) NOT NULL default '',
  `pen` varchar(16) NOT NULL default '',
  `kross` varchar(16) NOT NULL default '',
  `abonent` varchar(128) NOT NULL default '',
  `dluID` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY (`paraID`)
) DEFAULT CHARSET=utf8;

--
-- Table structure for table `podrazdel`
--

CREATE TABLE `podrazdel` (
  `podrazdelID` smallint(5) unsigned NOT NULL auto_increment,
  `name` varchar(128) NOT NULL default '',
  PRIMARY KEY  (podrazdelID)
) DEFAULT CHARSET=utf8;

--
-- Table structure for table `pult_a_data`
--

CREATE TABLE `pult_a_data` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `abonent` varchar(128) NOT NULL default '',
  `dlu_pult` varchar(16) NOT NULL default '',
  `kross_pult` varchar(16) NOT NULL default '',
  `dlu_abonent` varchar(16) NOT NULL default '',
  `kross_abonent` varchar(16) NOT NULL default '',
  `comment` varchar(128) NOT NULL default '',
  `pult_a_menu_id` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8;

--
-- Table structure for table `pult_a_menu`
--

CREATE TABLE `pult_a_menu` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `sort` smallint(5) unsigned NOT NULL default '0',
  `name` varchar(128) NOT NULL default '',
  PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8;

--
-- Table structure for table `razdel`
--

CREATE TABLE `razdel` (
  `razdelID` smallint(5) unsigned NOT NULL auto_increment,
  `name` varchar(128) NOT NULL default '',
  PRIMARY KEY (`razdelID`)
) DEFAULT CHARSET=utf8;

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `serviceID` smallint(5) unsigned NOT NULL auto_increment,
  `name` varchar(128) NOT NULL default '',
  `comment` varchar(128) NOT NULL default '',
  `podrazdelID` smallint(5) unsigned NOT NULL default '0',
  `razdelID` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY (`serviceID`)
) DEFAULT CHARSET=utf8;
