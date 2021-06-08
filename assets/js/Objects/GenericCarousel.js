/**
 * GenericCarousel for misc use.
 * @type {{}}
 */
const GenericCarousel = function(diaporamaElement) {
    this.counter = 0;
    this.images = diaporamaElement.querySelector(".elements").children;
    this.width = diaporamaElement.getBoundingClientRect().width;
    this.next = diaporamaElement.querySelector("#navRight");
    this.prev = diaporamaElement.querySelector("#navLeft");

    /**
     * Scroll the slide to the right
     */
    this.slideNext = () => {
        this.counter++;
        // beyond the end of the slide show, we "rewind"
        if(this.counter === this.images.length) {
            this.counter = 0;
        }
        // calculate the offset value

        this.images[0].parentElement.style.transform = `translateX(${-this.width * this.counter}px)`
    };

    /**
     * Scroll the slideshow to the left
     */
    this.slidePrev = () => {
        this.counter--;
        // If we go beyond the beginning of the slideshow, we start again at the end
        if(this.counter < 0) {
            this.counter = this.images.length - 1;
        }

        // calculate the offset value
        this.images[0].parentElement.style.transform = `translateX(${-this.width * this.counter}px)`;
    };

    /**
     * Clear diapo intervals.
     */
    this.stopTimer = () => {
        clearInterval(this.timer);
    };

    /**
     * restart scrolling
     */
    this.startTimer = () => {
        this.timer = setInterval(this.slideNext, 4000);
    };

    /**
     * Initialize diaporama.
     */
    this.init = function() {
        // installation of event listeners on arrows
        this.next.addEventListener("click", this.slideNext);
        this.prev.addEventListener("click", this.slidePrev);

        // Manage mouse hover
        diaporamaElement.addEventListener("mouseover", this.stopTimer);
        diaporamaElement.addEventListener("mouseout", this.startTimer);

        //Implementation of "responsive"
        window.addEventListener("resize", () => {
            this.width = diaporamaElement.getBoundingClientRect().width;
            this.slideNext();
        });
        this.slideNext();
    }
}

const diapo = document.querySelector(".diapo");
if(diapo) {
    new GenericCarousel(diapo).init();
}
