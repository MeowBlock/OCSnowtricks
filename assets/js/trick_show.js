var photos = document.querySelectorAll('.trick_photo');

photos.forEach(el => {
    el.addEventListener('click', function(){
        document.querySelectorAll('.photo-overlay').forEach(e => {
            e.classList.remove('photo-overlay')
        })
        el.classList.add('photo-overlay');

        document.querySelector('#dark-overlay').classList.add('dark-overlay');

        document.querySelector('.dark-overlay').addEventListener('click', function(){
            document.querySelectorAll('.photo-overlay').forEach(e => {
                e.classList.remove('photo-overlay');
            })
            this.classList.remove('dark-overlay');
        
        })
    });

})
function increasePagination() {
    page = parseInt(document.querySelector('#pagination').dataset.page);
    page = page + 1;
    var pagesBtn = document.querySelector('#pagination');
    pagesBtn.dataset.page = page;
    pagesBtn.addEventListener('click', getComments)

}

var pagesBtn = document.querySelector('#pagination');
pagesBtn.addEventListener('click', getComments)

async function getComments(){
    var pagesBtn = document.querySelector('#pagination');

    const response = await fetch('/comment/api/getComments/?page='+pagesBtn.dataset.page+'&trick='+pagesBtn.dataset.trick);
    content = await response.text();
    document.querySelector('#comments').innerHTML += content;
    increasePagination();
}