/**
 * Create a carousel for header ( Home page ).
 */
const HeaderCarousel = {
    speed: 3000, // Carousel speed in ms.
    carrousel: document.getElementById('slider'),
    div: document.createElement("img"),
    images: [
        "/assets/img/img1.jpg",
        "/assets/img/img2.jpg",
        "/assets/img/img3.jpg"
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
            margin-top: 20.5rem;
            box-shadow: 2px 1px 8px 5px #6c757d;
        `;
        this.carrousel.appendChild(this.div);
        this.div.className = "headerCarousel";
    },


    /**
     * Start the header carousel.
     */
    start: function() {
        setTimeout(() => {
            this.div.src = this.images[this.counter++];
            if (this.counter === this.images.length) {
                this.counter = 0;
            }
            this.start();
        }, this.speed)
    }
}

HeaderCarousel.init();
HeaderCarousel.start();