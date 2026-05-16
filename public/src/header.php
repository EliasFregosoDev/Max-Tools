<?php

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>MaxTools — Carrito</title>
        <link rel="preload" href="../static/css/normalize.css" as="style">
        <link rel="stylesheet" href="../static/css/normalize.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
        <link rel="preload" href="../static/css/style.css" as="style">
        <link rel="stylesheet" href="../static/css/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <header>
            <h1 class="titulo">MaxTools <span>Soluciones</span></h1>
        </header>

        <div class="nav-bg">
            <nav class="navegacion-principal contenedor">
                <a href="../index.php">Inicio</a>
                <a href="/src/catalogo.php">Catálogo</a>
                <a href="/src/carrito.php" id="cart-nav-link">
                    <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="23"
                    height="23"
                    viewBox="0 0 24 24"
                    fill="currentColor"
                    >
                    <path d="M6 2a1 1 0 0 1 .993 .883l.007 .117v1.068l13.071 .935a1 1 0 0 1 .929 1.024l-.01 .114l-1 7a1 1 0 0 1 -.877 .853l-.113 .006h-12v2h10a3 3 0 1 1 -2.995 3.176l-.005 -.176l.005 -.176c.017 -.288 .074 -.564 .166 -.824h-5.342a3 3 0 1 1 -5.824 1.176l-.005 -.176l.005 -.176a3.002 3.002 0 0 1 1.995 -2.654v-12.17h-1a1 1 0 0 1 -.993 -.883l-.007 -.117a1 1 0 0 1 .883 -.993l.117 -.007h2zm0 16a1 1 0 1 0 0 2a1 1 0 0 0 0 -2zm11 0a1 1 0 1 0 0 2a1 1 0 0 0 0 -2z" />
                    </svg>
<span id="cart-count">0</span></a>
            </nav>
        </div>