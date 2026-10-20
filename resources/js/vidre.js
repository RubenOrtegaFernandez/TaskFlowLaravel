
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
  const elementsVidre = [];

  const header = shell.querySelector(':scope > .admin-header[data-vidre]');

  if (header) {
    elementsVidre.push(header);
  }

  const panells = shell.querySelectorAll(':scope > .admin-panel');

  panells.forEach(function (panell) {
    elementsVidre.push(panell);
  });

  if (elementsVidre.length > 0) {
    LiquidGlass.init({
      root: shell,
      glassElements: elementsVidre,
      defaults: configuracioVidre,
    });

    elementsVidre.forEach(function (element) {
      element.classList.add('is-liquid');
    });
  }

  panells.forEach(function (panell) {
    const accio = panell.querySelector('.admin-panel__action');

    if (accio) {
      aplicaVidre(accio, panell, configuracioVidre);

      const boto = accio.querySelector('.btn');

      if (boto) {
        aplicaVidre(boto, accio, configuracioBoto);
      }
    }
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
