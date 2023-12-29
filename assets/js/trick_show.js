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
