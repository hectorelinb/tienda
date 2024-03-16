<?php
session_start();

// Verificar si el producto está en el carrito
if(isset($_POST['producto_id']) && isset($_POST['cantidad'])) {
    $producto_id = $_POST['producto_id'];
    $cantidad = intval($_POST['cantidad']);

    // Verificar si existe el carrito en la sesión
    if(isset($_SESSION['carrito'])) {
        $carrito = $_SESSION['carrito'];

        // Verificar si el producto ya está en el carrito
        if(array_key_exists($producto_id, $carrito)) {
            // Actualizar la cantidad del producto en el carrito
            $carrito[$producto_id]['cantidad'] += $cantidad;
        } else {
            // Agregar el producto al carrito
            $carrito[$producto_id] = array(
                'producto_id' => $producto_id,
                'cantidad' => $cantidad
            );
        }
    } else {
        // Si no existe el carrito, crear uno nuevo
        $carrito = array(
            $producto_id => array(
                'producto_id' => $producto_id,
                'cantidad' => $cantidad
            )
        );
    }

    // Guardar el carrito actualizado en la sesión
    $_SESSION['carrito'] = $carrito;
}

// Redireccionar de vuelta a la página de detalles del producto
header('Location: detalles_producto.php?id=' . $producto_id);
?>
