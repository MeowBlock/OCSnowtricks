
document.addEventListener('scroll', function(){
    console.log(window.scrollY);
    if(window.scrollY > 1000) {
        document.querySelector('.upArrow').classList.remove('hidden');
    } else {
        document.querySelector('.upArrow').classList.add('hidden');
    }
}, {passive:true});

document.querySelector('.upArrow').addEventListener('click', function(){
    window.scroll(0,0);
})