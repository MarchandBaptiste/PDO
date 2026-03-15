document.addEventListener('DOMContentLoaded', function () {
  const hamburger = document.getElementById('hamburger');
  const nav = document.getElementById('nav');

  hamburger.addEventListener('click', function () {
    nav.classList.toggle('active');

    hamburger.src = nav.classList.contains('active')
      ? '/assets/images/icon-close.svg'
      : '/assets/images/icon-hamburger.svg';
  });
});