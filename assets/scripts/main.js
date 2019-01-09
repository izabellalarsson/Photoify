'use strict';

const logOut = document.querySelector('.navbar .navbar-nav .nav-item .logout');
if (logOut) {
    logOut.addEventListener('click', () => {
        document.querySelector('.signout').style.display = 'flex';
    });
}
