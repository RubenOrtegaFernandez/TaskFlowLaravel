import Tasca from '../classes/Tasca.js';
import Esborrany from '../classes/Esborrany.js';

export function iniciaTasques() {
  const formularis = document.querySelectorAll('form[data-tasca]');

  formularis.forEach((form) => {
    // 1r la validació: si bloqueja l'enviament, l'esborrany no s'esborra
    new Tasca(form).activa();

    // 2n l'esborrany, només si el formulari té data-esborrany
    if (form.hasAttribute('data-esborrany')) {
      new Esborrany(form).activa();
    }
  });
}