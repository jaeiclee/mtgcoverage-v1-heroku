# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Generation Time: 2015-07-21 07:49:22 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table decks
# ------------------------------------------------------------

CREATE TABLE `decks` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `deckname` varchar(255) NOT NULL,
  `deckformat` text NOT NULL,
  `colorred` tinyint(1) NOT NULL,
  `colorwhite` tinyint(1) NOT NULL,
  `colorblack` tinyint(1) NOT NULL,
  `colorblue` tinyint(1) NOT NULL,
  `colorgreen` tinyint(1) NOT NULL,
  `colorartifact` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `deckname` (`deckname`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

# Dump of table events
# ------------------------------------------------------------

DROP TABLE IF EXISTS `events`;

CREATE TABLE `events` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `visible` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `formattype` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `results` varchar(255) NOT NULL,
  `finished` tinyint(1) NOT NULL DEFAULT '0',
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `organiser` varchar(255) NOT NULL,
  `infolink` varchar(255) NOT NULL,
  `extratext` varchar(255) NOT NULL,
  `extra1` varchar(255) NOT NULL,
  `extra1info` varchar(255) NOT NULL,
  `extra2` varchar(255) NOT NULL,
  `extra2info` varchar(255) NOT NULL,
  `extra3` varchar(255) NOT NULL,
  `extra3info` varchar(255) NOT NULL,
  `extra4` varchar(255) NOT NULL,
  `extra4info` varchar(255) NOT NULL,
  `extra5` varchar(255) NOT NULL,
  `extra5info` varchar(255) NOT NULL,
  `extra6` varchar(255) NOT NULL,
  `extra6info` varchar(255) NOT NULL,
  `extra7` varchar(255) NOT NULL,
  `extra7info` text NOT NULL,
  `extra8` text NOT NULL,
  `extra8info` text NOT NULL,
  `extra9` text NOT NULL,
  `extra9info` text NOT NULL,
  `extra10` text NOT NULL,
  `extra10info` text NOT NULL,
  `extra11` text NOT NULL,
  `extra11info` text NOT NULL,
  `extra12` text NOT NULL,
  `extra12info` text NOT NULL,
  `standard` tinyint(1) DEFAULT NULL,
  `modern` tinyint(1) DEFAULT NULL,
  `legacy` tinyint(1) DEFAULT NULL,
  `vintage` tinyint(1) DEFAULT NULL,
  `limited` tinyint(1) DEFAULT NULL,
  `block` tinyint(1) DEFAULT NULL,
  `round1` varchar(255) NOT NULL,
  `round2` varchar(255) NOT NULL,
  `round3` varchar(255) NOT NULL,
  `round4` varchar(255) NOT NULL,
  `round5` varchar(255) NOT NULL,
  `round6` varchar(255) NOT NULL,
  `round7` varchar(255) NOT NULL,
  `round8` varchar(255) NOT NULL,
  `round9` varchar(255) NOT NULL,
  `round10` varchar(255) NOT NULL,
  `round11` varchar(255) NOT NULL,
  `round12` varchar(255) NOT NULL,
  `round13` varchar(255) NOT NULL,
  `round14` varchar(255) NOT NULL,
  `round15` varchar(255) NOT NULL,
  `round16` varchar(255) NOT NULL,
  `round17` varchar(255) NOT NULL,
  `round18` varchar(255) NOT NULL,
  `round19` varchar(255) NOT NULL,
  `round20` varchar(255) NOT NULL,
  `quarter` varchar(255) NOT NULL,
  `quarter2` varchar(255) NOT NULL,
  `quarter3` varchar(255) NOT NULL,
  `quarter4` varchar(255) NOT NULL,
  `semi` varchar(255) NOT NULL,
  `semi2` varchar(255) NOT NULL,
  `final` varchar(255) NOT NULL,
  `round1player1` text NOT NULL,
  `round1player2` text NOT NULL,
  `round1deck1` text NOT NULL,
  `round1deck2` text NOT NULL,
  `round2player1` text NOT NULL,
  `round2player2` text NOT NULL,
  `round2deck1` text NOT NULL,
  `round2deck2` text NOT NULL,
  `round3player1` text NOT NULL,
  `round3player2` text NOT NULL,
  `round3deck1` text NOT NULL,
  `round3deck2` text NOT NULL,
  `round4player1` text NOT NULL,
  `round4player2` text NOT NULL,
  `round4deck1` text NOT NULL,
  `round4deck2` text NOT NULL,
  `round5player1` text NOT NULL,
  `round5player2` text NOT NULL,
  `round5deck1` text NOT NULL,
  `round5deck2` text NOT NULL,
  `round6player1` text NOT NULL,
  `round6player2` text NOT NULL,
  `round6deck1` text NOT NULL,
  `round6deck2` text NOT NULL,
  `round7player1` text NOT NULL,
  `round7player2` text NOT NULL,
  `round7deck1` text NOT NULL,
  `round7deck2` text NOT NULL,
  `round8player1` text NOT NULL,
  `round8player2` text NOT NULL,
  `round8deck1` text NOT NULL,
  `round8deck2` text NOT NULL,
  `round9player1` text NOT NULL,
  `round9player2` text NOT NULL,
  `round9deck1` text NOT NULL,
  `round9deck2` text NOT NULL,
  `round10player1` text NOT NULL,
  `round10player2` text NOT NULL,
  `round10deck1` text NOT NULL,
  `round10deck2` text NOT NULL,
  `round11player1` text NOT NULL,
  `round11player2` text NOT NULL,
  `round11deck1` text NOT NULL,
  `round11deck2` text NOT NULL,
  `round12player1` text NOT NULL,
  `round12player2` text NOT NULL,
  `round12deck1` text NOT NULL,
  `round12deck2` text NOT NULL,
  `round13player1` text NOT NULL,
  `round13player2` text NOT NULL,
  `round13deck1` text NOT NULL,
  `round13deck2` text NOT NULL,
  `round14player1` text NOT NULL,
  `round14player2` text NOT NULL,
  `round14deck1` text NOT NULL,
  `round14deck2` text NOT NULL,
  `round15player1` text NOT NULL,
  `round15player2` text NOT NULL,
  `round15deck1` text NOT NULL,
  `round15deck2` text NOT NULL,
  `round16player1` text NOT NULL,
  `round16player2` text NOT NULL,
  `round16deck1` text NOT NULL,
  `round16deck2` text NOT NULL,
  `round17player1` text NOT NULL,
  `round17player2` text NOT NULL,
  `round17deck1` text NOT NULL,
  `round17deck2` text NOT NULL,
  `round18player1` text NOT NULL,
  `round18player2` text NOT NULL,
  `round18deck1` text NOT NULL,
  `round18deck2` text NOT NULL,
  `round19player1` text NOT NULL,
  `round19player2` text NOT NULL,
  `round19deck1` text NOT NULL,
  `round19deck2` text NOT NULL,
  `round20player1` text NOT NULL,
  `round20player2` text NOT NULL,
  `round20deck1` text NOT NULL,
  `round20deck2` text NOT NULL,
  `quarterplayer1` varchar(255) NOT NULL,
  `quarterplayer2` varchar(255) NOT NULL,
  `quarterdeck1` varchar(255) NOT NULL,
  `quarterdeck2` varchar(255) NOT NULL,
  `quarter2player1` varchar(255) NOT NULL,
  `quarter2player2` varchar(255) NOT NULL,
  `quarter2deck1` varchar(255) NOT NULL,
  `quarter2deck2` varchar(255) NOT NULL,
  `quarter3player1` varchar(255) NOT NULL,
  `quarter3player2` varchar(255) NOT NULL,
  `quarter3deck1` varchar(255) NOT NULL,
  `quarter3deck2` varchar(255) NOT NULL,
  `quarter4player1` varchar(255) NOT NULL,
  `quarter4player2` varchar(255) NOT NULL,
  `quarter4deck1` varchar(255) NOT NULL,
  `quarter4deck2` varchar(255) NOT NULL,
  `semiplayer1` varchar(255) NOT NULL,
  `semiplayer2` varchar(255) NOT NULL,
  `semideck1` varchar(255) NOT NULL,
  `semideck2` varchar(255) NOT NULL,
  `semi2player1` varchar(255) NOT NULL,
  `semi2player2` varchar(255) NOT NULL,
  `semi2deck1` varchar(255) NOT NULL,
  `semi2deck2` varchar(255) NOT NULL,
  `finalplayer1` varchar(255) NOT NULL,
  `finalplayer2` varchar(255) NOT NULL,
  `finaldeck1` varchar(255) NOT NULL,
  `finaldeck2` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

# Dump of table players
# ------------------------------------------------------------

CREATE TABLE `players` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `playername` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `playername` (`playername`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

# Dump of table streams
# ------------------------------------------------------------

CREATE TABLE `streams` (
  `streamname` varchar(255) NOT NULL,
  `online` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`streamname`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
