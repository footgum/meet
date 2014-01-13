
CREATE TABLE IF NOT EXISTS `person` (
  `firstname` varchar(128) COLLATE cp1251_general_cs NOT NULL,
  `lastname` varchar(128) COLLATE cp1251_general_cs NOT NULL,
  `income` int(11) DEFAULT NULL,
  `mail` varchar(128) COLLATE cp1251_general_cs NOT NULL,
  `login` varchar(128) COLLATE cp1251_general_cs NOT NULL,
  `password` varchar(128) COLLATE cp1251_general_cs NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=cp1251 COLLATE=cp1251_general_cs AUTO_INCREMENT=1 ;

