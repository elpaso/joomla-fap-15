<?php
/**
* This file is part oj Joomla! 1.5 FAP
* @version      $Id: default.php 113 2010-05-31 15:40:33Z elpaso $
* @package      JoomlaFAP
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

// no direct access
defined('_JEXEC') or die('Restricted access');
if(JComponentHelper::isEnabled('com_accesskeys', true)){
    include dirname(__FILE__).DS.'accesskey_helper.php';
} else {
    // Include original file
    include JPATH_SITE.DS.'modules'.DS.'mod_mainmenu'.DS.'tmpl'.DS.'default.php';
}
