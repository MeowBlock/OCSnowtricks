console.log('wawa');
document.querySelector('.navbar-burger').addEventListener('click', function() {
    navbar = document.querySelector('#navbarMenu');
    if(navbar.style.display == 'none') {
        navbar.style.display = 'block';
    } else {
        navbar.style.display = 'none';
    }
})