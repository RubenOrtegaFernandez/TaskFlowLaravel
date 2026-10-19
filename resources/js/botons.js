document.addEventListener('DOMContentLoaded', function () {
    var boto = document.getElementById('boto-menu');
    var menu = document.getElementById('menu-perfil');

    if (boto && menu) {
        boto.addEventListener('click', function () {
            menu.hidden = !menu.hidden;
        });

        document.addEventListener('click', function (OnEsClica) {
            if (!menu.contains(OnEsClica.target) && !boto.contains(OnEsClica.target)) {
            menu.hidden = true;
        }});
    }
});