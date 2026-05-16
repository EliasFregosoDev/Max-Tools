<?php
/**
 * Script de importación automática de tablas SQL
 * Accede a: https://tu-sitio.onrender.com/import-db.php
 * Solo funciona la primera vez (verifica si las tablas ya existen)
 */

// Obtener conexión a la BD
try {
    $db_url = getenv('DATABASE_URL');
    
    if (!$db_url) {
        die("ERROR: DATABASE_URL no está configurada");
    }
    
    // Parse la URL de conexión
    $url = parse_url($db_url);
    $host = $url['host'];
    $user = $url['user'];
    $pass = $url['pass'];
    $db = ltrim($url['path'], '/');
    $port = $url['port'] ?? 5432;
    
    // Conectar a PostgreSQL
    $pdo = new PDO(
        "pgsql:host=$host;port=$port;dbname=$db",
        $user,
        $pass,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    
    echo "<h2>🚀 Importando tablas SQL...</h2>";
    
    // SQL para crear las tablas (convertido de MySQL a PostgreSQL)
    $sql_statements = [
        // Tabla: productos
        "CREATE TABLE IF NOT EXISTS productos (
            id SERIAL PRIMARY KEY,
            nombre varchar(50) NOT NULL,
            stock int NOT NULL,
            precio int NOT NULL,
            descripcion varchar(250) NOT NULL
        );",
        
        // Tabla: pedidos
        "CREATE TABLE IF NOT EXISTS pedidos (
            id SERIAL PRIMARY KEY,
            total int NOT NULL,
            direccion varchar(250) NOT NULL
        );",
        
        // Tabla: pedidos_detalles
        "CREATE TABLE IF NOT EXISTS pedidos_detalles (
            id SERIAL PRIMARY KEY,
            nombre varchar(50) NOT NULL,
            descripcion varchar(250) NOT NULL,
            precio int NOT NULL,
            id_pedidos int NOT NULL
        );",
        
        // Insertar datos en pedidos
        "DELETE FROM pedidos;
        INSERT INTO pedidos (id, total, direccion) VALUES
        (3, 120, 'jaja k'),
        (6, 11, 'asasdad'),
        (9, 950, 'enrique segoviano'),
        (10, 950, 'enrique segoviano'),
        (13, 120, 'pepepicas'),
        (14, 120, 'pepepicas'),
        (15, 120, 'pepepicas'),
        (16, 120, 'pepepicas'),
        (17, 24, 'holaaaa'),
        (18, 24, 'holaaaa'),
        (19, 49, 'Afuera de mi casa'),
        (20, 49, 'Afuera de mi casa'),
        (21, 49, 'Afuera de mi casa'),
        (22, 49, 'Afuera de mi casa'),
        (23, 1247, 'casa roja puerta color menta'),
        (24, 1247, 'casa roja puerta color menta'),
        (25, 1247, 'casa roja puerta color menta'),
        (26, 1247, 'casa roja puerta color menta'),
        (27, 867, 'Entrega en av aqui mero'),
        (28, 867, 'asdassdasd'),
        (29, 578, 'Entregar en Queretaro # 2892 Col. Las Flores'),
        (30, 4592, 'jaja'),
        (31, 4999, 'asd'),
        (32, 298, 'sadasdad') ON CONFLICT (id) DO NOTHING;
        SELECT setval('pedidos_id_seq', 33);",
        
        // Insertar datos en pedidos_detalles
        "DELETE FROM pedidos_detalles;
        INSERT INTO pedidos_detalles (id, nombre, descripcion, precio, id_pedidos) VALUES
        (1, 'Elias', 'cable largo bien chido', 140, 21),
        (2, 'Elias', 'cable largo bien chido', 140, 22) ON CONFLICT (id) DO NOTHING;
        SELECT setval('pedidos_detalles_id_seq', 3);"
    ];
    
    // Ejecutar cada statement
    foreach ($sql_statements as $sql) {
        try {
            $pdo->exec($sql);
            echo "<p style='color: green;'>✅ Ejecutado</p>";
        } catch (Exception $e) {
            echo "<p style='color: orange;'>⚠️ " . $e->getMessage() . "</p>";
        }
    }
    
    // Verificar tablas creadas
    echo "<h3>📊 Tablas en la BD:</h3>";
    $result = $pdo->query("
        SELECT table_name FROM information_schema.tables 
        WHERE table_schema = 'public'
    ");
    
    echo "<ul>";
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "<li>" . $row['table_name'] . "</li>";
    }
    echo "</ul>";
    
    echo "<h3 style='color: green;'>✨ ¡Importación completada!</h3>";
    echo "<p><a href='/'>← Volver al sitio</a></p>";
    
} catch (Exception $e) {
    echo "<h2 style='color: red;'>❌ Error de conexión:</h2>";
    echo "<p>" . $e->getMessage() . "</p>";
    echo "<p>Verifica que DATABASE_URL esté configurada en Render</p>";
}
?>