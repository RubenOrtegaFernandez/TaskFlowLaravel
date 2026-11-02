export default class Esborrany {
  _form;
  _clau;
  _camps;

  constructor(form) {
    this._form = form;
    this._clau = 'esborrany:' + form.getAttribute('action');

    // No guardem contrasenyes, camps ocults (_token), botons, checkbox ni radio
    this._camps = form.querySelectorAll(
      'input:not([type=password]):not([type=hidden]):not([type=submit]):not([type=checkbox]):not([type=radio]), select, textarea'
    );
  }

  get clau() {
    return this._clau;
  }

  guarda() {
    const dades = {};

    this._camps.forEach((camp) => {
      if (camp.name) {
        dades[camp.name] = camp.value;
      }
    });

    localStorage.setItem(this._clau, JSON.stringify(dades));
  }

  restaura() {
    const dades = JSON.parse(localStorage.getItem(this._clau));

    if (dades) {
      this._camps.forEach((camp) => {
        if (dades[camp.name] && camp.value === '') {
          camp.value = dades[camp.name];
        }
      });
    }
  }

  esborra() {
    localStorage.removeItem(this._clau);
  }

  activa() {
    this.restaura();

    this._form.addEventListener('input', () => this.guarda());

    this._form.addEventListener('submit', (e) => {
      if (!e.defaultPrevented) {
        this.esborra();
      }
    });
  }
}