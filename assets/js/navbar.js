window.onload = () => {
    const navButton = document.querySelector(".nav-button");
    const nav = document.querySelector('#nav-bar');

    navButton.addEventListener('click', () => {
        nav.classList.toggle('show');
    });
}