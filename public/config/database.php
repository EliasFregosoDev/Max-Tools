<?php
/**
 * Configuración de conexión a PostgreSQL
 * Usa la variable de entorno DATABASE_URL de Render
 */

function getDBConnection() {
    $database_url = getenv('DATABASE_URL');
    
    if (!$database_url) {
        throw new Exception("DATABASE_URL no configurada");
    }
    
    // Parse la URL de conexión
    $url = parse_url($database_url);
    
    $host = $url['host'] ?? 'localhost';
    $port = $url['port'] ?? 5432;
    $db = ltrim($url['path'] ?? '', '/');
    $user = $url['user'] ?? '';
    $pass = $url['pass'] ?? '';
    
    try {
        // Conectar a PostgreSQL con PDO
        $dsn = "pgsql:host=$host;port=$port;dbname=$db;sslmode=require";
        
        $pdo = new PDO(
            $dsn,
            $user,
            $pass,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]
        );
        
        return $pdo;
    } catch (PDOException $e) {
        throw new Exception("Error de conexión a la BD: " . $e->getMessage());
    }
}

// Probar la conexión
try {
    $test_conn = getDBConnection();
    // Opcional: Descomentar para debug
    // echo "Conexión exitosa a PostgreSQL";
} catch (Exception $e) {
    // error_log($e->getMessage());
}

?>