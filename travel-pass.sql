-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for travel-pass
CREATE DATABASE IF NOT EXISTS `travel-pass` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `travel-pass`;

-- Dumping structure for table travel-pass.provinces
CREATE TABLE IF NOT EXISTS `provinces` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `province_name` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=202 DEFAULT CHARSET=latin1;

-- Dumping data for table travel-pass.provinces: ~108 rows (approximately)
DELETE FROM `provinces`;
/*!40000 ALTER TABLE `provinces` DISABLE KEYS */;
INSERT INTO `provinces` (`id`, `province_name`, `name`, `status`) VALUES
	(1, 'Sorsogon', 'Barcelona', 'GCQ'),
	(2, 'Sorsogon', 'Bulan', 'MECQ'),
	(3, 'Sorsogon', 'Bulusan', 'GCQ'),
	(4, 'Sorsogon', 'Casiguran', 'MECQ'),
	(5, 'Sorsogon', 'Castilla', 'GCQ'),
	(6, 'Sorsogon', 'Donsol', 'ECQ'),
	(7, 'Sorsogon', 'Gubat	', 'GCQ'),
	(8, 'Sorsogon', 'Irosin', 'MECQ'),
	(9, 'Sorsogon', 'Juban', 'GCQ'),
	(10, 'Sorsogon', 'Magallanes', 'ECQ'),
	(11, 'Sorsogon', 'Matnog', 'MECQ'),
	(12, 'Sorsogon', 'Pilar', 'GCQ'),
	(13, 'Sorsogon', 'Prieto Diaz', 'MECQ'),
	(14, 'Sorsogon', 'Santa Magdalena', 'GCQ'),
	(15, 'Sorsogon', 'Sorsogon City', 'GCQ'),
	(109, 'Albay', 'Bacacay', 'GCQ'),
	(110, 'Albay', 'Camalig', 'GCQ'),
	(111, 'Albay', 'Daraga', 'GCQ'),
	(112, 'Albay', 'Ginubatan', 'GCQ'),
	(113, 'Albay', 'Jovellar', 'GCQ'),
	(114, 'Albay', 'Libon', 'GCQ'),
	(115, 'Albay', 'Malilipot', 'GCQ'),
	(116, 'Albay', 'Malinaw', 'GCQ'),
	(117, 'Albay', 'Manito', 'GCQ'),
	(118, 'Albay', 'Oas', 'GCQ'),
	(119, 'Albay', 'Pio Duran', 'GCQ'),
	(120, 'Albay', 'Polangui', 'GCQ'),
	(121, 'Albay', 'Santo Domingo', 'GCQ'),
	(122, 'Albay', 'Rapu-rapu', 'GCQ'),
	(123, 'Albay', 'Tiwi', 'GCQ'),
	(124, 'Camarines Norte', 'Basud', 'GCQ'),
	(125, 'Camarines Norte', 'Capalonga', 'GCQ'),
	(126, 'Camarines Norte', 'Daet', 'GCQ'),
	(127, 'Camarines Norte', 'Jose Panganiban', 'GCQ'),
	(128, 'Camarines Norte', 'Labo', 'GCQ'),
	(129, 'Camarines Norte', 'Mecedes', 'GCQ'),
	(130, 'Camarines Norte', 'Paracale', 'GCQ'),
	(131, 'Camarines Norte', 'San Lorenzo Ruiz', 'GCQ'),
	(132, 'Camarines Norte', 'San Vicente', 'GCQ'),
	(133, 'Camarines Norte', 'Santa Elena', 'GCQ'),
	(134, 'Camarines Norte', 'Talisay', 'GCQ'),
	(135, 'Camarines Norte', 'Vinzons', 'GCQ'),
	(136, 'Camarines Sur', 'Baao', 'GCQ'),
	(137, 'Camarines Sur', 'Balatan', 'GCQ'),
	(138, 'Camarines Sur', 'Bato', 'GCQ'),
	(139, 'Camarines Sur', 'Bombon', 'GCQ'),
	(140, 'Camarines Sur', 'Buhi', 'GCQ'),
	(141, 'Camarines Sur', 'Bula', 'GCQ'),
	(142, 'Camarines Sur', 'Cabusao', 'GCQ'),
	(143, 'Camarines Sur', 'Calabanga', 'GCQ'),
	(144, 'Camarines Sur', 'Camaligan', 'GCQ'),
	(145, 'Camarines Sur', 'Canaman', 'GCQ'),
	(146, 'Camarines Sur', 'Caramoan', 'GCQ'),
	(147, 'Camarines Sur', 'Del Gallego', 'GCQ'),
	(148, 'Camarines Sur', 'Gainza', 'GCQ'),
	(149, 'Camarines Sur', 'Garchitorena', 'GCQ'),
	(150, 'Camarines Sur', 'Goa', 'GCQ'),
	(151, 'Camarines Sur', 'Lagonoy', 'GCQ'),
	(152, 'Camarines Sur', 'Libmanan', 'GCQ'),
	(153, 'Camarines Sur', 'Lupi', 'GCQ'),
	(154, 'Camarines Sur', 'Magarao', 'GCQ'),
	(155, 'Camarines Sur', 'Milaor', 'GCQ'),
	(156, 'Camarines Sur', 'Minalabac', 'GCQ'),
	(157, 'Camarines Sur', 'Nabua', 'GCQ'),
	(158, 'Camarines Sur', 'Ocampo', 'GCQ'),
	(159, 'Camarines Sur', 'Pamplona', 'GCQ'),
	(160, 'Camarines Sur', 'Pasacao', 'GCQ'),
	(161, 'Camarines Sur', 'Pili', 'GCQ'),
	(162, 'Camarines Sur', 'Presentacion', 'GCQ'),
	(163, 'Camarines Sur', 'Ragay', 'GCQ'),
	(164, 'Camarines Sur', 'Sagnay', 'GCQ'),
	(165, 'Camarines Sur', 'San Fernando', 'GCQ'),
	(166, 'Camarines Sur', 'San Jose', 'GCQ'),
	(167, 'Camarines Sur', 'Sipocot', 'GCQ'),
	(168, 'Camarines Sur', 'Siruma', 'GCQ'),
	(169, 'Camarines Sur', 'Tigaon', 'GCQ'),
	(170, 'Camarines Sur', 'Tinambac', 'GCQ'),
	(171, 'Catanduanes', 'Bagamanoc', 'GCQ'),
	(172, 'Catanduanes', 'Baras', 'GCQ'),
	(173, 'Catanduanes', 'Bato', 'GCQ'),
	(174, 'Catanduanes', 'Caramoran', 'GCQ'),
	(175, 'Catanduanes', 'Gigmoto', 'GCQ'),
	(176, 'Catanduanes', 'Pandan', 'GCQ'),
	(177, 'Catanduanes', 'Panganiban', 'GCQ'),
	(178, 'Catanduanes', 'San Andres', 'GCQ'),
	(179, 'Catanduanes', 'San Miguel', 'GCQ'),
	(180, 'Catanduanes', 'Viga', 'GCQ'),
	(181, 'Catanduanes', 'Virac', 'GCQ'),
	(182, 'Masbate', 'Aroroy', 'GCQ'),
	(183, 'Masbate', 'Baleno', 'GCQ'),
	(184, 'Masbate', 'Balud', 'GCQ'),
	(185, 'Masbate', 'Batuan', 'GCQ'),
	(186, 'Masbate', 'Cataingan', 'GCQ'),
	(187, 'Masbate', 'Cawayan', 'GCQ'),
	(188, 'Masbate', 'Claveria', 'GCQ'),
	(189, 'Masbate', 'Dimasalang', 'GCQ'),
	(190, 'Masbate', 'Esperanza', 'GCQ'),
	(191, 'Masbate', 'Mandaong', 'GCQ'),
	(192, 'Masbate', 'Milangros', 'GCQ'),
	(193, 'Masbate', 'Mobo', 'GCQ'),
	(194, 'Masbate', 'Monreal', 'GCQ'),
	(195, 'Masbate', 'Palanas', 'GCQ'),
	(196, 'Masbate', 'Pio. V. Corpuz', 'GCQ'),
	(197, 'Masbate', 'Placer', 'GCQ'),
	(198, 'Masbate', 'San Fernando', 'GCQ'),
	(199, 'Masbate', 'San Jacinto', 'GCQ'),
	(200, 'Masbate', 'San Pascual', 'GCQ'),
	(201, 'Masbate', 'Uson', 'GCQ');
