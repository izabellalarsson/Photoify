'use strict';

const heart = document.querySelector('.posts .likes i.unfilled');
const filledHeart = document.querySelector('.posts .likes i.filled');

heart.addEventListener('click', () => {
    filledHeart.classList.add('show');
    heart.classList.add('hide');
});

filledHeart.addEventListener('click', () => {
    filledHeart.classList.remove('show');
    heart.classList.remove('hide');
});
