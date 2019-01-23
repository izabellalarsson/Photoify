'use strict';

const uploadBtn = document.querySelector(
  '.profile .profile-bio .edit .upload-btn'
);
const uploadBar = document.querySelector('.upload');

if (uploadBtn) {
  uploadBtn.addEventListener('click', () => {
    uploadBar.classList.toggle('active');
  });
}
