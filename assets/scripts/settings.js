'use strict';

const email = document.querySelector('.email-default', 'label[for=email]');
const emailTwo = document.querySelector('.confirm-w-password');
const emailConfirmButton = document.querySelectorAll(
  '.settings .change-email button'
);

const password = document.querySelector(
  '.password-default',
  'label[for=password-old]'
);
const passwordNew = document.querySelector('.confirm-new-password');
const passwordConfirmButton = document.querySelectorAll(
  '.settings .change-password button'
);

if (email) {
  email.addEventListener('click', () => {
    emailTwo.classList.toggle('show');
    emailConfirmButton.forEach(button => {
      button.classList.toggle('show');
    });
  });
}

if (password) {
  password.addEventListener('click', () => {
    password.setAttribute('placeholder', 'Current Password');
    passwordNew.classList.toggle('show');
    passwordConfirmButton.forEach(button => {
      button.classList.toggle('show');
    });
  });
}
