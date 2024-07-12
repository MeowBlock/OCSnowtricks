
document.addEventListener('scroll', function(){
    if(window.scrollY > 1000) {
        document.querySelector('.upArrow').classList.remove('hidden');
    } else {
        document.querySelector('.upArrow').classList.add('hidden');
    }
}, {passive:true});

document.querySelector('.upArrow').addEventListener('click', function(){
    window.scroll(0,0);
})

function increasePagination() {
    page = parseInt(document.querySelector('#pagination').dataset.page);
    page = page + 1;
    var pagesBtn = document.querySelector('#pagination');
    pagesBtn.dataset.page = page;
    pagesBtn.addEventListener('click', getTricks)

}

var pagesBtn = document.querySelector('#pagination');
pagesBtn.addEventListener('click', getTricks)

async function getTricks(){
    var pagesBtn = document.querySelector('#pagination');

    const response = await fetch('/api/getTricks/?page='+pagesBtn.dataset.page);
    content = await response.text();
    document.querySelector('#app').innerHTML += content;
    increasePagination();
}