let detalle = [];

document.addEventListener('DOMContentLoaded', () => {
    document.querySelector('#btn_agregar').addEventListener('click', () =>{
        const tabla = document.querySelector('#tbl_venta_rapida_detalle');
        const cmb_producto = document.querySelector('#cmb_producto');
        const tr = tabla.insertRow(tabla.rows.count);
        const td_producto = tr.insertCell(0);
        td_producto.innerText = cmb_producto.options[cmb_producto.selectedIndex].text;
        td_producto.setAttribute('data-id', cmb_producto.options[cmb_producto.selectedIndex].value);

        const td_precio = tr.insertCell(1);
        let precio = 0;
        if(cmb_producto.options[cmb_producto.selectedIndex].dataset['precioLeche'] !== undefined){
            precio = confirm('Con leche ?')
                ? cmb_producto.options[cmb_producto.selectedIndex].dataset['precioLeche']
                : cmb_producto.options[cmb_producto.selectedIndex].dataset['precio'];
        } else {
            precio = cmb_producto.options[cmb_producto.selectedIndex].dataset['precio'];
        }
        td_precio.innerText = precio; td_precio.setAttribute('data-precio', precio);

        const btn = document.createElement('button'); btn.className = 'button is-danger'; btn.type = 'button'; btn.innerText = 'X';
        btn.addEventListener('click', function(){
            const tr = this.parentElement.parentElement.remove();
            calcular_total();
        });
        const td_btn = tr.insertCell(2); td_btn.append(btn);
        calcular_total();
    });

    const calcular_total = () => {
        detalle = [];
        const tbl = document.querySelector('#tbl_venta_rapida_detalle');
        let total_precio = 0;
        Array.from(tbl.rows).forEach(fila => {
            total_precio += parseInt(fila.cells[1].getAttribute('data-precio'));
            detalle.push({
                'item': fila.cells[0].getAttribute('data-id'),
                'precio': parseInt(fila.cells[1].getAttribute('data-precio')),
            });
        });
        document.querySelector('#th_total').innerText = `$ ${total_precio.toLocaleString('de-DE')}`;
    };

    document.querySelector('#btn_guardar').addEventListener('click', () => {
        document.querySelector('input[name="detalle"]').value = JSON.stringify(detalle);
        document.querySelector('#form-venta-rapida').submit();
    });
});