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

namespace Joomla\Component\Guidedtours\Administrator\View\Tour;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ContentHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\GenericDataException;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\Toolbar;
use Joomla\CMS\Toolbar\ToolbarHelper;

/**
 * View to edit an article.
 *
 * @since 1.6
 */
class HtmlView extends BaseHtmlView
{
	/**
	 * The \JForm object
	 *
	 * @var \JForm
	 */
	protected $form;

	/**
	 * The active item
	 *
	 * @var object
	 */
	protected $item;

	/**
	 * The model state
	 *
	 * @var object
	 */
	protected $state;

	/**
	 * The actions the user is authorised to perform
	 *
	 * @var \JObject
	 */
	protected $canDo;

	/**
	 * Execute and display a template script.
	 *
	 * @param   string $tpl The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return mixed  A string if successful, otherwise an Error object.
	 *
	 * @throws \Exception
	 * @since  1.6
	 */
	public function display($tpl = null)
	{
		$this->form  = $this->get('Form');
		$this->item  = $this->get('Item');
		$this->state = $this->get('State');

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
	 * @return void
	 *
	 * @throws \Exception
	 * @since  1.6
	 */
	protected function addToolbar()
	{
		Factory::getApplication()->input->set('hidemainmenu', true);

		$user       = Factory::getUser();
		$userId     = $user->id;
		$isNew      = empty($this->item->id);

		$canDo = ContentHelper::getActions('com_guidedtours');

		$toolbar = Toolbar::getInstance();

		ToolbarHelper::title(
			Text::_('Guided Tour - ' . ($isNew ? 'Add Tour' : 'Edit Tour'))
		);

		$toolbarButtons = [];

		if ($isNew)
		{
			// For new records, check the create permission.
			if ($canDo->get('core.create'))
			{
				ToolbarHelper::apply('tour.apply');
				$toolbarButtons = [['save', 'tour.save'], ['save2new', 'tour.save2new']];
			}

			ToolbarHelper::saveGroup(
				$toolbarButtons,
				'btn-success'
			);

			ToolbarHelper::cancel(
				'tour.cancel'
			);
		}
		else
		{
			// Since it's an existing record, check the edit permission, or fall back to edit own if the owner.
			$itemEditable = $canDo->get('core.edit') || ($canDo->get('core.edit.own') && $this->item->created_by == $userId);

			if ($itemEditable)
			{
				ToolbarHelper::apply('tour.apply');
				$toolbarButtons = [['save', 'tour.save']];

				// We can save this record, but check the create permission to see if we can return to make a new one.
				if ($canDo->get('core.create'))
				{
					$toolbarButtons[] = ['save2new', 'tour.save2new'];
					$toolbarButtons[] = ['save2copy', 'tour.save2copy'];
				}
			}

			ToolbarHelper::saveGroup(
				$toolbarButtons,
				'btn-success'
			);

					ToolbarHelper::cancel(
						'tour.cancel',
						'JTOOLBAR_CLOSE'
					);
		}
	}
}
