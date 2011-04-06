<?php
/**
* This file is part of
* Joomla! 1.5 FAP
* @package   JoomlaFAP
* @version   $Id:$
* @author    Alessandro Pasotti
* @copyright    Copyright (C) 2007-2009 Alessandro Pasotti http://www.itopen.it
* @license      GNU/AGPL

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU Affero General Public License as
    published by the Free Software Foundation, either version 3 of the
    License, or (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/


defined('_JEXEC') or die('Restricted access'); ?>
<script type="text/javascript">
	function tableOrdering( order, dir, task ) {
	var form = $('adminForm');

	form.filter_order.value 	= order;
	form.filter_order_Dir.value	= dir;
	form.submit( task );
}
</script>

<form action="<?php echo JFilterOutput::ampReplace($this->action); ?>" method="post" id="adminForm">
<div style="text-align:right">
    <?php
        echo JText::_('Display Num') .'&nbsp;';
        echo $this->pagination->getLimitBox();
    ?>
</div>

<table style="width:100%" border="0" cellspacing="0" cellpadding="0">
<?php if ( $this->params->def( 'show_headings', 1 ) ) : ?>
<thead>
    <tr>
        <th scope="col" style="text-align:right;width:0.5em" class="sectiontableheader<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
		  <?php echo JText::_('Num'); ?>
        </th>
        <th scope="col" style="width:90%;height:1em" class="sectiontableheader<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
            <?php echo JHTML::_('grid.sort',  'Web Link', 'title', $this->lists['order_Dir'], $this->lists['order'] ); ?>
        </th>
        <?php if ( $this->params->get( 'show_link_hits' ) ) : ?>
        <th scope="col" style="text-align:center;width:30%;height:1em;white-space:nowrap" class="sectiontableheader<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
            <?php echo JHTML::_('grid.sort',  'Hits', 'hits', $this->lists['order_Dir'], $this->lists['order'] ); ?>
        </th>
        <?php endif; ?>
    </tr>
</thead>
<?php endif; ?>
<tbody>
<?php foreach ($this->items as $item) : ?>
<tr class="sectiontableentry<?php echo $item->odd + 1; ?>">
	<td align="right">
		<?php echo $this->pagination->getRowOffset( $item->count ); ?>
	</td>
	<td style="height:1em">
		<?php if ( $item->image ) : ?>
		&nbsp;&nbsp;<?php echo $item->image;?>&nbsp;&nbsp;
		<?php endif; ?>
		<?php echo $item->link; ?>
		<?php if ( $this->params->get( 'show_link_description' ) ) : ?>
		<br /><span class="description"><?php echo nl2br($item->description); ?></span>
		<?php endif; ?>
	</td>
	<?php if ( $this->params->get( 'show_link_hits' ) ) : ?>
	<td style="text-align:center">
		<?php echo $item->hits; ?>
	</td>
	<?php endif; ?>
</tr>
<?php endforeach; ?>
<tr>
	<td style="text-align:center" colspan="4" class="sectiontablefooter<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
	<?php echo $this->pagination->getPagesLinks(); ?>
	</td>
</tr>
<tr>
	<td style="text-align:right" colspan="4" class="pagecounter">
		<?php echo $this->pagination->getPagesCounter(); ?>
        <input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
        <input type="hidden" name="filter_order_Dir" value="" />
	</td>
</tr>
</tbody>
</table>
</form>