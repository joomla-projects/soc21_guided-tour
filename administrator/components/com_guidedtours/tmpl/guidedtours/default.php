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
defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;

$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));
$states = array(
	'0' => Text::_('JUNPUBLISHED'),
	'1' => Text::_('JPUBLISHED'),
	'2' => Text::_('JARCHIVED'),
	'-2' => Text::_('JTRASHED')
);
$editIcon = '<span class="fa fa-pen-square me-2" aria-hidden="true"></span>';
?>
<form action="<?php echo Route::_('index.php?option=com_guidedtours'); ?>" method="post" name="adminForm" id="adminForm">
	<div class="row">
		<div class="col-md-12">
			<div id="j-main-container" class="j-main-container">
				<?php echo LayoutHelper::render('joomla.searchtools.default', array('view' => $this)); ?>
				<?php if (empty($this->items)) : ?>
					<div class="alert alert-info">
						<span class="fa fa-info-circle" aria-hidden="true"></span><span class="sr-only"><?php echo Text::_('INFO'); ?></span>
						<?php echo Text::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
					</div>
				<?php else : ?>
					<table class="table" id="mywalksList">
						<caption id="captionTable">
							<?php echo Text::_('List'); ?>, <?php echo Text::_('JGLOBAL_SORTED_BY'); ?>
						</caption>
						<thead>
							<tr>
								<td style="width:1%" class="text-center">
									<?php echo HTMLHelper::_('grid.checkall'); ?>
								</td>
								<th scope="col" style="width:1%; min-width:85px" class="text-center">
									<?php echo HTMLHelper::_('searchtools.sort', 'JSTATUS', 'a.state', $listDirn, $listOrder); ?>
								</th>
								<th scope="col" style="width:20%">
									<?php echo HTMLHelper::_('searchtools.sort', 'Tour Title', 'a.title', $listDirn, $listOrder); ?>
								</th>
								<th scope="col" style="width:20%">
									<?php echo HTMLHelper::_('searchtools.sort', 'Description', 'a.description', $listDirn, $listOrder); ?>
								</th>

								<th scope="col" style="width:10%">
									<?php echo HTMLHelper::_('searchtools.sort', 'Steps', 'a.distance', $listDirn, $listOrder); ?>
								</th>


								<th scope="col" style="width:5%" class="d-none d-md-table-cell">
									<?php echo HTMLHelper::_('searchtools.sort', 'JGRID_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$n = count($this->items);
							foreach ($this->items as $i => $item) :
							?>
								<tr class="row<?php echo $i % 2; ?>">
									<td class="text-center">
										<?php echo HTMLHelper::_('grid.id', $i, $item->id); ?>
									</td>
									<td class="class=" article-status"">
										<?php echo $states[$item->state]; ?>
									</td>
									<th scope="row" class="has-context">
										<a class="hasTooltip" href="<?php echo Route::_('index.php?option=com_guidedtours&task=guidedtour.edit&id=' . $item->id); ?>">
											<?php echo $editIcon; ?><?php echo $this->escape($item->title); ?>
										</a>
									</th>
									<td class="">
										<?php echo $item->description; ?>
									</td>

									<td class="">
										<a href="index.php?option=com_guidedtours&view=guidedtour_steps&walk_id=<?php echo $item->id; ?>">
											<?php echo $editIcon; ?><?php echo $item->nvisits; ?></a>
									</td>


									<td class="d-none d-md-table-cell">
										<?php echo $item->id; ?>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>

					<?php // load the pagination. 
					?>
					<?php echo $this->pagination->getListFooter(); ?>

				<?php endif; ?>
				<input type="hidden" name="task" value="">
				<input type="hidden" name="boxchecked" value="0">
				<?php echo HTMLHelper::_('form.token'); ?>
			</div>
		</div>
	</div>
</form>