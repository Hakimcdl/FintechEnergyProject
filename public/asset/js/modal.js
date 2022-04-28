let del = document.querySelectorAll('.del');

del.forEach(function(delBtn){
   delBtn.addEventListener('click', function(){
      let modal = delBtn.nextElementSibling;
      modal.classList.add('displayBlock');
      modal.querySelector('.cancel').addEventListener('click', function (){
         modal.classList.remove('displayBlock');
      })
   })
})