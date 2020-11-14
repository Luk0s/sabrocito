let detalle_simple = [], detalle_menu = [], detalle_cena = [];

document.addEventListener('DOMContentLoaded', () => {

    document.querySelector('#btn_normal').addEventListener('click', () =>{
        const tabla = document.querySelector('#tbl_venta_cocina_detalle_simple');
        const cmb_producto = document.querySelector('#cmb_plato_simple');
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

    document.querySelector('#btn_menu').addEventListener('click', () => {
        const tabla = document.querySelector('#tbl_venta_cocina_detalle_simple');
        const cmb_entrada = document.querySelector('#cmb_entrada');
        const cmb_fondo = document.querySelector('#cmb_fondo');
        if(cmb_fondo.value === 'fondo_0' && cmb_entrada.value === 'entrada_0'){
        } else {
            const precio = (cmb_fondo.value === 'fondo_0' || cmb_entrada.value === 'entrada_0')
                ? cmb_entrada.options[1].dataset.precio : cmb_fondo.options[1].dataset.precio;
            const tr = tabla.insertRow(tabla.rows.count);
            const td_producto = tr.insertCell(0);
            td_producto.innerText = `Menú ${(cmb_entrada.value === 'entrada_0') ? '' : cmb_entrada.options[cmb_entrada.selectedIndex].innerText} 
            ${(cmb_fondo.value === 'fondo_0') ? '' : cmb_fondo.options[cmb_fondo.selectedIndex].innerText}`;
            td_producto.setAttribute('data-id', `${(cmb_entrada.value === 'entrada_0') ? '' : cmb_entrada.options[cmb_entrada.selectedIndex].value}_${(cmb_fondo.value === 'fondo_0') ? '' : cmb_fondo.options[cmb_fondo.selectedIndex].value}`);

            const td_precio = tr.insertCell(1); td_precio.innerText = precio;
            td_precio.setAttribute('data-precio', precio);

            const btn = document.createElement('button'); btn.className = 'button is-danger'; btn.type = 'button'; btn.innerText = 'X';
            btn.addEventListener('click', function(){
                const tr = this.parentElement.parentElement.remove();
                calcular_total();
            });
            const td_btn = tr.insertCell(2); td_btn.append(btn);
            calcular_total();
        }
    });

    document.querySelector('#btn_extra').addEventListener('click', () =>{
        const tabla = document.querySelector('#tbl_venta_cocina_detalle_simple');
        const cmb_extra = document.querySelector('#cmb_extra');
        const cmb_agregado1 = document.querySelector('#cmb_agregado1');
        const cmb_agregado2 = document.querySelector('#cmb_agregado2');
        const precio = (cmb_agregado2.value === 'agregado2_0')
            ? cmb_extra.options[0].dataset.precio2 : cmb_extra.options[0].dataset.precio3;
        const tr = tabla.insertRow(tabla.rows.count);
        const td_producto = tr.insertCell(0);
        td_producto.innerText = `Cena ${cmb_extra.options[cmb_extra.selectedIndex].innerText} 
            ${cmb_agregado1.options[cmb_agregado1.selectedIndex].innerText} ${(cmb_agregado2.value === 'agregado2_0') ? '' : cmb_agregado2.options[cmb_agregado2.selectedIndex].innerText}`;
        td_producto.setAttribute('data-id', `${cmb_extra.options[cmb_extra.selectedIndex].value}_${cmb_agregado1.options[cmb_agregado1.selectedIndex].value}_${(cmb_agregado2.value === 'agregado2_0') ? '' : cmb_agregado2.options[cmb_agregado2.selectedIndex].value}`);

        const td_precio = tr.insertCell(1); td_precio.innerText = precio;
        td_precio.setAttribute('data-precio', precio);

        const btn = document.createElement('button'); btn.className = 'button is-danger'; btn.type = 'button'; btn.innerText = 'X';
        btn.addEventListener('click', function(){
            const tr = this.parentElement.parentElement.remove();
            calcular_total();
        });
        const td_btn = tr.insertCell(2); td_btn.append(btn);
        calcular_total();
    });

    const calcular_total = () => {
        detalle_simple = [];
        const tbl = document.querySelector('#tbl_venta_cocina_detalle_simple');
        let total_precio = 0;
        Array.from(tbl.rows).forEach(fila => {
            total_precio += parseInt(fila.cells[1].getAttribute('data-precio'));
            detalle_simple.push({
                'item': fila.cells[0].getAttribute('data-id'),
                'precio': parseInt(fila.cells[1].getAttribute('data-precio')),
            });
        });
        document.querySelector('#th_total').innerText = `$ ${total_precio.toLocaleString('de-DE')}`;
    };

    document.querySelector('#btn_guardar').addEventListener('click', () => {
        document.querySelector('input[name="detalle_simple"]').value = JSON.stringify(detalle_simple);
        document.querySelector('input[name="detalle_menu"]').value = JSON.stringify(detalle_menu);
        document.querySelector('input[name="detalle_cena"]').value = JSON.stringify(detalle_cena);
        document.querySelector('#form-venta-cocina').submit();
    });
});