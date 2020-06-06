<?php

    include('conexion.php');
    
    $id = $_POST['Id'];
    $tipo = $_POST['tipo'];
    $name = $_POST['nombre'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $descripcion = $_POST['descripcion'];
    $imagen = $_FILES['imagen'];


    $consultaImagen = "SELECT imagen FROM productos WHERE Idpro = $id";
    $resultadoImagen = mysqli_query($connection, $consultaImagen);
    $archivo = mysqli_fetch_array($resultadoImagen);
    $imagenAnterior = $archivo['imagen'];

    if(!$imagen['size'] == 0 &&  $imagen['error']==0){
        //echo 'otra imagen';
        if($imagen["type"] == "image/jpg" or $imagen["type"] == "image/jpeg" or $imagen["type"] == "image/png"){
            if (file_exists($imagenAnterior)) {
                $success = unlink($imagenAnterior);
                if ($success) {
                    //echo "Imagen Eliminada Exitosamente";
                } else {
                    echo "Cannot delete $imagenAnterior";
                }
            }
            $ruta = "img/" . md5($imagen["tmp_name"]) . ".jpg";
            move_uploaded_file($imagen["tmp_name"], $ruta);

            $consulta = "UPDATE productos SET tipo = '$tipo', nombrepro = '$name', precio = '$precio', stock = '$stock', descripcion = '$descripcion', imagen = '$ruta' WHERE Idpro = '$id'";

            $resultado = mysqli_query($connection, $consulta);

            if (!$resultado) {
                die('Consulta Fallida');
            }
            echo 'Producto Actualizado Correctamente';
        }
        else{
            echo "Por favor Suba una imagen";
        }
        
    }
    else{
        //echo 'misma imagen';
        $ruta=$imagenAnterior;

        $consulta = "UPDATE productos SET tipo = '$tipo', nombrepro = '$name', precio = '$precio', stock = '$stock', descripcion = '$descripcion', imagen = '$ruta' WHERE Idpro = '$id'";

        $resultado = mysqli_query($connection, $consulta);

        if (!$resultado) {
            die('Consulta Fallida');
        }
        echo 'Producto Actualizado Correctamente';
    }

?>