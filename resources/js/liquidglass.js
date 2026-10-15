import { LiquidGlass } from '@ybouane/liquidglass';

document.addEventListener('DOMContentLoaded', async () => {
    const dashboard = document.querySelector('.admin-shell');
    const cabecera = dashboard?.querySelector('.admin-header');
    const contenido = dashboard?.querySelector('.admin-main');

    function prepararFondoCapturable(root) {
        if (!root || root.querySelector(':scope > .liquidglass-backdrop')) {
            return;
        }

        const estilos = getComputedStyle(document.body);
        const fondo = document.createElement('div');

        fondo.className = 'liquidglass-backdrop';
        fondo.style.position = 'absolute';
        fondo.style.inset = '0';
        fondo.style.pointerEvents = 'none';
        fondo.style.zIndex = '-2';
        fondo.style.backgroundImage = estilos.backgroundImage;
        fondo.style.backgroundPosition = 'center';
        fondo.style.backgroundSize = 'cover';
        fondo.style.backgroundRepeat = 'no-repeat';

        root.style.position = 'relative';
        root.style.isolation = 'isolate';
        root.prepend(fondo);
    }

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
        bevelMode: 0
    };

    try {
        // Efecto Liquid Glass en la cabecera
        if (dashboard && cabecera) {
            prepararFondoCapturable(dashboard);

            cabecera.dataset.config = JSON.stringify(configuracioVidre);

            await LiquidGlass.init({
                root: dashboard,
                glassElements: [cabecera]
            });
        }


        if (contenido) {
            prepararFondoCapturable(contenido);

            const paneles = contenido.querySelectorAll('.admin-panel');

            paneles.forEach((panel) => {
                panel.dataset.config = JSON.stringify(configuracioVidre);
            });

            if (paneles.length > 0) {
                await LiquidGlass.init({
                    root: contenido,
                    glassElements: Array.from(paneles)
                });
            }
        }
    } catch (error) {
        console.error(
            'No s’ha pogut iniciar Liquid Glass:',
            error
        );
    }
});
