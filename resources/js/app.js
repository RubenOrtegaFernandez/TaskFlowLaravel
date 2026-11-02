import { iniciaAutenticacio } from './modules/autenticacio.js';
import { iniciaTasques } from './modules/tasques.js';
import { iniciaPopups } from './modules/popups.js';
import Esborrany from './classes/Esborrany.js';
import Vidre from './modules/vidre.js';

document.addEventListener('DOMContentLoaded', () => {
  // 1r les validacions: han de registrar el seu "submit" abans que els esborranys
  iniciaAutenticacio();
  iniciaTasques();

  // Esborranys dels formularis que no són de tasca (usuaris, categories, departaments...)
  document.querySelectorAll('form[data-esborrany]').forEach((form) => {
    if (form.getAttribute('data-tasca') === null) {
      new Esborrany(form).activa();
    }
  });

  iniciaPopups();
});

// L'efecte vidre espera ell mateix a l'esdeveniment "load"
new Vidre().activa();