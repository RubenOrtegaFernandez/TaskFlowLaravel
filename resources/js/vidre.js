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

const configuracioTasca = Object.assign({}, configuracioVidre, {
  cornerRadius: 24,
  zRadius: 24,
  opacity: 0.75,
  blurAmount: 2,
  refraction: 1,
  edgeHighlight: 0.4,
});

const configuracioCaixa = Object.assign({}, configuracioVidre, {
  cornerRadius: 16,
  zRadius: 16,
  opacity: 0.6,
  blurAmount: 1,
});

function aplicaVidre(element, root, configuracio) {
  if (element && root && element.parentElement === root) {
    LiquidGlass.init({
      root: root,
      glassElements: [element],
      defaults: configuracio || configuracioVidre,
    });

    element.classList.add('is-liquid');
  }
}

function aplicaVidreGrup(elements, configuracio) {
  const perPare = new Map();

  elements.forEach(function (element) {
    const pare = element.parentElement;

    if (pare) {
      if (!perPare.has(pare)) {
        perPare.set(pare, []);
      }
      perPare.get(pare).push(element);
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
    });
  });
}

// Si el root no té imatge de fons, n'hi clona una perquè el vidre tingui què refractar
function asseguraFons(root) {
  if (!root || root.querySelector(':scope > .vidre-fons')) {
    return;
  }

  const origen = document.querySelector('img.vidre-fons');

  if (origen) {
    const fons = origen.cloneNode(true);
    root.insertBefore(fons, root.firstChild);
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

    const botoEnviar = targeta.querySelector('button.btn');

    if (botoEnviar) {
      aplicaVidre(botoEnviar, botoEnviar.parentElement, configuracioBoto);
    }
  }
}

function iniciaAdmin(shell) {
  const header = shell.querySelector(':scope > .admin-header[data-vidre]');
  const main = shell.querySelector(':scope > .admin-main');

  if (header) {
    LiquidGlass.init({
      root: shell,
      glassElements: [header],
      defaults: configuracioVidre,
    });

    header.classList.add('is-liquid');
  }

  if (main) {
    const panells = main.querySelectorAll(':scope > .admin-panel');

    if (panells.length > 0) {
      LiquidGlass.init({
        root: main,
        glassElements: Array.from(panells),
        defaults: configuracioVidre,
      });

      panells.forEach(function (panell) {
        panell.classList.add('is-liquid');
      });
    }

    panells.forEach(function (panell) {
      const boto = panell.querySelector('.admin-panel__action .btn');

      if (boto) {
        asseguraFons(boto.parentElement);
        aplicaVidre(boto, boto.parentElement, configuracioBoto);
      }
    });

    panells.forEach(function (panell) {
      const contingut = panell.querySelector(':scope > .admin-panel__content');

      if (contingut) {
        const targetes = contingut.querySelectorAll(':scope > .tasca');

        if (targetes.length > 0) {
          LiquidGlass.init({
            root: contingut,
            glassElements: Array.from(targetes),
            defaults: configuracioTasca,
          });

          targetes.forEach(function (targeta) {
            targeta.classList.add('is-liquid');
          });
        }
      }
    });
  }
}

function iniciaDetallTasca() {
  const fitxa = document.querySelector('.llistat--detall');

  if (fitxa) {
    aplicaVidre(fitxa, fitxa.parentElement, configuracioTasca);
  }
}

function iniciaCreaTasca() {
  const targeta = document.querySelector('.tasca-card[data-vidre]');

  if (targeta) {
    aplicaVidre(targeta, targeta.parentElement, configuracioVidre);

    // nom i descripció (root: cada .tasca-card__col)
    aplicaVidreGrup(
      Array.from(targeta.querySelectorAll('.tasca-card__col > .tasca-caixa:not(.tasca-treballadors)')),
      configuracioCaixa
    );

    // dates (root: .tasca-dates)
    aplicaVidreGrup(
      Array.from(targeta.querySelectorAll('.tasca-dates > .tasca-data')),
      configuracioCaixa
    );

    // botó (root: .tasca-accions)
    const botoEnviar = targeta.querySelector('.tasca-accions > button.btn--enviar');

    if (botoEnviar) {
      aplicaVidre(botoEnviar, botoEnviar.parentElement, configuracioBoto);
    }
  }
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
  iniciaDetallTasca();
}

function alCarregar() {
  requestAnimationFrame(function () {
    iniciaVidre();
  });
}

if (document.readyState === 'complete') {
  alCarregar();
} else {
  window.addEventListener('load', alCarregar, { once: true });
}