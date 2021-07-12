<?php

/**
 * @package     Mywalks.Administrator
 * @subpackage  com_mywalks
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Guidedtours\Administrator\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\FormController;

/**
 * Controller for a single mywalk
 *
 * @since  1.6
 */
class Guidedtour_stepController extends FormController
{
	public function cancel($key = null)
	{
		$this->setRedirect('index.php?option=com_guidedtours&view=guidedtour_steps');
	}
}
