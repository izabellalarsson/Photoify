'use strict';
const likes_url = 'http://localhost:8888/app/likes/countlikes.php'
const button = [...document.querySelectorAll('.posts .likes .like button')];
const form = [...document.querySelectorAll('.posts .likes form')];

form.forEach(form => {
  form.addEventListener('submit', event => {
    const formData = new FormData(form);
    const p = document.querySelector('.posts .likes form p');
    event.preventDefault();

    fetch(form.action, {
      method: 'POST',
      body: formData,
    }).then(response => {});

    fetch(likes_url, {
    }).then((response) => {
      return response.json()
    }).then(data => {
      p.innerHTML = Object.values(data[0])[0];
    })





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
