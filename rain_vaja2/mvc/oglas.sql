-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Gostitelj: localhost
-- Čas nastanka: 22. mar 2016 ob 23.48
-- Različica strežnika: 5.6.20-log
-- Različica PHP: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Zbirka podatkov: `vaja2`
--

-- --------------------------------------------------------

--
-- Struktura tabele `oglas`
--
CREATE TABLE IF NOT EXISTS `oglas` (
`ID` int(11) NOT NULL,
  `Naslov` longtext NOT NULL,
  `Vsebina` longtext NOT NULL,
  `DatumObjave` datetime NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Odloži podatke za tabelo `oglas`
--

INSERT INTO `oglas` (`ID`, `Naslov`, `Vsebina`, `DatumObjave`) VALUES
(1, 'Moj oglas', 'Moja vsebina', '2016-03-02 09:25:19'),
(2, 'moj nov bootstrap naslov', 'moja nova bootstrap vsebina', '2016-03-23 12:35:54');

--
-- Indeksi zavrženih tabel
--

--
-- Indeksi tabele `oglas`
--
ALTER TABLE `oglas`
 ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT zavrženih tabel
--

--
-- AUTO_INCREMENT tabele `oglas`
--
ALTER TABLE `oglas`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
