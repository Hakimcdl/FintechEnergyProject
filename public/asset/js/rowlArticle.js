const deroulant = document.querySelectorAll('.deroulant')
const eachArticle = document.querySelector('.eachArticle')


deroulant.forEach(element =>{
    console.log('ok', element);
    element.addEventListener('click',()=> {
        console.log(element);
        element.parentElement.classList.toggle('active')
        element.classList.toggle('rotate')
    })
});

//