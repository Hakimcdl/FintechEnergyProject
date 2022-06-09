const deroulant = document.querySelector('.deroulant')
const eachArticle = document.querySelector('.eachArticle')

deroulant.forEach(element =>{
    element.addEventListener('click',()=> {
        eachArticle.classList.toggle('active')
    })
});

//console.log('ok');