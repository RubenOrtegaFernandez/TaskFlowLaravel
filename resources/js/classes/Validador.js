export default class Validador {
  _form;

  constructor(form) {
    this._form = form;
  }

  static esBuit(valor) {
    return valor.trim() === '';
  }

  static compleix(regex, valor) {
    return regex.test(valor);
  }

  get form() {
    return this._form;
  }

  valor(nom) {
  let resultat = '';
  const camp = this._form.elements[nom];

  if (camp) {
    resultat = camp.value.trim();
  }

  return resultat;
}

  mostraError(nom, missatge) {
  const camp = this._form.elements[nom];
  
    if (camp) {
      const error = document.createElement('span');
      error.className = 'error-camp';
      error.textContent = missatge;

      const contenidor = camp.closest('.field') || camp;
      contenidor.insertAdjacentElement('afterend', error);
    }
  }

  netejaErrors() {
    this._form.querySelectorAll('.error-camp').forEach((error) => error.remove());
  }

  // Les classes filles sobreescriuen aquest mètode amb les seves regles
  valida() {
    return true;
  }

  activa() {
    this._form.addEventListener('submit', (e) => {
      this.netejaErrors();

      if (!this.valida()) {
        e.preventDefault();
      }
    });
  }
}