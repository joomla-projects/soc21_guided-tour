--
-- Table structure for table `#__guidedtours`
--

CREATE TABLE IF NOT EXISTS `#__guidedtours` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `description` text NOT NULL,
  `title` varchar(255) NOT NULL,
  `date` DATE NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `alias` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `published` tinyint NOT NULL DEFAULT 1,
  `ordering` int NOT NULL DEFAULT 0,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `created_by` int unsigned NOT NULL DEFAULT 0,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `modified_by` int unsigned NOT NULL DEFAULT 0,
  `state` TINYINT NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci;
  
--
-- Table structure for table `#__guidedtour_steps`
--

CREATE TABLE IF NOT EXISTS `#__guidedtour_steps` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `tour_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `title` varchar(255) NOT NULL,
  `date` DATE NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `alias` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `published` tinyint NOT NULL DEFAULT 1,
  `ordering` int NOT NULL DEFAULT 0,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int unsigned NOT NULL DEFAULT 0,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int unsigned NOT NULL DEFAULT 0,
  `state` TINYINT NOT NULL DEFAULT '1',
  KEY `idx_tour` (`tour_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci;


