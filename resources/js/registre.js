document.addEventListener('DOMContentLoaded', function () {
  var formLogin = document.getElementById('form-login');

  if (formLogin) {
    formLogin.addEventListener('submit', function (e) {
      var correu = formLogin.elements['correu'].value.trim();
      var contrasenya = formLogin.elements['contrasenya'].value;
      var error = document.getElementById('error-login');

      // Amaga el missatge d'error del servidor si l'usuari reintenta per JS
      var serverError = document.getElementById('error-server');
      if (serverError) {
        serverError.style.display = 'none';
      }

      var mensaje = '';

      if (correu === '' || contrasenya === '') {
        mensaje = 'Omple tots els camps.';
      } else if (correu.indexOf('@') === -1) {
        mensaje = 'El correu no és vàlid.';
      } else if (contrasenya.length < 8) {
        mensaje = 'La contrasenya ha de tenir mínim 8 caràcters.';
      }

      if (mensaje !== '') {
        e.preventDefault();
        if (error) {
          error.textContent = mensaje;
          error.style.color = 'red';
          error.hidden = false;
        }
      }
    });
  }

  var formRegistre = document.getElementById('form-registre');

  if (formRegistre) {
    formRegistre.addEventListener('submit', function (e) {
      var nom = formRegistre.elements['nom_usu'].value.trim();
      var correu = formRegistre.elements['correu'].value.trim();
      var contrasenya = formRegistre.elements['contrasenya'].value;
      var error = document.getElementById('error-registre');
      var missatge = '';

      if (nom === '' || correu === '' || contrasenya === '') {
        missatge = 'Omple tots els camps.';
      } else if (nom.length > 25) {
        missatge = 'El nom no pot tenir més de 25 caràcters.';
      } else if (correu.indexOf('@') === -1) {
        missatge = 'El correu no és vàlid.';
      } else if (contrasenya.length < 8) {
        missatge = 'La contrasenya ha de tenir mínim 8 caràcters.';
      }

      if (missatge !== '') {
        e.preventDefault();
        if (error) {
          error.textContent = missatge;
          error.style.color = 'red';
          error.hidden = false;
        }
      }
    });
  }
});