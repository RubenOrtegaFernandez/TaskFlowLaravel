import { LiquidGlass } from 'https://cdn.jsdelivr.net/npm/@ybouane/liquidglass@1.0.3/dist/index.js';

const BASE = {
  blurAmount: 0,
  refraction: 0.8,
  chromAberration: 0.3,
  edgeHighlight: 0.43,
  specular: 0.15,
  fresnel: 1,
  cornerRadius: 40,
  zRadius: 40,
  opacity: 0.91,
  saturation: 0,
  tintStrength: 0,
  brightness: 0,
  shadowOpacity: 0.3,
  shadowSpread: 10,
  shadowOffsetY: 1,
  distortion: 0,
  bevelMode: 0,
};

export default class Vidre {
  _vidre;
  _boto;
  _accio;
  _tasca;
  _taula;
  _caixa;

  constructor() {
    this._vidre = BASE;
    this._boto = Vidre.fusiona(BASE, { button: true, opacity: 0.65, edgeHighlight: 0.15 });
    this._accio = Vidre.fusiona(BASE, { cornerRadius: 24, zRadius: 24, opacity: 0.65, blurAmount: 1 });
    this._tasca = Vidre.fusiona(BASE, { cornerRadius: 24, zRadius: 24, opacity: 0.75, blurAmount: 2, refraction: 1, edgeHighlight: 0.4 });
    this._taula = Vidre.fusiona(BASE, { cornerRadius: 24, zRadius: 24, opacity: 0.65, blurAmount: 2 });
    this._caixa = Vidre.fusiona(BASE, { cornerRadius: 16, zRadius: 16, opacity: 0.6, blurAmount: 1 });
  }

  // Copia la configuració base i hi aplica els canvis
  static fusiona(base, canvis) {
    const resultat = {};

    for (const clau in base) {
      resultat[clau] = base[clau];
    }

    for (const clau in canvis) {
      resultat[clau] = canvis[clau];
    }

    return resultat;
  }

  // ---------- Utilitats ----------

  esInicialitzat(element) {
    return element.getAttribute('data-vidre-inicialitzat') !== null;
  }

  marca(element) {
    element.classList.add('is-liquid');
    element.setAttribute('data-vidre-inicialitzat', 'true');
  }

  pendents(llista) {
    const resultat = [];

    llista.forEach((element) => {
      if (!this.esInicialitzat(element)) {
        resultat.push(element);
      }
    });

    return resultat;
  }

  asseguraFons(root) {
    if (root && !root.querySelector(':scope > .vidre-fons')) {
      const origen = document.querySelector('img.vidre-fons');

      if (origen) {
        const fons = origen.cloneNode(true);
        fons.classList.add('vidre-fons--font-render');
        root.insertBefore(fons, root.firstChild);
      }
    }
  }

  aplicaVidre(element, root, configuracio) {
    if (element && root && element.parentElement === root && !this.esInicialitzat(element)) {
      LiquidGlass.init({
        root: root,
        glassElements: [element],
        defaults: configuracio,
      });

      this.marca(element);
    }
  }

  // Agrupa els elements pel seu pare i inicialitza un sol cop per pare
  aplicaVidreGrup(elements, configuracio) {
    const pares = [];
    const fills = [];

    elements.forEach((element) => {
      const pare = element.parentElement;

      if (pare && !this.esInicialitzat(element)) {
        const posicio = pares.indexOf(pare);

        if (posicio === -1) {
          pares.push(pare);
          fills.push([element]);
        } else {
          fills[posicio].push(element);
        }
      }
    });

    pares.forEach((pare, i) => {
      LiquidGlass.init({
        root: pare,
        glassElements: fills[i],
        defaults: configuracio,
      });

      fills[i].forEach((fill) => this.marca(fill));
    });
  }

  // ---------- Pantalles ----------

  iniciaLogin(arrel) {
    const targeta = arrel.querySelector('[data-vidre]');

    if (targeta) {
      this.aplicaVidre(targeta, targeta.parentElement, this._vidre);

      targeta.querySelectorAll('.field').forEach((camp) => {
        this.aplicaVidre(camp, camp.parentElement, this._vidre);
      });

      targeta.querySelectorAll('.login-actions').forEach((accio) => {
        this.aplicaVidre(accio, accio.parentElement, this._vidre);
     });
    }
  }

  iniciaAdmin(shell) {
    const header = shell.querySelector(':scope > .admin-header[data-vidre]');
    const main = shell.querySelector(':scope > .admin-main');

    this.aplicaVidre(header, shell, this._vidre);

    if (main) {
      const panells = this.pendents(main.querySelectorAll(':scope > .admin-panel'));

      panells.forEach((panell) => this.asseguraFons(panell));
      this.aplicaVidreGrup(panells, this._vidre);

      panells.forEach((panell) => {
        const contingut = panell.querySelector(':scope > .admin-panel__content');

        if (contingut) {
          this.asseguraFons(contingut);

          const tasques = contingut.querySelectorAll(':scope > .tasca');
          const targetes = contingut.querySelectorAll(':scope > .targeta-vidre');

          this.aplicaVidreGrup(tasques, this._tasca);
          this.aplicaVidreGrup(targetes, this._vidre);
        }
      });
    }
  }

