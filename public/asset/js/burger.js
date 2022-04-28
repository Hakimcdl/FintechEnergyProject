// MENU BURGER
let burger = document.querySelector('.burger');
// MODAL DEROULANT
let menuDeroulant = document.querySelector('.modalBurger');

burger.addEventListener('click', function (){
    menuDeroulant.classList.toggle('displayBlock');
})