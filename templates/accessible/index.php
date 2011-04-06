<?php
/**
* This file is part of
* Joomla! 1.5 FAP
* @package   JoomlaFAP
* @version   $Id: index.php 90 2009-05-26 17:29:05Z elpaso $
* @author    Alessandro Pasotti
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


defined( '_JEXEC' ) or die( 'Restricted access' );

// xml prolog
echo '<?xml version="1.0" encoding="'. $this->_charset .'"?' .'>';


$cols = 1;
if ($this->countModules('right')
	&& JRequest::getCmd('layout') != 'form'
	&& JRequest::getCmd('task') != 'edit') {
	$cols += 1;
}

if($this->countModules('left or inset or user4')) {
	$cols += 1;
}
?>
<!DOCTYPE html
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
<?php JHTML::_('behavior.mootools'); ?>
<meta name="language" content="<?php echo $this->language; ?>" />
<jdoc:include type="head" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/system.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/general.css" type="text/css" />
<link href="<?php echo JURI::base();?>templates/<?php echo $this->template; ?>/css/template_css.css" rel="stylesheet" type="text/css"/>
<!--[if IE]>
<link href="<?php echo JURI::base();?>templates/<?php echo $this->template; ?>/css/msie6.css" rel="stylesheet" type="text/css"/>
<![endif]-->
<script type="text/javascript">
/* <![CDATA[ */
    var skin_default = '<?php echo $this->params->get('default_skin'); ?>';
