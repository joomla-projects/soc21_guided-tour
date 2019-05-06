<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_newsfeeds
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Newsfeeds\Administrator\Field\Modal;

defined('JPATH_BASE') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Form\FormField;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\LanguageHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Session\Session;

/**
 * Supports a modal newsfeeds picker.
 *
 * @since  1.6
 */
class NewsfeedField extends FormField
{
	/**
	 * The form field type.
	 *
	 * @var     string
	 * @since   1.6
	 */
	protected $type = 'Modal_Newsfeed';

	/**
	 * Method to get the field input markup.
	 *
	 * @return  string  The field input markup.
	 *
	 * @since   1.6
	 */
	protected function getInput()
	{
		$allowNew       = ((string) $this->element['new'] == 'true');
		$allowEdit      = ((string) $this->element['edit'] == 'true');
		$allowClear     = ((string) $this->element['clear'] != 'false');
		$allowSelect    = ((string) $this->element['select'] != 'false');
		$allowPropagate = ((string) $this->element['propagate'] == 'true');

		$languages = LanguageHelper::getContentLanguages(array(0, 1));

		// Load language
		Factory::getLanguage()->load('com_newsfeeds', JPATH_ADMINISTRATOR);

		// The active newsfeed id field.
		$value = (int) $this->value > 0 ? (int) $this->value : '';

		// Create the modal id.
		$modalId = 'Newsfeed_' . $this->id;

		// Add the modal field script to the document head.
		HTMLHelper::_('script', 'system/fields/modal-fields.min.js', array('version' => 'auto', 'relative' => true));

		// Script to proxy the select modal function to the modal-fields.js file.
		if ($allowSelect)
		{
			static $scriptSelect = null;

			if (is_null($scriptSelect))
			{
				$scriptSelect = array();
			}

			if (!isset($scriptSelect[$this->id]))
			{
				Factory::getDocument()->addScriptDeclaration("
				function jSelectNewsfeed_" . $this->id . "(id, title, object) {
					window.processModalSelect('Newsfeed', '" . $this->id . "', id, title, '', object);
				}
				"
				);

				Text::script('JGLOBAL_ASSOCIATIONS_PROPAGATE_FAILED');

				$scriptSelect[$this->id] = true;
			}
		}

		// Setup variables for display.
		$linkNewsfeeds = 'index.php?option=com_newsfeeds&amp;view=newsfeeds&amp;layout=modal&amp;tmpl=component&amp;' . Session::getFormToken() . '=1';
		$linkNewsfeed  = 'index.php?option=com_newsfeeds&amp;view=newsfeed&amp;layout=modal&amp;tmpl=component&amp;' . Session::getFormToken() . '=1';
		$modalTitle    = Text::_('COM_NEWSFEEDS_CHANGE_FEED');

		if (isset($this->element['language']))
		{
			$linkNewsfeeds .= '&amp;forcedLanguage=' . $this->element['language'];
			$linkNewsfeed  .= '&amp;forcedLanguage=' . $this->element['language'];
			$modalTitle    .= ' &#8212; ' . $this->element['label'];
		}

		$urlSelect = $linkNewsfeeds . '&amp;function=jSelectNewsfeed_' . $this->id;
		$urlEdit   = $linkNewsfeed . '&amp;task=newsfeed.edit&amp;id=\' + document.getElementById("' . $this->id . '_id").value + \'';
		$urlNew    = $linkNewsfeed . '&amp;task=newsfeed.add';

		if ($value)
		{
			$db    = Factory::getDbo();
			$query = $db->getQuery(true)
				->select($db->quoteName('name'))
				->from($db->quoteName('#__newsfeeds'))
				->where($db->quoteName('id') . ' = ' . (int) $value);
			$db->setQuery($query);

			try
			{
				$title = $db->loadResult();
			}
			catch (\RuntimeException $e)
			{
				Factory::getApplication()->enqueueMessage($e->getMessage(), 'error');
			}
		}

		$title = empty($title) ? Text::_('COM_NEWSFEEDS_SELECT_A_FEED') : htmlspecialchars($title, ENT_QUOTES, 'UTF-8');

		// The current newsfeed display field.
		$html  = '';
		if ($allowSelect || $allowNew || $allowEdit || $allowClear)
		{
			$html .= '<span class="input-group">';
		}

		$html .= '<input class="form-control" id="' . $this->id . '_name" type="text" value="' . $title . '" readonly size="35">';

		if ($allowSelect || $allowNew || $allowEdit || $allowClear)
		{
			$html .= '<span class="input-group-append">';
		}

		// Select newsfeed button
		if ($allowSelect)
		{
			$html .= '<button'
				. ' class="btn btn-primary hasTooltip' . ($value ? ' hidden' : '') . '"'
				. ' id="' . $this->id . '_select"'
				. ' data-toggle="modal"'
				. ' type="button"'
				. ' data-target="#ModalSelect' . $modalId . '"'
				. ' title="' . HTMLHelper::tooltipText('COM_NEWSFEEDS_CHANGE_FEED') . '">'
				. '<span class="icon-file" aria-hidden="true"></span> ' . Text::_('JSELECT')
				. '</button>';
		}

		// New newsfeed button
		if ($allowNew)
		{
			$html .= '<button'
				. ' class="btn btn-secondary hasTooltip' . ($value ? ' hidden' : '') . '"'
				. ' id="' . $this->id . '_new"'
				. ' data-toggle="modal"'
				. ' type="button"'
				. ' data-target="#ModalNew' . $modalId . '"'
				. ' title="' . HTMLHelper::tooltipText('COM_NEWSFEEDS_NEW_NEWSFEED') . '">'
				. '<span class="icon-new" aria-hidden="true"></span> ' . Text::_('JACTION_CREATE')
				. '</button>';
		}

		// Edit newsfeed button
		if ($allowEdit)
		{
			$html .= '<button'
				. ' class="btn btn-secondary hasTooltip' . ($value ? '' : ' hidden') . '"'
				. ' id="' . $this->id . '_edit"'
				. ' data-toggle="modal"'
				. ' type="button"'
				. ' data-target="#ModalEdit' . $modalId . '"'
				. ' title="' . HTMLHelper::tooltipText('COM_NEWSFEEDS_EDIT_NEWSFEED') . '">'
				. '<span class="icon-edit" aria-hidden="true"></span> ' . Text::_('JACTION_EDIT')
				. '</button>';
		}

		// Clear newsfeed button
		if ($allowClear)
		{
			$html .= '<button'
				. ' class="btn btn-secondary' . ($value ? '' : ' hidden') . '"'
				. ' id="' . $this->id . '_clear"'
				. ' type="button"'
				. ' onclick="window.processModalParent(\'' . $this->id . '\'); return false;">'
				. '<span class="icon-remove" aria-hidden="true"></span>' . Text::_('JCLEAR')
				. '</button>';
		}

		// Propagate newsfeed button
		if ($allowPropagate && count($languages) > 2)
		{
			// Strip off language tag at the end
			$tagLength = (int) strlen($this->element['language']);
			$callbackFunctionStem = substr("jSelectNewsfeed_" . $this->id, 0, -$tagLength);

			$html .= '<a'
			. ' class="btn hasTooltip' . ($value ? '' : ' hidden') . '"'
			. ' id="' . $this->id . '_propagate"'
			. ' href="#"'
			. ' title="' . HtmlHelper::tooltipText('JGLOBAL_ASSOCIATIONS_PROPAGATE_TIP') . '"'
			. ' onclick="Joomla.propagateAssociation(\'' . $this->id . '\', \'' . $callbackFunctionStem . '\');">'
			. '<span class="icon-refresh" aria-hidden="true"></span>' . Text::_('JGLOBAL_ASSOCIATIONS_PROPAGATE_BUTTON')
			. '</a>';
		}

		if ($allowSelect || $allowNew || $allowEdit || $allowClear)
		{
			$html .= '</span></span>';
		}

		// Select newsfeed modal
		if ($allowSelect)
		{
			$html .= HTMLHelper::_(
				'bootstrap.renderModal',
				'ModalSelect' . $modalId,
				array(
					'title'       => $modalTitle,
					'url'         => $urlSelect,
					'height'      => '400px',
					'width'       => '800px',
					'bodyHeight'  => 70,
					'modalWidth'  => 80,
					'footer'      => '<a role="button" class="btn btn-secondary" data-dismiss="modal" aria-hidden="true">'
										. Text::_('JLIB_HTML_BEHAVIOR_CLOSE') . '</a>',
				)
			);
		}

		// New newsfeed modal
		if ($allowNew)
		{
			$html .= HTMLHelper::_(
				'bootstrap.renderModal',
				'ModalNew' . $modalId,
				array(
					'title'       => Text::_('COM_NEWSFEEDS_NEW_NEWSFEED'),
					'backdrop'    => 'static',
					'keyboard'    => false,
					'closeButton' => false,
					'url'         => $urlNew,
					'height'      => '400px',
					'width'       => '800px',
					'bodyHeight'  => 70,
					'modalWidth'  => 80,
					'footer'      => '<a role="button" class="btn btn-secondary" aria-hidden="true"'
							. ' onclick="window.processModalEdit(this, \''
							. $this->id . '\', \'add\', \'newsfeed\', \'cancel\', \'newsfeed-form\', \'jform_id\', \'jform_name\'); return false;">'
							. Text::_('JLIB_HTML_BEHAVIOR_CLOSE') . '</a>'
							. '<a role="button" class="btn btn-primary" aria-hidden="true"'
							. ' onclick="window.processModalEdit(this, \''
							. $this->id . '\', \'add\', \'newsfeed\', \'save\', \'newsfeed-form\', \'jform_id\', \'jform_name\'); return false;">'
							. Text::_('JSAVE') . '</a>'
							. '<a role="button" class="btn btn-success" aria-hidden="true"'
							. ' onclick="window.processModalEdit(this, \''
							. $this->id . '\', \'add\', \'newsfeed\', \'apply\', \'newsfeed-form\', \'jform_id\', \'jform_name\'); return false;">'
							. Text::_('JAPPLY') . '</a>',
				)
			);
		}

		// Edit newsfeed modal.
		if ($allowEdit)
		{
			$html .= HTMLHelper::_(
				'bootstrap.renderModal',
				'ModalEdit' . $modalId,
				array(
					'title'       => Text::_('COM_NEWSFEEDS_EDIT_NEWSFEED'),
					'backdrop'    => 'static',
					'keyboard'    => false,
					'closeButton' => false,
					'url'         => $urlEdit,
					'height'      => '400px',
					'width'       => '800px',
					'bodyHeight'  => 70,
					'modalWidth'  => 80,
					'footer'      => '<a role="button" class="btn btn-secondary" aria-hidden="true"'
							. ' onclick="window.processModalEdit(this, \'' . $this->id
							. '\', \'edit\', \'newsfeed\', \'cancel\', \'newsfeed-form\', \'jform_id\', \'jform_name\'); return false;">'
							. Text::_('JLIB_HTML_BEHAVIOR_CLOSE') . '</a>'
							. '<a role="button" class="btn btn-primary" aria-hidden="true"'
							. ' onclick="window.processModalEdit(this, \''
							. $this->id . '\', \'edit\', \'newsfeed\', \'save\', \'newsfeed-form\', \'jform_id\', \'jform_name\'); return false;">'
							. Text::_('JSAVE') . '</a>'
							. '<a role="button" class="btn btn-success" aria-hidden="true"'
							. ' onclick="window.processModalEdit(this, \''
							. $this->id . '\', \'edit\', \'newsfeed\', \'apply\', \'newsfeed-form\', \'jform_id\', \'jform_name\'); return false;">'
							. Text::_('JAPPLY') . '</a>',
				)
			);
		}

		// Add class='required' for client side validation
		$class = $this->required ? ' class="required modal-value"' : '';

		$html .= '<input type="hidden" id="' . $this->id . '_id"' . $class . ' data-required="' . (int) $this->required . '" name="' . $this->name
			. '" data-text="' . htmlspecialchars(Text::_('COM_NEWSFEEDS_SELECT_A_FEED', true), ENT_COMPAT, 'UTF-8') . '" value="' . $value . '">';

		return $html;
	}

	/**
	 * Method to get the field label markup.
	 *
	 * @return  string  The field label markup.
	 *
	 * @since   3.4
	 */
	protected function getLabel()
	{
		return str_replace($this->id, $this->id . '_name', parent::getLabel());
	}
}