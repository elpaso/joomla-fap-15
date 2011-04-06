<?php
/**
* This file is part of Joomla! 1.5 FAP
* @version      $Id: helper.php 9877 2008-01-05 12:37:25Z mtk $
* @package      JoomlaFAP
* @copyright    Copyright (C) 2008 Alessandro Pasotti http://www.itopen.it
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

// Impedisce l'accesso diretto al file
defined('_JEXEC') or die( 'Restricted access' );
require JPATH_COMPONENT_ADMINISTRATOR . DS . 'helpers' . DS . 'accesskeys.php';


// Crea pulsanti standard barra di strumenti
JToolBarHelper::title( JText::_('Access keys' ), 'generic.png');
//JToolBarHelper::deleteList();
//JToolBarHelper::editListX();
//JToolBarHelper::addNewX();
?>

<form action="index.php" method="post" name="adminForm">
<div id="editcell">
	<table class="adminlist">
	<thead>
		<tr>
			<th width="5">
				<?php echo JText::_('ID'); ?>
			</th>
			<th width="125">
				<?php echo JText::_('Menu type'); ?>
            <th width="125">
                <?php echo JText::_('Menu'); ?>
            </th>
			<th>
				<?php echo JText::_('Access key'); ?>
			</th>
            <th>
                <?php echo JText::_('Title'); ?>
            </th>
		</tr>
	</thead>
	<tfoot>
		<tr>
		<td colspan="5">
			<?php echo $this->pagination->getListFooter(); ?>
		</td>
		</tr>
	</tfoot>
	<tbody>
	<?php
	$k = 0;
	$n=count($this->items);

    // Set record Id
    if(is_array($this->ak_record) && count($this->ak_record)){
        $this->ak_record =  $this->ak_record[0];
    } else {
        $this->ak_record = 0; // Fake
    }

	for($i=0 ; $i < $n; $i++) {
		$row =& $this->items[$i];

		// Crea link per editare il record
		$edit_link = JRoute::_( 'index.php?option=com_accesskeys&controller=accesskeys&task=edit&cid[]='. $row->id );
		// Crea link per eliminare il record
		$delete_link = JRoute::_( 'index.php?option=com_accesskeys&controller=accesskeys&task=remove&cid[]='. $row->id );

	?>
		<tr class="<?php echo "row$k"; ?>">
			<td>
				<?php echo $row->id; ?>
			</td>
			<td>
				<?php echo $row->menutype; ?>
			</td>
			<td>
				<?php echo $row->name; ?>
			</td>
            <td>
                <?php

                    if($row->id == $this->ak_record){
                        ?><input type="hidden" id="cid_<?php echo $this->ak_record ?>" name="cid[]" value="<?php echo $this->ak_record ?>"/><input type="text" size="1" name="accesskey" value="<?php echo $row->accesskey ?>" />&nbsp;<button style="border:solid 1px gray;background:none" type="submit" ><img src="images/tick.png" border="0" alt="<?php echo JText::_( 'tick' ) ?>" />&nbsp;<?php echo JText::_( 'Save' )?></button>&nbsp;<button style="border:solid 1px gray;background:none" type="submit" onclick="$('cid_<?php echo $this->ak_record ?>').value=''" ><img src="images/publish_x.png" border="0" alt="<?php echo JText::_( 'Cancel' ) ?>" />&nbsp;<?php echo JText::_( 'Cancel' )?></button>
                        <?php
                    }
                    else
                    {
                    	echo JHTML::link($edit_link, JText::_( 'Edit' ));
                        ?>&nbsp;
                        <?php
                        	if(isset($row->accesskey) && '' != $row->accesskey){
                    			echo JHTML::link($delete_link, JText::_( 'Delete' ));
                    		}
                        ?>
                        &nbsp;<strong style="color:red"><?php echo $row->accesskey; ?></strong><?php
                    }
                ?>
            </td>
            <td>
                <?php

                    if($row->id == $this->ak_record){
                        ?><input type="text" size="64" maxlength="255" name="title" value="<?php echo $row->title ?>" />
                        <?php
                    }
                    else
                    {
                        ?>
                        <?php echo $row->title; ?><?php
                    }
                ?>
            </td>
		</tr>
	<?php
		//Per la classe che imposta lo sfondo delle righe a colori alternati
		$k = 1 - $k;
	}
	?>
	</tbody>
	</table>
</div>
<input type="hidden" name="option" value="com_accesskeys" />
<input type="hidden" name="task" id="task" value="<?php echo $this->ak_record ? 'save' : ''; ?>" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="controller" value="accesskeys" />
</form>