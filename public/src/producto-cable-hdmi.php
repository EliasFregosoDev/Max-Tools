<?php
include "header.php";
?>
        <section class="hero">
            <div class="contenido-hero">
                <h2>CATÁLOGO</h2>
                <div class="ubicacion">
                    <p>
                        <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="88"
                                height="88"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="#FFFFFF"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                        >
                            <path d="M3 21l18 0" />
                            <path d="M3 7v1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1h-18l2 -4h14l2 4" />
                            <path d="M5 21l0 -10.15" />
                            <path d="M19 21l0 -10.15" />
                            <path d="M9 21v-4a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v4" />
                        </svg>
                        Guadalajara Jalisco
                    </p>
                </div>
                <a class="boton click-boton" href="https://wa.me/5215667757532">Contactar</a>
            </div>
        </section>

        <main class="contenedor sombra">
            <h1>Cable HDMI</h1>
            <div class="contenedor__arti">
                <img src="../static/resources/hdmi.png" alt="articulo" class="cable__imagen">
                <div class="producto__articulo">
                    <p>
                        Cable HMDI Reforzado, Apto Resoluciones FULL HD, 4K, y Hasta 8K.
                    </p>
                    <p>$199</p>
                    <form id="add-to-cart">
                        <select id="form-variant">
                            <option disabled selected>--Seleccionar Tamaño--</option>
                            <option>1 Metro</option>
                            <option>3 Metros</option>
                            <option>5 Metros</option>
                        </select>
                        <input id="form-quantity" type="number" placeholder="Cantidad" min="1">
                        <input type="submit" value="Agregar al carrito">
                        <input id="form-product" type="text" value="cable-HDMI" data-price="199" hidden="hidden">
                    </form>
                </div>
            </div>


        </main>

        <footer>
            <p>todos los derechos reservados. Elias Fregoso DEV</p>
        </footer>
    </body>
    <script src="../static/JS/recipt.js"></script>
</html>
