<?php

    include('conexion.php');

    if(isset($_POST['id'])){
        $id = $_POST['id'];
    }

    $consultaImagen = "SELECT imagen FROM productos WHERE Idpro = $id";
    $resultadoImagen = mysqli_query($connection, $consultaImagen);
    $archivo = mysqli_fetch_array($resultadoImagen);
    $imagen = $archivo['imagen'];

    if (file_exists($imagen)) {
        $success = unlink($imagen);
     if ($success) {
        $consulta = "DELETE FROM productos WHERE Idpro = $id";
        $resultado = mysqli_query($connection, $consulta);
        echo "Producto Eliminado Exitosamente";

        if (!$resultado) {
            die('Consulta Fallida2');
        }
        
     } else{
        echo "Cannot delete $imagen";
     }
        
    }

    if (!$resultadoImagen) {
        die('Consulta Fallida3');
    }
        
    
    
    
    