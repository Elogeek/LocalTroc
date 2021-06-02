//DIAPO

//Counter which will allow you to know which slide you are on
let counter = 0;
let timer, elements, slides, slideWidth;

window.onload = () => {
    // div container recovery(".diapo")
    const diapo = document.querySelector(".diapo");

    // recovery of the container of all elements
    elements = document.querySelector(".elements");

    // recovery the table containing the list of slides
    slides = Array.from(elements.children);

    // calculate the visible width of the slideshow
    slideWidth = diapo.getBoundingClientRect().width;

    // arrows recovery
    let next = document.querySelector("#navRight");
    let prev = document.querySelector("#navLeft");

    // installation of event listeners on arrows
    next.addEventListener("click", slideNext);
    prev.addEventListener("click", slidePrev);

    // automate slide
    timer = setInterval(slideNext, 4000);

    // Manage mouse hover
    diapo.addEventListener("mouseover", stopTimer);
    diapo.addEventListener("mouseout", startTimer);

    //Implementation of "responsive"
    window.addEventListener("resize", () => {
        slideWidth = diapo.getBoundingClientRect().width;
        slideNext();
    });
};

/**
 * scroll the slide to the right
 */
function slideNext() {
    counter++;

    // beyond the end of the slide show, we "rewind"
    if(counter === slides.length) {
        counter = 0;
    }

    // calculate the offset value
    let decal = -slideWidth * counter
    elements.style.transform = `translateX(${decal}px)`
};

/**
 * scroll the slideshow to the left
 */
function slidePrev() {
    //decrement
    counter--;

    // If we go beyond the beginning of the slideshow, we start again at the end
    if(counter < 0) {
        counter = slides.length - 1;
    }

    // calculate the offset value
    let decal = -slideWidth * counter;
    elements.style.transform = `translateX(${decal}px)`;
};

/**
 * stop scrolling
 */
function stopTimer() {
    clearInterval(timer);
};

/**
 * restart scrolling
 */
function startTimer() {
    timer = setInterval(slideNext, 4000);
};

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

psswrd.addEventListener('change', checkPassword);
psswdConfirm.addEventListener('keyup', checkPassword);
