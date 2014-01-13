
CREATE TABLE IF NOT EXISTS `meeting` (
  `theme` varchar(256) COLLATE cp1251_general_cs NOT NULL,
  `city` varchar(256) COLLATE cp1251_general_cs NOT NULL,
  `address` varchar(256) COLLATE cp1251_general_cs NOT NULL,
  `startDate` TIMESTAMP NOT NULL,
  `maxParticipants` int(10) COLLATE cp1251_general_cs NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=cp1251 COLLATE=cp1251_general_cs AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `meetingparticipant` (
  `meetingid` int(11) NOT NULL,
  `personid` int(11) NOT NULL,
  PRIMARY KEY (`meetingid`, `personid`)
) ENGINE=InnoDB DEFAULT CHARSET=cp1251 COLLATE=cp1251_general_cs;