<?php

/**
 * File Doc Comment_
 * PHP version 5
 *
 * @category Component
 * @package  Joomla.Administrator
 * @author   Joomla! <admin@joomla.org>
 * @copyright (C) 2013 Open Source Matters, Inc. <https://www.joomla.org>
 * @license  GNU General Public License version 2 or later; see LICENSE.txt
 * @link     admin@joomla.org
 */



namespace Joomla\Component\Guidedtour\Administrator\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\BaseController;

/**
 * File Doc Comment
 * PHP version 5
 *
 * @category Component
 * @package  Joomla.Administrator
 * @author   Joomla! <admin@joomla.org>
 * @copyright (C) 2013 Open Source Matters, Inc. <https://www.joomla.org>
 * @license  GNU General Public License version 2 or later; see LICENSE.txt
 * @link     admin@joomla.org
 * @since 2013
 */
class DisplayController extends BaseController
{
	/**
	 * The default view.
	 *
	 * @var   string
	 * @since 1.6
	 */
<<<<<<< HEAD
	protected $defaultView = 'guidedtour';
=======
	protected $defaultView = 'hello';
>>>>>>> 0c33e78f5d325425969ca7ad09b11ade69a72e76

	/**
	 * Method to display a view.
	 *
	 * @param   boolean $cachable  If true, the view output will be cached
	 * @param   array   $urlparams An array of safe URL parameters and their variable types, for valid values see {@link \JFilterInput::clean()}.
	 *
	 * @return BaseController|boolean  This object to support chaining.
	 *
	 * @since 1.5
	 */
	public function display($cachable = false, $urlparams = array())
	{
		return parent::display($cachable, $urlparams);
	}
}
