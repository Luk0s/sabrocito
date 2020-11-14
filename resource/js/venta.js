document.querySelectorAll('.btn_detalle').forEach(btn => {
    btn.addEventListener('click', function(){
        document.querySelector(btn.dataset.target).classList.toggle('is-hidden');
    })
});