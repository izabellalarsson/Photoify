'use strict';

const button = [...document.querySelectorAll('.posts .likes form button')];
const form = [...document.querySelectorAll('.posts .likes form')];

console.log(form);

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
// });
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
// let formData = document.querySelector('.posts .likes form');
// console.log(formData);

// button.forEach(button => {
// form.addEventListener('submit', event => {
//     //Prevent form from sending
//     event.preventDefault();
//     const formData = new FormData(document.querySelector('.posts .likes form'));
//
//     // fetch(form.action, {
//     //     method: 'POST',
//     //     headers: {
//     //         'Content-Type': 'application/json',
//     //     },
//     //     body: JSON.stringify({
//     //         liked: 1,
//     //     }),
//     // });
//
//     fetch(form.action, {
//         method: 'POST',
//         body: formData,
//     }).then(response => {
//         // for (let heart of button.children) {
//         //     heart.classList.toggle('show');
//         // }
//         // let likes = 1;
//         // response = likes;
//         console.log(formData);
//         // console.log(response.json());
//     });
//     // .then(liked => {
//     //     console.log(liked);
//     // });
//     // .then(response => {
//     //     console.log(response);
//     // });
//
//     // fetch(formData.action, {
//     //     method: 'post',
//     //     body: {
//     //         post_id: 1,
//     //     },
//     // }).then(response => {
//     //     response;
//     // });
//
//     //Send form with fetch()
//     // fetch(formData, {
//     //     headers: {
//     //         'Content-type': 'application/json',
//     //     },
//     //     body: formData.values,
//     // });
// });
// });

// var formData = new FormData(document.querySelector('form'))

// först formet submittas adda event, prevent defauld, skickar requsetetn. hämta ut data.
