'use strict';

const button = document.querySelectorAll('.posts .likes button');
const form = document.querySelector('.posts .likes form');

// let formData = document.querySelector('.posts .likes form');
// console.log(formData);

let formData = new FormData(document.querySelector('.posts .likes form'));

console.log(button);

button.forEach(function(button) {
    button.addEventListener('click', event => {
        //Prevent form from sending
        event.preventDefault();

        //Toggle icon
        for (let heart of button.children) {
            heart.classList.toggle('show');
        }

        fetch(form.action, {
            method: 'POST',
            body: formData,
        })
            .then(response => response.json())
            .then(json => {
                console.log(json);
            });

        // fetch(formData.action, {
        //     method: 'post',
        //     body: {
        //         post_id: 1,
        //     },
        // }).then(response => {
        //     response;
        // });

        //Send form with fetch()
        // fetch(formData, {
        //     headers: {
        //         'Content-type': 'application/json',
        //     },
        //     body: formData.values,
        // });
    });
});

// var formData = new FormData(document.querySelector('form'))

// först formet submittas adda event, prevent defauld, skickar requsetetn. hämta ut data.
