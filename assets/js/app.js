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

// Current selected menu ( desktop version ).
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


// Handling menu ( mobile version ).
const mobileMenu = document.querySelector('.mobile-menu');
const menuItems = mobileMenu.querySelector('.mobile-menu-content');

if(mobileMenu) {
    mobileMenu.addEventListener('click', function() {
        const display = getComputedStyle(menuItems).getPropertyValue('display');
        if(display === 'none') {
            menuItems.style.display = 'flex';
        }
        else {
            menuItems.style.display = 'none';
        }
    });

    document.addEventListener('click', function(event) {
       if(!Array.from(mobileMenu.children).includes(event.target)) {
           menuItems.style.display = 'none';
       }
    });
}