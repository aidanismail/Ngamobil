document.getElementById('menu-btn').addEventListener('click', function() {
  var menu = document.getElementById('mobile-menu');
  if (menu.classList.contains('menu-closed')) {
    menu.classList.remove('menu-closed');
    menu.classList.add('menu-open');
  } else {
    menu.classList.remove('menu-open');
    menu.classList.add('menu-closed');
  }
});
