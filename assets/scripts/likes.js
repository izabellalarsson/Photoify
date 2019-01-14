'use strict';

const button = [...document.querySelectorAll('.posts .likes .like button')];
const form = [...document.querySelectorAll('.posts .likes form')];

form.forEach(form => {
    form.addEventListener('submit', event => {
        const formData = new FormData(form);
        event.preventDefault();

        fetch(form.action, {
            method: 'POST',
            body: formData,
        }).then(response => {});
    });
});

button.forEach(button => {
    button.addEventListener('click', () => {
        for (let heart of button.children) {
            if (heart.classList.contains('far', 'fa-heart')) {
                heart.classList.add('fas', 'fa-heart', 'show');
                heart.classList.remove('far');
            } else {
                heart.classList.add('far');
                heart.classList.remove('fas', 'show');
            }
        }
    });
});
