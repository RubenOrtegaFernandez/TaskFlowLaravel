import Usuari from '../classes/Usuari.js';

function iniciaBotonsContrasenya() {
  const botons = document.querySelectorAll('[data-password-toggle]');

  botons.forEach((boto) => {
    const camp = document.getElementById(boto.getAttribute('aria-controls'));
    const icona = boto.querySelector('use');

    if (camp && icona) {
      boto.addEventListener('click', () => {
        const esVisible = camp.type === 'text';
        const idIcona = esVisible ? '#icon-ull-tancat' : '#icon-ull-obert';

        camp.type = esVisible ? 'password' : 'text';
        boto.setAttribute('aria-label', esVisible ? 'Mostrar contrasenya' : 'Ocultar contrasenya');
        boto.setAttribute('aria-pressed', esVisible ? 'false' : 'true');
        icona.setAttribute('href', idIcona);
      });
    }
  });
}

function iniciaLogin() {
  const form = document.getElementById('form-login');

  if (form) {
    new Usuari(form).activa();

    // En tornar a enviar, amaguem l'error que havia retornat Laravel
    form.addEventListener('submit', () => {
      const errorServidor = document.getElementById('error-server');

      if (errorServidor) {
        errorServidor.hidden = true;
      }
    });
  }
}

function iniciaRegistre() {
  const form = document.getElementById('form-registre');

  if (form) {
    new Usuari(form).activa();
  }
}

export function iniciaAutenticacio() {
  iniciaBotonsContrasenya();
  iniciaLogin();
  iniciaRegistre();
}