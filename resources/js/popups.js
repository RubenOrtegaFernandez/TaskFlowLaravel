console.log('popups.js cargado');

document.addEventListener('DOMContentLoaded', () => {
    const popups = document.querySelectorAll('.missatge-popup');
    console.log('popups encontrados:', popups.length);

    popups.forEach((popup) => {
        setTimeout(() => popup.remove(), 10000);
        const btn = popup.querySelector('.missatge-popup__close');
        if (btn) btn.addEventListener('click', () => popup.remove());
    });
});