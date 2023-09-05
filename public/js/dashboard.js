function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
    document.querySelector('.cinema-list > img').classList.toggle("rotate");
}

function mySecondFunction() {
    document.querySelector('.dropoverlay').style.cssText = 'left: 0';
    document.querySelector('.dropleft').style.cssText = 'left: 0';
    document.querySelector('.page-content').style.cssText = 'overflow-y: hidden';
}

function myThirdFunction() {
    document.querySelector('.full').style.cssText = 'left: 0';
    document.querySelector('.vertical-content').style.cssText = 'height: 700px';
}

function deleteDropLeft() {
    document.querySelector('.dropoverlay').style.cssText = 'left: -100vw';
    document.querySelector('.dropleft').style.cssText = 'left: -1000px';
    document.querySelector('.full').style.cssText = 'left: -100vw';
    document.querySelector('.vertical-content').style.cssText = 'height: calc(100vh - 77px - 1)';
}

$('.slider-container').slick({
    dots: false ,
    infinite: true,
    speed: 300,
    slidesToShow: 1,
    centerMode: true,
    variableWidth: true,
    nextArrow: '<img  class = "next" src="../img/next.svg" alt="">'
});
