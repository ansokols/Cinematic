function ticketDetails(x, y, z) {
    document.getElementById(x).classList.toggle("color");
    document.getElementById(z).classList.toggle("border");
    document.getElementById(y).classList.toggle("rotate");
    document.getElementById(z).classList.toggle("active");
}
