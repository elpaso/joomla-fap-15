<?php


// Impedisce l'accesso diretto al file
defined('_JEXEC') or die('Restricted access');

// Include georef library from joomla

/*print_r(get_defined_constants());
die();*/
$georef_lib_file = JPATH_COMPONENT_ADMINISTRATOR . '/../com_georef/functions.georef.php';
if(is_readable($georef_lib_file)){
    require_once($georef_lib_file);
} else {
    dieError('cannot include georef_lib_file:');
}


/////////////////////////////////////////////////////
//
// Parameters
//

// WFS: SERVICE=WFS&VERSION=1.0.0&REQUEST=getfeature&TYPENAME=park


if(!isset($action)){
    $action = (string)mosGetParam($_REQUEST, 'action', '');
}

if(!isset($georefid)){
    $georefid = intval(mosGetParam($_REQUEST, 'georefid',''));
}

if(!isset($layername)){
    $layername = (string)mosGetParam($_REQUEST, 'layername','');
    if(!$layername){
       $layername = (string)mosGetParam($_REQUEST, 'TYPENAME','');
    }
}


/////////////////////////////////////////////////////
//
// Service actions
//

$GLOBALS['actions'] = array(
    'check'         => 'Search items errors',
    'test'          => 'Do some tests',
    'checkclear'    => 'Search items errors, delete them if any',
    'getlayers'     => 'Returns a list of enabled layers',
    //'getitem'       => 'Returns the item data given an item id @param integer georefid',
    'getitemurl'    => 'Returns the item url given an item id @param integer georefid'
    //, 'gml'           => 'GML webservice, specify layers'
    );



/////////////////////////////////////////////////////
//
// Main loop
//

// Document

switch($action){
    case 'gml':
        if($layername){
            returnXML(georefItemsGML('layers.name="'.$layername.'"'));
        } else {
            returnFail('no georefid');
        }
        break;
    case 'getitemurl':
        if($georefid && $layername){
            $itemurl = georefItemUrl($georefid, $layername);
            if($itemurl) {
                returnPlainText($itemurl);
            } else {
                returnFail('no itemurl for this georefid (' . $georefid . ', '.$layername.')');
            }
        } else {
            returnFail('no georefid or layername');
        }
        break;
    case 'getlayers':
        $layers = georefLayerList('enabled = 1');
        if(count($layers)){
            $xml = '<?xml version=\'1.0\' encoding="ISO-8859-1" ?>';
            $xml .= '<LayerList>';
            foreach ($layers as $l){
                $layer = new mosGeorefLayer($database);
                $layer->bind(get_object_vars($l));
                //var_dump($layer);
                // Load as:
                //$xml_data = simplexml_load_string($layer->toXML(),'mosGeorefLayer', LIBXML_NOCDATA);
                //var_dump($xml_data);
                $xml .= $layer->toXML();
            }
            $xml .= '</LayerList>';
            returnXML($xml);
        }
        break;
    case 'check':
        $checklist = georefItemsCheckAll();
        if(count($checklist)){
            var_dump($checklist);
        }
        break;
    case 'checkclear':
        $checklist = georefItemsCheckAll();
        if(count($checklist)){
            foreach($checklist as $georefid => $error_message){
                 $ret = georefItemDelete($georefid);
                 if(!$ret){
                    returnFail('checkclear failure');
                 }
            }
        }
        break;
    case 'test':
        print "<pre>Testing...</pre>\n";
        // Fall
    default:
        printDoc($action);
}


/////////////////////////////////////////////////////
//
// Useful functions
//

function printDoc($action){
    print "<pre>GeoRef - GeoRef Web Service</pre>\n";
    foreach($GLOBALS['actions'] as $a => $desc){
        print "<pre><a href=\"action=$a\">$desc</pre>\n";
    }
}


function dieError($msg){
    print "<h1>$msg</h1";
    exit(1);
}

function returnFail($msg){
    dieError($msg);
}

function returnSuccess(){
    print 1;
    exit(0);
}

function returnXML($xml){
    header('Content-type: text/xml');
    print $xml;
    exit(0);
}

function returnPlainText($txt){
    print $txt;
    exit(0);
}
?>