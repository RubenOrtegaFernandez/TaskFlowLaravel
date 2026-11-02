export function iniciaPopups() {
  const popups = document.querySelectorAll('.missatge-popup');

  popups.forEach((popup) => {
    // El popup desapareix sol als 10 segons
    const temporitzador = setTimeout(() => {
      popup.remove();
    }, 10000);

    // O quan l'usuari prem el botó de tancar
    const boto = popup.querySelector('.missatge-popup__close');

    if (boto) {
      boto.addEventListener('click', () => {
        clearTimeout(temporitzador);
        popup.remove();
      });
    }
  });
}