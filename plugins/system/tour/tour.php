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

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\WebAsset\WebAssetManager;
use Joomla\CMS\Component\ComponentHelper;

/**
 * PlgSystemTour
 *
 * @since  __DEPLOY_VERSION__
 */

class PlgSystemTour extends CMSPlugin implements SubscriberInterface
{
	/**
	 * Load the language file on instantiation
	 *
	 * @var    boolean
	 * @since  3.1
	 */
	protected $autoloadLanguage = true;

	/**
	 * Application object.
	 *
	 * @var    JApplicationCms
	 * @since  __DEPLOY_VERSION__
	 */
	protected $app;
	/**
	 * Returns an array of events this subscriber will listen to.
	 *
	 * @return  array
	 */
	public static function getSubscribedEvents(): array
	{
		return [
			'onBeforeRender' => 'onBeforeRender',
			'onBeforeCompileHead' => 'onBeforeCompileHead',
		];
	}

	/**
	 * Plugin method is the array value in the getSubscribedEvents method
	 * The plugin then modifies the Event object (if it's not immutable)
	 */

	/**
	 * @return void
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
			HTMLHelper::_(
				'script',
				Uri::root() . '/node_modules/shepherd.js/dist/js/shepherd.min.js',
				array('version' => 'auto', 'relative' => true)
			);

			HTMLHelper::_(
				'stylesheet',
				Uri::root() . '/node_modules/shepherd.js/dist/css/shepherd-theme-arrow.css',
				array('version' => 'auto', 'relative' => true)
			);

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
				Uri::root() . 'build/media-source/plg_system_tour/js/guide.js',
				array('version' => 'auto', 'relative' => true)
			);
		}
	}
}
