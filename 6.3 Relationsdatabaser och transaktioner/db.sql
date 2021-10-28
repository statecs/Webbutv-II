CREATE TABLE `usercomments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `time` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(128) NOT NULL,
  `homepage` varchar(128) NOT NULL,
  `comment` varchar(128) NOT NULL,
   primary key (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `gallery` (
  `id` int NOT NULL AUTO_INCREMENT,
  `imageType` varchar(255) NOT NULL,
  `image` MEDIUMBLOB NOT NULL,
   primary key (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;