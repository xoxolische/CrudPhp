CREATE TABLE `address_book` (
  `id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` TINYINT(1) NOT NULL DEFAULT 0
) ENGINE=INNODB;

INSERT INTO `address_book` (`id`, `author`, `title`, `description`, `creation_date`, `deleted`) VALUES
(1, 'Author_1', 'Title_1', 'Description_1', CURRENT_TIMESTAMP, 0),
(2, 'Author_2', 'Title_2', 'Description_2', CURRENT_TIMESTAMP, 0),
(3, 'Author_3', 'Title_3', 'Description_3', CURRENT_TIMESTAMP, 0),
(4, 'Author_4', 'Title_4', 'Description_4', CURRENT_TIMESTAMP, 0),
(5, 'Author_5', 'Title_5', 'Description_5', CURRENT_TIMESTAMP, 0),
(6, 'Author_6', 'Title_6', 'Description_6', CURRENT_TIMESTAMP, 0),
(7, 'Author_7', 'Title_7', 'Description_7', CURRENT_TIMESTAMP, 0),
(8, 'Author_8', 'Title_8', 'Description_8', CURRENT_TIMESTAMP, 0),
(9, 'Author_9', 'Title_9', 'Description_9', CURRENT_TIMESTAMP, 0);

ALTER TABLE `address_book`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `address_book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
