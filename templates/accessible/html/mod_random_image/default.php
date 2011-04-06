<?php // no direct access
defined('_JEXEC') or die('Restricted access'); ?>
<div id="random-image"><?php if ($link) : ?><a href="<?php echo $link; ?>"><?php endif; ?><?php echo JHTML::_('image', $image->folder.'/'.$image->name, $image->name, array('width' => $image->width, 'height' => $image->height)); ?><?php if ($link) : ?></a><?php endif; ?></div>
