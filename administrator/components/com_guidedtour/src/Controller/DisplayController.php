<?php


namespace Joomla\Component\Guidedtour\Administrator\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\BaseController;
/**
 * @package     Joomla.Administrator
 * @subpackage  com_guidedtour
 *
 * @copyright   (C) 2008 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
/**
 * Default Controller of HelloWorld component
 *
 * @package     Joomla.Administrator
 * @subpackage  com_guidedtour
 */
class DisplayController extends BaseController
{
    /**
     * The default view for the display method.
     *
     * @var string
     */

    protected $default_view = 'hello';

    public function display($cachable = false, $urlparams = array())
    {
        return parent::display($cachable, $urlparams);
    }
}
