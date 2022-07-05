const deroulant = document.querySelectorAll('.deroulant')
const eachArticle = document.querySelector('.eachArticle')

deroulant.forEach(element =>{
    element.addEventListener('click',()=> {
        element.parentElement.classList.toggle('active')
        element.classList.toggle('rotate')
    })
});
