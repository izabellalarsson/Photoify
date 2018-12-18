'use strict';

const email = document.querySelector('.email-default');
const emaildiv = document.querySelector('.change-email');
console.log(emaildiv);
const emailTwo = document.querySelector('.confirm-w-password');
const emailConfirmButton = document.querySelectorAll(
    '.settings .change-email button'
);
const password = document.querySelector('.password-default');
const passwordNew = document.querySelector('.confirm-new-password');
const passwordConfirmButton = document.querySelectorAll(
    '.settings .change-password button'
);

email.addEventListener('click', () => {
    emailTwo.classList.add('show');
    emailConfirmButton.forEach(button => {
        button.classList.add('show');
    });
});

emaildiv.addEventListener('blur', () => {
    emailTwo.classList.remove('show');
    emailConfirmButton.forEach(button => {
        button.classList.remove('show');
    });
});

password.addEventListener('click', () => {
    password.setAttribute('placeholder', 'Current Password');
    passwordNew.classList.toggle('show');
    passwordConfirmButton.forEach(button => {
        button.classList.toggle('show');
    });
});
password.addEventListener('blur', () => {
    password.setAttribute('placeholder', 'Current Password');
    passwordNew.classList.toggle('show');
    passwordConfirmButton.forEach(button => {
        button.classList.toggle('show');
    });
});
