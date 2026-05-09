<?php
include "../config/database.php";
function consulta($pedido_id){
    $conn = getDBConnection();
// Start transaction for data consistency
        $conn->begin_transaction();
        
        $total = 0;
    try {
        

$balance_query = "SELECT 
   total
FROM pedidos
WHERE id= ?";
$stmt = $conn->prepare($balance_query);
$stmt->bind_param("i", $pedido_id);
$stmt->execute();
$stmt->bind_result($total);
$stmt->fetch();
$stmt->close();
    } catch (Exception $e){
        echo "Error: ".$e->getMessage();
    }
    echo $total;
}


function insertar_pedido($total,$direccion){
    $conn = getDBConnection();
// Start transaction for data consistency

    try{
        // Insert expense transaction
            $insert_query = "INSERT INTO pedidos
                             (total, direccion) 
                             VALUES (?, ?)";

            $stmt = $conn->prepare($insert_query);
            $stmt->bind_param("is",$total, $direccion);
            


            if (!$stmt->execute()) {
                throw new Exception("Error adding expense: " . $stmt->error);
            }
            $transaction_id = $conn->insert_id;



            $stmt->close();

    }
    catch(Exception $e){
        echo "Error: ".$e->getMessage();
    }
    return $transaction_id;
}
function insertar_pedido_detalles($nombre, $descripcion,$precio,$id_pedidos){
    $conn = getDBConnection();
// Start transaction for data consistency

    try{
        // Insert expense transaction
            $insert_query = "INSERT INTO pedidos_detalles
                             (nombre,descripcion,precio,id_pedidos) 
                             VALUES (?, ?,?,?)";

            $stmt = $conn->prepare($insert_query);
            $stmt->bind_param("ssii",$nombre, $descripcion,$precio,$id_pedidos);
            


            if (!$stmt->execute()) {
                throw new Exception("Error adding expense: " . $stmt->error);
            }  
            $transaction_id = $conn->insert_id;
            


            $stmt->close();

    }
    catch(Exception $e){
        echo "Error: ".$e->getMessage();
    }
}

function insertar_productos($nombre,$stock,$precio,$descripcion){
    $conn = getDBConnection();
    try{
        $insert_query = "INSERT INTO productos
                             (nombre,stock,precio,descripcion) 
                             VALUES (?, ?,?,?)";

            $stmt = $conn->prepare($insert_query);
            $stmt->bind_param("siis",$nombre, $stock,$precio,$descripcion);

        
        
        if (!$stmt->execute()) {
                throw new Exception("Error adding expense: " . $stmt->error);
            }
        $transaction_id = $conn->insert_id;
        echo $transaction_id;

            $stmt->close();
    }
    catch(Exception $e){
        echo "Error: ".$e->getMessage();
    }
}

$data_total = $_POST["data_total"];
$data_descripcion = $_POST["data_descripcion"];
$id_articulo = $_POST["id_articulo"];
$resultado = insertar_pedido($data_total,$data_descripcion);
// $resultado = "La venta es: total: " .$data_total ."La direccion es: ".$data_descripcion ."El ID de articulo es: ".$id_articulo; 
// $resultado = "a";
PRINT_R($resultado);


// Si tiene los datos del carrito, generar recibo completo
if(isset($_POST["data_cart"])) {
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
    
    // Guardar el recibo en sesión o devolverlo como JSON
    session_start();
    $_SESSION['ultimo_recibo'] = $recibo;
    $_SESSION['ultimo_pedido_id'] = $pedido_id;
    
    echo "|PEDIDO_ID:{$pedido_id}|";
}


?>