# phpMyAdmin MySQL-Dump
# version 2.5.1
#
# Host: localhost
# Erstellungszeit: 14. Juni 2003 um 18:45
# Server Version: 3.23.54
# PHP-Version: 4.3.2
# Datenbank: `kino`
# --------------------------------------------------------

#
# Tabellenstruktur für Tabelle `bestellungen`
#
# Erzeugt am: 06. Juni 2003 um 19:39
# Aktualisiert am: 14. Juni 2003 um 18:29
#

DROP TABLE IF EXISTS `bestellungen`;
CREATE TABLE `bestellungen` (
  `id` int(3) NOT NULL auto_increment,
  `filmname` varchar(20) NOT NULL default '',
  `datum` varchar(20) NOT NULL default '',
  `plaetze` varchar(5) NOT NULL default '',
  `name` varchar(50) NOT NULL default '',
  `email` varchar(20) NOT NULL default '',
  `telefon` varchar(20) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 ;
# --------------------------------------------------------

#
# Tabellenstruktur für Tabelle `filme`
#
# Erzeugt am: 05. Juni 2003 um 15:26
# Aktualisiert am: 14. Juni 2003 um 18:29
#

DROP TABLE IF EXISTS `filme`;
CREATE TABLE `filme` (
  `namen` varchar(20) NOT NULL default ''
) ENGINE=MyISAM;

