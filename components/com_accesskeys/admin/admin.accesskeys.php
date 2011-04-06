<?php
/**
* This file is part of Joomla! 1.5 FAP
* @version      $Id: helper.php 9877 2008-01-05 12:37:25Z mtk $
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

// Impedisce l'accesso diretto al file
defined('_JEXEC') or die();

// Richiede la classe Controller principale del componente
require_once(JPATH_COMPONENT.DS.'controller.php');

// Richiede una classe specifica (se controller=nome_controller è presente in $_REQUEST)
if($controller = JRequest::getWord('controller')) {
    $path = JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php';
    if(file_exists($path)) {
        require_once $path;
    } else {
        $controller = '';
    }
}

// Crea un'instanza dell'oggetto Controller
$classname = 'AccesskeysController'.$controller;
$controller = new $classname();

//Esegue task (letto da $_REQUEST)
$controller->execute(JRequest::getVar('task'));
// Esegue un eventuale redirect
$controller->redirect();
?>