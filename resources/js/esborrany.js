document.addEventListener('DOMContentLoaded', function () {
  var formularis = document.querySelectorAll('form[data-esborrany]');

  formularis.forEach(function (form) {
    var clau = 'esborrany:' + form.getAttribute('action');

    var camps = Array.from(form.querySelectorAll('input, select, textarea'))
      .filter(function (camp) {
        return camp.name && ['hidden', 'password', 'submit'].indexOf(camp.type) === -1;
      });

    var guardat = JSON.parse(localStorage.getItem(clau) || '{}');

    camps.forEach(function (camp) {
      if (guardat[camp.name] && camp.value === '') {
        camp.value = guardat[camp.name];
      }
    });

    var guardar = function () {
      var dades = {};

      camps.forEach(function (camp) {
        if (camp.value !== '') {
          dades[camp.name] = camp.value;
        }
      });

      localStorage.setItem(clau, JSON.stringify(dades));
    };

    form.addEventListener('input', guardar);
    form.addEventListener('change', guardar);

    form.addEventListener('submit', function () {
      localStorage.removeItem(clau);
    });
  });
})