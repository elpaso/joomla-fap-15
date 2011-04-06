<?php // no direct access
defined('_JEXEC') or die('Restricted access'); ?>
<?php if($type == 'logout') : ?>
<form action="index.php" method="post" id="loginform">
<?php if ($params->get('greeting')) : ?>
	<div><?php echo JText::sprintf( 'HINAME', $user->get('name') ); ?></div>
<?php endif; ?>
	<div align="center">
		<input type="submit" name="Submit" class="button" value="<?php echo JText::_( 'BUTTON_LOGOUT'); ?>" />
        <input type="hidden" name="option" value="com_user" />
        <input type="hidden" name="task" value="logout" />
        <input type="hidden" name="return" value="<?php echo $return; ?>" />
	</div>

</form>
<?php else : ?>
<form action="index.php" method="post" id="loginform" >
	<?php echo $params->get('pretext'); ?>
    <div id="login">
			<label for="mod_login_username"><?php echo JText::_( 'Username' ); ?></label>
			<br />
			<input name="username" id="mod_login_username" type="text" class="inputbox" size="10" />
			<br />
			<label for="mod_login_password"><?php echo JText::_( 'Password' ); ?></label>
			<br />
			<input type="password" id="mod_login_password" name="passwd" class="inputbox" size="10" />
			<br />
			<input type="checkbox" name="remember" id="mod_login_remember" class="inputbox" value="yes" />
			<label for="mod_login_remember"><?php echo JText::_( 'Remember me' ); ?></label>
			<br />
			<input type="submit" name="Submit" class="button" value="<?php echo JText::_( 'BUTTON_LOGIN'); ?>" />
            <br />
            <a href="<?php echo JRoute::_( 'index.php?option=com_user&view=reset' ); ?>">
                <?php echo JText::_('FORGOT_YOUR_PASSWORD'); ?>
            </a>
            <br />
            <a href="<?php echo JRoute::_( 'index.php?option=com_user&view=remind' ); ?>">
                <?php echo JText::_('FORGOT_YOUR_USERNAME'); ?>
            </a>
            <?php
            $usersConfig = &JComponentHelper::getParams( 'com_users' );
            if ($usersConfig->get('allowUserRegistration')) : ?>
                    <br />
                    <?php echo JText::_('No account yet?'); ?>
                    <a href="<?php echo JRoute::_( 'index.php?option=com_user&task=register' ); ?>">
                        <?php echo JText::_('Register'); ?>
                    </a>
            <?php endif; ?>
            <input type="hidden" name="option" value="com_user" />
            <input type="hidden" name="task" value="login" />
            <input type="hidden" name="return" value="<?php echo $return; ?>" />
            <input type="hidden" name="<?php echo JUtility::getToken(); ?>" value="1" />
    </div>

	<?php echo $params->get('posttext'); ?>

</form>
<?php endif; ?>