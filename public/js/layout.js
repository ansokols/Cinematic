function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
    document.querySelector('.cinema-list > img').classList.toggle("rotate");
}

function mySecondFunction() {
    document.querySelector('.dropoverlay').style.cssText = 'left: 0';
    document.querySelector('.dropleft').style.cssText = 'left: 0';
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

function deleteDropdown() {
    document.getElementById("myDropdown").classList.remove("show");
    document.querySelector('.cinema-list > img').classList.remove("rotate");
}

window.addEventListener('resize', function(event){
    if (window.innerWidth > 960) {
        document.querySelector('.full').style.cssText = 'left: -100vw';
        document.querySelector('.vertical-content').style.cssText = 'height: calc(100vh - 77px - 1)';
    }
});
