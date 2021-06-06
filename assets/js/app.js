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
let selectedMenu = window.location.search;
if(selectedMenu && selectedMenu.includes('?controller=')) {
    selectedMenu = selectedMenu.replace('?controller=', '');
    if(selectedMenu.includes('&action=')) {
        selectedMenu = selectedMenu.substring(0, selectedMenu.indexOf('&action='));
    }
    const menu = document.getElementById(selectedMenu + 'Controller');
    if(menu) { // no menu for 'home' page.
        menu.classList.add('menu-active');
    }
}