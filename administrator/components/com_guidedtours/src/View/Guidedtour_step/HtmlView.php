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

namespace Joomla\Component\Guidedtours\Administrator\View\Guidedtour_step;

defined('_JEXEC') or die;

use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ContentHelper;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Associations;
use Joomla\CMS\Language\Multilanguage;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\GenericDataException;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Session\Session;
use Joomla\CMS\Toolbar\Toolbar;
use Joomla\CMS\Toolbar\ToolbarHelper;

// JLoader::register('MywalksHelperRoute', JPATH_SITE . '/components/com_mywalks/helpers/route.php');

/**
 * View to edit an article.
 *
 * @since  1.6
 */
class HtmlView extends BaseHtmlView
{
	/**
	 * The \JForm object
	 *
	 * @var  \JForm
	 */
	protected $form;

	/**
	 * The active item
	 *
	 * @var  object
	 */
	protected $item;

	/**
	 * The model state
	 *
	 * @var  object
	 */
	protected $state;

	/**
	 * The actions the user is authorised to perform
	 *
	 * @var  \JObject
	 */
	protected $canDo;

	/**
	 * Pagebreak TOC alias
	 *
	 * @var  string
	 */
	protected $eName;

	/**
	 * Execute and display a template script.
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  mixed  A string if successful, otherwise an Error object.
	 *
	 * @throws \Exception
	 * @since   1.6
	 */
	public function display($tpl = null)
	{
		$this->form  = $this->get('Form');
		$this->item  = $this->get('Item');
		$this->state = $this->get('State');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			throw new GenericDataException(implode("\n", $errors), 500);
		}

		$this->addToolbar();

		return parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @return  void
	 *
	 * @throws \Exception
	 * @since   1.6
	 */
	protected function addToolbar()
	{
		Factory::getApplication()->input->set('hidemainmenu', true);
		$user       = Factory::getUser();
		$userId     = $user->id;
		$isNew      = ($this->item->id == 0);

		// Built the actions for new and existing records.
		// $canDo = $this->canDo;

		$toolbar = Toolbar::getInstance();
		$title = $isNew ? 'Add Step' : 'Edit Step';
		$title = Text::_('Guided tour - ' . $title);
		ToolbarHelper::title($title);

		// For new records, check the create permission.
		if ($isNew)
		{
			$toolbar->apply('guidedtour_step.save');
		}
		else
		{
			$toolbar->apply('guidedtour_step.apply');
		}

		$toolbar->cancel('guidedtour_step.cancel', 'JTOOLBAR_CLOSE');
	}
}
