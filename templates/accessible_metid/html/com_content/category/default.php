<?php // no direct access
defined('_JEXEC') or die('Restricted access');
$cparams =& JComponentHelper::getParams('com_media');
?>
<?php if ($this->params->get('show_page_title')) : ?>
	<div class="componentheading<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
		<h2><?php echo $this->escape($this->category->title); ?></h2>
	</div>
<?php endif; ?>
<div class="contentpane<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
	<div class="contentdescription<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
		<?php if ($this->category->image) : ?>
		<img src="<?php echo $this->baseurl . '/' . $cparams->get('image_path') . '/'. $this->category->image;?>" style="float:<?php echo $this->category->image_position;?>" alt="<?php echo $this->category->image;?>" />
		<?php endif; ?>
		<?php echo $this->category->description; ?>
	</div>
	<div>
	<?php
		$this->items =& $this->getItems();
		echo $this->loadTemplate('items');
	?>

	<?php if ($this->access->canEdit || $this->access->canEditOwn) :
			echo JHTML::_('icon.create', $this->category  , $this->params, $this->access);
	endif; ?>
	</div>
</div>
