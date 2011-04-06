<?php
/**
* Alter menu table if needed
*/
defined('_JEXEC') OR defined('_VALID_MOS') OR die('...Direct Access to this location is not allowed...');


function com_install(){

    $database =& JFactory::getDBO();

    $q = "SHOW COLUMNS FROM #__menu";
    $database->setQuery($q);
    $fields = $database->loadObjectList();

    $exists = false;
    foreach($fields as $f){
        if($f->Field == 'accesskey'){
            $exists = true;
        }
    }
    if(!$exists) {
        $q2 = "ALTER TABLE #__menu ADD COLUMN accesskey CHAR(1)";
        $database->execute($q2);
    }

    $exists = false;
    foreach($fields as $f){
        if($f->Field == 'title'){
            $exists = true;
        }
    }
    if(!$exists) {
        $q2 = "ALTER TABLE #__menu ADD COLUMN title VARCHAR(255)";
        $database->execute($q2);
    }
    return "Installation ok.";
}
?>