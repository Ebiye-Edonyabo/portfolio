import './bootstrap';

document.addEventListener('scroll', function () {
    const nav = document.querySelector('nav');
    if (window.scrollY > 20) {
        nav.classList.add('backdrop-blur-md',);
    } else {
        nav.classList.remove('backdrop-blur-md',);
    }
});