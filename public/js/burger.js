let burgerBtn = document.querySelector('.burger-button');
let burgerMenu = document.querySelector('.navigation');
let burgerSiteMenu = document.querySelector('.navigation__user');
let burgerLinks = document.querySelectorAll('.navigation__user__item');
//открытие и закрытие меню
burgerBtn.onclick = function(){
    burgerSiteMenu.classList.toggle('navigation__user__mob');
    burgerMenu.classList.toggle('burger-menu');
    burgerMenu.classList.toggle('navigation');
    burgerBtn.classList.toggle('burger-exit');
    burgerBtn.classList.toggle('burger');
    //переход по ссылкам из меню
    for (let burgerLink of burgerLinks) {
        burgerLink.onclick = function(){
            burgerSiteMenu.classList.toggle('navigation__user__mob');
            burgerMenu.classList.toggle('burger-menu');
            burgerMenu.classList.toggle('navigation');
            burgerBtn.classList.toggle('burger-exit');
            burgerBtn.classList.toggle('burger');
        };
    }
};
