document.querySelector('.navbar-burger').addEventListener('click', function() {
    var navbar = document.querySelector('#navbarMenu');
    if(navbar.style.display == 'none') {
        navbar.style.display = 'block';
    } else {
        navbar.style.display = 'none';
    }
})


function paginate(clsName, itemsPerPage, page = 1) {
    var elements = document.querySelectorAll('.'+clsName);
    for( var i = 0; i < elements.length(); i++) {
        if( i < (page+1) * itemsPerPage && i > (page * itemsPerPage)) {
            elements[i].classList.remove('hidden');
        } else {
            elements[i].classList.add('hidden');
        }
    }
}