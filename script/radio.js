// Radio tabs functionality (enhanced for both menus)
const labels = document.querySelectorAll('.radio-tabs label');
const menus = document.querySelectorAll('.menu-box');

function showMenu(target) {
  menus.forEach(menu => menu.classList.remove('active'));
  labels.forEach(label => label.classList.remove('active'));
  document.querySelector(`.${target}`).classList.add('active');
  document.querySelector(`[data-target="${target}"]`).classList.add('active');
}

labels.forEach(label => {
  label.addEventListener('click', () => {
    showMenu(label.dataset.target);
  });
});

// Initial active menu
showMenu('cars-menu');

// Smooth scrolling for navbar links (upgrade)
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function (e) {
    e.preventDefault();
    document.querySelector(this.getAttribute('href')).scrollIntoView({
      behavior: 'smooth'
    });
  });
});