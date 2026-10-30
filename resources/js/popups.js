document.addEventListener('DOMContentLoaded', function () {
  var popups = document.querySelectorAll('.missatge-popup');

  popups.forEach(function (popup) {
    setTimeout(function () {
      popup.remove();
    }, 10000);

    var btn = popup.querySelector('.missatge-popup__close');

    if (btn) {
      btn.addEventListener('click', function () {
        popup.remove();
      });
    }
  });
});