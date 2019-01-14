'use strict';

const toggle = document.querySelector('.toggle');
const toggleClose = document.querySelector('.toggle-close');
const navbar = document.querySelector('.navbar');
const navItems = document.querySelectorAll('.nav-item');

toggle.addEventListener('click', () => {
  navbar.classList.add('active');
  toggleClose.classList.add('active');
  toggle.classList.add('active');
});

toggleClose.addEventListener('click', () => {
  navbar.classList.remove('active');
  toggleClose.classList.remove('active');
  toggle.classList.remove('active');
});
