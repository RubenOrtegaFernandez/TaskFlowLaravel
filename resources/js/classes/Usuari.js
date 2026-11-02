import Validador from './Validador.js';
import { REGEX_CORREU, REGEX_NOM } from '../utils/regex.js';

export default class Usuari extends Validador {
  _esRegistre;

  constructor(form) {
    super(form);
    // Si el formulari té el camp nom_usu, és el de registre
    this._esRegistre = form.elements['nom_usu'] !== undefined;
  }

  get esRegistre() {
    return this._esRegistre;
  }

  validaNom() {
    let correcte = true;
    const nom = this.valor('nom_usu');

    if (Validador.esBuit(nom)) {
      this.mostraError('nom_usu', 'El nom és obligatori.');
      correcte = false;
    } else if (nom.length > 25) {
      this.mostraError('nom_usu', 'El nom no pot tenir més de 25 caràcters.');
      correcte = false;
    } else if (!Validador.compleix(REGEX_NOM, nom)) {
      this.mostraError('nom_usu', 'El nom conté caràcters no permesos.');
      correcte = false;
    }

    return correcte;
  }

  validaCorreu() {
    let correcte = true;
    const correu = this.valor('correu');

    if (Validador.esBuit(correu)) {
      this.mostraError('correu', 'El correu és obligatori.');
      correcte = false;
    } else if (!Validador.compleix(REGEX_CORREU, correu)) {
      this.mostraError('correu', 'El correu no és vàlid.');
      correcte = false;
    }

    return correcte;
  }

  validaContrasenya() {
    let correcte = true;
    const contrasenya = this._form.elements['contrasenya'].value;

    if (contrasenya === '') {
      this.mostraError('contrasenya', 'La contrasenya és obligatòria.');
      correcte = false;
    } else if (contrasenya.length < 8) {
      this.mostraError('contrasenya', 'La contrasenya ha de tenir mínim 8 caràcters.');
      correcte = false;
    }

    return correcte;
  }

  valida() {
    let correcte = true;

    if (this._esRegistre && !this.validaNom()) {
      correcte = false;
    }

    if (!this.validaCorreu()) {
      correcte = false;
    }

    if (!this.validaContrasenya()) {
      correcte = false;
    }

    return correcte;
  }
}