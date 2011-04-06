<?php
/**
* @version		$Id:$
* @package		Plg_jFap
* @copyright	Copyright (C) 2011 ItOpen. All rights reserved.
* @licence      GNU/AGPL
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin' );

/**
 * Joomla! jFap plugin
 *
 * @package		jFap
 * @subpackage	System
 */
class  plgSystemJFap extends JPlugin
{
    function onAfterRender(){
        global $mainframe;
        if ($mainframe->isAdmin()){
            return true;
        }
        $body = JResponse::getBody();

        # Too hungry:
        #$style_regexp = '@<span[^>]*>@is';
        #$style_replace = ''

        # Remove style from span
        $style_regexp = '@<span([^>]*?)\sstyle=["\'][^"\']*["\']([^>]*?)>@is';
        $style_replace = '<span\1\2>';
        $body = preg_replace(array('/target=[\'"][^\'"]+/', $style_regexp, '/(<meta name="generator" content=")([^"]+)"/'
), array('onclick="window.open(this.href);return false;', $style_replace, '\1\2 - Versione FAP"'), $body);
        JResponse::setBody($body);
    }


}