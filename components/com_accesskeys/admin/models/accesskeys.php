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

// Include la classe base JModel
jimport('joomla.application.component.model');

class AccesskeysModelAccesskeys extends JModel {
	var $_data;
	var $_total = null;
	var $_pagination = null;

	function __construct()	{
		parent::__construct();

		global $mainframe, $option;

		$limit	= $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
		$limitstart = $mainframe->getUserStateFromRequest($option.'limitstart', 'limitstart', 0, 'int');

		$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);

		$this->setState('limit', $limit);
		$this->setState('limitstart', $limitstart);
	}

	function getTotal() {
		if (empty($this->_total)) {
			$query = $this->_buildQuery();
			$this->_total = $this->_getListCount($query);
		}
		return $this->_total;
	}

	function &getPagination() {
		if (empty($this->_pagination)) {
			jimport('joomla.html.pagination');
			$this->_pagination = new JPagination( $this->getTotal(), $this->getState('limitstart'), $this->getState('limit') );
		}
		return $this->_pagination;
	}

	function _buildQuery() {
        $query = ' SELECT * '
            . ' FROM #__menu WHERE published > 0 ORDER BY menutype, ordering';
        return $query;
    }

	function &getData() {
        // Carica i dati se non esistono già
        if(empty($this->_data)) {
            $query = $this->_buildQuery();
			$pagination = $this->getPagination();
            $this->_data = $this->_getList($query, $pagination->limitstart, $pagination->limit);
        }
        return $this->_data;
    }


    function &getItem() {
        static $item;
        if (isset($item)) {
            return $item;
        }

        $table =& $this->getTable();

        // Load the current item if it has been defined
        $cid = JRequest::getVar( 'cid', array(0), '', 'array' );
        JArrayHelper::toInteger($cid, array(0));
        $table->load($cid[0]);

        $item = $table;
        return $item;
    }


    function remove()
    {
        // Initialize variables
        $db     =& JFactory::getDBO();
        $row    =& $this->getItem();


		$row->accesskey = '';

        if (!$row->id > 0)
        {
            $this->setError(JText::_('Missing record id!'));
            return false;
        }

        if (!$row->store())
        {
            $this->setError($db->getErrorMsg(true));
            return false;
        }

        // clean menu cache
        $cache =& JFactory::getCache('mod_mainmenu');
        $cache->clean();

		return true;

	}


    function store()
    {
        // Initialize variables
        $db     =& JFactory::getDBO();
        $row    =& $this->getItem();

        $post   = JRequest::get('post');

        if(array_key_exists('accesskey', $post)) {
            $post['accesskey'] = strtoupper($post['accesskey']);
        }

        if (!$row->bind( $post )) {
            $this->setError($row->getError(true));
            return false;
        }

        if (!$row->id > 0)
        {
            $this->setError(JText::_('Missing record id!'));
            return false;
        }

        if (!$row->check())
        {
         	$this->setError(JText::_('Not a valid access key character (letters or numbers are accepted)!'));
            return false;
        }

        if (!$row->store())
        {
            $this->setError($db->getErrorMsg(true));
            return false;
        }

        // clean menu cache
        $cache =& JFactory::getCache('mod_mainmenu');
        $cache->clean();

        return true;

    }
}
?>