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

namespace Joomla\Component\Guidedtours\Administrator\Model;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\ListModel;
use Joomla\Utilities\ArrayHelper;
use Joomla\Database\ParameterType;

/**
 * Methods supporting a list of article records.
 *
 * @since 1.6
 */
class StepsModel extends ListModel
{
	/**
	 * Constructor.
	 *
	 * @param   array $config An optional associative array of configuration settings.
	 *
	 * @since 1.6
	 * @see   \Joomla\CMS\MVC\Controller\BaseController
	 */
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id', 'a.id',
				'tour_id', 'a.tour_id',
				'title', 'a.title',
				'description', 'a.description',
				'alias', 'a.alias',
				'published', 'a.published',
				'ordering', 'a.ordering',
				'created_by', 'a.created_by',
				'modified', 'a.modified',
				'modified_by', 'a.modified_by',
				'state', 'a.state',
			);
		}

		parent::__construct($config);
	}

	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @param   string $ordering  An optional ordering field.
	 * @param   string $direction An optional direction (asc|desc).
	 *
	 * @return void
	 *
	 * @since 1.6
	 */
	protected function populateState($ordering = 'a.id', $direction = 'asc')
	{
		$app = Factory::getApplication();

		// $tour_id = $app->input->get('tour_id', 0, 'int');
		$tour_id = $app->getUserStateFromRequest($this->context . '.filter.tour_id', 'tour_id', 0, 'int');

		if (empty($tour_id))
		{
			$tour_id = $app->getUserState('com_guidedtours.tour_id');
		}

		$this->setState('tour_id', $tour_id);

		// Keep the tour_id for adding new visits
		$app->setUserState('com_guidedtours.tour_id', $tour_id);

		$search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		$published = $this->getUserStateFromRequest($this->context . '.filter.published', 'filter_published', '');
		$this->setState('filter.published', $published);

		// List state information.
		parent::populateState($ordering, $direction);
	}

	/**
	 * Method to get a store id based on model configuration state.
	 *
	 * This is necessary because the model is used by the component and
	 * different modules that might need different sets of data or different
	 * ordering requirements.
	 *
	 * @param   string $id A prefix for the store id.
	 *
	 * @return string  A store id.
	 *
	 * @since 1.6
	 */
	protected function getStoreId($id = '')
	{
		// Compile the store id.
		$id .= ':' . $this->getState('filter.search');
		$id .= ':' . $this->getState('filter.published');

		return parent::getStoreId($id);
	}

	/**
	 * Build an SQL query to load the list data.
	 *
	 * @return \Joomla\Database\DatabaseQuery
	 *
	 * @since 1.6
	 */
	protected function getListQuery()
	{
		// Create a new query object.
		$db    = $this->getDbo();
		$query = $db->getQuery(true);

		// Select the required fields from the table.
		$query->select(
			$this->getState(
				'list.select',
				'a.*'
			)
		);
		$query->from('#__guidedtour_steps AS a');

		/**
		 * The tour id should be passed in url or hidden form variables
		 */

		/**
		 *  Filter Tour ID by levels
		 */
		$tour_id     = $this->getState('filter.tour_id');

		if (is_numeric($tour_id))
		{
			$tour_id = (int) $tour_id;
			$query->where($db->quoteName('a.tour_id') . ' = :tour_id')
				->bind(':tour_id', $tour_id, ParameterType::INTEGER);
		}
		elseif (is_array($tour_id))
		{
			$tour_id = ArrayHelper::toInteger($tour_id);
			$query->whereIn($db->quoteName('a.tour_id'), $tour_id);
		}

		$published = (string) $this->getState('filter.published');

		if (is_numeric($published))
		{
			$query->where($db->quoteName('a.state') . ' = :published');
			$query->bind(':published', $published, ParameterType::INTEGER);
		}
		elseif ($published === '')
		{
			$query->where('(' . $db->quoteName('a.state') . ' = 0 OR ' . $db->quoteName('a.state') . ' = 1)');
		}

		// Filter by search in title.
		$search = $this->getState('filter.search');

		if (!empty($search))
		{
			$search = $db->quote('%' . str_replace(' ', '%', $db->escape(trim($search), true) . '%'));
			$query->where('(a.title LIKE ' . $search . ')');
		}

		// Add the list ordering clause.
		$orderCol  = $this->state->get('list.ordering', 'a.id');
		$orderDirn = $this->state->get('list.direction', 'ASC');

		$query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));

		return $query;
	}

	/**
	 * Method to get a list of guidedtours.
	 * Overridden to add a check for access levels.
	 *
	 * @return mixed  An array of data items on success, false on failure.
	 *
	 * @since 4.0.0
	 */
	public function getItems()
	{
		$items = parent::getItems();

		return $items;
	}
}
