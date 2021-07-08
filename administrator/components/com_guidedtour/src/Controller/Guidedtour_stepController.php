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

use Joomla\CMS\MVC\Controller\FormController;


/**
 *  Guidedtour_stepController <=> Guidedtour_StepController
 */
/**
 * @since 1.6
 */
class Guidedtour_StepController extends FormController
{
	/**
	 * Undocumented function
	 *
	 * @param   here  $key is the param
	 * @return void
	 */
	public function cancel($key = null)
	{
		$this->setRedirect('index.php?option=com_guidedtour&view=guidedtour_steps');
	}
}
