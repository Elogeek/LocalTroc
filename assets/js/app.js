/// verify form register
let psswrd = document.getElementById('password');
let psswdConfirm = document.getElementById('passwordRepeat');

function checkPassword() {
    if(psswrd.value !== psswdConfirm.value) {
        psswdConfirm.setCustomValidity('Les mots de passe ne correspondent pas ! ');
    }
    //dès que l'user corrige son password
    else{
        psswdConfirm.setCustomValidity('');
    }
}

if(psswrd && psswdConfirm) {
    psswrd.addEventListener('change', checkPassword);
    psswdConfirm.addEventListener('keyup', checkPassword);
}

// Current selected menu.
let menuLocation = window.location.search;
if(menuLocation.includes('?controller=')) {
    menuLocation = menuLocation.replace('?controller=', '');
    if(menuLocation.includes('&action=')) {
        menuLocation = menuLocation.substring(0, menuLocation.indexOf('&action='));
    }

    document.getElementById(menuLocation + 'Controller').classList.add('menu-active');
}