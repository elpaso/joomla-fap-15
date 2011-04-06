/**
* Accessibility
*
* This file is part of
* Joomla! 1.5 FAP
* @copyright 2011 ItOpen http://www.itopen.it
* @author    Alessandro Pasotti
* @licence   GNU/AGPL v. 3
*
*/

var fs_default   = 80;
var prefs_loaded = false;
var fs_current   = fs_default;
var skin_current = skin_default;


function prefs_load(){
    if(!prefs_loaded){

        var c = Cookie.get('joomla_fs');
        fs_current = c ? c : fs_default;
        fs_set(fs_current);

        var s = Cookie.get('joomla_skin');
        skin_current = s ? s : skin_default;
        skin_set(skin_current);

        prefs_loaded = true;
    }
}

function prefs_save(){
        Cookie.set('joomla_fs', fs_current, {duration: 365, path : '/'})
        Cookie.set('joomla_skin', skin_current, {duration: 365, path : '/'})
}

function fs_change(diff){
    fs_current = parseInt(fs_current) + parseInt(diff * 5);
    if(fs_current > 100){
        fs_current = 100;
    }else if(fs_current < 70){
        fs_current = 70;
    }
    fs_set(fs_current);
}

function skin_change(skin){
    if (skin_current.search(' ') != -1) {
        variant = skin_current.substr(skin_current.search(' '));
        skin_current = skin_current.substr(0, skin_current.search(' '));
    } else {
        variant = '';
    }
    if (skin == 'swap'){
      //console.log('SWAP');
      //console.log('CURRENT:' + skin_current)
      //console.log('variant :' + variant)
      if (skin_current.search('white') != -1){
          skin = 'black';
      } else {
          skin = 'white';
      }
    }
    //console.log('skin :' + skin)
    //console.log('variant :' + variant)
    if (skin.search(' ') == -1) {
      skin = skin + variant;
    }
    skin_current = skin;
    skin_set(skin);
    prefs_save()
}


function skin_set_variant(variant){
    skin = skin_current
    if (skin.search(' ') != -1) {
        skin = skin.substr(0, skin.search(' '));
    }
    if (variant && skin_current.search(variant) == -1) {
      skin += ' ' + variant;
    }
    //console.log('skin_set_variant skin :' + skin)
    //console.log('skin_set_variant variant :' + variant)
    skin_current = skin;
    skin_change(skin);
}


function fs_set(fs){
    fs_current = fs;
    $E('body').setStyle('font-size', fs + '%');
}

function skin_set(skin){
    $E('body').setProperty('class', skin);
}

window.addEvent('domready', prefs_load);
window.addEvent('unload', prefs_save);
