
--
-- Table structure for table `#__mywalks`
--

CREATE TABLE IF NOT EXISTS `#__guidedtours` (
`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `title` varchar(64) NOT NULL,
  `description` text NOT NULL,
  `state` TINYINT NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci;

--
-- Dumping data for table `#__mywalks`
--

INSERT IGNORE INTO `#__guidedtours` (`id`, `title`, `description`) VALUES
(1, 'City Centre', 'Highligts of Anycity'),
(2, 'Woods', 'Woodland walk on hard paths'),
(3, 'Hills', 'Hill walk with good views on established path.'),
(4, 'Lake Thingy', 'Walk around the lake on an accessible path.'),
(5, 'Castle Railway Track', 'Walk along the line of the old railway track from start point car park to Thing castle');

-- --------------------------------------------------------

--
-- Table structure for table `#__mywalk_dates`
--

CREATE TABLE IF NOT EXISTS `#__guidedtour_steps` (
`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `walk_id` int(11) NOT NULL,
  `title` varchar(64) NOT NULL,
  `description` text DEFAULT NULL,
  `state` TINYINT NOT NULL DEFAULT '1',
  KEY `idx_walk` (`walk_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci;

--
-- Dumping data for table `#__mywalk_dates`
--


INSERT IGNORE INTO `#__guidedtour_steps` (`id`, `walk_id`, `title`, `description`) VALUES
(1, 1,'title 1', 'Dry and Sunny'),
(2, 2,'title 2',  'Wet and Windy'),
(3, 3,'title 3',  'Cold and wet'),
(4, 4,'title 4',  'Bright but frosty'),
(5, 5,'title 5',  'Dry and warm'),
(6, 1,'title 6',  'Wet and windy'),
(7, 3,'title 7', 'Hot and dry'),
(8, 5,'title 8',  'Overcast but warm and humid');





