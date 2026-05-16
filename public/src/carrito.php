<?php
include "header.php";
?>

        <main class="contenedor sombra" style="margin-top:2rem;">
            <h2>Tu Carrito</h2>

            <div id="carrito-vacio" style="text-align:center; padding:2rem; display:none;">
                <p>Tu carrito está vacío.</p>
                <a href="catalogo.php" class="boton" style="display:inline-block; margin-top:1rem;">Ver Catálogo</a>
            </div>

            <div id="carrito-contenido">
                <table id="cart-table" style="width:100%; border-collapse:collapse; margin-top:1rem;">
                    <thead>
                        <tr style="border-bottom:2px solid #fff;">
                            <th style="text-align:left; padding:.8rem;">Producto</th>
                            <th style="padding:.8rem;">Variante</th>
                            <th style="padding:.8rem;">Cant.</th>
                            <th style="padding:.8rem;">Precio unit.</th>
                            <th style="padding:.8rem;">Subtotal</th>
                            <th style="padding:.8rem;"></th>
                        </tr>
                    </thead>
                    <tbody id="cart-body"></tbody>
                    <tfoot>
                        <tr style="border-top:2px solid #fff;">
                            <td colspan="4" style="text-align:right; padding:.8rem; font-weight:bold;">TOTAL:</td>
                            <td id="cart-total" style="padding:.8rem; font-weight:bold; text-align:center;">$0 MXN</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>

                <div style="margin-top:2rem;">
                    <label style="font-weight:bold; display:block; margin-bottom:.5rem;">Dirección de entrega</label>
                    <textarea
                            id="delivery-address"
                            placeholder="Calle, número, colonia, ciudad, código postal..."
                            style="width:100%; padding:1rem; border-radius:.5rem; border:none; font-family:Kanit,sans-serif; font-size:1.4rem; min-height:8rem; resize:vertical;"
                    ></textarea>
                </div>

                <div style="display:flex; gap:1rem; margin-top:1.5rem; flex-wrap:wrap;">
                    <button id="btn-comprar" class="boton" style="flex:1;">
                        Comprar por WhatsApp
                    </button>
                    <button id="btn-vaciar" class="boton"
                            style="flex:0; background:#c0392b; padding:1rem 2rem; font-size:1.4rem;">
                        Vaciar carrito
                    </button>
                </div>
            </div>
        </main>

        <footer>
            <p>todos los derechos reservados. Elias Fregoso DEV</p>
        </footer>

        <script src="../static/JS/jquery.js"></script>

        <script>
            const WHATSAPP_NUMBER = '5215667757532';

            function getCart() {
                try {
                    return JSON.parse(localStorage.getItem('cart')) || [];
                } catch {
                    return [];
                }
            }

            function saveCart(cart) {
                localStorage.setItem('cart', JSON.stringify(cart));
            }

            function getNextOrderId() {
                const current = parseInt(localStorage.getItem('orderCounter') || '0', 10);
                const next = current + 1;
                localStorage.setItem('orderCounter', next);
                return String(next).padStart(4, '0');
            }

            function renderCart() {
                const cart = getCart();
                const tbody = document.getElementById('cart-body');
                const totalEl = document.getElementById('cart-total');
                const countEl = document.getElementById('cart-count');
                const contenido = document.getElementById('carrito-contenido');
                const vacio = document.getElementById('carrito-vacio');

                if (cart.length === 0) {
                    contenido.style.display = 'none';
                    vacio.style.display = 'block';
                    if (countEl) countEl.textContent = '0';
                    return;
                }

                contenido.style.display = 'block';
                vacio.style.display = 'none';

                let totalCount = 0;
                let totalPrice = 0;
                tbody.innerHTML = '';

                cart.forEach((item, index) => {
                    const qty = Number(item.quantity) || 1;
                    const price = Number(item.price) || 0;
                    const sub = qty * price;
                    totalCount += qty;
                    totalPrice += sub;

                    const tr = document.createElement('tr');
                    tr.style.borderBottom = '1px solid rgba(255,255,255,0.2)';
                    tr.innerHTML = `
                    <td style="padding:.8rem;">${item.product}</td>
                    <td style="padding:.8rem; text-align:center;">${item.variant || '—'}</td>
                    <td style="padding:.8rem; text-align:center;">${qty}</td>
                    <td style="padding:.8rem; text-align:center;">$${price} MXN</td>
                    <td style="padding:.8rem; text-align:center;">$${sub} MXN</td>
                    <td style="padding:.8rem; text-align:center;">
                        <button data-index="${index}" class="btn-remove"
                            style="background:#c0392b;color:#fff;border:none;border-radius:.3rem;padding:.3rem .7rem;cursor:pointer;font-size:1.2rem;">
                            ✕
                        </button>
                    </td>`;
                    tbody.appendChild(tr);
                });

                totalEl.textContent = `$${totalPrice} MXN`;
                if (countEl) countEl.textContent = totalCount;
                document.querySelectorAll('.btn-remove').forEach(btn => {
                    btn.addEventListener('click', () => {
                        const i = parseInt(btn.dataset.index, 10);
                        const c = getCart();
                        c.splice(i, 1);
                        saveCart(c);
                        renderCart();
                    });
                });
            }


            document.getElementById('btn-vaciar').addEventListener('click', () => {
                if (confirm('¿Vaciar el carrito?')) {
                    saveCart([]);
                    renderCart();
                }
            });


            document.getElementById('btn-comprar').addEventListener('click', () => {
                const cart = getCart();
                if (cart.length === 0) {
                    alert('Tu carrito está vacío.');
                    return;
                }

                const address = document.getElementById('delivery-address').value.trim();
                if (!address) {
                    alert('Por favor ingresa tu dirección de entrega.');
                    document.getElementById('delivery-address').focus();
                    return;
                }

                const orderId = getNextOrderId();

                let lines = '';
                let total = 0;
                cart.forEach(item => {
                    const qty = Number(item.quantity) || 1;
                    const price = Number(item.price) || 0;
                    const sub = qty * price;
                    total += sub;
                    const variant = item.variant ? ` (${item.variant})` : '';
                    lines += `▪ ${item.product}${variant} x${qty} = $${sub} MXN\n`;
                });

        $.ajax({
            type: "POST",
            url: "/src/venta.php",
            data: {
                data_total: total, 
                data_descripcion: address, 
                id_articulo: 1,
                data_cart: JSON.stringify(cart)
            },
    success: function(res){
        // Extraer el ID del pedido de la respuesta
        let match = res.match(/PEDIDO_ID:(\d+)/);
        let pedido_id = match ? match[1] : 'desconocido';
        
        // Generar el mensaje de WhatsApp
        let lines = '';
        let total = 0;
        cart.forEach(item => {
            const qty = Number(item.quantity) || 1;
            const price = Number(item.price) || 0;
            const sub = qty * price;
            total += sub;
            const variant = item.variant ? ` (${item.variant})` : '';
            lines += `▪ ${item.product}${variant} x${qty} = $${sub} MXN\n`;
        });
        
        const msg = `*RECIBO DE PEDIDO - MaxTools* \n *Número de pedido:* #${pedido_id}\n *Fecha:* ${new Date().toLocaleString()}\n──────────────────────\n${lines}──────────────────────\n *Total: $${total} MXN*\n *Dirección de entrega:*\n${address}\n──────────────────────\n *Pedido registrado exitosamente*\n¡Gracias por tu compra! `;
        
        const url = `https://wa.me/${WHATSAPP_NUMBER}?text=${encodeURIComponent(msg)}`;
        
        // Alert primero
        alert(`¡Pedido #${pedido_id} registrado! Serás redirigido a WhatsApp.`);
        
        // Redirección con delay
        setTimeout(() => {
            window.open(url, '_blank');
            saveCart([]);
            renderCart();
        }, 1000);
    }
});

            });


            renderCart();
        </script>
    </body>
</html>