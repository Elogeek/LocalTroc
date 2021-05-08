class Carousel {
    /**
     * @param {HTMLElement} element
     * @param options
     * @param {object } options.slideToscroll Nombre d'éléments à faire défiler
     * @param {Object} options.slideVisible Nombre d'éléments visible dans un slide
     * @param{boolean} options.loop = false pour boucler en fin de carousel
     * @param{boolean} options.pagination = false(false par defaut) boucler fin de carousel
     */
    constructor(element, options ={}) {
        console.log("hello");
        this.element = element;
        this.options = Object.assign({}, {
            slidesToScroll: 1,
            slidesVisible: 1,
            loop: false,
            pagination: false,
            navigation: true
           },options)
        let children = [].slice.call(element.children);
        this.currentItem = 0;
        this.root = this.createDivWithClass('carousel')
        this.container = this.createDivWithClass('carousel__container');
        this.root.appendChild(this.container);
        this.element.appendChild(this.root);

        this.item = children.map((element) => {
            let item = this.createDivWithClass('carousel__item');
            item.appendChild(element);
            this.container.appendChild(item);
            return  item;
        })
        this.setStyle();
        this.createNavigation();
        this.isMobile = false;
        this.currentItem = 0;
        this.moveCallBacks = [];

        /**
         * @param {string} className
         * àreturns {HTMLElements}
         */
        createDivWithClass(className) {
            let div = document.createElement('div');
            root.setAttribute('class',className);
            return div;
        }


        this.setStyle();
        if(this.options.navigation) {
            this.createNavigation();
        }
        if (this.options.pagination) {
            this.createPagination();
        }
        //events//
        this.moveCallbacks.foreach(cb =>cb(0));
        this.onWindowResize();
        window.addEvenListener('resize', this.onWindowResize.bind(this));
        this.root.addENventListenr('keyup', e => {
            if(e.key === 'ArrowRight' || e.key === 'Left') {
                this.next()
            }
            else if(e.key === 'ArrowLeft' || e.key === 'Left') {
                this.prev()
            }
        })
    }

    /** Applique les bonnes dimensions aux éléments carousel
     *
     */
    setStyle() {
        let ratio = this.items.length/ this.options.slidesVisible;
        this.container.style.width = (ratio * 100) + "%";
        this.item.forEach(item => item.style.width = ((100/this.options.slidesVisible) /ratio) + "%")
    };

    /**
     * créer les flèches de navigation
     */
    createNavigation() {
        let nextButton = this.createDivWithClass('carousel__next');
        let prevButton = this.createDivWithClass('carousel__prev');
        this.root.appendChild(nextButton);
        this.root.appendChild(prevButton);
        nextButton.addEventListener('click', this.next().bind(this));
        prevButton.addEventListener('click', this.prev().bind(this));
    };
        next() {
            this.goToItem(this.currentItem + this.options.slidesToscroll)

        };

        prev() {
            this.goToItem(this.currentItem - this.options.slidesToscroll)
        };

    /**
     * déplace le carrousel vers l'élement ciblé
     * @param{number} index
     */
     goToItem(index){
         //-number négatif  car direction left
         let translateX = index * -100/this.item.length;
        this.container.style.transform = 'translate3d('+ translateX +' %, 0, 0)'
        this.currentItem = index
    }

    /**
     * créer la pagination
      */
    createPavigation(){
       let pagination= this.cr
        }
    }
    /**
     * Déplace le carouselvers l'élément ciblé
     */



document.addEventListener('DOMContentLoaded', function () {

    new Carousel(document.querySelector("#carousel1"), {
        slidesVisible: 2,
        slideToscroll: 2,
        pagination: true,
        loop: true
    })

    new Carousel(document.querySelector("#carousel2"), {
        slidesVisible: 2,
        slideToscroll: 2,
        pagination: true
    })

    new Carousel(document.querySelector("#carousel3"), {
        slidesVisible: 2,
        slideToscroll: 2,
        pagination: true
    })
})
