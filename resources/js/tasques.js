document.addEventListener('DOMContentLoaded', function () {
  var formularisTasca = document.querySelectorAll('form[data-vidre]');

  formularisTasca.forEach(function (form) {
    if (form.querySelector('input[name="nom_tas"]')) {
      var clau = 'esborrany:tasca:' + (form.getAttribute('action') || form.id || 'default');

      var camps = Array.from(form.querySelectorAll('input, select, textarea'))
        .filter(function (camp) {
          return camp.name && ['hidden', 'password', 'submit'].indexOf(camp.type) === -1;
        });

      var guardat = {};
      try {
        guardat = JSON.parse(localStorage.getItem(clau) || '{}');
      } catch (err) {
        guardat = {};
      }

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

      form.addEventListener('submit', function (e) {
        var valor = function (nom) {
          return form.elements[nom] ? form.elements[nom].value.trim() : '';
        };

        var nomTasca = valor('nom_tas');
        var descripcio = valor('descripcio');
        var prioritat = valor('prioritat');
        var dataInici = valor('data_inici');
        var dataFinal = valor('data_final');
        var error = form.querySelector('[data-error-tasca]');
        var missatge = '';

        if (nomTasca === '') {
          missatge = 'El nom de la tasca és obligatori.';
        } else if (nomTasca.length > 25) {
          missatge = 'El nom no pot tenir més de 25 caràcters.';
        } else if (descripcio === '') {
          missatge = 'La descripció és obligatòria.';
        } else if (descripcio.length < 10) {
          missatge = 'La descripció ha de tenir mínim 10 caràcters.';
        } else if (prioritat === '') {
          missatge = 'Has de seleccionar una prioritat.';
        } else if (dataInici === '') {
          missatge = 'La data d’inici és obligatòria.';
        } else if (dataFinal !== '' && dataFinal < dataInici) {
          missatge = 'La data final no pot ser anterior a la d’inici.';
        }

        if (missatge !== '') {
          e.preventDefault();

          if (error) {
            error.textContent = missatge;
            error.hidden = false;
            error.style.color = '#ff5555';
          } else {
            alert(missatge);
          }
        } else {
          localStorage.removeItem(clau);
        }
      });
    }
  });
});