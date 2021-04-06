-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 11. Apr 2017 um 15:12
-- Server-Version: 10.1.16-MariaDB
-- PHP-Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `bildx`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `absenz_anfrage`
--

CREATE TABLE `absenz_anfrage` (
  `id` int(11) NOT NULL,
  `anfrage` varchar(5) NOT NULL,
  `anfrage_kommentar` varchar(100) DEFAULT NULL,
  `anfrage_datum` datetime NOT NULL,
  `signiert_praxisbildner` enum('offen','ja','abgelehnt') NOT NULL DEFAULT 'offen',
  `signiert_praxisbildner_datum` datetime DEFAULT NULL,
  `signiert_praxisbildner_nachricht` varchar(100) DEFAULT NULL,
  `signiert_berufsbildner` enum('offen','ja','abgelehnt') NOT NULL DEFAULT 'offen',
  `signiert_berufsbildner_datum` datetime DEFAULT NULL,
  `signiert_berufsbildner_nachricht` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `absenz_anfrage`
--

INSERT INTO `absenz_anfrage` (`id`, `anfrage`, `anfrage_kommentar`, `anfrage_datum`, `signiert_praxisbildner`, `signiert_praxisbildner_datum`, `signiert_praxisbildner_nachricht`, `signiert_berufsbildner`, `signiert_berufsbildner_datum`, `signiert_berufsbildner_nachricht`) VALUES
(673, 'UNF', NULL, '0000-00-00 00:00:00', 'offen', NULL, NULL, 'offen', NULL, NULL),
(674, 'UNF', NULL, '0000-00-00 00:00:00', 'offen', NULL, NULL, 'offen', NULL, NULL),
(681, 'KRA', '', '0000-00-00 00:00:00', 'ja', '2017-03-13 15:23:07', NULL, 'ja', '2017-03-13 15:23:19', NULL),
(682, 'KRA', '', '0000-00-00 00:00:00', 'ja', '2017-03-13 15:23:07', NULL, 'ja', '2017-03-13 15:23:19', NULL),
(683, 'KAB', '', '0000-00-00 00:00:00', 'ja', '2017-03-13 16:08:37', NULL, 'ja', '2017-03-13 16:09:47', NULL),
(684, 'KAB', '', '0000-00-00 00:00:00', 'ja', '2017-03-13 16:08:37', NULL, 'ja', '2017-03-13 16:09:47', NULL),
(685, 'FER', NULL, '0000-00-00 00:00:00', 'ja', '2017-03-13 16:07:24', NULL, 'ja', '2017-03-13 16:07:58', NULL),
(686, 'FER', NULL, '0000-00-00 00:00:00', 'ja', '2017-03-13 16:07:24', NULL, 'ja', '2017-03-13 16:07:58', NULL),
(687, 'FER', 'ccc', '0000-00-00 00:00:00', 'ja', '2017-03-13 15:23:07', NULL, 'ja', '2017-03-13 15:23:19', NULL),
(688, 'FER', 'ccc', '0000-00-00 00:00:00', 'ja', '2017-03-13 15:23:07', NULL, 'ja', '2017-03-13 15:23:19', NULL),
(689, 'FER', NULL, '0000-00-00 00:00:00', 'ja', '2017-03-13 15:23:07', NULL, 'ja', '2017-03-13 15:23:19', NULL),
(690, 'FER', NULL, '0000-00-00 00:00:00', 'ja', '2017-03-13 15:23:07', NULL, 'ja', '2017-03-13 15:23:19', NULL),
(695, 'KRA', NULL, '0000-00-00 00:00:00', 'ja', '2017-03-13 15:23:09', NULL, 'ja', '2017-03-13 15:23:19', NULL),
(696, 'KRA', NULL, '0000-00-00 00:00:00', 'ja', '2017-03-13 15:23:09', NULL, 'ja', '2017-03-13 15:23:19', NULL),
(697, 'KRA', NULL, '0000-00-00 00:00:00', 'ja', '2017-03-13 15:23:09', NULL, 'ja', '2017-03-13 15:23:19', NULL),
(698, 'KRA', NULL, '0000-00-00 00:00:00', 'ja', '2017-03-13 15:23:09', NULL, 'ja', '2017-03-13 15:23:19', NULL),
(699, 'KRA', 'vxcvxcvxc', '0000-00-00 00:00:00', 'ja', '2017-03-13 15:23:09', NULL, 'ja', '2017-03-13 15:23:19', NULL),
(700, 'KRA', 'vxcvxcvxc', '0000-00-00 00:00:00', 'ja', '2017-03-13 15:23:09', NULL, 'ja', '2017-03-13 15:23:19', NULL),
(701, 'KRA', NULL, '0000-00-00 00:00:00', 'ja', '2017-03-13 15:23:09', NULL, 'ja', '2017-03-13 15:23:19', NULL),
(702, 'KRA', NULL, '0000-00-00 00:00:00', 'ja', '2017-03-13 15:23:09', NULL, 'ja', '2017-03-13 15:23:19', NULL),
(703, 'KRA', NULL, '0000-00-00 00:00:00', 'ja', '2017-03-13 15:23:09', NULL, 'ja', '2017-03-13 15:23:19', NULL),
(704, 'KRA', NULL, '0000-00-00 00:00:00', 'ja', '2017-03-13 15:23:09', NULL, 'ja', '2017-03-13 15:23:19', NULL),
(713, 'KRA', '', '0000-00-00 00:00:00', 'offen', NULL, NULL, 'ja', '2017-03-13 16:09:42', NULL),
(714, 'KRA', '', '0000-00-00 00:00:00', 'offen', NULL, NULL, 'ja', '2017-03-13 16:09:42', NULL),
(889, 'UNF', NULL, '0000-00-00 00:00:00', 'offen', NULL, NULL, 'ja', '2017-03-13 15:18:14', NULL),
(901, 'MIL', NULL, '0000-00-00 00:00:00', 'ja', '2017-02-02 12:00:00', 'hallo', 'ja', '2017-03-13 15:22:30', NULL),
(902, 'MIL', NULL, '0000-00-00 00:00:00', 'ja', '2017-02-02 12:00:00', 'hallo', 'ja', '2017-03-13 15:22:30', NULL),
(903, 'MIL', NULL, '0000-00-00 00:00:00', 'ja', '2017-02-02 12:00:00', 'hallo', 'ja', '2017-03-13 15:22:30', NULL),
(904, 'MIL', NULL, '0000-00-00 00:00:00', 'ja', '2017-02-02 12:00:00', 'hallo', 'ja', '2017-03-13 15:22:30', NULL),
(905, 'FER', NULL, '0000-00-00 00:00:00', 'ja', '2017-03-13 14:43:00', NULL, 'ja', '2017-03-13 15:22:21', NULL),
(906, 'MIL', NULL, '0000-00-00 00:00:00', 'ja', '2017-03-13 14:44:06', NULL, 'ja', '2017-03-13 15:21:36', NULL),
(907, 'JUG', NULL, '0000-00-00 00:00:00', 'offen', NULL, NULL, 'offen', NULL, NULL),
(1029, 'KRA', NULL, '0000-00-00 00:00:00', 'offen', NULL, NULL, 'offen', NULL, NULL),
(1030, 'KRA', NULL, '0000-00-00 00:00:00', 'offen', NULL, NULL, 'offen', NULL, NULL),
(1031, 'KRA', NULL, '0000-00-00 00:00:00', 'offen', NULL, NULL, 'offen', NULL, NULL),
(1032, 'KRA', NULL, '0000-00-00 00:00:00', 'offen', NULL, NULL, 'offen', NULL, NULL),
(1033, 'KRA', NULL, '0000-00-00 00:00:00', 'offen', NULL, NULL, 'offen', NULL, NULL),
(1034, 'KRA', NULL, '0000-00-00 00:00:00', 'offen', NULL, NULL, 'offen', NULL, NULL),
(1035, 'KRA', NULL, '0000-00-00 00:00:00', 'offen', NULL, NULL, 'offen', NULL, NULL),
(1036, 'KRA', NULL, '0000-00-00 00:00:00', 'offen', NULL, NULL, 'offen', NULL, NULL),
(1093, 'SOB', NULL, '0000-00-00 00:00:00', 'offen', NULL, NULL, 'offen', NULL, NULL),
(1885, 'FER', '', '0000-00-00 00:00:00', 'ja', '2017-03-13 14:45:24', NULL, 'ja', '2017-03-13 15:13:14', NULL),
(1886, 'FER', '', '0000-00-00 00:00:00', 'ja', '2017-03-13 14:45:24', NULL, 'ja', '2017-03-13 15:13:14', NULL),
(1887, 'FER', '', '0000-00-00 00:00:00', 'ja', '2017-03-13 14:45:24', NULL, 'ja', '2017-03-13 15:13:14', NULL),
(1888, 'FER', '', '0000-00-00 00:00:00', 'ja', '2017-03-13 14:45:24', NULL, 'ja', '2017-03-13 15:13:14', NULL),
(1889, 'FER', '', '0000-00-00 00:00:00', 'ja', '2017-03-13 14:45:24', NULL, 'ja', '2017-03-13 15:13:14', NULL),
(1890, 'FER', '', '0000-00-00 00:00:00', 'ja', '2017-03-13 14:45:24', NULL, 'ja', '2017-03-13 15:13:14', NULL),
(1891, 'FER', '', '0000-00-00 00:00:00', 'ja', '2017-03-13 14:45:24', NULL, 'ja', '2017-03-13 15:13:14', NULL),
(1892, 'FER', '', '0000-00-00 00:00:00', 'ja', '2017-03-13 14:45:24', NULL, 'ja', '2017-03-13 15:13:14', NULL),
(1893, 'KRA', '', '0000-00-00 00:00:00', 'ja', '2017-03-13 15:13:21', NULL, 'ja', '2017-03-13 15:13:37', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `benutzer`
--

CREATE TABLE `benutzer` (
  `id` int(11) NOT NULL,
  `vorname` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password_hash` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `benutzer`
--

INSERT INTO `benutzer` (`id`, `vorname`, `name`, `email`, `password_hash`) VALUES
(4, 'Administrator', '', 'admin', '$2y$10$lYENhEwtxlBM0Xq49n/l8ePjcmiNjeYh0w3re6FFFm6mdx0ZDfWM2'),
(5, 'Jasmin', 'Wicki', 'jasi', '$2y$10$lYENhEwtxlBM0Xq49n/l8ePjcmiNjeYh0w3re6FFFm6mdx0ZDfWM2'),
(6, 'Bruno', 'Vorburger', 'bruno', '$2y$10$lYENhEwtxlBM0Xq49n/l8ePjcmiNjeYh0w3re6FFFm6mdx0ZDfWM2'),
(9, 'Rainer', 'Walser', 'rainer', '$2y$10$lYENhEwtxlBM0Xq49n/l8ePjcmiNjeYh0w3re6FFFm6mdx0ZDfWM2'),
(10, 'Levin', 'Bründler', 'levin', '$2y$10$lYENhEwtxlBM0Xq49n/l8ePjcmiNjeYh0w3re6FFFm6mdx0ZDfWM2'),
(13, 'asd', 'Asd', 'd', '$2y$10$qK48B8Ji0XZTVXHVbxoHiOMUzlEqSphdfogwZEXSGfJnoOBgyjnz2'),
(15, 'PB2', 'Test', 'pb2', '$2y$10$mWROc83Umettc9fxhjykaODuRVFi6wKTysywGBn0EInwvWcnoRq7W'),
(16, 'PB3', 'Test', 'pb3', '$2y$10$mWROc83Umettc9fxhjykaODuRVFi6wKTysywGBn0EInwvWcnoRq7W'),
(17, 'Hans', 'Muster', 'hans', '$2y$10$ce1bexdqxL0SAy/m7ER5WuFjD2tTfHmpWDtA7FB0GkM5.z93.1dq2'),
(21, 'Helena', 'Zimmermann', 'hel', '$2y$10$Zo6XtUAp5j4.7t6WoSBFJ.AV4BY.4k.bsbFApcl0EhV4FzAsSu5VG'),
(23, '3', '3', '3', '$2y$10$lko.OTAdkXW4CTyNsna.LuG9.V9m/ME9V110A5glGdf1bPXNwm.R.'),
(25, '4', '4', '4', '$2y$10$rvQg.nnEyEToEpKIPCQ7t.4kKdyB7jxCX2u1KQJLulZvta2eyoZN2'),
(26, 'Levin', 'B', 'eeee', '$2y$10$0E7VMg4bdr8mfe7MS7561udKRPOUuakK7Pbdfz4D66.JUoEO.22Ai'),
(28, 'e', 'e', 'e', '$2y$10$EO1m95JrAT8IKzvLWpGn/.mz0SBuc8OwTIdYob6iuOe4IYT3hmAOK'),
(29, 'r', 'r', 'r', '$2y$10$z5OSCDZBUqWZk5vLhMeJAu.hYRy2fVwnVolAEiz2jikC44tjFsZ8W'),
(30, '3', '3', '33332', '$2y$10$iyua0kWwiPRu8/4hW1NmkulDM1fW65i35Adw/76xksR7X.faXDNxC'),
(31, 'hh', 'hh', 'hhh', '$2y$10$e.5Hk7a9urpw.X6VoToT/eLWn/Tno2MW3a40CuYuGBp7WIH4483Ia'),
(32, 'Hans', 'Musterbube', 'l', '$2y$10$ABGplMoXJy7GeglAeMUyyOQ75PhTJk4pE2dVc3dQgZEVJ2Wn5knLu'),
(34, 'gg', 'gg', 'ggg', '$2y$10$Z92UMRuCpC13w1vfXW5bceCTOkziS4oMRBALyrDgW8TpKbfaDN7NW'),
(35, 'Josef', 'Muster', 'jo', '$2y$10$fbopG.3jTstufC2LOwxTyOVQ/dKM9gKjlNJK0mNdpVckylEHKyGHy'),
(36, 'Praxisbildner', 'Migration', 'pb-migration', ''),
(37, 'Praxisbildner', 'ÜK', 'pb-uek', ''),
(38, 'Praxisbildner', 'Überbrückung', 'pb-ueberbrueckung', ''),
(39, 'Praxisbildner', 'Krankheit', 'pb-krankheit', ''),
(40, 'ccccccccccccccccccc', 'cccccccccccccccccccccccccccc', 'ccccc', '$2y$10$Z3bkklvYKvKuSm/5Z0rSuexwn53GL7uDkgoBLZVUnpVHcjs1onBvO'),
(41, 'fdgs', 'sdfg', 'sdfg', '$2y$10$7ezoM0iNtd.KG2opoB3GCe7RiqjN25m1lz8aCGp.LjrPbpnlkxOL2'),
(42, '4', '4', '444', '$2y$10$cimBl9Bz8GzZrGlXyRJ9J.oYRpLlrEld/WczhBQtKfmy8E.q1ckYS'),
(43, 'cccc', 'cccc', 'c', '$2y$10$8posyICrmnohdj8wyrtKIu3TJ.dEWSDka7S2K0eskKCBT68tDGcPe'),
(44, '1', '1', '1', '$2y$10$hlHQrd.jQjQN.TdMhfVZ2OQtbuCv0bUuKHLQrNdUXLgSK5OnP8ZXS'),
(45, '2', '2', '2', '$2y$10$V7EV05KIDJkL8JI0UZYgH.yK89ohpM5XKwwmhDCKx9X5/EQIxo9.W'),
(46, '5', '5', '5', '$2y$10$j3DoXrmoBhJEoEcm4/dzm.h.GBHOtn/Rdy1bXaPYn5nF0k59f0FuW'),
(47, '6', '6', '6', '$2y$10$Fumdfy4xUqADMSanvCj43u9sld4C/WbpAZWNbL4g6xfi8/m7DuWh6'),
(48, '7', '7', '7', '$2y$10$t1KNKpJO3Gf3M18W/2GjvOKRl8KB5/Nryma9muMDXVjPaF2Fdn.TC'),
(49, '8', '8', '8', '$2y$10$dTb1RowkeQKryPQAKqQfhu79wbt2RYP6rzDc0oZtajl013dPdiv36'),
(50, '9', '9', '9', '$2y$10$Q4tVG7ug/A3MsZvJuvjyM.wxZsfyIGES5L9JkKhgutmNbEWmGJlyy'),
(51, '0', '0', '0', '$2y$10$IZHEw7L0iLl180wCSqM0.uLtOhc.75OcembsFDDCgqMKYDD6U1Miy'),
(52, '11', '11', '11', '$2y$10$YASt0KHjWLy8.IjC.5od0O0N1sct0pmo1FOWLDT2kHZecaKoPnIBW');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `benutzer_einstellungen`
--

CREATE TABLE `benutzer_einstellungen` (
  `benutzer` int(11) NOT NULL,
  `startrolle` enum('verwaltung','lehrling','praxisbildner','berufsbildner') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `benutzer_einstellungen`
--

INSERT INTO `benutzer_einstellungen` (`benutzer`, `startrolle`) VALUES
(5, 'verwaltung');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `berechtigung`
--

CREATE TABLE `berechtigung` (
  `benutzer` int(11) NOT NULL,
  `berechtigung` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `berechtigung`
--

INSERT INTO `berechtigung` (`benutzer`, `berechtigung`) VALUES
(4, 'LLV'),
(4, 'PBV'),
(4, 'RAP'),
(4, 'SFE'),
(5, 'LLV'),
(9, 'LLV'),
(9, 'RAP'),
(9, 'SFE'),
(10, 'LLV'),
(10, 'PBV'),
(10, 'RAP'),
(10, 'SFE'),
(10, 'STA');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `berufsbildner`
--

CREATE TABLE `berufsbildner` (
  `id` int(11) NOT NULL,
  `archiviert` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `berufsbildner`
--

INSERT INTO `berufsbildner` (`id`, `archiviert`) VALUES
(9, 0),
(16, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `feiertag`
--

CREATE TABLE `feiertag` (
  `id` smallint(6) NOT NULL,
  `datum` date NOT NULL,
  `feiertag` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `halbtag`
--

CREATE TABLE `halbtag` (
  `id` int(11) NOT NULL,
  `lehrling` int(11) NOT NULL,
  `tag` date NOT NULL,
  `halbtag` enum('vormittag','nachmittag') NOT NULL,
  `taetigkeit` varchar(5) DEFAULT NULL,
  `taetigkeit_kommentar` varchar(100) DEFAULT NULL,
  `absenz` varchar(5) NOT NULL DEFAULT 'KAB',
  `absenz_kommentar` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `halbtag`
--

INSERT INTO `halbtag` (`id`, `lehrling`, `tag`, `halbtag`, `taetigkeit`, `taetigkeit_kommentar`, `absenz`, `absenz_kommentar`) VALUES
(1639, 10, '2014-08-01', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1640, 10, '2014-08-01', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1641, 10, '2014-08-02', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1642, 10, '2014-08-02', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1643, 10, '2014-08-03', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1644, 10, '2014-08-03', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1645, 10, '2014-08-04', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1646, 10, '2014-08-04', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1647, 10, '2014-08-05', 'vormittag', 'STU', NULL, 'KAB', NULL),
(1648, 10, '2014-08-05', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1649, 10, '2014-08-06', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1650, 10, '2014-08-06', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1651, 10, '2014-08-07', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1652, 10, '2014-08-07', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1653, 10, '2014-08-08', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1654, 10, '2014-08-08', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1655, 10, '2014-08-09', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1656, 10, '2014-08-09', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1657, 10, '2014-08-10', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1658, 10, '2014-08-10', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1659, 10, '2014-08-11', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1660, 10, '2014-08-11', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1661, 10, '2014-08-12', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1662, 10, '2014-08-12', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1663, 10, '2014-08-13', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1664, 10, '2014-08-13', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1665, 10, '2014-08-14', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1666, 10, '2014-08-14', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1667, 10, '2014-08-15', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1668, 10, '2014-08-15', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1669, 10, '2014-08-16', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1670, 10, '2014-08-16', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1671, 10, '2014-08-17', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1672, 10, '2014-08-17', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1673, 10, '2014-08-18', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1674, 10, '2014-08-18', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1675, 10, '2014-08-19', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1676, 10, '2014-08-19', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1677, 10, '2014-08-20', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1678, 10, '2014-08-20', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1679, 10, '2014-08-21', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1680, 10, '2014-08-21', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1681, 10, '2014-08-22', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1682, 10, '2014-08-22', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1683, 10, '2014-08-23', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1684, 10, '2014-08-23', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1685, 10, '2014-08-24', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1686, 10, '2014-08-24', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1687, 10, '2014-08-25', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1688, 10, '2014-08-25', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1689, 10, '2014-08-26', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1690, 10, '2014-08-26', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1691, 10, '2014-08-27', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1692, 10, '2014-08-27', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1693, 10, '2014-08-28', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1694, 10, '2014-08-28', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1695, 10, '2014-08-29', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1696, 10, '2014-08-29', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1697, 10, '2014-08-30', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1698, 10, '2014-08-30', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1699, 10, '2014-08-31', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1700, 10, '2014-08-31', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(789, 10, '2014-09-01', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(790, 10, '2014-09-01', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(791, 10, '2014-09-02', 'vormittag', 'SCH', NULL, 'KAB', NULL),
(792, 10, '2014-09-02', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(793, 10, '2014-09-03', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(794, 10, '2014-09-03', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(795, 10, '2014-09-04', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(796, 10, '2014-09-04', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(797, 10, '2014-09-05', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(798, 10, '2014-09-05', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(799, 10, '2014-09-06', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(800, 10, '2014-09-06', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(801, 10, '2014-09-07', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(802, 10, '2014-09-07', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(803, 10, '2014-09-08', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(804, 10, '2014-09-08', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(805, 10, '2014-09-09', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(806, 10, '2014-09-09', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(807, 10, '2014-09-10', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(808, 10, '2014-09-10', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(809, 10, '2014-09-11', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(810, 10, '2014-09-11', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(811, 10, '2014-09-12', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(812, 10, '2014-09-12', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(813, 10, '2014-09-13', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(814, 10, '2014-09-13', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(815, 10, '2014-09-14', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(816, 10, '2014-09-14', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(817, 10, '2014-09-15', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(818, 10, '2014-09-15', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(819, 10, '2014-09-16', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(820, 10, '2014-09-16', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(821, 10, '2014-09-17', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(822, 10, '2014-09-17', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(823, 10, '2014-09-18', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(824, 10, '2014-09-18', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(825, 10, '2014-09-19', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(826, 10, '2014-09-19', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(827, 10, '2014-09-20', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(828, 10, '2014-09-20', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(829, 10, '2014-09-21', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(830, 10, '2014-09-21', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(831, 10, '2014-09-22', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(832, 10, '2014-09-22', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(833, 10, '2014-09-23', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(834, 10, '2014-09-23', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(835, 10, '2014-09-24', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(836, 10, '2014-09-24', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(837, 10, '2014-09-25', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(838, 10, '2014-09-25', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(839, 10, '2014-09-26', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(840, 10, '2014-09-26', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(841, 10, '2014-09-27', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(842, 10, '2014-09-27', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(843, 10, '2014-09-28', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(844, 10, '2014-09-28', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(845, 10, '2014-09-29', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(846, 10, '2014-09-29', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(847, 10, '2014-09-30', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(848, 10, '2014-09-30', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1455, 10, '2015-01-01', 'vormittag', NULL, NULL, 'KAB', NULL),
(1456, 10, '2015-01-01', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1457, 10, '2015-01-02', 'vormittag', NULL, NULL, 'KAB', NULL),
(1458, 10, '2015-01-02', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1459, 10, '2015-01-03', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1460, 10, '2015-01-03', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1461, 10, '2015-01-04', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1462, 10, '2015-01-04', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1463, 10, '2015-01-05', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1464, 10, '2015-01-05', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1465, 10, '2015-01-06', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1466, 10, '2015-01-06', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1467, 10, '2015-01-07', 'vormittag', NULL, NULL, 'KAB', NULL),
(1468, 10, '2015-01-07', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1469, 10, '2015-01-08', 'vormittag', NULL, NULL, 'KAB', NULL),
(1470, 10, '2015-01-08', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1471, 10, '2015-01-09', 'vormittag', NULL, NULL, 'KAB', NULL),
(1472, 10, '2015-01-09', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1473, 10, '2015-01-10', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1474, 10, '2015-01-10', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1475, 10, '2015-01-11', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1476, 10, '2015-01-11', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1477, 10, '2015-01-12', 'vormittag', NULL, NULL, 'KAB', NULL),
(1478, 10, '2015-01-12', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1479, 10, '2015-01-13', 'vormittag', NULL, NULL, 'KAB', NULL),
(1480, 10, '2015-01-13', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1481, 10, '2015-01-14', 'vormittag', NULL, NULL, 'KAB', NULL),
(1482, 10, '2015-01-14', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1483, 10, '2015-01-15', 'vormittag', NULL, NULL, 'KAB', NULL),
(1484, 10, '2015-01-15', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1485, 10, '2015-01-16', 'vormittag', NULL, NULL, 'KAB', NULL),
(1486, 10, '2015-01-16', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1487, 10, '2015-01-17', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1488, 10, '2015-01-17', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1489, 10, '2015-01-18', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1490, 10, '2015-01-18', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1491, 10, '2015-01-19', 'vormittag', NULL, NULL, 'KAB', NULL),
(1492, 10, '2015-01-19', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1493, 10, '2015-01-20', 'vormittag', NULL, NULL, 'KAB', NULL),
(1494, 10, '2015-01-20', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1495, 10, '2015-01-21', 'vormittag', NULL, NULL, 'KAB', NULL),
(1496, 10, '2015-01-21', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1497, 10, '2015-01-22', 'vormittag', NULL, NULL, 'KAB', NULL),
(1498, 10, '2015-01-22', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1499, 10, '2015-01-23', 'vormittag', NULL, NULL, 'KAB', NULL),
(1500, 10, '2015-01-23', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1501, 10, '2015-01-24', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1502, 10, '2015-01-24', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1503, 10, '2015-01-25', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1504, 10, '2015-01-25', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1505, 10, '2015-01-26', 'vormittag', NULL, NULL, 'KAB', NULL),
(1506, 10, '2015-01-26', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1507, 10, '2015-01-27', 'vormittag', NULL, NULL, 'KAB', NULL),
(1508, 10, '2015-01-27', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1509, 10, '2015-01-28', 'vormittag', NULL, NULL, 'KAB', NULL),
(1510, 10, '2015-01-28', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1511, 10, '2015-01-29', 'vormittag', NULL, NULL, 'KAB', NULL),
(1512, 10, '2015-01-29', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1513, 10, '2015-01-30', 'vormittag', NULL, NULL, 'KAB', NULL),
(1514, 10, '2015-01-30', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1515, 10, '2015-01-31', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1516, 10, '2015-01-31', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(971, 10, '2015-02-01', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(972, 10, '2015-02-01', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(973, 10, '2015-02-02', 'vormittag', NULL, NULL, 'KAB', NULL),
(974, 10, '2015-02-02', 'nachmittag', NULL, NULL, 'KAB', NULL),
(975, 10, '2015-02-03', 'vormittag', NULL, NULL, 'KAB', NULL),
(976, 10, '2015-02-03', 'nachmittag', NULL, NULL, 'KAB', NULL),
(977, 10, '2015-02-04', 'vormittag', NULL, NULL, 'KAB', NULL),
(978, 10, '2015-02-04', 'nachmittag', NULL, NULL, 'KAB', NULL),
(979, 10, '2015-02-05', 'vormittag', NULL, NULL, 'KAB', NULL),
(980, 10, '2015-02-05', 'nachmittag', NULL, NULL, 'KAB', NULL),
(981, 10, '2015-02-06', 'vormittag', NULL, NULL, 'KAB', NULL),
(982, 10, '2015-02-06', 'nachmittag', NULL, NULL, 'KAB', NULL),
(983, 10, '2015-02-07', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(984, 10, '2015-02-07', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(985, 10, '2015-02-08', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(986, 10, '2015-02-08', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(987, 10, '2015-02-09', 'vormittag', NULL, NULL, 'KAB', NULL),
(988, 10, '2015-02-09', 'nachmittag', NULL, NULL, 'KAB', NULL),
(989, 10, '2015-02-10', 'vormittag', NULL, NULL, 'KAB', NULL),
(990, 10, '2015-02-10', 'nachmittag', NULL, NULL, 'KAB', NULL),
(991, 10, '2015-02-11', 'vormittag', NULL, NULL, 'KAB', NULL),
(992, 10, '2015-02-11', 'nachmittag', NULL, NULL, 'KAB', NULL),
(993, 10, '2015-02-12', 'vormittag', NULL, NULL, 'KAB', NULL),
(994, 10, '2015-02-12', 'nachmittag', NULL, NULL, 'KAB', NULL),
(995, 10, '2015-02-13', 'vormittag', NULL, NULL, 'KAB', NULL),
(996, 10, '2015-02-13', 'nachmittag', NULL, NULL, 'KAB', NULL),
(997, 10, '2015-02-14', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(998, 10, '2015-02-14', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(999, 10, '2015-02-15', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1000, 10, '2015-02-15', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1001, 10, '2015-02-16', 'vormittag', NULL, NULL, 'KAB', NULL),
(1002, 10, '2015-02-16', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1003, 10, '2015-02-17', 'vormittag', NULL, NULL, 'KAB', NULL),
(1004, 10, '2015-02-17', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1005, 10, '2015-02-18', 'vormittag', NULL, NULL, 'KAB', NULL),
(1006, 10, '2015-02-18', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1007, 10, '2015-02-19', 'vormittag', NULL, NULL, 'KAB', NULL),
(1008, 10, '2015-02-19', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1009, 10, '2015-02-20', 'vormittag', NULL, NULL, 'KAB', NULL),
(1010, 10, '2015-02-20', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1011, 10, '2015-02-21', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1012, 10, '2015-02-21', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1013, 10, '2015-02-22', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1014, 10, '2015-02-22', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1015, 10, '2015-02-23', 'vormittag', NULL, NULL, 'KAB', NULL),
(1016, 10, '2015-02-23', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1017, 10, '2015-02-24', 'vormittag', NULL, NULL, 'KAB', NULL),
(1018, 10, '2015-02-24', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1019, 10, '2015-02-25', 'vormittag', NULL, NULL, 'KAB', NULL),
(1020, 10, '2015-02-25', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1021, 10, '2015-02-26', 'vormittag', NULL, NULL, 'KAB', NULL),
(1022, 10, '2015-02-26', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1023, 10, '2015-02-27', 'vormittag', 'SEM', NULL, 'KAB', NULL),
(1024, 10, '2015-02-27', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1025, 10, '2015-02-28', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1026, 10, '2015-02-28', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(727, 10, '2015-03-01', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(728, 10, '2015-03-01', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(729, 10, '2015-03-02', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(730, 10, '2015-03-02', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(731, 10, '2015-03-03', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(732, 10, '2015-03-03', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(733, 10, '2015-03-04', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(734, 10, '2015-03-04', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(735, 10, '2015-03-05', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(736, 10, '2015-03-05', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(737, 10, '2015-03-06', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(738, 10, '2015-03-06', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(739, 10, '2015-03-07', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(740, 10, '2015-03-07', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(741, 10, '2015-03-08', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(742, 10, '2015-03-08', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(743, 10, '2015-03-09', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(744, 10, '2015-03-09', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(745, 10, '2015-03-10', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(746, 10, '2015-03-10', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(747, 10, '2015-03-11', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(748, 10, '2015-03-11', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(749, 10, '2015-03-12', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(750, 10, '2015-03-12', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(751, 10, '2015-03-13', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(752, 10, '2015-03-13', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(753, 10, '2015-03-14', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(754, 10, '2015-03-14', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(755, 10, '2015-03-15', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(756, 10, '2015-03-15', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(757, 10, '2015-03-16', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(758, 10, '2015-03-16', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(759, 10, '2015-03-17', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(760, 10, '2015-03-17', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(761, 10, '2015-03-18', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(762, 10, '2015-03-18', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(763, 10, '2015-03-19', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(764, 10, '2015-03-19', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(765, 10, '2015-03-20', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(766, 10, '2015-03-20', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(767, 10, '2015-03-21', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(768, 10, '2015-03-21', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(769, 10, '2015-03-22', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(770, 10, '2015-03-22', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(771, 10, '2015-03-23', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(772, 10, '2015-03-23', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(773, 10, '2015-03-24', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(774, 10, '2015-03-24', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(775, 10, '2015-03-25', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(776, 10, '2015-03-25', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(777, 10, '2015-03-26', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(778, 10, '2015-03-26', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(779, 10, '2015-03-27', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(780, 10, '2015-03-27', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(781, 10, '2015-03-28', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(782, 10, '2015-03-28', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(783, 10, '2015-03-29', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(784, 10, '2015-03-29', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(785, 10, '2015-03-30', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(786, 10, '2015-03-30', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(787, 10, '2015-03-31', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(788, 10, '2015-03-31', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1702, 10, '2015-05-01', 'vormittag', NULL, NULL, 'KAB', NULL),
(1703, 10, '2015-05-01', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1704, 10, '2015-05-02', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1705, 10, '2015-05-02', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1706, 10, '2015-05-03', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1707, 10, '2015-05-03', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1708, 10, '2015-05-04', 'vormittag', 'SEM', NULL, 'KAB', NULL),
(1709, 10, '2015-05-04', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1710, 10, '2015-05-05', 'vormittag', NULL, NULL, 'KAB', NULL),
(1711, 10, '2015-05-05', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1712, 10, '2015-05-06', 'vormittag', NULL, NULL, 'KAB', NULL),
(1713, 10, '2015-05-06', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1714, 10, '2015-05-07', 'vormittag', NULL, NULL, 'KAB', NULL),
(1715, 10, '2015-05-07', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1716, 10, '2015-05-08', 'vormittag', NULL, NULL, 'KAB', NULL),
(1717, 10, '2015-05-08', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1718, 10, '2015-05-09', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1719, 10, '2015-05-09', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1720, 10, '2015-05-10', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1721, 10, '2015-05-10', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1722, 10, '2015-05-11', 'vormittag', NULL, NULL, 'KAB', NULL),
(1723, 10, '2015-05-11', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1724, 10, '2015-05-12', 'vormittag', NULL, NULL, 'KAB', NULL),
(1725, 10, '2015-05-12', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1726, 10, '2015-05-13', 'vormittag', NULL, NULL, 'KAB', NULL),
(1727, 10, '2015-05-13', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1728, 10, '2015-05-14', 'vormittag', NULL, NULL, 'KAB', NULL),
(1729, 10, '2015-05-14', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1730, 10, '2015-05-15', 'vormittag', NULL, NULL, 'KAB', NULL),
(1731, 10, '2015-05-15', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1732, 10, '2015-05-16', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1733, 10, '2015-05-16', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1734, 10, '2015-05-17', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1735, 10, '2015-05-17', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1736, 10, '2015-05-18', 'vormittag', NULL, NULL, 'KAB', NULL),
(1737, 10, '2015-05-18', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1738, 10, '2015-05-19', 'vormittag', NULL, NULL, 'KAB', NULL),
(1739, 10, '2015-05-19', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1740, 10, '2015-05-20', 'vormittag', NULL, NULL, 'KAB', NULL),
(1741, 10, '2015-05-20', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1742, 10, '2015-05-21', 'vormittag', NULL, NULL, 'KAB', NULL),
(1743, 10, '2015-05-21', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1744, 10, '2015-05-22', 'vormittag', NULL, NULL, 'KAB', NULL),
(1745, 10, '2015-05-22', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1746, 10, '2015-05-23', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1747, 10, '2015-05-23', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1748, 10, '2015-05-24', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1749, 10, '2015-05-24', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1750, 10, '2015-05-25', 'vormittag', NULL, NULL, 'KAB', NULL),
(1751, 10, '2015-05-25', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1752, 10, '2015-05-26', 'vormittag', NULL, NULL, 'KAB', NULL),
(1753, 10, '2015-05-26', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1754, 10, '2015-05-27', 'vormittag', NULL, NULL, 'KAB', NULL),
(1755, 10, '2015-05-27', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1756, 10, '2015-05-28', 'vormittag', NULL, NULL, 'KAB', NULL),
(1757, 10, '2015-05-28', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1758, 10, '2015-05-29', 'vormittag', NULL, NULL, 'KAB', NULL),
(1759, 10, '2015-05-29', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1760, 10, '2015-05-30', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1761, 10, '2015-05-30', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1762, 10, '2015-05-31', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1763, 10, '2015-05-31', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1764, 10, '2015-06-01', 'vormittag', NULL, NULL, 'KAB', NULL),
(1765, 10, '2015-06-01', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1766, 10, '2015-06-02', 'vormittag', NULL, NULL, 'KAB', NULL),
(1767, 10, '2015-06-02', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1768, 10, '2015-06-03', 'vormittag', NULL, NULL, 'KAB', NULL),
(1769, 10, '2015-06-03', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1770, 10, '2015-06-04', 'vormittag', NULL, NULL, 'KAB', NULL),
(1771, 10, '2015-06-04', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1772, 10, '2015-06-05', 'vormittag', NULL, NULL, 'KAB', NULL),
(1773, 10, '2015-06-05', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1774, 10, '2015-06-06', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1775, 10, '2015-06-06', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1776, 10, '2015-06-07', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1777, 10, '2015-06-07', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1778, 10, '2015-06-08', 'vormittag', NULL, NULL, 'KAB', NULL),
(1779, 10, '2015-06-08', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1780, 10, '2015-06-09', 'vormittag', NULL, NULL, 'KAB', NULL),
(1781, 10, '2015-06-09', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1782, 10, '2015-06-10', 'vormittag', NULL, NULL, 'KAB', NULL),
(1783, 10, '2015-06-10', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1784, 10, '2015-06-11', 'vormittag', NULL, NULL, 'KAB', NULL),
(1785, 10, '2015-06-11', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1786, 10, '2015-06-12', 'vormittag', NULL, NULL, 'KAB', NULL),
(1787, 10, '2015-06-12', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1788, 10, '2015-06-13', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1789, 10, '2015-06-13', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1790, 10, '2015-06-14', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1791, 10, '2015-06-14', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1792, 10, '2015-06-15', 'vormittag', NULL, NULL, 'KAB', NULL),
(1793, 10, '2015-06-15', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1794, 10, '2015-06-16', 'vormittag', NULL, NULL, 'KAB', NULL),
(1795, 10, '2015-06-16', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1796, 10, '2015-06-17', 'vormittag', 'STU', NULL, 'KAB', NULL),
(1797, 10, '2015-06-17', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1798, 10, '2015-06-18', 'vormittag', NULL, NULL, 'KAB', NULL),
(1799, 10, '2015-06-18', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1800, 10, '2015-06-19', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1801, 10, '2015-06-19', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1802, 10, '2015-06-20', 'vormittag', 'PRA', 'dsfgsdfg', 'KAB', NULL),
(1803, 10, '2015-06-20', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1804, 10, '2015-06-21', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1805, 10, '2015-06-21', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1806, 10, '2015-06-22', 'vormittag', NULL, NULL, 'KAB', NULL),
(1807, 10, '2015-06-22', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1808, 10, '2015-06-23', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1809, 10, '2015-06-23', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1810, 10, '2015-06-24', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1811, 10, '2015-06-24', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1812, 10, '2015-06-25', 'vormittag', NULL, NULL, 'KAB', NULL),
(1813, 10, '2015-06-25', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1814, 10, '2015-06-26', 'vormittag', NULL, NULL, 'KAB', NULL),
(1815, 10, '2015-06-26', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1816, 10, '2015-06-27', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1817, 10, '2015-06-27', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1818, 10, '2015-06-28', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1819, 10, '2015-06-28', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1820, 10, '2015-06-29', 'vormittag', NULL, NULL, 'KAB', NULL),
(1821, 10, '2015-06-29', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1822, 10, '2015-06-30', 'vormittag', NULL, NULL, 'KAB', NULL),
(1823, 10, '2015-06-30', 'nachmittag', NULL, NULL, 'KAB', NULL),
(2002, 10, '2015-11-01', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(2003, 10, '2015-11-01', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(2004, 10, '2015-11-02', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(2005, 10, '2015-11-02', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(2006, 10, '2015-11-03', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(2007, 10, '2015-11-03', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(2008, 10, '2015-11-04', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(2009, 10, '2015-11-04', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(2010, 10, '2015-11-05', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(2011, 10, '2015-11-05', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(2012, 10, '2015-11-06', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(2013, 10, '2015-11-06', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(2014, 10, '2015-11-07', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(2015, 10, '2015-11-07', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(2016, 10, '2015-11-08', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(2017, 10, '2015-11-08', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(2018, 10, '2015-11-09', 'vormittag', NULL, NULL, 'KAB', NULL),
(2019, 10, '2015-11-09', 'nachmittag', NULL, NULL, 'KAB', NULL),
(2020, 10, '2015-11-10', 'vormittag', NULL, NULL, 'KAB', NULL),
(2021, 10, '2015-11-10', 'nachmittag', NULL, NULL, 'KAB', NULL),
(2022, 10, '2015-11-11', 'vormittag', NULL, NULL, 'KAB', NULL),
(2023, 10, '2015-11-11', 'nachmittag', NULL, NULL, 'KAB', NULL),
(2024, 10, '2015-11-12', 'vormittag', NULL, NULL, 'KAB', NULL),
(2025, 10, '2015-11-12', 'nachmittag', NULL, NULL, 'KAB', NULL),
(2026, 10, '2015-11-13', 'vormittag', NULL, NULL, 'KAB', NULL),
(2027, 10, '2015-11-13', 'nachmittag', NULL, NULL, 'KAB', NULL),
(2028, 10, '2015-11-14', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(2029, 10, '2015-11-14', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(2030, 10, '2015-11-15', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(2031, 10, '2015-11-15', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(2032, 10, '2015-11-16', 'vormittag', NULL, NULL, 'KAB', NULL),
(2033, 10, '2015-11-16', 'nachmittag', NULL, NULL, 'KAB', NULL),
(2034, 10, '2015-11-17', 'vormittag', NULL, NULL, 'KAB', NULL),
(2035, 10, '2015-11-17', 'nachmittag', NULL, NULL, 'KAB', NULL),
(2036, 10, '2015-11-18', 'vormittag', NULL, NULL, 'KAB', NULL),
(2037, 10, '2015-11-18', 'nachmittag', NULL, NULL, 'KAB', NULL),
(2038, 10, '2015-11-19', 'vormittag', NULL, NULL, 'KAB', NULL),
(2039, 10, '2015-11-19', 'nachmittag', NULL, NULL, 'KAB', NULL),
(2040, 10, '2015-11-20', 'vormittag', NULL, NULL, 'KAB', NULL),
(2041, 10, '2015-11-20', 'nachmittag', NULL, NULL, 'KAB', NULL),
(2042, 10, '2015-11-21', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(2043, 10, '2015-11-21', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(2044, 10, '2015-11-22', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(2045, 10, '2015-11-22', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(2046, 10, '2015-11-23', 'vormittag', NULL, NULL, 'KAB', NULL),
(2047, 10, '2015-11-23', 'nachmittag', NULL, NULL, 'KAB', NULL),
(2048, 10, '2015-11-24', 'vormittag', NULL, NULL, 'KAB', NULL),
(2049, 10, '2015-11-24', 'nachmittag', NULL, NULL, 'KAB', NULL),
(2050, 10, '2015-11-25', 'vormittag', NULL, NULL, 'KAB', NULL),
(2051, 10, '2015-11-25', 'nachmittag', NULL, NULL, 'KAB', NULL),
(2052, 10, '2015-11-26', 'vormittag', NULL, NULL, 'KAB', NULL),
(2053, 10, '2015-11-26', 'nachmittag', NULL, NULL, 'KAB', NULL),
(2054, 10, '2015-11-27', 'vormittag', NULL, NULL, 'KAB', NULL),
(2055, 10, '2015-11-27', 'nachmittag', NULL, NULL, 'KAB', NULL),
(2056, 10, '2015-11-28', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(2057, 10, '2015-11-28', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(2058, 10, '2015-11-29', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(2059, 10, '2015-11-29', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(2060, 10, '2015-11-30', 'vormittag', NULL, NULL, 'KAB', NULL),
(2061, 10, '2015-11-30', 'nachmittag', NULL, NULL, 'KAB', NULL),
(609, 10, '2016-01-01', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(610, 10, '2016-01-01', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(611, 10, '2016-01-02', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(612, 10, '2016-01-02', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(613, 10, '2016-01-03', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(614, 10, '2016-01-03', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(615, 10, '2016-01-04', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(616, 10, '2016-01-04', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(617, 10, '2016-01-05', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(618, 10, '2016-01-05', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(619, 10, '2016-01-06', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(620, 10, '2016-01-06', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(621, 10, '2016-01-07', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(622, 10, '2016-01-07', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(623, 10, '2016-01-08', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(624, 10, '2016-01-08', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(625, 10, '2016-01-09', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(626, 10, '2016-01-09', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(627, 10, '2016-01-10', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(628, 10, '2016-01-10', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(629, 10, '2016-01-11', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(630, 10, '2016-01-11', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(631, 10, '2016-01-12', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(632, 10, '2016-01-12', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(633, 10, '2016-01-13', 'vormittag', 'SCH', NULL, 'KAB', NULL),
(634, 10, '2016-01-13', 'nachmittag', 'SCH', NULL, 'KAB', NULL),
(635, 10, '2016-01-14', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(636, 10, '2016-01-14', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(637, 10, '2016-01-15', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(638, 10, '2016-01-15', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(639, 10, '2016-01-16', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(640, 10, '2016-01-16', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(641, 10, '2016-01-17', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(642, 10, '2016-01-17', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(643, 10, '2016-01-18', 'vormittag', NULL, NULL, 'KAB', NULL),
(644, 10, '2016-01-18', 'nachmittag', NULL, NULL, 'KAB', NULL),
(645, 10, '2016-01-19', 'vormittag', NULL, NULL, 'KAB', NULL),
(646, 10, '2016-01-19', 'nachmittag', NULL, NULL, 'KAB', NULL),
(647, 10, '2016-01-20', 'vormittag', NULL, NULL, 'KAB', NULL),
(648, 10, '2016-01-20', 'nachmittag', NULL, NULL, 'KAB', NULL),
(649, 10, '2016-01-21', 'vormittag', NULL, NULL, 'KAB', NULL),
(650, 10, '2016-01-21', 'nachmittag', NULL, NULL, 'KAB', NULL),
(651, 10, '2016-01-22', 'vormittag', NULL, NULL, 'KAB', NULL),
(652, 10, '2016-01-22', 'nachmittag', NULL, NULL, 'KAB', NULL),
(653, 10, '2016-01-23', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(654, 10, '2016-01-23', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(655, 10, '2016-01-24', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(656, 10, '2016-01-24', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(657, 10, '2016-01-25', 'vormittag', NULL, NULL, 'KAB', NULL),
(658, 10, '2016-01-25', 'nachmittag', NULL, NULL, 'KAB', NULL),
(659, 10, '2016-01-26', 'vormittag', NULL, NULL, 'KAB', NULL),
(660, 10, '2016-01-26', 'nachmittag', NULL, NULL, 'KAB', NULL),
(661, 10, '2016-01-27', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(662, 10, '2016-01-27', 'nachmittag', NULL, NULL, 'KAB', NULL),
(663, 10, '2016-01-28', 'vormittag', NULL, NULL, 'KAB', NULL),
(664, 10, '2016-01-28', 'nachmittag', NULL, NULL, 'KAB', NULL),
(665, 10, '2016-01-29', 'vormittag', NULL, NULL, 'KAB', NULL),
(666, 10, '2016-01-29', 'nachmittag', NULL, NULL, 'KAB', NULL),
(667, 10, '2016-01-30', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(668, 10, '2016-01-30', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(669, 10, '2016-01-31', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(670, 10, '2016-01-31', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(551, 10, '2016-02-01', 'vormittag', NULL, NULL, 'KAB', NULL),
(552, 10, '2016-02-01', 'nachmittag', NULL, NULL, 'KAB', NULL),
(553, 10, '2016-02-02', 'vormittag', NULL, NULL, 'KAB', NULL),
(554, 10, '2016-02-02', 'nachmittag', NULL, NULL, 'KAB', NULL),
(555, 10, '2016-02-03', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(556, 10, '2016-02-03', 'nachmittag', NULL, NULL, 'KAB', NULL),
(557, 10, '2016-02-04', 'vormittag', NULL, NULL, 'KAB', NULL),
(558, 10, '2016-02-04', 'nachmittag', NULL, NULL, 'KAB', NULL),
(559, 10, '2016-02-05', 'vormittag', NULL, NULL, 'KAB', NULL),
(560, 10, '2016-02-05', 'nachmittag', NULL, NULL, 'KAB', NULL),
(561, 10, '2016-02-06', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(562, 10, '2016-02-06', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(563, 10, '2016-02-07', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(564, 10, '2016-02-07', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(565, 10, '2016-02-08', 'vormittag', NULL, NULL, 'KAB', NULL),
(566, 10, '2016-02-08', 'nachmittag', NULL, NULL, 'KAB', NULL),
(567, 10, '2016-02-09', 'vormittag', NULL, NULL, 'KAB', NULL),
(568, 10, '2016-02-09', 'nachmittag', NULL, NULL, 'KAB', NULL),
(569, 10, '2016-02-10', 'vormittag', NULL, NULL, 'KAB', NULL),
(570, 10, '2016-02-10', 'nachmittag', NULL, NULL, 'KAB', NULL),
(571, 10, '2016-02-11', 'vormittag', NULL, NULL, 'KAB', NULL),
(572, 10, '2016-02-11', 'nachmittag', NULL, NULL, 'KAB', NULL),
(573, 10, '2016-02-12', 'vormittag', NULL, NULL, 'KAB', NULL),
(574, 10, '2016-02-12', 'nachmittag', NULL, NULL, 'KAB', NULL),
(575, 10, '2016-02-13', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(576, 10, '2016-02-13', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(577, 10, '2016-02-14', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(578, 10, '2016-02-14', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(579, 10, '2016-02-15', 'vormittag', NULL, NULL, 'KAB', NULL),
(580, 10, '2016-02-15', 'nachmittag', NULL, NULL, 'KAB', NULL),
(581, 10, '2016-02-16', 'vormittag', NULL, NULL, 'KAB', NULL),
(582, 10, '2016-02-16', 'nachmittag', NULL, NULL, 'KAB', NULL),
(583, 10, '2016-02-17', 'vormittag', NULL, NULL, 'KAB', NULL),
(584, 10, '2016-02-17', 'nachmittag', NULL, NULL, 'KAB', NULL),
(585, 10, '2016-02-18', 'vormittag', NULL, NULL, 'KAB', NULL),
(586, 10, '2016-02-18', 'nachmittag', NULL, NULL, 'KAB', NULL),
(587, 10, '2016-02-19', 'vormittag', NULL, NULL, 'KAB', NULL),
(588, 10, '2016-02-19', 'nachmittag', NULL, NULL, 'KAB', NULL),
(589, 10, '2016-02-20', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(590, 10, '2016-02-20', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(591, 10, '2016-02-21', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(592, 10, '2016-02-21', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(593, 10, '2016-02-22', 'vormittag', NULL, NULL, 'KAB', NULL),
(594, 10, '2016-02-22', 'nachmittag', NULL, NULL, 'KAB', NULL),
(595, 10, '2016-02-23', 'vormittag', 'PRA', 'hallo', 'KAB', NULL),
(596, 10, '2016-02-23', 'nachmittag', NULL, NULL, 'KAB', NULL),
(597, 10, '2016-02-24', 'vormittag', NULL, NULL, 'KAB', NULL),
(598, 10, '2016-02-24', 'nachmittag', NULL, NULL, 'KAB', NULL),
(599, 10, '2016-02-25', 'vormittag', NULL, NULL, 'KAB', NULL),
(600, 10, '2016-02-25', 'nachmittag', NULL, NULL, 'KAB', NULL),
(601, 10, '2016-02-26', 'vormittag', NULL, NULL, 'KAB', NULL),
(602, 10, '2016-02-26', 'nachmittag', NULL, NULL, 'KAB', NULL),
(603, 10, '2016-02-27', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(604, 10, '2016-02-27', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(605, 10, '2016-02-28', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(606, 10, '2016-02-28', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(607, 10, '2016-02-29', 'vormittag', NULL, NULL, 'KAB', NULL),
(608, 10, '2016-02-29', 'nachmittag', NULL, NULL, 'KAB', NULL),
(429, 10, '2016-03-01', 'vormittag', NULL, NULL, 'KAB', NULL),
(430, 10, '2016-03-01', 'nachmittag', NULL, NULL, 'KAB', NULL),
(431, 10, '2016-03-02', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(432, 10, '2016-03-02', 'nachmittag', 'SCH', NULL, 'KAB', NULL),
(433, 10, '2016-03-03', 'vormittag', 'SEM', NULL, 'KAB', NULL),
(434, 10, '2016-03-03', 'nachmittag', 'SCH', NULL, 'KAB', NULL),
(435, 10, '2016-03-04', 'vormittag', 'SEM', NULL, 'KAB', NULL),
(436, 10, '2016-03-04', 'nachmittag', 'SCH', NULL, 'KAB', NULL),
(437, 10, '2016-03-05', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(438, 10, '2016-03-05', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(439, 10, '2016-03-06', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(440, 10, '2016-03-06', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(441, 10, '2016-03-07', 'vormittag', 'UEK', NULL, 'KAB', NULL),
(442, 10, '2016-03-07', 'nachmittag', NULL, NULL, 'KAB', NULL),
(443, 10, '2016-03-08', 'vormittag', NULL, NULL, 'KAB', NULL),
(444, 10, '2016-03-08', 'nachmittag', NULL, NULL, 'KAB', NULL),
(445, 10, '2016-03-09', 'vormittag', 'UEK', NULL, 'KAB', NULL),
(446, 10, '2016-03-09', 'nachmittag', NULL, NULL, 'KAB', NULL),
(447, 10, '2016-03-10', 'vormittag', NULL, NULL, 'KAB', NULL),
(448, 10, '2016-03-10', 'nachmittag', NULL, NULL, 'KAB', NULL),
(449, 10, '2016-03-11', 'vormittag', NULL, NULL, 'KAB', NULL),
(450, 10, '2016-03-11', 'nachmittag', NULL, NULL, 'KAB', NULL),
(451, 10, '2016-03-12', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(452, 10, '2016-03-12', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(453, 10, '2016-03-13', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(454, 10, '2016-03-13', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(455, 10, '2016-03-14', 'vormittag', NULL, NULL, 'KAB', NULL),
(456, 10, '2016-03-14', 'nachmittag', NULL, NULL, 'KAB', NULL),
(457, 10, '2016-03-15', 'vormittag', NULL, NULL, 'KAB', NULL),
(458, 10, '2016-03-15', 'nachmittag', NULL, NULL, 'KAB', NULL),
(459, 10, '2016-03-16', 'vormittag', 'SEM', NULL, 'KAB', NULL),
(460, 10, '2016-03-16', 'nachmittag', NULL, NULL, 'KAB', NULL),
(461, 10, '2016-03-17', 'vormittag', 'SEM', NULL, 'KAB', NULL),
(462, 10, '2016-03-17', 'nachmittag', NULL, NULL, 'KAB', NULL),
(463, 10, '2016-03-18', 'vormittag', NULL, NULL, 'KAB', NULL),
(464, 10, '2016-03-18', 'nachmittag', NULL, NULL, 'KAB', NULL),
(465, 10, '2016-03-19', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(466, 10, '2016-03-19', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(467, 10, '2016-03-20', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(468, 10, '2016-03-20', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(469, 10, '2016-03-21', 'vormittag', NULL, NULL, 'KAB', NULL),
(470, 10, '2016-03-21', 'nachmittag', NULL, NULL, 'KAB', NULL),
(471, 10, '2016-03-22', 'vormittag', NULL, NULL, 'KAB', NULL),
(472, 10, '2016-03-22', 'nachmittag', NULL, NULL, 'KAB', NULL),
(473, 10, '2016-03-23', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(474, 10, '2016-03-23', 'nachmittag', NULL, NULL, 'KAB', NULL),
(475, 10, '2016-03-24', 'vormittag', NULL, NULL, 'KAB', NULL),
(476, 10, '2016-03-24', 'nachmittag', NULL, NULL, 'KAB', NULL),
(477, 10, '2016-03-25', 'vormittag', NULL, NULL, 'KAB', NULL),
(478, 10, '2016-03-25', 'nachmittag', NULL, NULL, 'KAB', NULL),
(479, 10, '2016-03-26', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(480, 10, '2016-03-26', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(481, 10, '2016-03-27', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(482, 10, '2016-03-27', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(483, 10, '2016-03-28', 'vormittag', NULL, NULL, 'KAB', NULL),
(484, 10, '2016-03-28', 'nachmittag', NULL, NULL, 'KAB', NULL),
(485, 10, '2016-03-29', 'vormittag', NULL, NULL, 'KAB', NULL),
(486, 10, '2016-03-29', 'nachmittag', NULL, NULL, 'KAB', NULL),
(487, 10, '2016-03-30', 'vormittag', NULL, NULL, 'KAB', NULL),
(488, 10, '2016-03-30', 'nachmittag', NULL, NULL, 'KAB', NULL),
(489, 10, '2016-03-31', 'vormittag', NULL, NULL, 'KAB', NULL),
(490, 10, '2016-03-31', 'nachmittag', NULL, NULL, 'KAB', NULL),
(491, 10, '2016-04-01', 'vormittag', NULL, NULL, 'KAB', NULL),
(492, 10, '2016-04-01', 'nachmittag', NULL, NULL, 'KAB', NULL),
(493, 10, '2016-04-02', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(494, 10, '2016-04-02', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(495, 10, '2016-04-03', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(496, 10, '2016-04-03', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(497, 10, '2016-04-04', 'vormittag', NULL, NULL, 'KAB', NULL),
(498, 10, '2016-04-04', 'nachmittag', NULL, NULL, 'KAB', NULL),
(499, 10, '2016-04-05', 'vormittag', NULL, NULL, 'KAB', NULL),
(500, 10, '2016-04-05', 'nachmittag', NULL, NULL, 'KAB', NULL),
(501, 10, '2016-04-06', 'vormittag', NULL, NULL, 'KAB', NULL),
(502, 10, '2016-04-06', 'nachmittag', NULL, NULL, 'KAB', NULL),
(503, 10, '2016-04-07', 'vormittag', NULL, NULL, 'KAB', NULL),
(504, 10, '2016-04-07', 'nachmittag', NULL, NULL, 'KAB', NULL),
(505, 10, '2016-04-08', 'vormittag', NULL, NULL, 'KAB', NULL),
(506, 10, '2016-04-08', 'nachmittag', NULL, NULL, 'KAB', NULL),
(507, 10, '2016-04-09', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(508, 10, '2016-04-09', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(509, 10, '2016-04-10', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(510, 10, '2016-04-10', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(511, 10, '2016-04-11', 'vormittag', NULL, NULL, 'KAB', NULL),
(512, 10, '2016-04-11', 'nachmittag', NULL, NULL, 'KAB', NULL),
(513, 10, '2016-04-12', 'vormittag', NULL, NULL, 'KAB', NULL),
(514, 10, '2016-04-12', 'nachmittag', NULL, NULL, 'KAB', NULL),
(515, 10, '2016-04-13', 'vormittag', NULL, NULL, 'KAB', NULL),
(516, 10, '2016-04-13', 'nachmittag', NULL, NULL, 'KAB', NULL),
(517, 10, '2016-04-14', 'vormittag', NULL, NULL, 'KAB', NULL),
(518, 10, '2016-04-14', 'nachmittag', NULL, NULL, 'KAB', NULL),
(519, 10, '2016-04-15', 'vormittag', NULL, NULL, 'KAB', NULL),
(520, 10, '2016-04-15', 'nachmittag', NULL, NULL, 'KAB', NULL),
(521, 10, '2016-04-16', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(522, 10, '2016-04-16', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(523, 10, '2016-04-17', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(524, 10, '2016-04-17', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(525, 10, '2016-04-18', 'vormittag', NULL, NULL, 'KAB', NULL),
(526, 10, '2016-04-18', 'nachmittag', NULL, NULL, 'KAB', NULL),
(527, 10, '2016-04-19', 'vormittag', NULL, NULL, 'KAB', NULL),
(528, 10, '2016-04-19', 'nachmittag', NULL, NULL, 'KAB', NULL),
(529, 10, '2016-04-20', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(530, 10, '2016-04-20', 'nachmittag', NULL, NULL, 'KAB', NULL),
(531, 10, '2016-04-21', 'vormittag', NULL, NULL, 'KAB', NULL),
(532, 10, '2016-04-21', 'nachmittag', NULL, NULL, 'KAB', NULL),
(533, 10, '2016-04-22', 'vormittag', NULL, NULL, 'KAB', NULL),
(534, 10, '2016-04-22', 'nachmittag', NULL, NULL, 'KAB', NULL),
(535, 10, '2016-04-23', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(536, 10, '2016-04-23', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(537, 10, '2016-04-24', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(538, 10, '2016-04-24', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(539, 10, '2016-04-25', 'vormittag', NULL, NULL, 'KAB', NULL),
(540, 10, '2016-04-25', 'nachmittag', NULL, NULL, 'KAB', NULL),
(541, 10, '2016-04-26', 'vormittag', NULL, NULL, 'KAB', NULL),
(542, 10, '2016-04-26', 'nachmittag', NULL, NULL, 'KAB', NULL),
(543, 10, '2016-04-27', 'vormittag', NULL, NULL, 'KAB', NULL),
(544, 10, '2016-04-27', 'nachmittag', NULL, NULL, 'KAB', NULL),
(545, 10, '2016-04-28', 'vormittag', NULL, NULL, 'KAB', NULL),
(546, 10, '2016-04-28', 'nachmittag', NULL, NULL, 'KAB', NULL),
(547, 10, '2016-04-29', 'vormittag', NULL, NULL, 'KAB', NULL),
(548, 10, '2016-04-29', 'nachmittag', NULL, NULL, 'KAB', NULL),
(549, 10, '2016-04-30', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(550, 10, '2016-04-30', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(2066, 10, '2016-08-01', 'vormittag', 'PRA', '', 'KAB', NULL),
(2067, 10, '2016-08-01', 'nachmittag', 'PRA', '', 'KAB', NULL),
(2068, 10, '2016-08-02', 'vormittag', 'PRA', '', 'KAB', NULL),
(2069, 10, '2016-08-02', 'nachmittag', 'PRA', '', 'KAB', NULL),
(2070, 10, '2016-08-03', 'vormittag', 'PRA', '', 'KAB', NULL),
(2071, 10, '2016-08-03', 'nachmittag', 'PRA', '', 'KAB', NULL),
(2072, 10, '2016-08-04', 'vormittag', 'PRA', '', 'KAB', NULL),
(2073, 10, '2016-08-04', 'nachmittag', 'PRA', '', 'KAB', NULL),
(2074, 10, '2016-08-05', 'vormittag', 'PRA', '', 'KAB', NULL),
(2075, 10, '2016-08-05', 'nachmittag', 'PRA', '', 'KAB', NULL),
(2076, 10, '2016-08-06', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(2077, 10, '2016-08-06', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(2078, 10, '2016-08-07', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(2079, 10, '2016-08-07', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(2080, 10, '2016-08-08', 'vormittag', 'PRA', '', 'KAB', NULL),
(2081, 10, '2016-08-08', 'nachmittag', 'PRA', '', 'KAB', NULL),
(2082, 10, '2016-08-09', 'vormittag', 'PRA', '', 'KAB', NULL),
(2083, 10, '2016-08-09', 'nachmittag', 'PRA', '', 'KAB', NULL),
(2084, 10, '2016-08-10', 'vormittag', 'PRA', '', 'KAB', NULL),
(2085, 10, '2016-08-10', 'nachmittag', 'PRA', '', 'KAB', NULL),
(2086, 10, '2016-08-11', 'vormittag', 'PRA', '', 'KAB', NULL),
(2087, 10, '2016-08-11', 'nachmittag', 'PRA', '', 'KAB', NULL),
(2088, 10, '2016-08-12', 'vormittag', 'PRA', '', 'KAB', NULL),
(2089, 10, '2016-08-12', 'nachmittag', 'PRA', '', 'KAB', NULL),
(2090, 10, '2016-08-13', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(2091, 10, '2016-08-13', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(2092, 10, '2016-08-14', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(2093, 10, '2016-08-14', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(2094, 10, '2016-08-15', 'vormittag', 'PRA', '', 'KAB', NULL),
(2095, 10, '2016-08-15', 'nachmittag', 'PRA', '', 'KAB', NULL),
(2096, 10, '2016-08-16', 'vormittag', 'PRA', '', 'KAB', NULL),
(2097, 10, '2016-08-16', 'nachmittag', 'PRA', '', 'KAB', NULL),
(2098, 10, '2016-08-17', 'vormittag', 'PRA', '', 'KAB', NULL),
(2099, 10, '2016-08-17', 'nachmittag', 'PRA', '', 'KAB', NULL),
(2100, 10, '2016-08-18', 'vormittag', 'PRA', '', 'KAB', NULL),
(2101, 10, '2016-08-18', 'nachmittag', 'PRA', '', 'KAB', NULL),
(2102, 10, '2016-08-19', 'vormittag', 'PRA', '', 'KAB', NULL),
(2103, 10, '2016-08-19', 'nachmittag', 'PRA', '', 'KAB', NULL),
(2104, 10, '2016-08-20', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(2105, 10, '2016-08-20', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(2106, 10, '2016-08-21', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(2107, 10, '2016-08-21', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(2108, 10, '2016-08-22', 'vormittag', 'PRA', '', 'KAB', NULL),
(2109, 10, '2016-08-22', 'nachmittag', 'PRA', '', 'KAB', NULL),
(2110, 10, '2016-08-23', 'vormittag', 'PRA', '', 'KAB', NULL),
(2111, 10, '2016-08-23', 'nachmittag', 'PRA', '', 'KAB', NULL),
(2112, 10, '2016-08-24', 'vormittag', 'PRA', '', 'KAB', NULL),
(2113, 10, '2016-08-24', 'nachmittag', 'PRA', '', 'KAB', NULL),
(2114, 10, '2016-08-25', 'vormittag', 'PRA', '', 'KAB', NULL),
(2115, 10, '2016-08-25', 'nachmittag', 'PRA', '', 'KAB', NULL),
(2116, 10, '2016-08-26', 'vormittag', 'PRA', '', 'KAB', NULL),
(2117, 10, '2016-08-26', 'nachmittag', 'PRA', '', 'KAB', NULL),
(2118, 10, '2016-08-27', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(2119, 10, '2016-08-27', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(2120, 10, '2016-08-28', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(2121, 10, '2016-08-28', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(2122, 10, '2016-08-29', 'vormittag', 'PRA', '', 'KAB', NULL),
(2123, 10, '2016-08-29', 'nachmittag', 'PRA', '', 'KAB', NULL),
(2124, 10, '2016-08-30', 'vormittag', 'PRA', '', 'KAB', NULL),
(2125, 10, '2016-08-30', 'nachmittag', 'PRA', '', 'KAB', NULL),
(2126, 10, '2016-08-31', 'vormittag', 'PRA', '', 'KAB', NULL),
(2127, 10, '2016-08-31', 'nachmittag', 'PRA', '', 'KAB', NULL),
(1579, 10, '2016-09-01', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1580, 10, '2016-09-01', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1581, 10, '2016-09-02', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1582, 10, '2016-09-02', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1583, 10, '2016-09-03', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1584, 10, '2016-09-03', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1585, 10, '2016-09-04', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1586, 10, '2016-09-04', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1587, 10, '2016-09-05', 'vormittag', 'PRA', NULL, 'KAB', NULL);
INSERT INTO `halbtag` (`id`, `lehrling`, `tag`, `halbtag`, `taetigkeit`, `taetigkeit_kommentar`, `absenz`, `absenz_kommentar`) VALUES
(1588, 10, '2016-09-05', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1589, 10, '2016-09-06', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1590, 10, '2016-09-06', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1591, 10, '2016-09-07', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1592, 10, '2016-09-07', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1593, 10, '2016-09-08', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1594, 10, '2016-09-08', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1595, 10, '2016-09-09', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1596, 10, '2016-09-09', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1597, 10, '2016-09-10', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1598, 10, '2016-09-10', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1599, 10, '2016-09-11', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1600, 10, '2016-09-11', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1601, 10, '2016-09-12', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1602, 10, '2016-09-12', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1603, 10, '2016-09-13', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1604, 10, '2016-09-13', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1605, 10, '2016-09-14', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1606, 10, '2016-09-14', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1607, 10, '2016-09-15', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1608, 10, '2016-09-15', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1609, 10, '2016-09-16', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1610, 10, '2016-09-16', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1611, 10, '2016-09-17', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1612, 10, '2016-09-17', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1613, 10, '2016-09-18', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1614, 10, '2016-09-18', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1615, 10, '2016-09-19', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1616, 10, '2016-09-19', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1617, 10, '2016-09-20', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1618, 10, '2016-09-20', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1619, 10, '2016-09-21', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1620, 10, '2016-09-21', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1621, 10, '2016-09-22', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1622, 10, '2016-09-22', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1623, 10, '2016-09-23', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1624, 10, '2016-09-23', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1625, 10, '2016-09-24', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1626, 10, '2016-09-24', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1627, 10, '2016-09-25', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1628, 10, '2016-09-25', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1629, 10, '2016-09-26', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1630, 10, '2016-09-26', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1631, 10, '2016-09-27', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1632, 10, '2016-09-27', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1633, 10, '2016-09-28', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1634, 10, '2016-09-28', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1635, 10, '2016-09-29', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1636, 10, '2016-09-29', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1637, 10, '2016-09-30', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1638, 10, '2016-09-30', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1517, 10, '2016-10-01', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1518, 10, '2016-10-01', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1519, 10, '2016-10-02', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1520, 10, '2016-10-02', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1521, 10, '2016-10-03', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1522, 10, '2016-10-03', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1523, 10, '2016-10-04', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1524, 10, '2016-10-04', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1525, 10, '2016-10-05', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1526, 10, '2016-10-05', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1527, 10, '2016-10-06', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1528, 10, '2016-10-06', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1529, 10, '2016-10-07', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1530, 10, '2016-10-07', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1531, 10, '2016-10-08', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1532, 10, '2016-10-08', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1533, 10, '2016-10-09', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1534, 10, '2016-10-09', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1535, 10, '2016-10-10', 'vormittag', 'UEK', NULL, 'KAB', NULL),
(1536, 10, '2016-10-10', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1537, 10, '2016-10-11', 'vormittag', 'UEK', NULL, 'KAB', NULL),
(1538, 10, '2016-10-11', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1539, 10, '2016-10-12', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1540, 10, '2016-10-12', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1541, 10, '2016-10-13', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1542, 10, '2016-10-13', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1543, 10, '2016-10-14', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1544, 10, '2016-10-14', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1545, 10, '2016-10-15', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1546, 10, '2016-10-15', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1547, 10, '2016-10-16', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1548, 10, '2016-10-16', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1549, 10, '2016-10-17', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1550, 10, '2016-10-17', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1551, 10, '2016-10-18', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1552, 10, '2016-10-18', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1553, 10, '2016-10-19', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1554, 10, '2016-10-19', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1555, 10, '2016-10-20', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1556, 10, '2016-10-20', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1557, 10, '2016-10-21', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1558, 10, '2016-10-21', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1559, 10, '2016-10-22', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1560, 10, '2016-10-22', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1561, 10, '2016-10-23', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1562, 10, '2016-10-23', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1563, 10, '2016-10-24', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1564, 10, '2016-10-24', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1565, 10, '2016-10-25', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1566, 10, '2016-10-25', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1567, 10, '2016-10-26', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1568, 10, '2016-10-26', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1569, 10, '2016-10-27', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1570, 10, '2016-10-27', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1571, 10, '2016-10-28', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1572, 10, '2016-10-28', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1573, 10, '2016-10-29', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1574, 10, '2016-10-29', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1575, 10, '2016-10-30', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1576, 10, '2016-10-30', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1577, 10, '2016-10-31', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1578, 10, '2016-10-31', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(911, 10, '2016-11-01', 'vormittag', NULL, NULL, 'KAB', NULL),
(912, 10, '2016-11-01', 'nachmittag', NULL, NULL, 'KAB', NULL),
(913, 10, '2016-11-02', 'vormittag', NULL, NULL, 'KAB', NULL),
(914, 10, '2016-11-02', 'nachmittag', NULL, NULL, 'KAB', NULL),
(915, 10, '2016-11-03', 'vormittag', 'STU', NULL, 'KAB', NULL),
(916, 10, '2016-11-03', 'nachmittag', NULL, NULL, 'KAB', NULL),
(917, 10, '2016-11-04', 'vormittag', NULL, NULL, 'KAB', NULL),
(918, 10, '2016-11-04', 'nachmittag', NULL, NULL, 'KAB', NULL),
(919, 10, '2016-11-05', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(920, 10, '2016-11-05', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(921, 10, '2016-11-06', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(922, 10, '2016-11-06', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(923, 10, '2016-11-07', 'vormittag', NULL, NULL, 'KAB', NULL),
(924, 10, '2016-11-07', 'nachmittag', NULL, NULL, 'KAB', NULL),
(925, 10, '2016-11-08', 'vormittag', NULL, NULL, 'KAB', NULL),
(926, 10, '2016-11-08', 'nachmittag', NULL, NULL, 'KAB', NULL),
(927, 10, '2016-11-09', 'vormittag', NULL, NULL, 'KAB', NULL),
(928, 10, '2016-11-09', 'nachmittag', NULL, NULL, 'KAB', NULL),
(929, 10, '2016-11-10', 'vormittag', NULL, NULL, 'KAB', NULL),
(930, 10, '2016-11-10', 'nachmittag', NULL, NULL, 'KAB', NULL),
(931, 10, '2016-11-11', 'vormittag', NULL, NULL, 'KAB', NULL),
(932, 10, '2016-11-11', 'nachmittag', NULL, NULL, 'KAB', NULL),
(933, 10, '2016-11-12', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(934, 10, '2016-11-12', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(935, 10, '2016-11-13', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(936, 10, '2016-11-13', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(937, 10, '2016-11-14', 'vormittag', NULL, NULL, 'KAB', NULL),
(938, 10, '2016-11-14', 'nachmittag', NULL, NULL, 'KAB', NULL),
(939, 10, '2016-11-15', 'vormittag', NULL, NULL, 'KAB', NULL),
(940, 10, '2016-11-15', 'nachmittag', NULL, NULL, 'KAB', NULL),
(941, 10, '2016-11-16', 'vormittag', NULL, NULL, 'KAB', NULL),
(942, 10, '2016-11-16', 'nachmittag', NULL, NULL, 'KAB', NULL),
(943, 10, '2016-11-17', 'vormittag', NULL, NULL, 'KAB', NULL),
(944, 10, '2016-11-17', 'nachmittag', NULL, NULL, 'KAB', NULL),
(945, 10, '2016-11-18', 'vormittag', NULL, NULL, 'KAB', NULL),
(946, 10, '2016-11-18', 'nachmittag', NULL, NULL, 'KAB', NULL),
(947, 10, '2016-11-19', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(948, 10, '2016-11-19', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(949, 10, '2016-11-20', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(950, 10, '2016-11-20', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(951, 10, '2016-11-21', 'vormittag', NULL, NULL, 'KAB', NULL),
(952, 10, '2016-11-21', 'nachmittag', NULL, NULL, 'KAB', NULL),
(953, 10, '2016-11-22', 'vormittag', NULL, NULL, 'KAB', NULL),
(954, 10, '2016-11-22', 'nachmittag', NULL, NULL, 'KAB', NULL),
(955, 10, '2016-11-23', 'vormittag', NULL, NULL, 'KAB', NULL),
(956, 10, '2016-11-23', 'nachmittag', NULL, NULL, 'KAB', NULL),
(957, 10, '2016-11-24', 'vormittag', NULL, NULL, 'KAB', NULL),
(958, 10, '2016-11-24', 'nachmittag', NULL, NULL, 'KAB', NULL),
(959, 10, '2016-11-25', 'vormittag', NULL, NULL, 'KAB', NULL),
(960, 10, '2016-11-25', 'nachmittag', NULL, NULL, 'KAB', NULL),
(961, 10, '2016-11-26', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(962, 10, '2016-11-26', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(963, 10, '2016-11-27', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(964, 10, '2016-11-27', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(965, 10, '2016-11-28', 'vormittag', NULL, NULL, 'KAB', NULL),
(966, 10, '2016-11-28', 'nachmittag', NULL, NULL, 'KAB', NULL),
(967, 10, '2016-11-29', 'vormittag', NULL, NULL, 'KAB', NULL),
(968, 10, '2016-11-29', 'nachmittag', NULL, NULL, 'KAB', NULL),
(969, 10, '2016-11-30', 'vormittag', NULL, NULL, 'KAB', NULL),
(970, 10, '2016-11-30', 'nachmittag', NULL, NULL, 'KAB', NULL),
(849, 10, '2016-12-01', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(850, 10, '2016-12-01', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(851, 10, '2016-12-02', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(852, 10, '2016-12-02', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(853, 10, '2016-12-03', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(854, 10, '2016-12-03', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(855, 10, '2016-12-04', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(856, 10, '2016-12-04', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(857, 10, '2016-12-05', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(858, 10, '2016-12-05', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(859, 10, '2016-12-06', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(860, 10, '2016-12-06', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(861, 10, '2016-12-07', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(862, 10, '2016-12-07', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(863, 10, '2016-12-08', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(864, 10, '2016-12-08', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(865, 10, '2016-12-09', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(866, 10, '2016-12-09', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(867, 10, '2016-12-10', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(868, 10, '2016-12-10', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(869, 10, '2016-12-11', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(870, 10, '2016-12-11', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(871, 10, '2016-12-12', 'vormittag', NULL, NULL, 'KAB', NULL),
(872, 10, '2016-12-12', 'nachmittag', NULL, NULL, 'KAB', NULL),
(873, 10, '2016-12-13', 'vormittag', NULL, NULL, 'KAB', NULL),
(874, 10, '2016-12-13', 'nachmittag', NULL, NULL, 'KAB', NULL),
(875, 10, '2016-12-14', 'vormittag', NULL, NULL, 'KAB', NULL),
(876, 10, '2016-12-14', 'nachmittag', NULL, NULL, 'KAB', NULL),
(877, 10, '2016-12-15', 'vormittag', NULL, NULL, 'KAB', NULL),
(878, 10, '2016-12-15', 'nachmittag', NULL, NULL, 'KAB', NULL),
(879, 10, '2016-12-16', 'vormittag', NULL, NULL, 'KAB', NULL),
(880, 10, '2016-12-16', 'nachmittag', NULL, NULL, 'KAB', NULL),
(881, 10, '2016-12-17', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(882, 10, '2016-12-17', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(883, 10, '2016-12-18', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(884, 10, '2016-12-18', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(885, 10, '2016-12-19', 'vormittag', NULL, NULL, 'KAB', NULL),
(886, 10, '2016-12-19', 'nachmittag', NULL, NULL, 'KAB', NULL),
(887, 10, '2016-12-20', 'vormittag', NULL, NULL, 'KAB', NULL),
(888, 10, '2016-12-20', 'nachmittag', NULL, NULL, 'KAB', NULL),
(889, 10, '2016-12-21', 'vormittag', 'UEK', NULL, 'KAB', NULL),
(890, 10, '2016-12-21', 'nachmittag', NULL, NULL, 'KAB', NULL),
(891, 10, '2016-12-22', 'vormittag', NULL, NULL, 'KAB', NULL),
(892, 10, '2016-12-22', 'nachmittag', NULL, NULL, 'KAB', NULL),
(893, 10, '2016-12-23', 'vormittag', NULL, NULL, 'KAB', NULL),
(894, 10, '2016-12-23', 'nachmittag', NULL, NULL, 'KAB', NULL),
(895, 10, '2016-12-24', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(896, 10, '2016-12-24', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(897, 10, '2016-12-25', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(898, 10, '2016-12-25', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(899, 10, '2016-12-26', 'vormittag', NULL, NULL, 'KAB', NULL),
(900, 10, '2016-12-26', 'nachmittag', NULL, NULL, 'KAB', NULL),
(901, 10, '2016-12-27', 'vormittag', 'PRA', NULL, 'MIL', NULL),
(902, 10, '2016-12-27', 'nachmittag', 'PRA', NULL, 'MIL', NULL),
(903, 10, '2016-12-28', 'vormittag', 'PRA', NULL, 'MIL', NULL),
(904, 10, '2016-12-28', 'nachmittag', 'PRA', NULL, 'MIL', NULL),
(905, 10, '2016-12-29', 'vormittag', 'PRA', NULL, 'FER', NULL),
(906, 10, '2016-12-29', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(907, 10, '2016-12-30', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(908, 10, '2016-12-30', 'nachmittag', NULL, NULL, 'KAB', NULL),
(909, 10, '2016-12-31', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(910, 10, '2016-12-31', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(367, 10, '2017-01-01', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(368, 10, '2017-01-01', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(369, 10, '2017-01-02', 'vormittag', 'UEK', NULL, 'KAB', NULL),
(370, 10, '2017-01-02', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(371, 10, '2017-01-03', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(372, 10, '2017-01-03', 'nachmittag', 'PEI', NULL, 'KAB', NULL),
(373, 10, '2017-01-04', 'vormittag', 'UEK', NULL, 'KAB', NULL),
(374, 10, '2017-01-04', 'nachmittag', 'PEI', NULL, 'KAB', NULL),
(375, 10, '2017-01-05', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(376, 10, '2017-01-05', 'nachmittag', 'SCH', NULL, 'KAB', NULL),
(377, 10, '2017-01-06', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(378, 10, '2017-01-06', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(379, 10, '2017-01-07', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(380, 10, '2017-01-07', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(381, 10, '2017-01-08', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(382, 10, '2017-01-08', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(383, 10, '2017-01-09', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(384, 10, '2017-01-09', 'nachmittag', 'SEM', NULL, 'KAB', NULL),
(385, 10, '2017-01-10', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(386, 10, '2017-01-10', 'nachmittag', 'PEI', NULL, 'KAB', NULL),
(387, 10, '2017-01-11', 'vormittag', 'SCH', NULL, 'KAB', NULL),
(388, 10, '2017-01-11', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(389, 10, '2017-01-12', 'vormittag', 'SCH', NULL, 'KAB', NULL),
(390, 10, '2017-01-12', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(391, 10, '2017-01-13', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(392, 10, '2017-01-13', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(393, 10, '2017-01-14', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(394, 10, '2017-01-14', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(395, 10, '2017-01-15', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(396, 10, '2017-01-15', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(397, 10, '2017-01-16', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(398, 10, '2017-01-16', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(399, 10, '2017-01-17', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(400, 10, '2017-01-17', 'nachmittag', 'STU', NULL, 'KAB', NULL),
(401, 10, '2017-01-18', 'vormittag', 'UEK', NULL, 'KAB', NULL),
(402, 10, '2017-01-18', 'nachmittag', 'UEK', NULL, 'KAB', NULL),
(403, 10, '2017-01-19', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(404, 10, '2017-01-19', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(405, 10, '2017-01-20', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(406, 10, '2017-01-20', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(407, 10, '2017-01-21', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(408, 10, '2017-01-21', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(409, 10, '2017-01-22', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(410, 10, '2017-01-22', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(411, 10, '2017-01-23', 'vormittag', 'SCH', NULL, 'KAB', NULL),
(412, 10, '2017-01-23', 'nachmittag', 'UEK', NULL, 'KAB', NULL),
(413, 10, '2017-01-24', 'vormittag', 'SCH', NULL, 'KAB', NULL),
(414, 10, '2017-01-24', 'nachmittag', 'UEK', NULL, 'KAB', NULL),
(415, 10, '2017-01-25', 'vormittag', 'SEM', NULL, 'KAB', NULL),
(416, 10, '2017-01-25', 'nachmittag', 'SEM', NULL, 'KAB', NULL),
(417, 10, '2017-01-26', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(418, 10, '2017-01-26', 'nachmittag', 'SCH', 'Düdd', 'KAB', NULL),
(419, 10, '2017-01-27', 'vormittag', 'SEM', NULL, 'KAB', NULL),
(420, 10, '2017-01-27', 'nachmittag', 'SCH', NULL, 'KAB', NULL),
(421, 10, '2017-01-28', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(422, 10, '2017-01-28', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(423, 10, '2017-01-29', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(424, 10, '2017-01-29', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(425, 10, '2017-01-30', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(426, 10, '2017-01-30', 'nachmittag', 'SCH', NULL, 'KAB', NULL),
(427, 10, '2017-01-31', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(428, 10, '2017-01-31', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(671, 10, '2017-02-01', 'vormittag', 'KAR', '', 'KAB', NULL),
(672, 10, '2017-02-01', 'nachmittag', 'KAR', '', 'KAB', NULL),
(673, 10, '2017-02-02', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(674, 10, '2017-02-02', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(675, 10, '2017-02-03', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(676, 10, '2017-02-03', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(677, 10, '2017-02-04', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(678, 10, '2017-02-04', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(679, 10, '2017-02-05', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(680, 10, '2017-02-05', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(681, 10, '2017-02-06', 'vormittag', 'PRA', NULL, 'FER', NULL),
(682, 10, '2017-02-06', 'nachmittag', 'PRA', NULL, 'FER', NULL),
(683, 10, '2017-02-07', 'vormittag', 'PRA', NULL, 'KAB', ''),
(684, 10, '2017-02-07', 'nachmittag', 'PRA', NULL, 'KAB', ''),
(685, 10, '2017-02-08', 'vormittag', 'PRA', NULL, 'FER', NULL),
(686, 10, '2017-02-08', 'nachmittag', 'PRA', NULL, 'FER', NULL),
(687, 10, '2017-02-09', 'vormittag', 'PRA', NULL, 'FER', NULL),
(688, 10, '2017-02-09', 'nachmittag', 'PRA', NULL, 'FER', NULL),
(689, 10, '2017-02-10', 'vormittag', 'PRA', NULL, 'FER', NULL),
(690, 10, '2017-02-10', 'nachmittag', 'PRA', NULL, 'FER', NULL),
(691, 10, '2017-02-11', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(692, 10, '2017-02-11', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(693, 10, '2017-02-12', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(694, 10, '2017-02-12', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(695, 10, '2017-02-13', 'vormittag', 'PRA', NULL, 'KRA', NULL),
(696, 10, '2017-02-13', 'nachmittag', 'PRA', NULL, 'KRA', NULL),
(697, 10, '2017-02-14', 'vormittag', 'PRA', NULL, 'KRA', NULL),
(698, 10, '2017-02-14', 'nachmittag', 'PRA', NULL, 'KRA', NULL),
(699, 10, '2017-02-15', 'vormittag', 'PRA', NULL, 'KRA', NULL),
(700, 10, '2017-02-15', 'nachmittag', 'PRA', NULL, 'KRA', NULL),
(701, 10, '2017-02-16', 'vormittag', 'PRA', NULL, 'KRA', NULL),
(702, 10, '2017-02-16', 'nachmittag', 'PRA', NULL, 'KRA', NULL),
(703, 10, '2017-02-17', 'vormittag', 'PRA', NULL, 'KRA', NULL),
(704, 10, '2017-02-17', 'nachmittag', 'PRA', NULL, 'KRA', NULL),
(705, 10, '2017-02-18', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(706, 10, '2017-02-18', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(707, 10, '2017-02-19', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(708, 10, '2017-02-19', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(709, 10, '2017-02-20', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(710, 10, '2017-02-20', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(711, 10, '2017-02-21', 'vormittag', 'SCH', NULL, 'KAB', NULL),
(712, 10, '2017-02-21', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(713, 10, '2017-02-22', 'vormittag', 'SCH', NULL, 'KRA', ''),
(714, 10, '2017-02-22', 'nachmittag', 'SCH', NULL, 'KRA', ''),
(715, 10, '2017-02-23', 'vormittag', 'SCH', NULL, 'KAB', NULL),
(716, 10, '2017-02-23', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(717, 10, '2017-02-24', 'vormittag', 'SCH', NULL, 'KAB', NULL),
(718, 10, '2017-02-24', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(719, 10, '2017-02-25', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(720, 10, '2017-02-25', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(721, 10, '2017-02-26', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(722, 10, '2017-02-26', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(723, 10, '2017-02-27', 'vormittag', 'PEI', NULL, 'KAB', NULL),
(724, 10, '2017-02-27', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(725, 10, '2017-02-28', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(726, 10, '2017-02-28', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1940, 10, '2017-03-01', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1941, 10, '2017-03-01', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1942, 10, '2017-03-02', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1943, 10, '2017-03-02', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1944, 10, '2017-03-03', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1945, 10, '2017-03-03', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1946, 10, '2017-03-04', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1947, 10, '2017-03-04', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1948, 10, '2017-03-05', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1949, 10, '2017-03-05', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1950, 10, '2017-03-06', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1951, 10, '2017-03-06', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1952, 10, '2017-03-07', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1953, 10, '2017-03-07', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1954, 10, '2017-03-08', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1955, 10, '2017-03-08', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1956, 10, '2017-03-09', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1957, 10, '2017-03-09', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1958, 10, '2017-03-10', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1959, 10, '2017-03-10', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1960, 10, '2017-03-11', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1961, 10, '2017-03-11', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1962, 10, '2017-03-12', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1963, 10, '2017-03-12', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1964, 10, '2017-03-13', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1965, 10, '2017-03-13', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1966, 10, '2017-03-14', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1967, 10, '2017-03-14', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1968, 10, '2017-03-15', 'vormittag', 'SCH', NULL, 'KAB', NULL),
(1969, 10, '2017-03-15', 'nachmittag', 'SCH', NULL, 'KAB', NULL),
(1970, 10, '2017-03-16', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1971, 10, '2017-03-16', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1972, 10, '2017-03-17', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1973, 10, '2017-03-17', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1974, 10, '2017-03-18', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1975, 10, '2017-03-18', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1976, 10, '2017-03-19', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1977, 10, '2017-03-19', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1978, 10, '2017-03-20', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1979, 10, '2017-03-20', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1980, 10, '2017-03-21', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1981, 10, '2017-03-21', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1982, 10, '2017-03-22', 'vormittag', 'PRA', 'Feiertag - Allerheiligen', 'KAB', NULL),
(1983, 10, '2017-03-22', 'nachmittag', 'PRA', 'Feiertag - Allerheiligen', 'KAB', NULL),
(1984, 10, '2017-03-23', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1985, 10, '2017-03-23', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1986, 10, '2017-03-24', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1987, 10, '2017-03-24', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1988, 10, '2017-03-25', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1989, 10, '2017-03-25', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1990, 10, '2017-03-26', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1991, 10, '2017-03-26', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1992, 10, '2017-03-27', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1993, 10, '2017-03-27', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1994, 10, '2017-03-28', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1995, 10, '2017-03-28', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1996, 10, '2017-03-29', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1997, 10, '2017-03-29', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1998, 10, '2017-03-30', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1999, 10, '2017-03-30', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(2000, 10, '2017-03-31', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(2001, 10, '2017-03-31', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1880, 10, '2017-04-01', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1881, 10, '2017-04-01', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1882, 10, '2017-04-02', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1883, 10, '2017-04-02', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1884, 10, '2017-04-03', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1885, 10, '2017-04-03', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1886, 10, '2017-04-04', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1887, 10, '2017-04-04', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1888, 10, '2017-04-05', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1889, 10, '2017-04-05', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1890, 10, '2017-04-06', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1891, 10, '2017-04-06', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1892, 10, '2017-04-07', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1893, 10, '2017-04-07', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1894, 10, '2017-04-08', 'vormittag', 'KAR', 'hallo', 'KAB', NULL),
(1895, 10, '2017-04-08', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1896, 10, '2017-04-09', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1897, 10, '2017-04-09', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1898, 10, '2017-04-10', 'vormittag', NULL, NULL, 'KAB', NULL),
(1899, 10, '2017-04-10', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1900, 10, '2017-04-11', 'vormittag', NULL, NULL, 'KAB', NULL),
(1901, 10, '2017-04-11', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1902, 10, '2017-04-12', 'vormittag', 'UEK', NULL, 'KAB', NULL),
(1903, 10, '2017-04-12', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1904, 10, '2017-04-13', 'vormittag', NULL, NULL, 'KAB', NULL),
(1905, 10, '2017-04-13', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1906, 10, '2017-04-14', 'vormittag', NULL, NULL, 'KAB', NULL),
(1907, 10, '2017-04-14', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1908, 10, '2017-04-15', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1909, 10, '2017-04-15', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1910, 10, '2017-04-16', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1911, 10, '2017-04-16', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1912, 10, '2017-04-17', 'vormittag', NULL, NULL, 'KAB', NULL),
(1913, 10, '2017-04-17', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1914, 10, '2017-04-18', 'vormittag', NULL, NULL, 'KAB', NULL),
(1915, 10, '2017-04-18', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1916, 10, '2017-04-19', 'vormittag', NULL, NULL, 'KAB', NULL),
(1917, 10, '2017-04-19', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1918, 10, '2017-04-20', 'vormittag', NULL, NULL, 'KAB', NULL),
(1919, 10, '2017-04-20', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1920, 10, '2017-04-21', 'vormittag', NULL, NULL, 'KAB', NULL),
(1921, 10, '2017-04-21', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1922, 10, '2017-04-22', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1923, 10, '2017-04-22', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1924, 10, '2017-04-23', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1925, 10, '2017-04-23', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1926, 10, '2017-04-24', 'vormittag', NULL, NULL, 'KAB', NULL),
(1927, 10, '2017-04-24', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1928, 10, '2017-04-25', 'vormittag', NULL, NULL, 'KAB', NULL),
(1929, 10, '2017-04-25', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1930, 10, '2017-04-26', 'vormittag', NULL, NULL, 'KAB', NULL),
(1931, 10, '2017-04-26', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1932, 10, '2017-04-27', 'vormittag', NULL, NULL, 'KAB', NULL),
(1933, 10, '2017-04-27', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1934, 10, '2017-04-28', 'vormittag', NULL, NULL, 'KAB', NULL),
(1935, 10, '2017-04-28', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1936, 10, '2017-04-29', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1937, 10, '2017-04-29', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1938, 10, '2017-04-30', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1939, 10, '2017-04-30', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1027, 10, '2017-05-01', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1028, 10, '2017-05-01', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1029, 10, '2017-05-02', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1030, 10, '2017-05-02', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1031, 10, '2017-05-03', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1032, 10, '2017-05-03', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1033, 10, '2017-05-04', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1034, 10, '2017-05-04', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1035, 10, '2017-05-05', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1036, 10, '2017-05-05', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1037, 10, '2017-05-06', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1038, 10, '2017-05-06', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1039, 10, '2017-05-07', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1040, 10, '2017-05-07', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1041, 10, '2017-05-08', 'vormittag', 'SCH', NULL, 'KAB', NULL),
(1042, 10, '2017-05-08', 'nachmittag', 'SCH', NULL, 'KAB', NULL),
(1043, 10, '2017-05-09', 'vormittag', 'SCH', NULL, 'KAB', NULL),
(1044, 10, '2017-05-09', 'nachmittag', 'SCH', NULL, 'KAB', NULL),
(1045, 10, '2017-05-10', 'vormittag', 'SCH', NULL, 'KAB', NULL),
(1046, 10, '2017-05-10', 'nachmittag', 'SCH', NULL, 'KAB', NULL),
(1047, 10, '2017-05-11', 'vormittag', 'SCH', NULL, 'KAB', NULL),
(1048, 10, '2017-05-11', 'nachmittag', 'SCH', NULL, 'KAB', NULL),
(1049, 10, '2017-05-12', 'vormittag', 'SCH', NULL, 'KAB', NULL),
(1050, 10, '2017-05-12', 'nachmittag', 'SCH', NULL, 'KAB', NULL),
(1051, 10, '2017-05-13', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1052, 10, '2017-05-13', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1053, 10, '2017-05-14', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1054, 10, '2017-05-14', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1055, 10, '2017-05-15', 'vormittag', 'SCH', NULL, 'KAB', NULL),
(1056, 10, '2017-05-15', 'nachmittag', 'SCH', NULL, 'KAB', NULL),
(1057, 10, '2017-05-16', 'vormittag', 'SCH', NULL, 'KAB', NULL),
(1058, 10, '2017-05-16', 'nachmittag', 'SCH', NULL, 'KAB', NULL),
(1059, 10, '2017-05-17', 'vormittag', 'SCH', NULL, 'KAB', NULL),
(1060, 10, '2017-05-17', 'nachmittag', 'SCH', NULL, 'KAB', NULL),
(1061, 10, '2017-05-18', 'vormittag', 'SCH', NULL, 'KAB', NULL),
(1062, 10, '2017-05-18', 'nachmittag', 'SCH', NULL, 'KAB', NULL),
(1063, 10, '2017-05-19', 'vormittag', 'SCH', NULL, 'KAB', NULL),
(1064, 10, '2017-05-19', 'nachmittag', 'SCH', NULL, 'KAB', NULL),
(1065, 10, '2017-05-20', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1066, 10, '2017-05-20', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1067, 10, '2017-05-21', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1068, 10, '2017-05-21', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1069, 10, '2017-05-22', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1070, 10, '2017-05-22', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1071, 10, '2017-05-23', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1072, 10, '2017-05-23', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1073, 10, '2017-05-24', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1074, 10, '2017-05-24', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1075, 10, '2017-05-25', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1076, 10, '2017-05-25', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1077, 10, '2017-05-26', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1078, 10, '2017-05-26', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1079, 10, '2017-05-27', 'vormittag', 'SCH', NULL, 'KAB', NULL),
(1080, 10, '2017-05-27', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1081, 10, '2017-05-28', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1082, 10, '2017-05-28', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1083, 10, '2017-05-29', 'vormittag', NULL, NULL, 'KAB', NULL),
(1084, 10, '2017-05-29', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1085, 10, '2017-05-30', 'vormittag', NULL, NULL, 'KAB', NULL),
(1086, 10, '2017-05-30', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1087, 10, '2017-05-31', 'vormittag', NULL, NULL, 'KAB', NULL),
(1088, 10, '2017-05-31', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1151, 10, '2017-07-01', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1152, 10, '2017-07-01', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1153, 10, '2017-07-02', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1154, 10, '2017-07-02', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1155, 10, '2017-07-03', 'vormittag', 'SEM', NULL, 'KAB', NULL),
(1156, 10, '2017-07-03', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1157, 10, '2017-07-04', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1158, 10, '2017-07-04', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1159, 10, '2017-07-05', 'vormittag', NULL, NULL, 'KAB', NULL),
(1160, 10, '2017-07-05', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1161, 10, '2017-07-06', 'vormittag', NULL, NULL, 'KAB', NULL),
(1162, 10, '2017-07-06', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1163, 10, '2017-07-07', 'vormittag', NULL, NULL, 'KAB', NULL),
(1164, 10, '2017-07-07', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1165, 10, '2017-07-08', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1166, 10, '2017-07-08', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1167, 10, '2017-07-09', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1168, 10, '2017-07-09', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1169, 10, '2017-07-10', 'vormittag', NULL, NULL, 'KAB', NULL),
(1170, 10, '2017-07-10', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1171, 10, '2017-07-11', 'vormittag', NULL, NULL, 'KAB', NULL),
(1172, 10, '2017-07-11', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1173, 10, '2017-07-12', 'vormittag', NULL, NULL, 'KAB', NULL),
(1174, 10, '2017-07-12', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1175, 10, '2017-07-13', 'vormittag', NULL, NULL, 'KAB', NULL),
(1176, 10, '2017-07-13', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1177, 10, '2017-07-14', 'vormittag', NULL, NULL, 'KAB', NULL),
(1178, 10, '2017-07-14', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1179, 10, '2017-07-15', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1180, 10, '2017-07-15', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1181, 10, '2017-07-16', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1182, 10, '2017-07-16', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1183, 10, '2017-07-17', 'vormittag', NULL, NULL, 'KAB', NULL),
(1184, 10, '2017-07-17', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1185, 10, '2017-07-18', 'vormittag', NULL, NULL, 'KAB', NULL),
(1186, 10, '2017-07-18', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1187, 10, '2017-07-19', 'vormittag', NULL, NULL, 'KAB', NULL),
(1188, 10, '2017-07-19', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1189, 10, '2017-07-20', 'vormittag', NULL, NULL, 'KAB', NULL),
(1190, 10, '2017-07-20', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1191, 10, '2017-07-21', 'vormittag', NULL, NULL, 'KAB', NULL),
(1192, 10, '2017-07-21', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1193, 10, '2017-07-22', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1194, 10, '2017-07-22', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1195, 10, '2017-07-23', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1196, 10, '2017-07-23', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1197, 10, '2017-07-24', 'vormittag', NULL, NULL, 'KAB', NULL),
(1198, 10, '2017-07-24', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1199, 10, '2017-07-25', 'vormittag', NULL, NULL, 'KAB', NULL),
(1200, 10, '2017-07-25', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1201, 10, '2017-07-26', 'vormittag', NULL, NULL, 'KAB', NULL),
(1202, 10, '2017-07-26', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1203, 10, '2017-07-27', 'vormittag', NULL, NULL, 'KAB', NULL),
(1204, 10, '2017-07-27', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1205, 10, '2017-07-28', 'vormittag', NULL, NULL, 'KAB', NULL),
(1206, 10, '2017-07-28', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1207, 10, '2017-07-29', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1208, 10, '2017-07-29', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1209, 10, '2017-07-30', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1210, 10, '2017-07-30', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1211, 10, '2017-07-31', 'vormittag', NULL, NULL, 'KAB', NULL),
(1212, 10, '2017-07-31', 'nachmittag', NULL, NULL, 'KAB', NULL),
(2065, 10, '2020-01-01', 'vormittag', NULL, NULL, 'FER', NULL),
(1824, 13, '2017-02-01', 'vormittag', NULL, NULL, 'KAB', NULL),
(1825, 13, '2017-02-01', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1826, 13, '2017-02-02', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1827, 13, '2017-02-02', 'nachmittag', 'PRA', NULL, 'KAB', NULL),
(1828, 13, '2017-02-03', 'vormittag', NULL, NULL, 'KAB', NULL),
(1829, 13, '2017-02-03', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1830, 13, '2017-02-04', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1831, 13, '2017-02-04', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1832, 13, '2017-02-05', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1833, 13, '2017-02-05', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1834, 13, '2017-02-06', 'vormittag', NULL, NULL, 'KAB', NULL),
(1835, 13, '2017-02-06', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1836, 13, '2017-02-07', 'vormittag', NULL, NULL, 'KAB', NULL),
(1837, 13, '2017-02-07', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1838, 13, '2017-02-08', 'vormittag', NULL, NULL, 'KAB', NULL),
(1839, 13, '2017-02-08', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1840, 13, '2017-02-09', 'vormittag', NULL, NULL, 'KAB', NULL),
(1841, 13, '2017-02-09', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1842, 13, '2017-02-10', 'vormittag', NULL, NULL, 'KAB', NULL),
(1843, 13, '2017-02-10', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1844, 13, '2017-02-11', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1845, 13, '2017-02-11', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1846, 13, '2017-02-12', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1847, 13, '2017-02-12', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1848, 13, '2017-02-13', 'vormittag', NULL, NULL, 'KAB', NULL),
(1849, 13, '2017-02-13', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1850, 13, '2017-02-14', 'vormittag', NULL, NULL, 'KAB', NULL),
(1851, 13, '2017-02-14', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1852, 13, '2017-02-15', 'vormittag', NULL, NULL, 'KAB', NULL),
(1853, 13, '2017-02-15', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1854, 13, '2017-02-16', 'vormittag', NULL, NULL, 'KAB', NULL),
(1855, 13, '2017-02-16', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1856, 13, '2017-02-17', 'vormittag', NULL, NULL, 'KAB', NULL),
(1857, 13, '2017-02-17', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1858, 13, '2017-02-18', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1859, 13, '2017-02-18', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1860, 13, '2017-02-19', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1861, 13, '2017-02-19', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1862, 13, '2017-02-20', 'vormittag', NULL, NULL, 'KAB', NULL),
(1863, 13, '2017-02-20', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1864, 13, '2017-02-21', 'vormittag', NULL, NULL, 'KAB', NULL),
(1865, 13, '2017-02-21', 'nachmittag', 'SEM', NULL, 'KAB', NULL),
(1866, 13, '2017-02-22', 'vormittag', 'SEM', NULL, 'KAB', NULL),
(1867, 13, '2017-02-22', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1868, 13, '2017-02-23', 'vormittag', NULL, NULL, 'KAB', NULL),
(1869, 13, '2017-02-23', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1870, 13, '2017-02-24', 'vormittag', NULL, NULL, 'KAB', NULL),
(1871, 13, '2017-02-24', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1872, 13, '2017-02-25', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1873, 13, '2017-02-25', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1874, 13, '2017-02-26', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1875, 13, '2017-02-26', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1876, 13, '2017-02-27', 'vormittag', NULL, NULL, 'KAB', NULL),
(1877, 13, '2017-02-27', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1878, 13, '2017-02-28', 'vormittag', NULL, NULL, 'KAB', NULL),
(1879, 13, '2017-02-28', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1701, 13, '2018-06-01', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1089, 17, '2017-01-01', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1090, 17, '2017-01-01', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1091, 17, '2017-01-02', 'vormittag', NULL, NULL, 'KAB', NULL),
(1092, 17, '2017-01-02', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1093, 17, '2017-01-03', 'vormittag', 'PRA', NULL, 'KAB', NULL),
(1094, 17, '2017-01-03', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1095, 17, '2017-01-04', 'vormittag', NULL, NULL, 'KAB', NULL),
(1096, 17, '2017-01-04', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1097, 17, '2017-01-05', 'vormittag', NULL, NULL, 'KAB', NULL),
(1098, 17, '2017-01-05', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1099, 17, '2017-01-06', 'vormittag', NULL, NULL, 'KAB', NULL),
(1100, 17, '2017-01-06', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1101, 17, '2017-01-07', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1102, 17, '2017-01-07', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1103, 17, '2017-01-08', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1104, 17, '2017-01-08', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1105, 17, '2017-01-09', 'vormittag', NULL, NULL, 'KAB', NULL),
(1106, 17, '2017-01-09', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1107, 17, '2017-01-10', 'vormittag', NULL, NULL, 'KAB', NULL),
(1108, 17, '2017-01-10', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1109, 17, '2017-01-11', 'vormittag', NULL, NULL, 'KAB', NULL),
(1110, 17, '2017-01-11', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1111, 17, '2017-01-12', 'vormittag', NULL, NULL, 'KAB', NULL),
(1112, 17, '2017-01-12', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1113, 17, '2017-01-13', 'vormittag', NULL, NULL, 'KAB', NULL),
(1114, 17, '2017-01-13', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1115, 17, '2017-01-14', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1116, 17, '2017-01-14', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1117, 17, '2017-01-15', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1118, 17, '2017-01-15', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1119, 17, '2017-01-16', 'vormittag', NULL, NULL, 'KAB', NULL),
(1120, 17, '2017-01-16', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1121, 17, '2017-01-17', 'vormittag', NULL, NULL, 'KAB', NULL),
(1122, 17, '2017-01-17', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1123, 17, '2017-01-18', 'vormittag', NULL, NULL, 'KAB', NULL),
(1124, 17, '2017-01-18', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1125, 17, '2017-01-19', 'vormittag', NULL, NULL, 'KAB', NULL),
(1126, 17, '2017-01-19', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1127, 17, '2017-01-20', 'vormittag', NULL, NULL, 'KAB', NULL),
(1128, 17, '2017-01-20', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1129, 17, '2017-01-21', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1130, 17, '2017-01-21', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1131, 17, '2017-01-22', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1132, 17, '2017-01-22', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1133, 17, '2017-01-23', 'vormittag', NULL, NULL, 'KAB', NULL),
(1134, 17, '2017-01-23', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1135, 17, '2017-01-24', 'vormittag', NULL, NULL, 'KAB', NULL),
(1136, 17, '2017-01-24', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1137, 17, '2017-01-25', 'vormittag', NULL, NULL, 'KAB', NULL),
(1138, 17, '2017-01-25', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1139, 17, '2017-01-26', 'vormittag', NULL, NULL, 'KAB', NULL),
(1140, 17, '2017-01-26', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1141, 17, '2017-01-27', 'vormittag', NULL, NULL, 'KAB', NULL),
(1142, 17, '2017-01-27', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1143, 17, '2017-01-28', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1144, 17, '2017-01-28', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1145, 17, '2017-01-29', 'vormittag', 'KAR', NULL, 'KAB', NULL),
(1146, 17, '2017-01-29', 'nachmittag', 'KAR', NULL, 'KAB', NULL),
(1147, 17, '2017-01-30', 'vormittag', NULL, NULL, 'KAB', NULL),
(1148, 17, '2017-01-30', 'nachmittag', NULL, NULL, 'KAB', NULL),
(1149, 17, '2017-01-31', 'vormittag', NULL, NULL, 'KAB', NULL),
(1150, 17, '2017-01-31', 'nachmittag', NULL, NULL, 'KAB', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `halbtag_korrektur`
--

CREATE TABLE `halbtag_korrektur` (
  `id` int(11) NOT NULL,
  `taetigkeit_aenderungsdatum` date DEFAULT NULL,
  `taetigkeit_nachricht` varchar(100) DEFAULT NULL,
  `absenz_aenderungsdatum` date DEFAULT NULL,
  `absenz_nachricht` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lehrjahr`
--

CREATE TABLE `lehrjahr` (
  `lehrling` int(11) NOT NULL,
  `vertragsjahr` tinyint(4) NOT NULL,
  `jahr` year(4) NOT NULL,
  `schuljahr` tinyint(4) NOT NULL,
  `lehrgang` varchar(25) NOT NULL,
  `ferientage` decimal(3,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `lehrjahr`
--

INSERT INTO `lehrjahr` (`lehrling`, `vertragsjahr`, `jahr`, `schuljahr`, `lehrgang`, `ferientage`) VALUES
(10, 1, 2014, 1, 'INF_SYS_ABU', '1.0'),
(10, 2, 2015, 2, 'INF_APP_ABU', '25.0'),
(10, 3, 2016, 3, 'INF_SYS_ABU', '23.5'),
(10, 4, 2016, 4, 'INF_WU', '25.0'),
(10, 5, 2017, 5, 'INF_WU', '25.0'),
(13, 1, 2014, 1, 'INF_APP_ABU', '10.0'),
(13, 2, 2015, 2, 'INF_APP_ABU', '10.0'),
(13, 3, 2016, 3, 'INF_APP_ABU', '10.0'),
(13, 4, 2017, 4, 'INF_APP_ABU', '10.0'),
(17, 1, 2014, 1, 'KA_BEP_B', '10.0'),
(17, 2, 2015, 2, 'KA_BEP_B', '10.0'),
(17, 3, 2016, 3, 'KA_BEP_B', '10.0'),
(17, 4, 2017, 4, 'KA_BEP_B', '10.0'),
(21, 1, 2017, 1, 'KA_V_WU', '10.0'),
(21, 2, 2018, 2, 'INF_WU', '10.0'),
(21, 3, 2018, 3, 'INF_WU', '10.0'),
(21, 4, 2019, 4, 'INF_WU', '10.0'),
(23, 1, 2017, 1, 'INF_SYS_ABU', '10.0'),
(23, 2, 2018, 2, 'INF_SYS_ABU', '10.0'),
(23, 3, 2019, 3, 'INF_SYS_ABU', '10.0'),
(23, 4, 2020, 4, 'INF_SYS_ABU', '10.0'),
(25, 1, 2017, 1, 'INF_SYS_BM', '10.0'),
(25, 2, 2018, 2, 'INF_SYS_BM', '10.0'),
(25, 3, 2019, 3, 'INF_SYS_BM', '10.0'),
(25, 4, 2020, 4, 'INF_SYS_BM', '10.0'),
(26, 1, 2017, 1, 'KA_BEP_E', '10.0'),
(26, 2, 2018, 2, 'KA_BEP_E', '10.0'),
(26, 3, 2019, 3, 'KA_BEP_E', '10.0'),
(34, 1, 2017, 1, 'INF_INT', '10.0'),
(34, 2, 2018, 2, 'INF_INT', '10.0'),
(34, 3, 2019, 3, 'INF_INT', '10.0'),
(34, 4, 2020, 4, 'INF_INT', '10.0'),
(35, 1, 2016, 1, 'INF_SYS_BM', '10.0'),
(35, 2, 2017, 2, 'INF_SYS_BM', '10.0'),
(35, 3, 2018, 3, 'INF_SYS_BM', '25.0'),
(40, 1, 2017, 1, 'INF_SYS_ABU', '10.0'),
(40, 2, 2018, 2, 'INF_SYS_ABU', '10.0'),
(40, 3, 2019, 3, 'INF_SYS_ABU', '10.0'),
(40, 4, 2020, 4, 'INF_SYS_ABU', '10.0'),
(42, 1, 2017, 1, 'INF_APP_BM', '25.0'),
(42, 2, 2018, 2, 'INF_APP_BM', '25.0'),
(42, 3, 2019, 3, 'INF_APP_BM', '25.0'),
(42, 4, 2020, 4, 'INF_APP_BM', '25.0'),
(44, 1, 2017, 1, 'INF_APP_ABU', '25.0'),
(44, 2, 2018, 2, 'INF_APP_ABU', '25.0'),
(44, 3, 2019, 3, 'INF_APP_ABU', '25.0'),
(44, 4, 2020, 4, 'INF_APP_ABU', '25.0'),
(44, 5, 2020, 5, 'INF_APP_ABU', '25.0'),
(45, 1, 2017, 1, 'INF_APP_ABU', '25.0'),
(45, 2, 2018, 2, 'INF_APP_ABU', '25.0'),
(45, 3, 2019, 3, 'INF_APP_ABU', '25.0'),
(45, 4, 2020, 4, 'INF_APP_ABU', '25.0'),
(46, 1, 2017, 1, 'INF_APP_ABU', '25.0'),
(46, 2, 2018, 2, 'INF_APP_ABU', '25.0'),
(46, 3, 2019, 3, 'INF_APP_ABU', '25.0'),
(46, 4, 2020, 4, 'INF_APP_ABU', '25.0'),
(47, 1, 2017, 1, 'KA_M', '25.0'),
(47, 2, 2018, 2, 'KA_M', '25.0'),
(47, 3, 2019, 3, 'KA_M', '25.0'),
(48, 1, 2017, 1, 'INF_SYS_ABU', '25.0'),
(48, 2, 2018, 2, 'INF_SYS_ABU', '25.0'),
(48, 3, 2019, 3, 'INF_SYS_ABU', '25.0'),
(48, 4, 2020, 4, 'INF_SYS_ABU', '25.0'),
(49, 1, 2017, 1, 'KA_V_WU', '25.0'),
(49, 2, 2018, 2, 'KA_V_WU', '25.0'),
(49, 3, 2019, 3, 'KA_V_WU', '25.0'),
(50, 1, 2017, 1, 'INF_APP_ABU', '25.0'),
(50, 2, 2018, 2, 'INF_APP_ABU', '25.0'),
(50, 3, 2019, 3, 'INF_APP_ABU', '25.0'),
(50, 4, 2020, 4, 'INF_APP_ABU', '25.0'),
(51, 1, 2017, 1, 'INF_SYS_ABU', '25.0'),
(51, 2, 2018, 2, 'INF_SYS_ABU', '25.0'),
(51, 3, 2019, 3, 'INF_SYS_ABU', '25.0'),
(51, 4, 2020, 4, 'INF_SYS_ABU', '25.0'),
(51, 5, 2020, 5, 'INF_SYS_ABU', '25.0'),
(52, 1, 2017, 1, 'INF_APP_ABU', '25.0'),
(52, 2, 2018, 2, 'INF_APP_ABU', '25.0'),
(52, 3, 2019, 3, 'INF_APP_ABU', '25.0'),
(52, 4, 2020, 4, 'INF_APP_ABU', '25.0');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lehrling`
--

CREATE TABLE `lehrling` (
  `id` int(11) NOT NULL,
  `nr` varchar(10) DEFAULT NULL,
  `lehrgang` varchar(25) NOT NULL,
  `berufsbildner` int(11) NOT NULL,
  `lehrbeginn` date NOT NULL,
  `lehrende` date NOT NULL,
  `lehrbeginn_ganzesjahr` date NOT NULL,
  `schulort` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `lehrling`
--

INSERT INTO `lehrling` (`id`, `nr`, `lehrgang`, `berufsbildner`, `lehrbeginn`, `lehrende`, `lehrbeginn_ganzesjahr`, `schulort`) VALUES
(10, '6661', 'INF_WU', 9, '2014-08-06', '2017-09-22', '2014-08-17', 1),
(13, '1112', 'INF_SYS_ABU', 9, '2014-09-09', '2018-09-08', '2014-09-09', 1),
(17, '5555', 'KA_BEP_B', 9, '2014-08-21', '2018-08-20', '2014-08-21', 1),
(21, '2134', 'INF_WU', 9, '2014-12-01', '2017-12-01', '2014-12-01', 1),
(23, '3', 'INF_SYS_ABU', 9, '2017-03-01', '2021-02-28', '2017-03-01', 1),
(25, '444', 'INF_SYS_BM', 9, '2017-02-16', '2021-02-15', '2017-02-16', 1),
(26, '4321', 'KA_INT_E', 9, '2017-02-01', '2020-01-31', '2017-02-01', 1),
(34, '353', 'INF_INT', 9, '2017-02-27', '2021-03-08', '2017-03-09', 1),
(35, '9999', 'INF_SYS_BM', 9, '2016-08-08', '2018-08-08', '2016-08-08', 2),
(40, 'c', 'INF_APP_BM', 9, '2017-02-01', '2021-01-31', '2017-02-01', 1),
(42, '44', 'INF_APP_BM', 9, '2017-02-15', '2021-02-14', '2017-02-15', 1),
(44, '1', 'INF_SYS_ABU', 9, '2017-02-27', '2021-03-27', '2017-03-28', 1),
(45, '2', 'INF_APP_ABU', 9, '2017-02-27', '2021-02-26', '2017-02-27', 2),
(46, '5', 'INF_APP_ABU', 9, '2017-02-27', '2021-03-29', '2017-03-30', 3),
(47, '6', 'KA_M', 9, '2017-02-08', '2020-02-07', '2017-02-08', 3),
(48, '7', 'INF_SYS_ABU', 9, '2017-02-27', '2021-03-23', '2017-03-24', 3),
(49, '8', 'KA_V_WU', 9, '2017-02-27', '2020-03-23', '2017-03-24', 2),
(50, '9', 'INF_APP_ABU', 9, '2017-02-27', '2021-03-28', '2017-03-29', 3),
(51, 'bb', 'INF_SYS_ABU', 16, '2017-02-27', '2021-03-29', '2017-03-30', 2),
(52, '11', 'INF_APP_BM', 9, '2017-02-27', '2021-02-26', '2017-02-27', 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `praxisbetrieb`
--

CREATE TABLE `praxisbetrieb` (
  `id` smallint(6) NOT NULL,
  `praxisbetrieb` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `praxisbetrieb`
--

INSERT INTO `praxisbetrieb` (`id`, `praxisbetrieb`) VALUES
(1, 'Neue Firma'),
(2, 'c'),
(3, 'bildxzug'),
(4, 'bildxzug - System'),
(5, 'bildx'),
(6, 'O'),
(7, 'hiolhki'),
(8, 'Firma neu'),
(9, 'dcc'),
(10, 'cccccccc');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `praxisbildner`
--

CREATE TABLE `praxisbildner` (
  `id` int(11) NOT NULL,
  `praxisbetrieb` smallint(6) DEFAULT NULL,
  `archiviert` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `praxisbildner`
--

INSERT INTO `praxisbildner` (`id`, `praxisbetrieb`, `archiviert`) VALUES
(5, 5, 0),
(9, 8, 0),
(15, 3, 1),
(16, 7, 0),
(32, 5, 0),
(36, 4, 0),
(37, 4, 0),
(38, 4, 0),
(39, 4, 0),
(41, 6, 0),
(43, 3, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `praxiseinsatz`
--

CREATE TABLE `praxiseinsatz` (
  `id` mediumint(9) NOT NULL,
  `lehrling` int(11) NOT NULL,
  `startdatum` date NOT NULL,
  `enddatum` date NOT NULL,
  `praxisbildner` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `praxiseinsatz`
--

INSERT INTO `praxiseinsatz` (`id`, `lehrling`, `startdatum`, `enddatum`, `praxisbildner`) VALUES
(40, 10, '2014-08-06', '2016-12-07', 9),
(45, 10, '2016-12-08', '2017-09-22', 37),
(33, 13, '2014-09-09', '2018-09-08', 5),
(19, 21, '2014-12-01', '2017-11-14', 9),
(27, 23, '2017-03-01', '2021-02-28', 39),
(14, 25, '2017-02-16', '2021-02-15', 32),
(12, 26, '2017-02-01', '2020-01-31', 16),
(16, 35, '2016-08-08', '2016-08-09', 9),
(17, 35, '2016-08-10', '2016-08-10', 16),
(28, 35, '2016-08-11', '2018-08-08', 9),
(37, 42, '2017-02-15', '2021-01-26', 39),
(39, 44, '2017-02-27', '2021-03-03', 32),
(42, 52, '2017-02-27', '2021-01-27', 9),
(44, 52, '2021-01-28', '2021-02-26', 32);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rapport`
--

CREATE TABLE `rapport` (
  `id` int(11) NOT NULL,
  `lehrling` int(11) NOT NULL,
  `monat` date NOT NULL,
  `praxisbildner` int(11) NOT NULL,
  `signiert_lehrling` enum('offen','ja') NOT NULL DEFAULT 'offen',
  `signiert_lehrling_datum` datetime DEFAULT NULL,
  `signiert_praxisbildner` enum('offen','ja') NOT NULL DEFAULT 'offen',
  `signiert_praxisbildner_datum` datetime DEFAULT NULL,
  `signiert_berufsbildner` enum('offen','ja') NOT NULL DEFAULT 'offen',
  `signiert_berufsbildner_datum` datetime DEFAULT NULL,
  `berufsbildner` int(11) DEFAULT NULL,
  `rechnungsnr` varchar(16) DEFAULT NULL,
  `rechnungsdatum` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `rapport`
--

INSERT INTO `rapport` (`id`, `lehrling`, `monat`, `praxisbildner`, `signiert_lehrling`, `signiert_lehrling_datum`, `signiert_praxisbildner`, `signiert_praxisbildner_datum`, `signiert_berufsbildner`, `signiert_berufsbildner_datum`, `berufsbildner`, `rechnungsnr`, `rechnungsdatum`) VALUES
(39, 10, '2014-08-01', 9, 'offen', NULL, 'offen', NULL, 'offen', NULL, NULL, NULL, NULL),
(35, 10, '2014-09-01', 9, 'offen', NULL, 'offen', NULL, 'offen', NULL, NULL, NULL, NULL),
(33, 10, '2015-03-01', 9, 'ja', '2017-01-15 17:44:56', 'offen', NULL, 'offen', NULL, NULL, NULL, NULL),
(34, 10, '2015-03-01', 16, 'offen', NULL, 'offen', NULL, 'offen', NULL, NULL, NULL, NULL),
(48, 10, '2016-08-01', 9, 'ja', '2017-03-22 16:34:04', 'ja', '2017-03-22 16:34:32', 'ja', '2017-03-22 16:34:45', 9, NULL, NULL),
(37, 10, '2016-09-01', 9, 'ja', '2017-01-28 17:11:42', 'ja', '2017-01-28 17:12:04', 'ja', '2017-01-28 17:12:23', 9, NULL, NULL),
(36, 10, '2016-10-01', 9, 'ja', '2017-01-28 17:11:11', 'ja', '2017-01-28 17:12:10', 'ja', '2017-01-28 17:12:28', 9, '', '2017-03-24'),
(46, 10, '2016-12-01', 9, 'ja', '2017-03-07 15:59:03', 'offen', NULL, 'offen', NULL, NULL, NULL, NULL),
(32, 10, '2017-01-01', 9, 'ja', '2017-02-06 10:35:37', 'ja', '2017-02-06 10:35:48', 'ja', '2017-02-06 10:36:29', 9, NULL, NULL),
(29, 10, '2017-01-01', 16, 'offen', NULL, 'offen', NULL, 'offen', NULL, NULL, NULL, NULL),
(41, 10, '2017-01-01', 32, 'ja', '2017-02-27 14:00:37', 'ja', '2017-02-27 14:01:05', 'ja', '2017-02-27 14:01:29', 9, NULL, NULL),
(47, 10, '2017-01-01', 37, 'ja', '2017-03-16 18:11:07', 'ja', '2017-03-16 18:11:07', 'offen', NULL, NULL, NULL, NULL),
(38, 10, '2017-02-01', 9, 'ja', '2017-02-21 15:12:26', 'ja', '2017-02-21 15:13:31', 'ja', '2017-02-21 15:13:44', 9, NULL, NULL),
(40, 10, '2017-02-01', 16, 'offen', NULL, 'offen', NULL, 'offen', NULL, NULL, NULL, NULL),
(42, 10, '2017-02-01', 32, 'ja', '2017-03-04 17:34:34', 'offen', NULL, 'offen', NULL, NULL, NULL, NULL),
(44, 10, '2017-02-01', 37, 'offen', NULL, 'offen', NULL, 'offen', NULL, 9, NULL, NULL),
(45, 10, '2017-03-01', 37, 'ja', '2017-03-07 15:52:14', 'ja', '2017-03-07 15:52:14', 'ja', '2017-03-22 16:34:24', 9, '123456', '2017-03-23'),
(43, 13, '2017-02-01', 32, 'ja', '2017-01-01 12:00:00', 'ja', NULL, 'ja', NULL, 9, NULL, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rapport_abgelehnt`
--

CREATE TABLE `rapport_abgelehnt` (
  `id` int(11) NOT NULL,
  `benutzer` int(11) NOT NULL,
  `datum` datetime NOT NULL,
  `nachricht` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `rapport_abgelehnt`
--

INSERT INTO `rapport_abgelehnt` (`id`, `benutzer`, `datum`, `nachricht`) VALUES
(39, 9, '2017-01-31 18:26:52', NULL),
(44, 9, '2017-03-10 18:17:33', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `schulferien`
--

CREATE TABLE `schulferien` (
  `id` smallint(6) NOT NULL,
  `schulort` tinyint(4) NOT NULL,
  `startdatum` date NOT NULL,
  `enddatum` date NOT NULL,
  `schulferien` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `schulferien`
--

INSERT INTO `schulferien` (`id`, `schulort`, `startdatum`, `enddatum`, `schulferien`) VALUES
(9, 1, '2016-11-01', '2016-11-12', 'cccc'),
(4, 1, '2017-03-09', '2017-03-09', 'cccc'),
(7, 1, '2017-03-16', '2017-03-18', 'ccccc'),
(8, 1, '2017-03-20', '2017-03-26', 'Weihnachten'),
(10, 1, '2017-04-11', '2017-04-26', 'frühling');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `_absenz`
--

CREATE TABLE `_absenz` (
  `id` varchar(5) NOT NULL,
  `absenz` varchar(30) NOT NULL,
  `reihenfolge` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `_absenz`
--

INSERT INTO `_absenz` (`id`, `absenz`, `reihenfolge`) VALUES
('FER', 'Ferien', 1),
('JUG', 'Jugendurlaub', 6),
('KAB', 'Keine Absenz', 10),
('KRA', 'Krank', 2),
('MIL', 'Militär', 7),
('SOB', 'Sonderurlaub bezahlt', 4),
('SOU', 'Sonderurlaub unbezahlt', 5),
('SPO', 'Sportkontingent', 8),
('UNF', 'Unfall', 3);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `_berechtigung`
--

CREATE TABLE `_berechtigung` (
  `id` varchar(3) NOT NULL,
  `titel` varchar(60) NOT NULL,
  `beschreibung` varchar(300) NOT NULL,
  `reihenfolge` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `_berechtigung`
--

INSERT INTO `_berechtigung` (`id`, `titel`, `beschreibung`, `reihenfolge`) VALUES
('ADM', 'Administrator', 'Berechtigungen erteilen, Berufsbildner erstellen und bearbeiten', 1),
('LLV', 'Lernende', 'Lernende erstellen und bearbeiten', 4),
('PBV', 'Praxisbildner', 'Praxisbildner erstellen und bearbeiten, Praxisbetriebe erstellen und bearbeiten', 5),
('RAP', 'Rapporte', 'Rapporte aller Lernenden einsehen', 2),
('RKR', 'Rapportekorrektur', 'Rapporte korrigieren, Unterschriften zurücksetzen', 3),
('SFE', 'Schulferien und Feiertage', 'Schulferien und Feiertage bearbeiten', 6),
('STA', 'Statistik', 'Statistiken für die Buchhaltung erzeugen', 14);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `_kostenstelle`
--

CREATE TABLE `_kostenstelle` (
  `id` varchar(25) NOT NULL,
  `kostenstelle` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `_kostenstelle`
--

INSERT INTO `_kostenstelle` (`id`, `kostenstelle`) VALUES
('INF', 'Informatiker/in'),
('INF_INT', 'Informatiker/in International'),
('INF_WU', 'Informatiker/in way up'),
('KA', 'Kauffrau/mann'),
('KA_BEP', 'Kauffrau/mann BEP'),
('KA_BEP_WU', 'Kauffrau/mann BEP way up'),
('KA_INT', 'Kauffrau/mann International'),
('KA_WU', 'Kauffrau/mann way up'),
('MM', 'Mediamatiker/in'),
('MM_WU', 'Mediamatiker/in way up');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `_lehrberuf`
--

CREATE TABLE `_lehrberuf` (
  `id` varchar(10) NOT NULL,
  `lehrberuf` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `_lehrberuf`
--

INSERT INTO `_lehrberuf` (`id`, `lehrberuf`) VALUES
('INF', 'Informatiker/in'),
('KA', 'Kauffrau/mann'),
('MM', 'Mediamatiker/in');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `_lehrgang`
--

CREATE TABLE `_lehrgang` (
  `id` varchar(25) NOT NULL,
  `lehrgang` varchar(100) NOT NULL,
  `lehrberuf` varchar(10) NOT NULL,
  `lehrdauer` tinyint(4) NOT NULL,
  `kostenstelle` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `_lehrgang`
--

INSERT INTO `_lehrgang` (`id`, `lehrgang`, `lehrberuf`, `lehrdauer`, `kostenstelle`) VALUES
('INF_APP_ABU', 'Informatiker/in ABU Applikationsentwicklung', 'INF', 4, 'INF'),
('INF_APP_BM', 'Informatiker/in BM Applikationsentwicklung', 'INF', 4, 'INF'),
('INF_INT', 'Informatiker/in International', 'INF', 4, 'INF_INT'),
('INF_SYS_ABU', 'Informatiker/in ABU Systemtechnik', 'INF', 4, 'INF'),
('INF_SYS_BM', 'Informatiker/in BM Systemtechnik', 'INF', 4, 'INF'),
('INF_WU', 'Informatiker/in way up', 'INF', 2, 'INF_WU'),
('KA_B', 'Kauffrau/mann B-Profil', 'KA', 3, 'KA'),
('KA_BEP_B', 'Kauffrau/mann BEP B-Profil', 'KA', 3, 'KA_BEP'),
('KA_BEP_E', 'Kauffrau/mann BEP E-Profil', 'KA', 3, 'KA_BEP'),
('KA_BEP_M', 'Kauffrau/mann BEP M-Profil', 'KA', 3, 'KA_BEP'),
('KA_E', 'Kauffrau/mann E-Profil', 'KA', 3, 'KA'),
('KA_INT_E', 'Kauffrau/mann International E-Profil', 'KA', 3, 'KA_INT'),
('KA_M', 'Kauffrau/mann M-Profil', 'KA', 3, 'KA'),
('KA_V', 'Kauffrau/mann Vinto', 'KA', 4, 'KA'),
('KA_VL', 'Kauffrau/mann verkürzte Lehre', 'KA', 2, 'KA_WU'),
('KA_V_WU', 'Kauffrau/mann Vinto way up', 'KA', 3, 'KA_WU'),
('KA_WU', 'Kauffrau/mann way up', 'KA', 2, 'KA_WU'),
('KA_WU_BEP', 'Kauffrau/mann way up BEP', 'KA', 2, 'KA_BEP_WU'),
('MM_ABU', 'Mediamatiker/in ABU', 'MM', 4, 'MM'),
('MM_BM', 'Mediamatiker/in BM', 'MM', 4, 'MM'),
('MM_WU', 'Mediamatiker/in way up', 'MM', 2, 'MM_WU');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `_schulort`
--

CREATE TABLE `_schulort` (
  `id` tinyint(4) NOT NULL,
  `schulort` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `_schulort`
--

INSERT INTO `_schulort` (`id`, `schulort`) VALUES
(1, 'Zug'),
(2, 'Sursee'),
(3, 'Horgen');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `_taetigkeit`
--

CREATE TABLE `_taetigkeit` (
  `id` varchar(5) NOT NULL,
  `taetigkeit` varchar(30) NOT NULL,
  `reihenfolge` tinyint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `_taetigkeit`
--

INSERT INTO `_taetigkeit` (`id`, `taetigkeit`, `reihenfolge`) VALUES
('KAR', 'Kein Arbeitstag', 10),
('PEI', 'Prozesseinheit', 6),
('PRA', 'Praxis', 1),
('SCH', 'Schule', 2),
('SEM', 'Seminar', 4),
('STU', 'Stützkurs', 5),
('UEK', 'ÜK', 3);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `absenz_anfrage`
--
ALTER TABLE `absenz_anfrage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `anfrage` (`anfrage`);

--
-- Indizes für die Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_2` (`email`),
  ADD KEY `email` (`email`);

--
-- Indizes für die Tabelle `benutzer_einstellungen`
--
ALTER TABLE `benutzer_einstellungen`
  ADD PRIMARY KEY (`benutzer`);

--
-- Indizes für die Tabelle `berechtigung`
--
ALTER TABLE `berechtigung`
  ADD PRIMARY KEY (`benutzer`,`berechtigung`),
  ADD KEY `berechtigung` (`berechtigung`);

--
-- Indizes für die Tabelle `berufsbildner`
--
ALTER TABLE `berufsbildner`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `feiertag`
--
ALTER TABLE `feiertag`
  ADD PRIMARY KEY (`datum`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indizes für die Tabelle `halbtag`
--
ALTER TABLE `halbtag`
  ADD PRIMARY KEY (`lehrling`,`tag`,`halbtag`),
  ADD KEY `id` (`id`),
  ADD KEY `taetigkeit` (`taetigkeit`),
  ADD KEY `absenz` (`absenz`),
  ADD KEY `lehrling` (`lehrling`);

--
-- Indizes für die Tabelle `halbtag_korrektur`
--
ALTER TABLE `halbtag_korrektur`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `lehrjahr`
--
ALTER TABLE `lehrjahr`
  ADD PRIMARY KEY (`lehrling`,`vertragsjahr`),
  ADD KEY `lehrprofil` (`lehrgang`(1)),
  ADD KEY `lehrprofil_2` (`lehrgang`);

--
-- Indizes für die Tabelle `lehrling`
--
ALTER TABLE `lehrling`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nr` (`nr`),
  ADD KEY `berufsbildner` (`berufsbildner`),
  ADD KEY `lehrprofil_2` (`lehrgang`),
  ADD KEY `schule` (`schulort`);

--
-- Indizes für die Tabelle `praxisbetrieb`
--
ALTER TABLE `praxisbetrieb`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `praxisbildner`
--
ALTER TABLE `praxisbildner`
  ADD PRIMARY KEY (`id`),
  ADD KEY `praxisbetrieb` (`praxisbetrieb`);

--
-- Indizes für die Tabelle `praxiseinsatz`
--
ALTER TABLE `praxiseinsatz`
  ADD PRIMARY KEY (`lehrling`,`startdatum`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `praxisbildner` (`praxisbildner`),
  ADD KEY `lehrling` (`lehrling`);

--
-- Indizes für die Tabelle `rapport`
--
ALTER TABLE `rapport`
  ADD PRIMARY KEY (`lehrling`,`monat`,`praxisbildner`),
  ADD UNIQUE KEY `rechnungsnr` (`rechnungsnr`),
  ADD KEY `berufsbildner` (`berufsbildner`),
  ADD KEY `praxisbildner` (`praxisbildner`),
  ADD KEY `id_2` (`id`),
  ADD KEY `lehrling` (`lehrling`);

--
-- Indizes für die Tabelle `rapport_abgelehnt`
--
ALTER TABLE `rapport_abgelehnt`
  ADD PRIMARY KEY (`id`),
  ADD KEY `abgelehnt` (`benutzer`);

--
-- Indizes für die Tabelle `schulferien`
--
ALTER TABLE `schulferien`
  ADD PRIMARY KEY (`schulort`,`startdatum`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `schulort` (`schulort`);

--
-- Indizes für die Tabelle `_absenz`
--
ALTER TABLE `_absenz`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `_berechtigung`
--
ALTER TABLE `_berechtigung`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `_kostenstelle`
--
ALTER TABLE `_kostenstelle`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `_lehrberuf`
--
ALTER TABLE `_lehrberuf`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `_lehrgang`
--
ALTER TABLE `_lehrgang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lehrberuf` (`lehrberuf`),
  ADD KEY `kostenstelle` (`kostenstelle`);

--
-- Indizes für die Tabelle `_schulort`
--
ALTER TABLE `_schulort`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `_taetigkeit`
--
ALTER TABLE `_taetigkeit`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT für Tabelle `feiertag`
--
ALTER TABLE `feiertag`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `halbtag`
--
ALTER TABLE `halbtag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2128;
--
-- AUTO_INCREMENT für Tabelle `praxisbetrieb`
--
ALTER TABLE `praxisbetrieb`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT für Tabelle `praxiseinsatz`
--
ALTER TABLE `praxiseinsatz`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT für Tabelle `rapport`
--
ALTER TABLE `rapport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT für Tabelle `schulferien`
--
ALTER TABLE `schulferien`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT für Tabelle `_schulort`
--
ALTER TABLE `_schulort`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `absenz_anfrage`
--
ALTER TABLE `absenz_anfrage`
  ADD CONSTRAINT `absenz_anfrage_ibfk_3` FOREIGN KEY (`id`) REFERENCES `halbtag` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `absenz_anfrage_ibfk_4` FOREIGN KEY (`anfrage`) REFERENCES `_absenz` (`id`) ON UPDATE CASCADE;

--
-- Constraints der Tabelle `benutzer_einstellungen`
--
ALTER TABLE `benutzer_einstellungen`
  ADD CONSTRAINT `benutzer_einstellungen_ibfk_1` FOREIGN KEY (`benutzer`) REFERENCES `benutzer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `berechtigung`
--
ALTER TABLE `berechtigung`
  ADD CONSTRAINT `berechtigung_ibfk_1` FOREIGN KEY (`benutzer`) REFERENCES `benutzer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `berechtigung_ibfk_2` FOREIGN KEY (`berechtigung`) REFERENCES `_berechtigung` (`id`) ON UPDATE CASCADE;

--
-- Constraints der Tabelle `berufsbildner`
--
ALTER TABLE `berufsbildner`
  ADD CONSTRAINT `berufsbildner_ibfk_1` FOREIGN KEY (`id`) REFERENCES `benutzer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `halbtag`
--
ALTER TABLE `halbtag`
  ADD CONSTRAINT `halbtag_ibfk_10` FOREIGN KEY (`lehrling`) REFERENCES `lehrling` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `halbtag_ibfk_5` FOREIGN KEY (`taetigkeit`) REFERENCES `_taetigkeit` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `halbtag_ibfk_9` FOREIGN KEY (`absenz`) REFERENCES `_absenz` (`id`) ON UPDATE CASCADE;

--
-- Constraints der Tabelle `halbtag_korrektur`
--
ALTER TABLE `halbtag_korrektur`
  ADD CONSTRAINT `halbtag_korrektur_ibfk_1` FOREIGN KEY (`id`) REFERENCES `halbtag` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `lehrjahr`
--
ALTER TABLE `lehrjahr`
  ADD CONSTRAINT `lehrjahr_ibfk_1` FOREIGN KEY (`lehrling`) REFERENCES `lehrling` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lehrjahr_ibfk_2` FOREIGN KEY (`lehrgang`) REFERENCES `_lehrgang` (`id`) ON UPDATE CASCADE;

--
-- Constraints der Tabelle `lehrling`
--
ALTER TABLE `lehrling`
  ADD CONSTRAINT `lehrling_ibfk_3` FOREIGN KEY (`id`) REFERENCES `benutzer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lehrling_ibfk_6` FOREIGN KEY (`berufsbildner`) REFERENCES `berufsbildner` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `lehrling_ibfk_7` FOREIGN KEY (`lehrgang`) REFERENCES `_lehrgang` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `lehrling_ibfk_8` FOREIGN KEY (`schulort`) REFERENCES `_schulort` (`id`) ON UPDATE CASCADE;

--
-- Constraints der Tabelle `praxisbildner`
--
ALTER TABLE `praxisbildner`
  ADD CONSTRAINT `praxisbildner_ibfk_1` FOREIGN KEY (`id`) REFERENCES `benutzer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `praxisbildner_ibfk_2` FOREIGN KEY (`praxisbetrieb`) REFERENCES `praxisbetrieb` (`id`) ON UPDATE CASCADE;

--
-- Constraints der Tabelle `praxiseinsatz`
--
ALTER TABLE `praxiseinsatz`
  ADD CONSTRAINT `praxiseinsatz_ibfk_1` FOREIGN KEY (`lehrling`) REFERENCES `lehrling` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `praxiseinsatz_ibfk_2` FOREIGN KEY (`praxisbildner`) REFERENCES `praxisbildner` (`id`) ON UPDATE CASCADE;

--
-- Constraints der Tabelle `rapport`
--
ALTER TABLE `rapport`
  ADD CONSTRAINT `rapport_ibfk_5` FOREIGN KEY (`praxisbildner`) REFERENCES `praxisbildner` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `rapport_ibfk_6` FOREIGN KEY (`berufsbildner`) REFERENCES `berufsbildner` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `rapport_ibfk_7` FOREIGN KEY (`lehrling`) REFERENCES `lehrling` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `rapport_abgelehnt`
--
ALTER TABLE `rapport_abgelehnt`
  ADD CONSTRAINT `rapport_abgelehnt_ibfk_2` FOREIGN KEY (`benutzer`) REFERENCES `benutzer` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `rapport_abgelehnt_ibfk_3` FOREIGN KEY (`id`) REFERENCES `rapport` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `schulferien`
--
ALTER TABLE `schulferien`
  ADD CONSTRAINT `schulferien_ibfk_1` FOREIGN KEY (`schulort`) REFERENCES `_schulort` (`id`) ON UPDATE CASCADE;

--
-- Constraints der Tabelle `_lehrgang`
--
ALTER TABLE `_lehrgang`
  ADD CONSTRAINT `_lehrgang_ibfk_1` FOREIGN KEY (`lehrberuf`) REFERENCES `_lehrberuf` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `_lehrgang_ibfk_2` FOREIGN KEY (`kostenstelle`) REFERENCES `_kostenstelle` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
