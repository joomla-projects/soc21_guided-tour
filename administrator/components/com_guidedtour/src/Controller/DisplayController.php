<?php
/**
 * @package    Joomla.Administrator
 * @subpackage com_guidedtour
 *
 * @copyright (C) 2009 Open Source Matters, Inc. <https://www.joomla.org>
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Guidedtour\Administrator\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\BaseController;

/**
 * Guidedtour master display controller.
 *
 * @since 1.6
 */
class DisplayController extends BaseController
{
     /**
      * The default view.
      *
      * @var   string
      * @since 1.6
      */
     protected $default_view = 'hello';

    /**
     * Method to display a view.
     *
     * @param boolean $cachable  If true, the view output will be cached
     * @param array   $urlparams An array of safe URL parameters and their variable types, for valid values see {@link \JFilterInput::clean()}.
     *
     * @return BaseController|boolean  This object to support chaining.
     *
     * @since 1.5
     */

   

    public function display($cachable = false, $urlparams = array())
    {
        return parent::display($cachable, $urlparams);
    }
}
