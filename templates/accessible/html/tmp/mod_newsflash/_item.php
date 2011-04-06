<?php // no direct access
defined('_JEXEC') or die('Restricted access');

//ABP: added trigger for content plugins
$dispatcher        =& JDispatcher::getInstance();
$limitstart     = JRequest::getVar('limitstart', 0, '', 'int');
JPluginHelper::importPlugin('content');
$results = $dispatcher->trigger('onPrepareContent', array (& $item, & $params, $limitstart));

?>
<?php if ($params->get('item_title')) : ?>
<div class="contentheading<?php echo $params->get( 'moduleclass_sfx' ); ?>">
	<?php if ($params->get('link_titles') && $item->linkOn != '') : ?>
		<a href="<?php echo $item->linkOn;?>" class="contentpagetitle<?php echo $params->get( 'moduleclass_sfx' ); ?>">
			<?php echo $item->title;?></a>
	<?php else : ?>
		<?php echo $item->title; ?>
	<?php endif; ?>
</div>
<?php endif; ?>

<?php if (!$params->get('intro_only')) :
	echo $item->afterDisplayTitle;
endif; ?>

<?php echo $item->beforeDisplayContent; ?>

<div class="contentpaneopen<?php echo $params->get( 'moduleclass_sfx' ); ?>">
	<?php echo $item->text; ?>
</div>
<div>
<?php if (isset($item->linkOn) && $item->readmore && $params->get('readmore')) :
	echo '<a class="readon" title="' . JText::_('Read more') . ': ' . addcslashes($item->title, '\'') . '" href="'.$item->linkOn.'">'.JText::_('Read more').'</a>';
endif; ?>
</div>
