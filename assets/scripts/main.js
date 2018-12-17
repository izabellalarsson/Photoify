'use strict';

const logOut = document.querySelector('.navbar .navbar-nav .nav-item .logout');

logOut.addEventListener('click', () => {
    document.querySelector('.signout').style.display = 'flex';
});

const toggle = document.querySelector('.toggle');
const toggleClose = document.querySelector('.toggle-close');
const navbar = document.querySelector('.navbar');
const navItems = document.querySelectorAll('.nav-item');

console.log(toggle);

toggle.addEventListener('click', () => {
    // navItems.forEach(navItem => {
    //     navItem.classList.toggle('active');
    // });
    navbar.classList.add('active');
    toggleClose.classList.add('active');
    toggle.classList.add('active');
});

toggleClose.addEventListener('click', () => {
    navbar.classList.remove('active');
    toggleClose.classList.remove('active');
    toggle.classList.remove('active');
});