/*!40000 ALTER TABLE `provinces` ENABLE KEYS */;

-- Dumping structure for table travel-pass.requirements
CREATE TABLE IF NOT EXISTS `requirements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table travel-pass.requirements: ~5 rows (approximately)
DELETE FROM `requirements`;
/*!40000 ALTER TABLE `requirements` DISABLE KEYS */;
INSERT INTO `requirements` (`id`, `name`) VALUES
	(1, 'Picture'),
	(2, 'Valid ID'),
	(3, 'Medical Certificate'),
	(4, 'Swab Certificate'),
	(5, 'Vaccine ID');
/*!40000 ALTER TABLE `requirements` ENABLE KEYS */;

-- Dumping structure for table travel-pass.status
CREATE TABLE IF NOT EXISTS `status` (
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table travel-pass.status: ~3 rows (approximately)
DELETE FROM `status`;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` (`status`) VALUES
	('ECQ'),
	('GCQ'),
	('MECQ');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;

-- Dumping structure for table travel-pass.status_requirements
CREATE TABLE IF NOT EXISTS `status_requirements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(255) DEFAULT NULL,
  `requirement_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Dumping data for table travel-pass.status_requirements: ~6 rows (approximately)
DELETE FROM `status_requirements`;
/*!40000 ALTER TABLE `status_requirements` DISABLE KEYS */;
INSERT INTO `status_requirements` (`id`, `status`, `requirement_id`) VALUES
	(4, 'MECQ', 1),
	(5, 'MECQ', 2),
	(6, 'MECQ', 5),
	(13, 'GCQ', 5),
	(14, 'ECQ', 2),
	(15, 'ECQ', 5);
