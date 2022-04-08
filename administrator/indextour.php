<?php
/**
 * @package    Joomla.Administrator
 *
 * @copyright  (C) 2005 Open Source Matters, Inc. <https://www.joomla.org>
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

// NOTE: This file should remain compatible with PHP 5.2 or higher version to allow us to run our PHP minimum check and show a friendly error message

// Define the application's minimum supported PHP version as a constant so it can be referenced within the application.
define('JOOMLA_MINIMUM_PHP', '7.2.5');

if (version_compare(PHP_VERSION, JOOMLA_MINIMUM_PHP, '<'))
{
	die(
		str_replace(
			'{{phpversion}}',
			JOOMLA_MINIMUM_PHP,
			file_get_contents(dirname(__FILE__) . '/../templates/system/incompatible.html')
		)
	);
}

/*
 * Constant that is checked in included files to prevent direct access.
 * define() is used rather than "const" to not error for PHP 5.2 and lower
 * this is only for PHP 5.2 or Higher version only 
 */
define('_JEXEC', 1);

// Run the application - All executable code should be triggered through this file
require_once dirname(__FILE__) . '/includes/app.php';
