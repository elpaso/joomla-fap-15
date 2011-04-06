<?php // @version $Id: confirm.php 36 2008-04-03 06:26:47Z elpaso $
defined('_JEXEC') or die('Restricted access');
?>

<div class="componentheading">
	<?php echo JText::_('Confirm your Account'); ?>
</div>

<form action="index.php?option=com_user&amp;task=confirmreset" method="post" class="josForm form-validate">
	<div class="contentpane">
		<p><?php echo JText::_('RESET_PASSWORD_CONFIRM_DESCRIPTION'); ?></p>
        <p>
          <label for="token" class="hasTip" title="<?php echo JText::_('RESET_PASSWORD_TOKEN_TIP_TITLE'); ?>::<?php echo JText::_('RESET_PASSWORD_TOKEN_TIP_TEXT'); ?>"><?php echo JText::_('Token'); ?>:</label>
        	<input id="token" name="token" type="text" class="required" size="36" />
        </p>
		<p>
          <label for="username" class="hasTip" title="<?php echo JText::_('RESET_PASSWORD_USERNAME_TIP_TITLE'); ?>::<?php echo JText::_('RESET_PASSWORD_USERNAME_TIP_TEXT'); ?>"><?php echo JText::_('User Name'); ?>:</label>
          <input id="username" name="username" type="text" class="required inputbox" size="36" />
        </p>
        <p>
          <button type="submit" class="validate"><?php echo JText::_('Submit'); ?></button>
        </p>
	    <?php echo JHTML::_( 'form.token' ); ?>
      </div>

</form>