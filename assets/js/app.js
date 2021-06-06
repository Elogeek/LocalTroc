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

/**
 * Managing menu
 */
// Main menu hovering.
document.querySelectorAll('.menu').forEach(menu => {
    menu.addEventListener('mouseover', () => {
        document.querySelectorAll('.menu .submenu').forEach(submenu => submenu.style.display = 'none');
        menu.querySelector('.submenu').style.display = 'block';
    });
});

// Submenu out.
document.querySelectorAll('.menu .submenu').forEach(submenu => submenu.addEventListener('mouseout', () => {
    submenu.style.display = 'none';
}))

// Current selected menu.
document.querySelector(`.nav a[href*="${window.location.pathname}"]`).classList.add('menu-active');