import Validador from './Validador.js';
import { REGEX_DATA } from '../utils/regex.js';

export default class Tasca extends Validador {
  _prioritatFixa;

  constructor(form) {
    super(form);
    // Si la prioritat ve fixada (per exemple, tasca urgent), no cal seleccionar-la
    this._prioritatFixa = form.querySelector('[data-prioritat-fixa]') !== null
      || window.location.search.indexOf('prioritat=urgent') !== -1;
  }

  get prioritatFixa() {
    return this._prioritatFixa;
  }

  validaNom() {
    let correcte = true;
    const nom = this.valor('nom_tas');

    if (Validador.esBuit(nom)) {
      this.mostraError('nom_tas', 'El nom de la tasca és obligatori.');
      correcte = false;
    } else if (nom.length > 25) {
      this.mostraError('nom_tas', 'El nom no pot tenir més de 25 caràcters.');
      correcte = false;
    }

    return correcte;
  }

  validaDescripcio() {
    let correcte = true;
    const descripcio = this.valor('descripcio');

    if (Validador.esBuit(descripcio)) {
      this.mostraError('descripcio', 'La descripció és obligatòria.');
      correcte = false;
    } else if (descripcio.length < 10) {
      this.mostraError('descripcio', 'La descripció ha de tenir mínim 10 caràcters.');
      correcte = false;
    }

    return correcte;
  }

  validaPrioritat() {
    let correcte = true;

    if (!this._prioritatFixa && Validador.esBuit(this.valor('prioritat'))) {
      this.mostraError('prioritat', 'Has de seleccionar una prioritat.');
      correcte = false;
    }

    return correcte;
  }

  validaDates() {
    let correcte = true;
    const dataInici = this.valor('data_inici');
    const dataFinal = this.valor('data_final');

    if (Validador.esBuit(dataInici)) {
      this.mostraError('data_inici', 'La data d\'inici és obligatòria.');
      correcte = false;
    } else if (!Validador.compleix(REGEX_DATA, dataInici)) {
      this.mostraError('data_inici', 'La data d\'inici no té un format vàlid.');
      correcte = false;
    }

    if (!Validador.esBuit(dataFinal)) {
      if (!Validador.compleix(REGEX_DATA, dataFinal)) {
        this.mostraError('data_final', 'La data final no té un format vàlid.');
        correcte = false;
      } else if (correcte && dataFinal < dataInici) {
        this.mostraError('data_final', 'La data final no pot ser anterior a la d\'inici.');
        correcte = false;
      }
    }

    return correcte;
  }

  valida() {
    let correcte = true;

    if (!this.validaNom()) {
      correcte = false;
    }

    if (!this.validaDescripcio()) {
      correcte = false;
    }

    if (!this.validaPrioritat()) {
      correcte = false;
    }

    if (!this.validaDates()) {
      correcte = false;
    }

    return correcte;
  }
}