let delet = document.querySelector('.delete');
let modal = document.querySelector('.modal');
let cancel = document.querySelector('.cancel');
delet.addEventListener('click', function (){
    modal.classList.add('displayBlock');
})
cancel.addEventListener('click', function (){
    modal.classList.remove('displayBlock');
})