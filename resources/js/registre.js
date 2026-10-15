// Espai per al JavaScript de l'aplicació
document.addEventListener('DOMContentLoaded', () => {
  // Ex.: validacions o interaccions del formulari de login
  const formulari = document.getElementById('form-registre');
 
  const missatgeError = document.getElementById('error-registre');
  const botoEnviar = formulari.querySelector('button[type="submit"]');
 
  const mostrarError = (text) => {
    missatgeError.textContent = text;
    missatgeError.hidden = false;
  };
 
  const amagarError = () => {
    missatgeError.textContent = '';
    missatgeError.hidden = true;
  };
 
  // Mateixes regles que tenia $request->validate()
  const validar = ({ nom_usu, correu, contrasenya }) => {
      const regexCorreu = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      let error = null;
 
      if (!nom_usu) {
        error = 'El nom és obligatori.';
      } else if (nom_usu.length > 25) {
        error = 'El nom no pot tenir més de 25 caràcters.';
      } else if (!correu) {
        error = 'El correu és obligatori.';
      } else if (!regexCorreu.test(correu) || correu.length > 255) {
        error = 'El correu no és vàlid.';
      } else if (!contrasenya) {
        error = 'La contrasenya és obligatòria.';
      } else if (contrasenya.length < 8) {
        error = 'La contrasenya ha de tenir mínim 8 caràcters.';
      }
 
    return error;
  };
 
  formulari.addEventListener('submit', async (e) => {
    e.preventDefault();
    amagarError();
 
    const dades = {
      nom_usu: formulari.elements['nom_usu'].value.trim(),
      correu: formulari.elements['correu'].value.trim(),
      contrasenya: formulari.elements['contrasenya'].value,
    };
 
    const errorValidacio = validar(dades);
    if (errorValidacio) {
        mostrarError(errorValidacio);
        return;
      }
 
      botoEnviar.disabled = true;
 
    try {
      const resposta = await fetch('/registre', {method: 'POST',headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        // El token ve del @csrf que ja hi ha al formulari
        'X-CSRF-TOKEN': formulari.querySelector('input[name="_token"]').value,},
        body: JSON.stringify(dades),});
      const resultat = await resposta.json().catch(() => ({}));
      if (resposta.ok) {
        window.location.href = resultat.redirect ?? '/login';
      } else {
        mostrarError(resultat.error ?? 'Error en registrar l\'usuari. Torna-ho a provar.');
        botoEnviar.disabled = false;
      }
    } catch (err) {
      mostrarError('No s\'ha pogut connectar amb el servidor.');
      botoEnviar.disabled = false;
    }
  });
});