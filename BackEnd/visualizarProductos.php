<?php

    include_once('conexion.php');

    $consulta = "SELECT * from productos";
    $resultado = mysqli_query($connection, $consulta);

    if(!$resultado){
        die('Fallo Consulta' . mysqli_error($connection));
    }

    $json = array();
    while($fila = mysqli_fetch_array($resultado)){
        $json[] = array(
            'Id' => $fila['Idpro'],
            'tipo' => $fila['tipo'],
            'nombre' => $fila['nombrepro'],
            'precio' => $fila['precio'],
            'stock' => $fila['stock'],
            'descripcion' => $fila['descripcion'],
            'imagen' => $fila['imagen']
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;

?>