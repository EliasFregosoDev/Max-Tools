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
            <h2 class="catalogo-titulo">Catálogo de Productos</h2>
            <p class="catalogo-subtitulo">Precios de Nuestros Productos</p>

            <div class="catalogo-grid">


                <div class="producto-card">
                    <a href="producto-cable-hdmi.php" class="producto-links">
                        <img
                                src="../static/resources/hdmi.png"
                                alt="Cable HDMI"
                        >
                        <div class="producto-info">
                            <h3 class="producto-nombre">Cable HDMI</h3>
                            <p class="producto-descripcion">Soporta  resoluciones 4K y 8K.<br> 3 Metros.<br>Taza de Refresco de Hasta 144 Hz. </p>
                            <p class="producto-precio">Desde $199 MXN</p>
                        </div>
                    </a>
                </div> <!-- producto 1 -->


                <div class="producto-card">
                    <a href="producto-control.php" class="producto-links">
                        <img
                                src="../static/resources/control.png"
                                alt="Control Remoto"
                        >
                        <div class="producto-info">
                            <h3 class="producto-nombre">Control Remoto Universal</h3>
                            <p class="producto-descripcion">Control Remoto Universal. <br> Facil de Configurar.<br> Resistente y Duradero.</p>
                            <p class="producto-precio">Desde $289 MXN</p>
                        </div>
                    </a>
                </div> <!-- producto 2 -->


                <div class="producto-card">
                    <a href="producto-alimentacion.php" class="producto-links">
                        <img
                                src="../static/resources/cable.png"
                                alt="Cable de Alimentacion"
                        >
                        <div class="producto-info">
                            <h3 class="producto-nombre">Cable de Alimentación 120V</h3>
                            <p class="producto-descripcion">Cable de Alimentación Estándar C13 Con Conexión a Tierra. <br> Perfecto para Monitores y Computadoras. <br> Diseño Robusto y Duradero</p>
                            <p class="producto-precio">Desde $149 MXN</p>
                        </div>
                    </a>
                </div> <!-- producto 3 -->


                <div class="producto-card">
                    <a href="producto-soporte.php" class="producto-links">
                        <img
                                src="../static/resources/soporte.png"
                                alt="Soporte para television"
                        >
                        <div class="producto-info">
                            <h3 class="producto-nombre">Soporte para Televisión</h3>
                            <p class="producto-descripcion">Brazo de Movimiento Para Ajustar el Ángulo de Visión. <br>Estructura de Acero Reforzado, Soporta Pantallas de Gran Tamaño. <br>Sistema de Gestón de Cables Para Mantener Todo Ordenado.</p>
                            <p class="producto-precio">Desde $549 MXN</p>
                        </div>
                    </a>
                </div> <!-- producto 4 -->


                <div class="producto-card">
                    <a href="producto-camaras.php" class="producto-links">
                        <img
                                src="../static/resources/camaras.png"
                                alt="Kit de Cámaras"
                        >
                        <div class="producto-info">
                            <h3 class="producto-nombre">Kit de 6 Cámaras</h3>
                            <p class="producto-descripcion">Resolución FULL HD Con Visión Nocturna Clara Para Viiglancia 24/7.<br>Para Uso en Interiores o Exteriores. <br>Sistema Autoinstalable con Grabación Continua y Acceso Desde el Celular.</p>
                            <p class="producto-precio">Desde $4999 MXN</p>
                        </div>
                    </a>
                </div> <!-- producto 5 -->


                <div class="producto-card">
                    <a href="producto-no-brake.php" class="producto-links">
                        <img
                                src="../static/resources/nobrake.png"
                                alt="No Brake"
                        >
                        <div class="producto-info">
                            <h3 class="producto-nombre">No-Brake</h3>
                            <p class="producto-descripcion">Protege Contra Picos de Voltaje y Apagones Repentinos de Forma Automática.<br>Batería de Respaldo para mantener tus cámaras o PC Funcionando Sin Luz.<br>Pantalla LCD Frontal Para Monitorear El Nivel De Carga y Voltaje en Tiempo Real. </p>
                            <p class="producto-precio">Desde $1399 MXN</p>
                        </div>
                    </a>
                </div> <!-- Producto 6 -->

            </div>
        </main>

        <footer>
            <p>todos los derechos reservados. Elias Fregoso DEV</p>
        </footer>
    </body>
    <script src="../static/JS/recipt.js"></script>
</html>
