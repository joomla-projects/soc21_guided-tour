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

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;

HTMLHelper::_('behavior.formvalidator');
HTMLHelper::_('behavior.keepalive');

?>

<form action="<?php echo Route::_('index.php?option=com_guidedtours&view=tour&layout=edit&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="guidedtours-form" class="form-validate">

	<?php echo LayoutHelper::render('joomla.edit.title_alias', $this); ?>

	<div>
		<?php echo HTMLHelper::_('uitab.startTabSet', 'myTab', array('active' => 'details')); ?>

		<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'details', Text::_('Details')); ?>
		<div class="row">
			<div class="col-lg">
				<!-- <div class="row"> -->
				<!-- <div class="col-md-6"> -->
				<?php echo $this->form->renderField('description'); ?>
				<?php echo $this->form->renderField('allowedlist'); ?>
				<!-- <?php echo $this->form->renderField('distance'); ?> -->
				<!-- <?php echo $this->form->renderField('id'); ?> -->



			</div>
			<div class="col-md-3">
				<div class="card card-light">
					<div class="card-body">
						<?php echo LayoutHelper::render('joomla.edit.global', $this); ?>
					</div>
				</div>
			</div>
		</div>
		<?php echo HTMLHelper::_('uitab.endTab'); ?>
		<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'publishing', Text::_('JGLOBAL_FIELDSET_PUBLISHING')); ?>
		<div class="row">
			<div class="col-12 col-lg-8">
				<fieldset id="fieldset-publishingdata" class="options-form">
					<legend><?php echo Text::_('JGLOBAL_FIELDSET_PUBLISHING'); ?></legend>
					<div>
						<?php echo LayoutHelper::render('joomla.edit.publishingdata', $this); ?>
					</div>
				</fieldset>
			</div>
			<?php echo HTMLHelper::_('uitab.endTab'); ?>

			<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'permissions', Text::_('Permissions')); ?>
			<div class="row">
				<div class="col-12 col-lg">
					<fieldset id="fieldset-rules" class="options-form">
						<legend><?php echo Text::_('Permissions'); ?></legend>
						<?php echo $this->form->getInput('rules'); ?>
					</fieldset>
				</div>
				<?php echo HTMLHelper::_('uitab.endTab'); ?>
			</div>
			<input type="hidden" name="task" value="">
			<?php echo HTMLHelper::_('form.token'); ?>
</form>
