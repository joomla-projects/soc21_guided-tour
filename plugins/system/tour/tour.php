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
use Joomla\Event\Event;
use Joomla\Event\SubscriberInterface;

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
			$toolbar = JToolbar::getInstance('toolbar');
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
		/**
		 * @return void
		 */
		if ($this->app->isClient('administrator'))
		{
			/**
			 * TODO
			 */
		}
	}
}
