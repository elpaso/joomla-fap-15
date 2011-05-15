<?php // @version $Id: default_login.php 36 2008-04-03 06:26:47Z elpaso $
defined( '_JEXEC' ) or die( 'Restricted access' );
?>
<form action="<?php echo JRoute::_( 'index.php', true, $this->params->get('usesecure')); ?>" method="post" id="login" class="login_form<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
	<?php if ( $this->params->get( 'page_title' ) ) : ?>
	<h1 class="componentheading<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
		<?php echo $this->params->get( 'header_login' ); ?>
	</h1>
	<?php endif; ?>

	<?php if ( $this->params->get( 'description_login' ) || isset( $this->image ) ) : ?>
		<div class="contentdescription<?php echo $this->params->get( 'pageclass_sfx' );?>">
			<?php // Image is not XHTML stric: disabled
				 if (false && isset ($this->image)) :
				echo $this->image;
			endif;
			if ($this->params->get('description_login')) : ?>
			<p>
				<?php echo $this->params->get('description_login_text'); ?>
			</p>
			<?php endif;
			// Image is not XHTML strict: disabled
			if (false && isset ($this->image)) : ?>
			<div class="wrap_image">&nbsp;</div>
			<?php endif; ?>
		</div>
	<?php endif; ?>
	<fieldset>
		<div class="name">
			<label for="user" ><?php echo JText::_( 'Username' ); ?></label>
			<input name="username" type="text" class="inputbox" size="20"  id="user" />
		</div>
		<div class="pass">
			<label for="pass" ><?php echo JText::_( 'Password' ); ?></label>
			<input name="passwd" type="password" class="inputbox" size="20" id="pass" />
		</div>
		<div class="remember">
			<label for="rem"><?php echo JText::_( 'Remember me' ); ?></label>
			<input type="checkbox" name="remember" class="inputbox" value="yes" id="rem" />
		</div>
		
			
	</fieldset>
	<div>
			<input type="submit" name="submit" class="button" value="<?php echo JText::_( 'Login' ); ?>" />
		</div>
	<div>
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
 
		<noscript><div><?php echo JText::_( 'WARNJAVASCRIPT' ); ?></div></noscript>
		<input type="hidden" name="option" value="com_user" />
		<input type="hidden" name="task" value="login" />
		<input type="hidden" name="return" value="<?php echo $this->return; ?>" />
		<?php echo JHTML::_( 'form.token' ); ?>
	</div>
</form>
