import { LiquidGlass } from 'https://cdn.jsdelivr.net/npm/@ybouane/liquidglass@1.0.3/dist/index.js';

const configuracioVidre = {
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

const configuracioBoto = Object.assign({}, configuracioVidre, {
  button: true,
  opacity: 0.65,
  edgeHighlight: 0.15,
});

const configuracioAccio = Object.assign({}, configuracioVidre, {
  cornerRadius: 24,
  zRadius: 24,
  opacity: 0.65,
  blurAmount: 1,
});

const configuracioTasca = Object.assign({}, configuracioVidre, {
  cornerRadius: 24,
  zRadius: 24,
  opacity: 0.75,
  blurAmount: 2,
  refraction: 1,
  edgeHighlight: 0.4,
});

const configuracioTaula = Object.assign({}, configuracioVidre, {
  cornerRadius: 24,
  zRadius: 24,
  opacity: 0.65,
  blurAmount: 2,
});

const configuracioCaixa = Object.assign({}, configuracioVidre, {
  cornerRadius: 16,
  zRadius: 16,
  opacity: 0.6,
  blurAmount: 1,
});

function aplicaVidre(element, root, configuracio) {
  if (element && root && element.parentElement === root && !element.dataset.vidreInicialitzat) {
    LiquidGlass.init({
      root: root,
      glassElements: [element],
      defaults: configuracio || configuracioVidre,
    });

    element.classList.add('is-liquid');
    element.dataset.vidreInicialitzat = 'true';
  }
}

function aplicaVidreGrup(elements, configuracio) {
  const perPare = new Map();

  elements.forEach(function (element) {
    if (!element.dataset.vidreInicialitzat) {
      const pare = element.parentElement;

      if (pare) {
        if (!perPare.has(pare)) {
          perPare.set(pare, []);
        }
        perPare.get(pare).push(element);
      }
    }
  });

  perPare.forEach(function (fills, pare) {
    LiquidGlass.init({
      root: pare,
      glassElements: fills,
      defaults: configuracio || configuracioVidre,
    });

    fills.forEach(function (fill) {
      fill.classList.add('is-liquid');
      fill.dataset.vidreInicialitzat = 'true';
    });
  });
}

function asseguraFons(root) {
  const teFons = root && root.querySelector(':scope > .vidre-fons');

  if (root && !teFons) {
    const origen = document.querySelector('img.vidre-fons');

    if (origen) {
      const fons = origen.cloneNode(true);
      fons.classList.add('vidre-fons--font-render');
      root.insertBefore(fons, root.firstChild);
    }
  }
}

function iniciaLogin(arrel) {
  const targeta = arrel.querySelector('[data-vidre]');

  if (targeta) {
    aplicaVidre(targeta, targeta.parentElement, configuracioVidre);

    const camps = targeta.querySelectorAll('.field');

    camps.forEach(function (camp) {
      aplicaVidre(camp, camp.parentElement, configuracioVidre);
    });

    const accions = targeta.querySelectorAll('.login-actions');

    accions.forEach(function (accio) {
      aplicaVidre(accio, accio.parentElement, configuracioVidre);
    });

  }
}

function iniciaAdmin(shell) {
  const header = shell.querySelector(':scope > .admin-header[data-vidre]');
  const main = shell.querySelector(':scope > .admin-main');

  if (header && !header.dataset.vidreInicialitzat) {
    LiquidGlass.init({
      root: shell,
      glassElements: [header],
      defaults: configuracioVidre,
    });

    header.classList.add('is-liquid');
    header.dataset.vidreInicialitzat = 'true';
  }

  if (main) {
    const panells = Array.from(main.querySelectorAll(':scope > .admin-panel'))
      .filter(function (panell) {
        return !panell.dataset.vidreInicialitzat;
      });

    if (panells.length > 0) {
      panells.forEach(function (panell) {
        asseguraFons(panell);
      });

      LiquidGlass.init({
        root: main,
        glassElements: Array.from(panells),
        defaults: configuracioVidre,
      });

      panells.forEach(function (panell) {
        panell.classList.add('is-liquid');
        panell.dataset.vidreInicialitzat = 'true';
      });
    }

    panells.forEach(function (panell) {
      const contingut = panell.querySelector(':scope > .admin-panel__content');

      if (contingut) {
      const targetes = Array.from(contingut.querySelectorAll(':scope > .tasca'))
        .filter(function (targeta) {
          return !targeta.dataset.vidreInicialitzat;
        });

        if (targetes.length > 0) {
          LiquidGlass.init({
            root: contingut,
            glassElements: Array.from(targetes),
            defaults: configuracioTasca,
          });

          targetes.forEach(function (targeta) {
            targeta.classList.add('is-liquid');
            targeta.dataset.vidreInicialitzat = 'true';
          });
        }
      }
    });
  }
}

function iniciaDetallTasca() {
  const fitxa = document.querySelector('.tasca-detall__superficie[data-vidre-detall]');

  if (fitxa) {
    asseguraFons(fitxa.parentElement);
    aplicaVidre(fitxa, fitxa.parentElement, configuracioTaula);
  }
}

function iniciaConfirmacioEliminacio() {
  const targeta = document.querySelector('.tasca-eliminacio__card');

  if (targeta) {
    asseguraFons(targeta.parentElement);
    aplicaVidre(targeta, targeta.parentElement, configuracioTasca);
  }
}

function iniciaTaulaTasques() {
  const taules = document.querySelectorAll('.taula-tasques[data-vidre-taula]');

  taules.forEach(function (taula) {
    aplicaVidre(taula, taula.parentElement, configuracioTaula);
  });
}

function iniciaCreaTasca() {
  const targeta = document.querySelector('.tasca-card[data-vidre]');

  if (targeta) {
    aplicaVidre(targeta, targeta.parentElement, configuracioVidre);

    if (!targeta.classList.contains('usuari-form')) {
      // nom i descripció (root: cada .tasca-card__col)
      const caixes = Array.from(targeta.querySelectorAll('.tasca-caixa:not(.tasca-data)'));
      const arrelsCaixes = new Set();

      caixes.forEach(function (caixa) {
        if (caixa.parentElement) {
          arrelsCaixes.add(caixa.parentElement);
        }
      });

      arrelsCaixes.forEach(function (arrel) {
        asseguraFons(arrel);
      });

      aplicaVidreGrup(caixes, configuracioCaixa);
    }

    // dates (root: .tasca-dates)
    const dates = Array.from(targeta.querySelectorAll('.tasca-dates > .tasca-data'));
    const arrelDates = targeta.querySelector('.tasca-dates');

    if (arrelDates) {
      asseguraFons(arrelDates);
    }

    aplicaVidreGrup(dates, configuracioCaixa);

    // botó (root: .tasca-accions)
  }
}

function iniciaColumnesUsuaris() {
  const formulari = document.querySelector('.usuari-form[data-vidre]');

  if (formulari) {
    const graella = formulari.querySelector('.tasca-card__grid');
    const columnes = Array.from(formulari.querySelectorAll('.tasca-card__col'));

    if (graella) {
      asseguraFons(graella);
      aplicaVidreGrup(columnes, configuracioTasca);
    }
  }
}

function iniciaCampsDepartament() {
  const formulari = document.querySelector('.departament-form[data-vidre]');

  if (formulari) {
    const grups = Array.from(formulari.querySelectorAll('[data-vidre-camp]'));
    const arrels = new Set();

    grups.forEach(function (grup) {
      if (grup.parentElement) {
        arrels.add(grup.parentElement);
      }
    });

    arrels.forEach(function (arrel) {
      asseguraFons(arrel);
    });

    aplicaVidreGrup(grups, configuracioCaixa);
  }
}

function iniciaVidreBotons() {
  const accions = document.querySelectorAll('.admin-panel__action');

  accions.forEach(function (accio) {
    asseguraFons(accio.parentElement);
  });

  aplicaVidreGrup(Array.from(accions), configuracioAccio);

  const botons = document.querySelectorAll('.btn, .tasca__boto');

  botons.forEach(function (boto) {
    const root = boto.parentElement;

    if (root && (root.classList.contains('admin-panel__action') || root.classList.contains('tasca-accions'))) {
      asseguraFons(root);
    }

    aplicaVidre(boto, root, configuracioBoto);
  });
}

function iniciaVidre() {
  const arrel = document.querySelector('[data-vidre-arrel]');
  const shell = document.querySelector('.admin-shell');

  if (arrel) {
    iniciaLogin(arrel);
  }

  if (shell) {
    iniciaAdmin(shell);
  }

  iniciaCreaTasca();
  iniciaColumnesUsuaris();
  iniciaCampsDepartament();
  iniciaDetallTasca();
  iniciaConfirmacioEliminacio();
  iniciaTaulaTasques();
  iniciaVidreBotons();
}

function iniciaQuanEstiguiPreparat() {
  requestAnimationFrame(function () {
    requestAnimationFrame(function () {
      iniciaVidre();
    });
  });
}

if (document.readyState === 'complete') {
  iniciaQuanEstiguiPreparat();
} else {
  window.addEventListener('load', iniciaQuanEstiguiPreparat, { once: true });
}

// Reaplica la inicialització quan el navegador restaura la pàgina des de BFCache.
window.addEventListener('pageshow', function (event) {
  if (event.persisted) {
    iniciaQuanEstiguiPreparat();
  }
});