  iniciaDetallTasca() {
    const fitxa = document.querySelector('.tasca-detall__superficie[data-vidre-detall]');

    if (fitxa) {
      this.asseguraFons(fitxa.parentElement);
      this.aplicaVidre(fitxa, fitxa.parentElement, this._taula);
    }
  }

  iniciaConfirmacioEliminacio() {
    const targeta = document.querySelector('.tasca-eliminacio__card');

    if (targeta) {
      this.asseguraFons(targeta.parentElement);
      this.aplicaVidre(targeta, targeta.parentElement, this._tasca);
    }
  }

  iniciaTaulaTasques() {
    document.querySelectorAll('.taula-tasques[data-vidre-taula]').forEach((taula) => {
      this.aplicaVidre(taula, taula.parentElement, this._taula);
    });
  }

  iniciaAjustes() {
    const seccions = document.querySelectorAll('.ajustes__seccio');

    seccions.forEach((seccio) => this.asseguraFons(seccio.parentElement));
    this.aplicaVidreGrup(seccions, this._taula);
  }

  iniciaCreaTasca() {
    const targeta = document.querySelector('.tasca-card[data-vidre]');

    if (targeta) {
      this.aplicaVidre(targeta, targeta.parentElement, this._vidre);

      if (!targeta.classList.contains('usuari-form') && !targeta.classList.contains('categoria-form')) {
        const caixes = targeta.querySelectorAll('.tasca-caixa:not(.tasca-data)');

        caixes.forEach((caixa) => this.asseguraFons(caixa.parentElement));
        this.aplicaVidreGrup(caixes, this._caixa);
      }

      this.asseguraFons(targeta.querySelector('.tasca-dates'));
      this.aplicaVidreGrup(targeta.querySelectorAll('.tasca-dates > .tasca-data'), this._caixa);
    }
  }

  iniciaColumnes(selector, configuracio) {
    const formulari = document.querySelector(selector);

    if (formulari) {
      const graella = formulari.querySelector('.tasca-card__grid');

      if (graella) {
        this.asseguraFons(graella);
        this.aplicaVidreGrup(formulari.querySelectorAll('.tasca-card__col'), configuracio);
      }
    }
  }

  iniciaCampsDepartament() {
    const formulari = document.querySelector('.departament-form[data-vidre]');

    if (formulari) {
      const grups = formulari.querySelectorAll('[data-vidre-camp]');

      grups.forEach((grup) => this.asseguraFons(grup.parentElement));
      this.aplicaVidreGrup(grups, this._caixa);
    }
  }

  iniciaVidreBotons() {
    const accions = document.querySelectorAll('.admin-panel__action');

    accions.forEach((accio) => this.asseguraFons(accio.parentElement));
    this.aplicaVidreGrup(accions, this._accio);

    document.querySelectorAll('.btn, .tasca__boto').forEach((boto) => {
      const root = boto.parentElement;

      if (root && root.closest('.ajustes-panel')) {
        this.asseguraFons(root);
      }

      if (root && (root.classList.contains('admin-panel__action') || root.classList.contains('tasca-accions'))) {
        this.asseguraFons(root);
      }

      this.aplicaVidre(boto, root, this._boto);
    });
  }


  inicia() {
    const arrel = document.querySelector('[data-vidre-arrel]');
    const shell = document.querySelector('.admin-shell');

    if (arrel) {
      this.iniciaLogin(arrel);
    }

    if (shell) {
      this.iniciaAdmin(shell);
    }

    this.iniciaCreaTasca();
    this.iniciaColumnes('.usuari-form[data-vidre]', this._tasca);
    this.iniciaColumnes('.categoria-form[data-vidre]', this._taula);
    this.iniciaCampsDepartament();
    this.iniciaDetallTasca();
    this.iniciaConfirmacioEliminacio();
    this.iniciaTaulaTasques();
    this.iniciaAjustes();
    this.iniciaVidreBotons();
  }

  // Esperem dos fotogrames perquè el navegador hagi pintat el disseny
  iniciaQuanEstiguiPreparat() {
    requestAnimationFrame(() => {
      requestAnimationFrame(() => {
        this.inicia();
      });
    });
  }

  activa() {
    if (document.readyState === 'complete') {
      this.iniciaQuanEstiguiPreparat();
    } else {
      window.addEventListener('load', () => this.iniciaQuanEstiguiPreparat(), { once: true });
    }

    // Quan el navegador restaura la pàgina des de la memòria cau
    window.addEventListener('pageshow', (e) => {
      if (e.persisted) {
        this.iniciaQuanEstiguiPreparat();
      }
    });
  }
}