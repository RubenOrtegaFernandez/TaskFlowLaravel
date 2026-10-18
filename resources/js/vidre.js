import { LiquidGlass } from 'https://cdn.jsdelivr.net/npm/@ybouane/liquidglass@1.0.3/dist/index.js';

const configuracioVidre = {
  blurAmount: 0,
  refraction: 0.8,
  chromAberration: 0.3,
  edgeHighlight: 0.43,
  specular: 0,
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
  specular: 0.15,
  tintStrength: 0,
});

// Aplica el vidre a un element
function aplicaVidre(element, root, defaults) {
  let configuracio = configuracioVidre;

  if (defaults) {
    configuracio = defaults;
  }

  LiquidGlass.init({
    root: root,
    glassElements: [element],
    defaults: configuracio,
  });

  element.classList.add('is-liquid');
}

// Login i registre
function iniciaLogin(arrel) {
  const targeta = arrel.querySelector('[data-vidre]');

  if (targeta) {
    aplicaVidre(targeta, targeta.parentElement);

    const camps = targeta.querySelectorAll('.field');
    camps.forEach(function (camp) {
      aplicaVidre(camp, camp.parentElement);
    });

    const accions = targeta.querySelectorAll('.login-actions');
    accions.forEach(function (accio) {
      aplicaVidre(accio, accio.parentElement);
    });

    const botoEnviar = targeta.querySelector('button.btn');
    if (botoEnviar) {
      aplicaVidre(botoEnviar, botoEnviar.parentElement, configuracioBoto);
    }
  }
}

// Dashboard de l'admin
function iniciaAdmin(shell) {
  const header = shell.querySelector('.admin-header[data-vidre]');
  if (header) {
    aplicaVidre(header, shell);
  }

  const panells = shell.querySelectorAll('.admin-panel');
  panells.forEach(function (panell) {
    aplicaVidre(panell, panell.parentElement);
  });

  const caixes = shell.querySelectorAll('.admin-panel__action');
  caixes.forEach(function (caixa) {
    aplicaVidre(caixa, caixa.parentElement);
  });

  const botons = shell.querySelectorAll('.admin-panel__action .btn');
  botons.forEach(function (boto) {
    aplicaVidre(boto, boto.parentElement, configuracioBoto);
  });
}

// Decideix quina pàgina és
function iniciaVidre() {
  const arrel = document.querySelector('[data-vidre-arrel]');
  const shell = document.querySelector('.admin-shell');

  if (arrel) {
    iniciaLogin(arrel);
  } else if (shell) {
    iniciaAdmin(shell);
  }
}

function alCarregar() {
  requestAnimationFrame(iniciaVidre);
}

if (document.readyState === 'complete') {
  alCarregar();
} else {
  window.addEventListener('load', alCarregar, { once: true });
}