/*!40000 ALTER TABLE `status_requirements` ENABLE KEYS */;

-- Dumping structure for table travel-pass.travels
CREATE TABLE IF NOT EXISTS `travels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) NOT NULL,
  `physical_address` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `gender` varchar(255) NOT NULL,
  `cp_number` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `purpose` text NOT NULL,
  `origin` int(11) NOT NULL DEFAULT '0',
  `destination` int(11) NOT NULL DEFAULT '0',
  `vehicle_type` varchar(255) NOT NULL,
  `plate_number` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `date_of_travel` date NOT NULL,
  `duration` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table travel-pass.travels: ~0 rows (approximately)
DELETE FROM `travels`;
/*!40000 ALTER TABLE `travels` DISABLE KEYS */;
/*!40000 ALTER TABLE `travels` ENABLE KEYS */;

-- Dumping structure for table travel-pass.travel_attachments
CREATE TABLE IF NOT EXISTS `travel_attachments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `travel_id` int(11) NOT NULL,
  `filename` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table travel-pass.travel_attachments: ~0 rows (approximately)
DELETE FROM `travel_attachments`;
/*!40000 ALTER TABLE `travel_attachments` DISABLE KEYS */;
/*!40000 ALTER TABLE `travel_attachments` ENABLE KEYS */;

-- Dumping structure for table travel-pass.travel_passengers
CREATE TABLE IF NOT EXISTS `travel_passengers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `travel_id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table travel-pass.travel_passengers: ~0 rows (approximately)
DELETE FROM `travel_passengers`;
/*!40000 ALTER TABLE `travel_passengers` DISABLE KEYS */;
/*!40000 ALTER TABLE `travel_passengers` ENABLE KEYS */;

-- Dumping structure for table travel-pass.travel_rejected
CREATE TABLE IF NOT EXISTS `travel_rejected` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `travel_id` int(11) NOT NULL,
  `reason` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table travel-pass.travel_rejected: ~0 rows (approximately)
DELETE FROM `travel_rejected`;
/*!40000 ALTER TABLE `travel_rejected` DISABLE KEYS */;
/*!40000 ALTER TABLE `travel_rejected` ENABLE KEYS */;

-- Dumping structure for table travel-pass.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `usertype` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table travel-pass.users: ~5 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `password`, `usertype`, `firstname`, `middlename`, `lastname`, `designation`) VALUES
	(1, 'admin', 'helloworld', 'System Administrator', 'PNP', '', 'Administrator', 'All'),
	(6, 'pnp_sorsogoncity', 'helloworld', 'PNP Staff', 'PNP Staff', '', 'Sorsogon', 'Sorsogon'),
	(7, 'pnp_albay', 'helloworld', 'PNP Staff', 'PNP Staff', '', 'Albay', 'Albay'),
	(8, 'pnp_director1', 'helloworld', 'PNP Director', 'Director', '', 'Sorsogon', 'Sorsogon'),
	(9, 'pnp_director2', 'helloworld', 'PNP Director', 'Director', '', 'Catanduaner', 'Catanduanes');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
