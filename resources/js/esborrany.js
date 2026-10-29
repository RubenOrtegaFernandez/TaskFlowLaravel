document.addEventListener('DOMContentLoaded', () => {
    const formularis = document.querySelectorAll('form[data-esborrany]');

    formularis.forEach((form) => {
        const clau = 'esborrany:' + form.getAttribute('action');

        const camps = Array.from(form.querySelectorAll('input, select, textarea'))
            .filter((c) => c.name && !['hidden', 'password', 'submit'].includes(c.type));

        const guardat = JSON.parse(localStorage.getItem(clau) || '{}');
        camps.forEach((c) => {
            if (guardat[c.name] && c.value === '') {
                c.value = guardat[c.name];
            }
        });

        const guardar = () => {
            const dades = {};
            camps.forEach((c) => {
                if (c.value !== '') dades[c.name] = c.value;
            });
            localStorage.setItem(clau, JSON.stringify(dades));
        };
        form.addEventListener('input', guardar);
        form.addEventListener('change', guardar);

        form.addEventListener('submit', () => {
            localStorage.removeItem(clau);
        });
    });
});