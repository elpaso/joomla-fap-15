<?php
/**
* This file is part of
* Joomla! 1.5 FAP
* @package   JoomlaFAP
* @version   $Id: form.php 95 2009-08-10 14:23:31Z elpaso $
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

defined('_JEXEC') or die('Restricted access');
?>
<script language="javascript" type="text/javascript">
<!--
function setgood() {
	// TODO: Put setGood back
	return true;
}

var sectioncategories = new Array;
<?php
$i = 0;
foreach ($this->lists['sectioncategories'] as $k=>$items) {
	foreach ($items as $v) {
		echo "sectioncategories[".$i++."] = new Array( '$k','".addslashes( $v->id )."','".addslashes( $v->title )."' );\n\t\t";
	}
}
?>


function submitbutton(pressbutton) {
	var form = $('adminForm');
	if (pressbutton == 'cancel') {
		submitform( pressbutton );
		return;
	}
	try {
		form.onsubmit();
	} catch(e) {
		alert(e);
	}

	// do field validation
	var text = <?php echo $this->editor->getContent( 'text' ); ?>
	if (form.title.value == '') {
		return alert ( "<?php echo JText::_( 'Article must have a title', true ); ?>" );
	} else if (text == '') {
		return alert ( "<?php echo JText::_( 'Article must have some text', true ); ?>");
	} else if (parseInt('<?php echo $this->article->sectionid;?>')) {
		// for articles
		if (form.catid && getSelectedValue('adminForm','catid') < 1) {
			return alert ( "<?php echo JText::_( 'Please select a category', true ); ?>" );
		}
	}
	<?php echo $this->editor->save( 'text' ); ?>
	submitform(pressbutton);
}
//-->
</script>
<form action="<?php echo htmlentities($this->action) ?>" method="post" id="adminForm" onSubmit="setgood();" class="editor">
<fieldset>
<legend><?php echo JText::_('Editor'); ?></legend>

		<div>
			<label for="title" class="block">
				<?php echo JText::_( 'Title' ); ?>:
			</label>
			<input class="inputbox" type="text" id="title" name="title" size="50" maxlength="100" value="<?php echo $this->escape($this->article->title); ?>" />
		</div>
		<div class="save">
			<button type="button" onclick="submitbutton('save')">
				<?php echo JText::_('Save') ?>
			</button>
			<button type="button" onclick="submitbutton('cancel')" />
				<?php echo JText::_('Cancel') ?>
			</button>
		</div>


<?php
echo $this->editor->display('text', $this->article->text, '100%', '400', '70', '15');
?>
</fieldset>
<fieldset class="publishing">
<legend><?php echo JText::_('Publishing'); ?></legend>

	<div>
		<label for="sectionid" class="block">
			<?php echo JText::_( 'Section' ); ?>:
		</label>
		<?php echo $this->lists['sectionid']; ?>
	</div>

	<div>
		<label for="catid" class="block">
			<?php echo JText::_( 'Category' ); ?>:
		</label>
		<?php echo $this->lists['catid']; ?>
	</div>

<?php if ($this->user->authorize('com_content', 'publish', 'content', 'all')) : ?>

	<div class="radio">
		<label for="state" class="block">
			<span><?php echo JText::_( 'Published' ); ?>:</span>
		</label>

		<?php echo $this->lists['state']; ?>
	</div>


<?php endif; ?>

	<div class="radio">
		<label for="frontpage" class="block">
			<span><?php echo JText::_( 'Show on Front Page' ); ?>:</span>
		</label>
		<?php echo $this->lists['frontpage']; ?>
	</div>

	<div>
		<label for="created_by_alias" class="block">
			<?php echo JText::_( 'Author Alias' ); ?>:
		</label>

		<input type="text" id="created_by_alias" name="created_by_alias" size="50" maxlength="100" value="<?php echo $this->article->created_by_alias; ?>" class="inputbox" />

	</div>

	<div>
		<label for="publish_up" class="block">
			<?php echo JText::_( 'Start Publishing' ); ?>:
		</label>
        <?php echo JHTML::_('calendar', $this->article->publish_up, 'publish_up', 'publish_up', '%Y-%m-%d %H:%M:%S', array('class'=>'inputbox', 'size'=>'25',  'maxlength'=>'19')); ?>
	</div>

	<div>
		<label for="publish_down" class="block">
			<?php echo JText::_( 'Finish Publishing' ); ?>:
		</label>
        <?php echo JHTML::_('calendar', $this->article->publish_down, 'publish_down', 'publish_down', '%Y-%m-%d %H:%M:%S', array('class'=>'inputbox', 'size'=>'25',  'maxlength'=>'19')); ?>
	</div>

	<div>
		<label for="access" class="block">
			<?php echo JText::_( 'Access Level' ); ?>:
		</label>

		<?php echo $this->lists['access']; ?>
	</div>

	<div>
		<label for="ordering" class="block">
			<?php echo JText::_( 'Ordering' ); ?>:
		</label>

		<?php echo $this->lists['ordering']; ?>
	</div>


</fieldset>

<fieldset class="metadata">
<legend><?php echo JText::_('Metadata'); ?></legend>


		<label for="metadesc" class="block">
			<?php echo JText::_( 'Description' ); ?>:
		</label>

		<textarea rows="5" cols="50" style="width:500px; height:120px" class="inputbox" id="metadesc" name="metadesc"><?php echo str_replace('&','&amp;',$this->article->metadesc); ?></textarea>

		<label for="metakey" class="block">
			<?php echo JText::_( 'Keywords' ); ?>:
		</label>

		<textarea rows="5" cols="50" style="width:500px; height:50px" class="inputbox" id="metakey" name="metakey"><?php echo str_replace('&','&amp;',$this->article->metakey); ?></textarea>

</fieldset>

	<input type="hidden" name="option" value="com_content" />
	<input type="hidden" name="Returnid" value="<?php echo $this->returnid; ?>" />
	<input type="hidden" name="id" value="<?php echo $this->article->id; ?>" />
	<input type="hidden" name="version" value="<?php echo $this->article->version; ?>" />
	<input type="hidden" name="created_by" value="<?php echo $this->article->created_by; ?>" />
	<input type="hidden" name="referer" value="<?php echo @$_SERVER['HTTP_REFERER']; ?>" />
	<input type="hidden" name="task" value="" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>
<script type="text/javascript">
	// Fix: http://forum.joomla.it/index.php?topic=77898.msg339813#msg339813
	document.adminForm = document.getElementById('adminForm');
</script>
<?php echo JHTML::_('behavior.keepalive'); ?>