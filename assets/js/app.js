/*my videoImg*/
let carrousel = document.getElementById('videoImg');
let div = document.createElement("img");
let img1 = "./assets/img/img1.png";
let img2 = "./assets/img/img2.png";
let img3 = "./assets/img/img3.png";
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

/*my carousel*/
let imgs = document.querySelectorAll(".imgArtcls");
for(let a = 0; a < imgs.length; a++) {
    console.log(imgs); //it's ok!
}

function carousel() {
    

}