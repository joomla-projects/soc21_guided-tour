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
defined('_JEXEC') or die;

use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\Event\SubscriberInterface;
use Joomla\CMS\Factory;
use Joomla\CMS\Toolbar\Toolbar;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Input\Input;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Uri\Uri;

/**
 * PlgSystemTour
 *
 * @since  __DEPLOY_VERSION__
 */
class PlgSystemTour extends CMSPlugin implements SubscriberInterface
{
	/**
	 * Application object.
	 *
	 * @var    JApplicationCms
	 * @since  __DEPLOY_VERSION__
	 */
	protected $app;
	/**
	 * function for getSubscribedEvents : new Joomla 4 feature
	 *
	 * @return array
	 */
	public static function getSubscribedEvents(): array
	{
		return [
			'onBeforeRender' => 'onBeforeRender',
			'onBeforeCompileHead' => 'onBeforeCompileHead'
		];
	}
	/**
	 * Listener for the `onBeforeRender` event
	 *
	 * @return  void
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function onBeforeRender()
	{
		// Run in backend
		if ($this->app->isClient('administrator'))
		{
			// Get an instance of the Toolbar
			$toolbar = Toolbar::getInstance('toolbar');
		}
	}

	/**
	 * Listener for the `onBeforeCompileHead` event
	 *
	 * @return  void
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function onBeforeCompileHead()
	{
		// Only going to run these in the backend for now
		if ($this->app->isClient('administrator'))
		{
			// Spliting the URL for get param of the layout,view,option etc
			$input = Factory::getApplication()->input;
			$this->loadLanguage();
			Factory::getDocument()->addScriptOptions(
				'tour-guide',
				array(
					'urlOption' => $input->get('option'),
					'urlView' => $input->get('view'),
					'urlLayout' => $input->get('layout'),
					'langtag'  => Factory::getLanguage()->getTag(),
					'baseUrl' => Uri::root(),
					'btnName' => Text::_('COM_PLG_TOUR_START_TOUR_BTN'),
				)
			);

			HTMLHelper::_(
				'script',
				Uri::root() . 'media/plg_system_tour/js/guide.js',
				array('version' => 'auto', 'relative' => true)
			);
		}
	}
}
