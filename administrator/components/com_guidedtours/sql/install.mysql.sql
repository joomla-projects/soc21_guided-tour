
--
-- Table structure for table `#__mywalks`
--

CREATE TABLE IF NOT EXISTS `#__mywalks` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `title` varchar(64) NOT NULL,
  `description` text NOT NULL,
  'distance' int(11) NOT NULL,
  `state` TINYINT NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE utf8mb4_unicode_ci;

--
-- Dumping data for table `#__mywalks`
--

INSERT IGNORE INTO `#__mywalks` (`id`, `title`,`distance`, `description`) VALUES
(1, 'City Centre',3, 'Highligts of Anycity'),
(2, 'Woods',2, 'Woodland walk on hard paths'),
(3, 'Hills',3 ,'Hill walk with good views on established path.'),
(4, 'Lake Thingy',4 ,'Walk around the lake on an accessible path.'),
(5, 'Castle Railway Track',5, 'Walk along the line of the old railway track from start point car park to Thing castle');

-- --------------------------------------------------------

--
-- Table structure for table `#__mywalk_dates`
--

CREATE TABLE IF NOT EXISTS `#__mywalk_dates` (
`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `walk_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `date` date NOT NULL,
  `weather` varchar(256) DEFAULT NULL,
  `state` TINYINT NOT NULL DEFAULT '1',
  KEY `idx_walk` (`walk_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE utf8mb4_unicode_ci;

--
-- Dumping data for table `#__mywalk_dates`
--

INSERT IGNORE INTO `#__mywalk_dates` (`id`, `walk_id`, `title`, `date`, `weather`) VALUES
(1, 1,'title 1','2019-05-22', 'Dry and Sunny'),
(2, 2,'title 2', '2019-06-09', 'Wet and Windy'),
(3, 3,'title 3', '2019-01-01', 'Cold and wet'),
(4, 4,'title 4', '2019-01-20', 'Bright but frosty'),
(5, 5,'title 5', '2019-04-28', 'Dry and warm'),
(6, 1,'title 6', '2019-05-12', 'Wet and windy'),
(7, 3,'title 7', '2019-06-09', 'Hot and dry'),
(8, 5,'title 8', '2019-07-21', 'Overcast but warm and humid');
