/**
 * Create a carousel for header ( Home page ).
 */
const HeaderCarousel = {
    speed: 3000, // Carousel speed in ms.
    carrousel: document.getElementById('slider'),
    div: document.createElement("img"),
    images: [
        "/assets/img/carouselImg/headerCarousel/1.jpg",
        "/assets/img/carouselImg/headerCarousel/2.jpg",
        "/assets/img/carouselImg/headerCarousel/3.jpg"
    ],
    counter: 0,

    /**
     * Initialize carousel.
     */
    init: function() {
        this.div.style.cssText = `
            width: 50%;
            display: flex;
            flex-flow: row;
            justify-content: center;
            height: 31vw;
            margin-top: 0.5rem;
            box-shadow: 2px 1px 8px 5px #6c757d;
        `;
        this.carrousel.appendChild(this.div);
        this.div.className = "headerCarousel";
        HeaderCarousel.start();
    },


    /**
     * Start the header carousel.
     */
    start: function() {
        this.div.src = this.images[this.counter++];
        if (this.counter === this.images.length) {
            this.counter = 0;
        }

        setTimeout(() => { this.start();}, this.speed)
    }
}

HeaderCarousel.init();
