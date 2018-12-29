'use strict';

const editbtn = [...document.querySelectorAll('.edit-post-button')];
console.log(editbtn);

function handleClick() {
    console.log('hej');
}
editbtn.forEach(btn => {
    console.log(btn);
    btn.addEventListener('click', handleClick);
});
