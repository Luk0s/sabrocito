document.addEventListener('DOMContentLoaded', () => {
    const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);
    if ($navbarBurgers.length > 0) {
        $navbarBurgers.forEach( el => {
            el.addEventListener('click', () => {
                const target = el.dataset.target;
                const $target = document.getElementById(target);
                el.classList.toggle('is-active');
                $target.classList.toggle('is-active');
            });
        });
    }

    const $btn_modal_cerrar = Array.prototype.slice.call(document.querySelectorAll('.cerrar_modal'), 0);
    if($btn_modal_cerrar.length > 0){
        $btn_modal_cerrar.forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelector(`#${btn.dataset.target}`).classList.toggle('is-active');
            });
        });
    }
});