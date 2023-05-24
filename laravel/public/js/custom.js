const navToggle = document.getElementById('navToggle');
const navMenu = document.getElementById('navMenu');

navToggle.addEventListener('click', () => {
    navMenu.classList.toggle('open');
    const openIcon = document.getElementById('open-icon');
    const closeIcon = document.getElementById('close-icon');
    openIcon.classList.toggle('hidden');
    closeIcon.classList.toggle('hidden');
});