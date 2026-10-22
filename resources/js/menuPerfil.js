const dropdown = document.getElementById('perfilDropdown');
const toggle = document.getElementById('perfilToggle');
const menu = document.getElementById('perfilMenu');

if (dropdown) {
    function abrirMenu() {
        menu.hidden = false;
        toggle.setAttribute('aria-expanded', 'true');
    }

    function cerrarMenu() {
        menu.hidden = true;
        toggle.setAttribute('aria-expanded', 'false');
    }

    toggle.addEventListener('click', () => {
        menu.hidden ? abrirMenu() : cerrarMenu();
    });

    document.addEventListener('click', (e) => {
        if (!dropdown.contains(e.target)) cerrarMenu();
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') cerrarMenu();
    });
}