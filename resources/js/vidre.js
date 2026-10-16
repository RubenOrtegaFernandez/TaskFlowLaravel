
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

  if (arrel) {
    const elements = arrel.querySelectorAll(':scope > [data-vidre]');

    LiquidGlass.init({
      root: arrel,
      glassElements: elements,
      defaults: configuracioVidre,
    });

    elements.forEach((el) => el.classList.add('is-liquid'));
  }
}

window.addEventListener('load', iniciaVidre);