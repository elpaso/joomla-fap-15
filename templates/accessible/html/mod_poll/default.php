<?php // no direct access
defined('_JEXEC') or die('Restricted access'); ?>
<form id="pollform" method="post" action="index.php">

<div class="poll<?php echo $params->get('moduleclass_sfx'); ?>">
    <fieldset>
	<legend class="poll-title"><?php echo $poll->title; ?></legend>
	<div class="poll-title"><?php echo $poll->title; ?></div>
    <?php for ($i = 0, $n = count($options); $i < $n; $i ++) : ?>
        <div class="<?php echo $tabclass_arr[$tabcnt]; ?><?php echo $params->get('moduleclass_sfx'); ?>">
                <input type="radio" name="voteid" id="voteid<?php echo $options[$i]->id;?>" value="<?php echo $options[$i]->id;?>" />
                <label for="voteid<?php echo $options[$i]->id;?>">
                    <?php echo $options[$i]->text; ?>
                </label>
        </div>
        <?php
            $tabcnt = 1 - $tabcnt;
        ?>
    <?php endfor; ?>
    </fieldset>
    <div>
        <input type="submit" name="task_button" class="button" value="<?php echo JText::_('Vote'); ?>" />
        &nbsp;
        <input type="button" name="option" class="button" value="<?php echo JText::_('Results'); ?>" onclick="document.location.href='<?php echo JRoute::_("index.php?option=com_poll&id=$poll->slug"); ?>'"  onkeypress="document.location.href='<?php echo JRoute::_("index.php?option=com_poll&id=$poll->slug"); ?>'"  />
    </div>
<input type="hidden" name="option" value="com_poll" />
<input type="hidden" name="Itemid" value="<?php echo $pollid; ?>" />
<input type="hidden" name="id" value="<?php echo $poll->id;?>" />
<input type="hidden" name="task" value="vote" />
<input type="hidden" name="<?php echo JUtility::getToken(); ?>" value="1" />
</div>
</form>