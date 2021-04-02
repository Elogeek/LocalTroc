/*my carousel*/
let carrousel = document.getElementById('carousel');
let div = document.createElement("img");
let img1 = "./assets/img/img1.png";
let img2 = "./assets/img/img2.png";
let img3 = "./assets/img/img3.png";
let arrayImg =[img1,img2,img3];

div.style.cssText =
    `
    padding-top: 3rem;
    width: 50%;
    height: 31vw;
    display: flex;
    margin-left: 27rem;
    `;

carrousel.appendChild(div);
div.className = "videoImg";


let i = 0;

function videoCarousel() {
     setTimeout(function () {
        div.src = arrayImg[i];
        i++;
        if(i === arrayImg.length) {
            i = 0;
        }
        videoCarousel()
    },2000)
}

videoCarousel();
