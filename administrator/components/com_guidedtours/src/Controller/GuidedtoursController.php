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

namespace Joomla\Component\Guidedtours\Administrator\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\AdminController;

/**
 * Mywalks list controller class.
 *
 * @since  1.6
 */
class GuidedtoursController extends AdminController
{
	/**
	 * Proxy for getModel.
	 *
	 * @param   string  $name    The model name. Optional.
	 * @param   string  $prefix  The class prefix. Optional.
	 * @param   array   $config  The array of possible config values. Optional.
	 *
	 * @return  \Joomla\CMS\MVC\Model\BaseDatabaseModel
	 *
	 * @since   1.6
	 */
	public function getModel($name = 'Guidedtour', $prefix = 'Administrator', $config = array('ignore_request' => true))
	{
		return parent::getModel($name, $prefix, $config);
	}
}
