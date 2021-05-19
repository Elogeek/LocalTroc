/*my videoImg*/
let carrousel = document.getElementById('videoImg');
let div = document.createElement("img");
let img1 = "./assets/img/img1.jpg";
let img2 = "./assets/img/img2.jpg";
let img3 = "./assets/img/img3.jpg";
let arrayImg =[img1,img2,img3];

div.style.cssText =
    `
    width: 50%;
    height: 31vw;
    display: flex;
    margin-left: 27rem;
    box-shadow: 2px 1px 8px 5px #6c757d;
    `;

carrousel.appendChild(div);
div.className = "videoImg";


let i = 0;

/*videoIMg LocalTroc*/
function videoImg() {
     setTimeout(function () {
        div.src = arrayImg[i];
        i++;
        if(i === arrayImg.length) {
            i = 0;
        }
        videoImg()
    },2000)
}
videoImg();

/*my articles*/
let articles = document.querySelector(".containerArticles");
let image = document.createElement("img");

let slide2 = "/assets/img/dog-sitter.jpg";
let slide3 = "/assets/img/couture.jpg";
let slide4 = "/assets/img/photographe.jpg";
let slide5 = "/assets/img/course.jpg";
let slide6 ="/assets/img/baby-sitter.jpg";
let slide7 ="/assets/img/déménagement.jpg";
let slide8 = "/assets/img/cuisine.jpg";
let slide9 ="/assets/img/bricolage.jpg";
function slidesMove(){



}


