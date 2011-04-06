/**
* Accessibility
*/

var fs_default   = 80;
var prefs_loaded = false;
var fs_current   = fs_default;
var skin_current = skin_default;


window.onload = prefs_load;
window.onunload = prefs_save;

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
        Cookie.set('joomla_fs', fs_current, {duration: 365})
        Cookie.set('joomla_skin', skin_current, {duration: 365})
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
        if (skin == 'swap'){
                if (skin_current == 'white'){
                        skin = 'black';
                } else {
                        skin = 'white';
                }
        }
        skin_current = skin;
        skin_set(skin);
}

function fs_set(fs){
    fs_current = fs;
    $E('body').setStyle('font-size', fs + '%');
}

function skin_set(skin){
    $E('body').setProperty('class', skin);
}