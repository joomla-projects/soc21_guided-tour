<?php

/**
 * File Doc Comment_
 * PHP version 5
 *
 * @category  Component
 * @package   Joomla.Administrator
 * @author    Joomla! <admin@joomla.org>
 * @copyright (C) 2013 Open Source Matters, Inc. <https://www.joomla.org>
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 * @link      admin@joomla.org
 */

namespace Joomla\Component\Guidedtours\Administrator\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\FormController;

/**
 * Controller for a single mywalk
 *
 * @since 1.6
 */
class Guidedtour_stepController extends FormController
{
	/**
	 * Cancel function for the display Controller
	 *
	 * @param   the param = $key which is used in the cancel function
	 * @return void
	 */
	public function cancel($key = null)
	{
		$this->setRedirect('index.php?option=com_guidedtours&view=guidedtour_steps');
	}
}
