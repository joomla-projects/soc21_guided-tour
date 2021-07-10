
--
-- Table structure for table `#__guidedtours`
--
CREATE TABLE IF NOT EXISTS `#__guidedtours` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `title` varchar(64) NOT NULL,
  `description` text NOT NULL,
  `state` TINYINT NOT NULL DEFAULT '1'
) EENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci;

--

-- Dumping data for table `#__guidedtours`
--

INSERT IGNORE INTO `#__guidedtours` (`id`, `title`, `description`) VALUES
(1, 'Guided tour 1 JS', 'Highligts of Anycity'),
(2, 'Guided tour 2 JS', 'Woodland walk on hard paths'),
(3, 'Guided tour 3 JS', 'Hill walk with good views on established path.'),
(4, 'Guided tour 4 JS', 'Walk around the lake on an accessible path.'),
(5, 'Guided tour 5 JS', 'Walk along the line of the old railway track from start point car park to Thing castle');

-- --------------------------------------------------------

--
-- Table structure for table `#__guidedtour_steps`
--

CREATE TABLE IF NOT EXISTS `#__guidedtour_steps` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `tour_id` int(11) NOT NULL,
  `step` int(11) NOT NULL,
  `description` text NOT NULL,
  `state` TINYINT NOT NULL DEFAULT '1',
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci;



--
-- Dumping data for table `#__guidedtour_steps`
--

INSERT IGNORE INTO `#__guidedtour_steps` (`id`, `tour_id`,`step`, `description`) VALUES
(1, 1, 1, 'Dry and Sunny'),
(2, 2, 1, 'Wet and Windy'),
(3, 3, 1, 'Cold and wet'),
(4, 4, 1, 'Bright but frosty'),
(5, 5, 1, 'Dry and warm'),
(6, 1, 2, 'Wet and windy'),
(7, 3, 2, 'Hot and dry'),
(8, 5, 2, 'Overcast but warm and humid');



