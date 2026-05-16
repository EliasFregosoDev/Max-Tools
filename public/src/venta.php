<?php
include "../config/database.php";

function consulta($pedido_id){
    $conn = getDBConnection();
    $total = 0;
    try {
        $balance_query = "SELECT total FROM pedidos WHERE id = :id";
        $stmt = $conn->prepare($balance_query);
        $stmt->bindParam(':id', $pedido_id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            $total = $row['total'];
        }
    } catch (Exception $e){
        echo "Error: ".$e->getMessage();
    }
    echo $total;
}

function insertar_pedido($total, $direccion){
    $conn = getDBConnection();
    
    try{
        // Para PostgreSQL con PDO, usamos RETURNING para obtener el ID
        $insert_query = "INSERT INTO pedidos (total, direccion) 
                         VALUES (:total, :direccion) 
                         RETURNING id";
        
        $stmt = $conn->prepare($insert_query);
        $stmt->bindParam(':total', $total, PDO::PARAM_INT);
        $stmt->bindParam(':direccion', $direccion, PDO::PARAM_STR);
        
        if (!$stmt->execute()) {
            throw new Exception("Error adding pedido");
        }
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $transaction_id = $row['id'];
        
    } catch(Exception $e){
        echo "Error: ".$e->getMessage();
        $transaction_id = null;
    }
    
    return $transaction_id;
}

function insertar_pedido_detalles($nombre, $descripcion, $precio, $id_pedidos){
    $conn = getDBConnection();
    
    try{
        $insert_query = "INSERT INTO pedidos_detalles (nombre, descripcion, precio, id_pedidos) 
                         VALUES (:nombre, :descripcion, :precio, :id_pedidos)";
        
        $stmt = $conn->prepare($insert_query);
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
        $stmt->bindParam(':precio', $precio, PDO::PARAM_INT);
        $stmt->bindParam(':id_pedidos', $id_pedidos, PDO::PARAM_INT);
        
        if (!$stmt->execute()) {
            throw new Exception("Error adding detalle");
        }
        
    } catch(Exception $e){
        echo "Error: ".$e->getMessage();
    }
}

function insertar_productos($nombre, $stock, $precio, $descripcion){
    $conn = getDBConnection();
    try{
        $insert_query = "INSERT INTO productos (nombre, stock, precio, descripcion) 
                         VALUES (:nombre, :stock, :precio, :descripcion) 
                         RETURNING id";
        
        $stmt = $conn->prepare($insert_query);
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':stock', $stock, PDO::PARAM_INT);
        $stmt->bindParam(':precio', $precio, PDO::PARAM_INT);
        $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
        
        if (!$stmt->execute()) {
            throw new Exception("Error adding producto");
        }
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $transaction_id = $row['id'];
        echo $transaction_id;
        
    } catch(Exception $e){
        echo "Error: ".$e->getMessage();
    }
}

// Obtener datos del POST
$data_total = $_POST["data_total"];
$data_descripcion = $_POST["data_descripcion"];
$id_articulo = $_POST["id_articulo"];

// Insertar el pedido
$resultado = insertar_pedido($data_total, $data_descripcion);

// Si tiene los datos del carrito, generar recibo completo
if(isset($_POST["data_cart"]) && $resultado) {
    $cart_items = json_decode($_POST["data_cart"], true);
    $pedido_id = $resultado; // El ID que devuelve insertar_pedido
    
    // Construir el recibo
    $recibo = " *RECIBO DE PEDIDO - MaxTools* \n";
    $recibo .= " *Número de pedido:* #" . $pedido_id . "\n";
    $recibo .= " *Fecha:* " . date('d/m/Y H:i') . "\n";
    $recibo .= "──────────────────────\n";
    
    $total = 0;
    foreach($cart_items as $item) {
        $qty = $item['quantity'];
        $precio = $item['price'];
        $subtotal = $qty * $precio;
        $total += $subtotal;
        $variant = isset($item['variant']) && $item['variant'] ? " ({$item['variant']})" : '';
        $recibo .= "▪ {$item['product']}{$variant}\n";
        $recibo .= "  Cantidad: {$qty} x \${$precio} = \${$subtotal}\n";
    }
    
    $recibo .= "──────────────────────\n";
    $recibo .= " *Total:* \${$total} MXN\n";
    $recibo .= " *Dirección:* " . $_POST["data_descripcion"] . "\n";
    $recibo .= "──────────────────────\n";
    $recibo .= " ¡Gracias por tu compra!\n";
    $recibo .= " Te contactaremos en breve.";
    
    // Guardar el recibo en sesión
    session_start();
    $_SESSION['ultimo_recibo'] = $recibo;
    $_SESSION['ultimo_pedido_id'] = $pedido_id;
    
    // Devolver el ID del pedido
    echo "|PEDIDO_ID:{$pedido_id}|";
} else if (!$resultado) {
    echo "|PEDIDO_ID:error|";
}

?>