class Carousel {
    /**
     * @param {HTMLElement} element
     * @param options
     * @param {object } options.slideToscroll Nombre d'éléments à faire défiler
     * @param {Object} options.slideVisible Nombre d'éléments visible dans un slide
     */
    constructor(element, options ={}) {
        console.log("hello");
        this.element = element;
        this.options = Object.assign({}, {
            slidesToScroll: 1,
            slidesVisible: 1
           },options)
        //CHILDRENS div
        this.children = [].slice.call(element.children);
        //create element .carousel
        let root = this.createDivWithClass('carousel')
        let panorama = this.createDivWithClass('carousel-container');
        root.appendChild(panorama);
        this.element.appendChild(root);
        this.children.forEach(function (child) {
            panorama.appendChild(child);
        })
    }

    /**
     *
     * @param {string} className
     * @returns {HTMLElement}
     */
    createDivWithClass (className) {
      let div =  document.createElement('div');
      root.setAttribute('class',className);
      return div;
    }
}


new Carousel(document.querySelector("#carousel1"), {
    slidesVisible:3
})