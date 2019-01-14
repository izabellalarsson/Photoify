'use strict';

const editBtn = [...document.querySelectorAll('.edit-post-button button')];
const post = document.querySelector('.posts');


editBtn.forEach(button => {
  button.addEventListener('click', event => {
    let id = button.dataset.id;
    const edit = document.querySelector(`.posts .edit-post[data-id="${id}"]`);

    if (id == edit.dataset.id) {
      edit.classList.toggle('hidden');
    }
  })
})
