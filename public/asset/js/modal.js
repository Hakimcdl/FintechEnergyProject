let cancel = document.querySelector('.cancel');
let del = document.querySelector('.del');
let modal = document.querySelector('.modal');


del.addEventListener('click', function(){

   modal.classList.add('displayBlock');
})
cancel.addEventListener('click', function (){
   modal.classList.remove('displayBlock')
})