/* ]]> */
</script>
<script type="text/javascript" src="<?php echo JURI::base();?>templates/<?php echo $this->template;?>/js/skin_alter.js"></script>
</head>
<body class="<?php echo $this->params->get('default_skin'); ?>" id="mainbody">
	<div class="hidden">
		<a name="up" id="up"></a>
		<h1><?php echo $this->description; ?></h1>
		<!-- accesskey goes here! -->
		<ul>
			<li><a accesskey="P" href="#main-content"><?php echo JText::_('Skip to Content'); ?></a></li>
			<li><a accesskey="M" href="#main-menu"><?php echo JText::_('Jump to Main Navigation and Login'); ?></a></li>
		</ul>
	</div>
    <div id="wrapper">
        <?php if ($this->countModules('breadcrumb')) { ?>
        <div id="pathway">
            <div class="padding"><?php echo JText::_('You are here'); ?>
            <jdoc:include type="modules" name="breadcrumb" />
            </div>
        </div>
        <?php } ?>
        <div id="top">

          <div class="padding">
            <?php if('no' == $this->params->get('accessibility_icons')) { ?>
            <div id="accessibility-links">
				<script type="text/javascript">
                    //<![CDATA[
                        document.write('<?php echo JText::_('FONTSIZE'); ?>:');
                        document.write('<input type="button" name="decrease" id="decrease" value=" A - " accesskey="D" onclick="fs_change(-1); return false;" onkeypress="if(event.keyCode && event.keyCode != 9){fs_change(-1); return false;}" title="<?php echo JText::_('Decrease size'); ?> [D]" />');
                        document.write('<input type="button" name="increase" id="increase" value=" A + " accesskey="A" onclick="fs_change(1); return false;" onkeypress="if(event.keyCode && event.keyCode != 9){fs_change(1); return false;}" title="<?php echo JText::_('Increase size'); ?> [A]" />');
                        document.write('<input type="button" name="contrasthigh" id="contrasthigh" value="<?php echo JText::_('contrast'); ?>" accesskey="X" onclick="skin_change(\'swap\');return false;" onkeypress="if(event.keyCode && event.keyCode != 9){skin_change(\'swap\'); return false;}" title="<?php echo JText::_('High contrast'); ?> [X]" />');
                        <?php if('yes' == $this->params->get('liquid_variant')) { ?>
                        document.write('<input type="button" name="liquid" id="liquid" value="<?php echo JText::_('LAYOUT'); ?>" accesskey="L" onclick="skin_set_variant(\'liquid\'); return false;" onkeypress="if(event.keyCode && event.keyCode != 9){skin_set_variant(\'liquid\'); return false;}" title="<?php echo JText::_('SET VARIABLE WIDTH'); ?> [L]" />');
                        <?php } ?>
                        document.write('<input type="button" name="reset" id="reset" value="<?php echo JText::_('reset'); ?>" accesskey="Z" onclick="skin_change(\'<?php echo $this->params->get('default_skin'); ?>\'); skin_set_variant(\'\'); fs_set(fs_default); return false;" onkeypress="if(event.keyCode && event.keyCode != 9){skin_change(\'<?php echo $this->params->get('default_skin'); ?>\'); skin_set_variant(\'\'); fs_set(fs_default);return false;}" title="<?php echo JText::_('Revert styles to default'); ?> [Z]" />');
                    //]]>
				</script>
				<noscript><h2><?php echo JText::_('NOSCRIPT'); ?></h2></noscript>
            </div>
            <?php } else { ?>
            <div id="accessibility-links" class="accessibility-icons">
              <script type="text/javascript">
                //<![CDATA[
                      document.write('<span class="accessibility-text"><?php echo JText::_('FONTSIZE'); ?></span>');
                      document.write('<span class="accessibility-icon"><input type="button" name="decrease" id="decrease" accesskey="D" onclick="fs_change(-1); return false;" onkeypress="if(event.keyCode && event.keyCode != 9){fs_change(-1); return false;}" title="<?php echo JText::_('Decrease size'); ?> [D]" /></span>');
                      document.write('<span class="accessibility-icon"><input type="button" name="increase" id="increase" accesskey="A" onclick="fs_change(1); return false;" onkeypress="if(event.keyCode && event.keyCode != 9){fs_change(1); return false;}" title="<?php echo JText::_('Increase size'); ?> [A]" /></span>');
                      document.write('<span class="accessibility-text"><?php echo JText::_('contrast'); ?></span>');
                      document.write('<span class="accessibility-icon"><input type="button" name="contrasthigh" id="contrasthigh" accesskey="X" onclick="skin_change(\'swap\');return false;" onkeypress="if(event.keyCode && event.keyCode != 9){skin_change(\'swap\'); return false;}" title="<?php echo JText::_('High contrast'); ?> [X]" /></span>');
                      <?php if('yes' == $this->params->get('liquid_variant')) { ?>
                      document.write('<span class="accessibility-text"><?php echo JText::_('LAYOUT'); ?></span>');
                      document.write('<span class="accessibility-icon"><input type="button" name="liquid" id="layouttext" accesskey="L" onclick="skin_set_variant(\'liquid\'); return false;" onkeypress="if(event.keyCode && event.keyCode != 9){skin_set_variant(\'liquid\'); return false;}" title="<?php echo JText::_('SET VARIABLE WIDTH'); ?> [L]" /></span>');
                      <?php } ?>
                      document.write('<span class="accessibility-text"><?php echo JText::_('reset'); ?></span>');
                      document.write('<span class="accessibility-icon"><input type="button" name="reset" id="reset" accesskey="Z" onclick="skin_change(\'<?php echo $this->params->get('default_skin'); ?>\'); skin_set_variant(\'\'); fs_set(fs_default); return false;" onkeypress="if(event.keyCode && event.keyCode != 9){skin_change(\'<?php echo $this->params->get('default_skin'); ?>\'); skin_set_variant(\'\'); fs_set(fs_default);return false;}" title="<?php echo JText::_('Revert styles to default'); ?> [Z]" /></span>');
                    //]]>
				</script>
				<noscript><h2><?php echo JText::_('NOSCRIPT'); ?></h2></noscript>
            </div>
            <?php } ?>
          </div>
        </div>
        <?php // Banner from component or CSS
        if ($this->countModules('banner')) { ?>
        <div id="banner">
            <div class="padding">
            <jdoc:include type="modules" name="banner" style="xhtml" />
            </div>
        </div>
        <?php } ?>
            <?php if ($this->countModules('user3')) { ?>
            <div id="menu-top">
                <div class="padding">
                <jdoc:include type="modules" name="user3" style="xhtml" />
                </div>
            </div>
            <?php } ?>
            <div class="clr"></div>
            <?php if ($this->countModules('left or inset or user4')) { ?>
            <div id="sidebar-left">
            <div class="padding">
            	<?php if ($this->countModules('user4')) { ?>
                <div id="searchbox">
                    <jdoc:include type="modules" name="user4" style="xhtml" />
                </div>
                <?php } ?>
                <a name="main-menu" class="hidden"></a>
                <jdoc:include type="modules" name="left" style="xhtml" />
                <?php if ($this->countModules('inset')) { ?>
                <div class="inset">
                    <jdoc:include type="modules" name="inset" style="xhtml" />
                </div>
                <?php } ?>
            </div>
            </div>
        <?php } ?>
        <?php if ($this->countModules('right') 	&& JRequest::getCmd('layout') != 'form'
	&& JRequest::getCmd('task') != 'edit') { ?>
        <div id="sidebar-right">
            <div class="padding">
                <jdoc:include type="modules" name="right" style="xhtml" />
            </div>
        </div>
        <?php } ?>
        <div id="main-<?php print $cols ;?>">
          <?php if ($this->countModules('center')){ ?>
          <div id="center-module">
              <div class="padding">
                  <jdoc:include type="modules" name="center" style="xhtml" />
              </div>
          </div>
          <?php } ?>
            <a name="main-content" class="hidden"></a>
            <div class="padding">
            <jdoc:include type="message" />
            <jdoc:include type="component" style="xhtml"/>
            <div id="user12">
                <?php if ($this->countModules('user1 or user2') && ! $this->countModules('user1 and user2')) { ?>
                <div class="userfull">
                    <jdoc:include type="modules" name="user1" style="xhtml" />
                    <jdoc:include type="modules" name="user2" style="xhtml" />
                </div>
                <?php } ?>
                <?php if ($this->countModules('user1 and user2')) { ?>
                <div class="column_left">
                    <jdoc:include type="modules" name="user1" style="xhtml" />
                </div>
                <div class="column_right">
                    <jdoc:include type="modules" name="user2" style="xhtml" />
                </div>
                <?php } ?>
            </div>
            <?php if ($this->countModules('bottom') && JRequest::getCmd('task') != 'edit') { ?>
            <jdoc:include type="modules" name="bottom" style="xhtml" />
            <div class="clr"></div>
            <?php } ?>
            </div>
        </div>
        <div id="footer">
            <div class="padding">
                <?php if ($this->countModules('footer')) { ?>
                <jdoc:include type="modules" name="footer" style="xhtml" />
				<?php } ?>
            </div>

        </div>
    </div>
    <jdoc:include type="modules" name="debug" />
</body>
</html>