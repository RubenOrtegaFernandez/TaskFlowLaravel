
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

function iniciaVidre() {
  const arrel = document.querySelector('[data-vidre-arrel]');
  const targeta = arrel
    ? arrel.querySelector('[data-vidre]')
    : null;

  const camps = targeta
    ? targeta.querySelectorAll('.field')
    : [];

  const accions = targeta
    ? targeta.querySelectorAll('.login-actions')
    : [];

  const botoEnviar = targeta
    ? targeta.querySelector('button.btn')
    : null;

  // Targeta del formulari
  if (arrel && targeta) {
    LiquidGlass.init({
      root: targeta.parentElement,
      glassElements: [targeta],
      defaults: configuracioVidre,
    });

    targeta.classList.add('is-liquid');
  }

  // Camps de nom, correu i contrasenya
  camps.forEach((camp) => {
    LiquidGlass.init({
      root: camp.parentElement,
      glassElements: [camp],
      defaults: configuracioVidre,
    });

    camp.classList.add('is-liquid');
  });

  // Zona inferior del formulari
  accions.forEach((accio) => {
    LiquidGlass.init({
      root: accio.parentElement,
      glassElements: [accio],
      defaults: configuracioVidre,
    });

    accio.classList.add('is-liquid');
  });

  // Botó Enviar
  if (botoEnviar) {
    LiquidGlass.init({
      root: botoEnviar.parentElement,
      glassElements: [botoEnviar],
      defaults: {
        ...configuracioVidre,
        button: true,
        opacity: 0.65,
        edgeHighlight: 0.15,
        specular: 0.15,
        tintStrength: 0,
      },
    });

    botoEnviar.classList.add('is-liquid');
  }
}

if (document.readyState === 'complete') {
  requestAnimationFrame(iniciaVidre);
} else {
  window.addEventListener(
    'load',
    () => {
      requestAnimationFrame(iniciaVidre);
    },
    { once: true }
  );
}
