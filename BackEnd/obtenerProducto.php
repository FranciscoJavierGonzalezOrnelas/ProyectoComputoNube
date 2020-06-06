<?php
    include('conexion.php');
    $id = $_POST['id'];
    $consulta = "SELECT * from productos WHERE Idpro = $id";
    $resultado = mysqli_query($connection, $consulta);

    if(!$resultado){
        die('Fallo Consulta' . mysqli_error($connection));
    }

    $json = array();
    while($fila = mysqli_fetch_array($resultado)){
        $json[] = array(
            'id' => $fila['Idpro'],
            'tipo' => $fila['tipo'],
            'nombre' => $fila['nombrepro'],
            'precio' => $fila['precio'],
            'stock' => $fila['stock'],
            'descripcion' => $fila['descripcion'],  
            'imagen' => $fila['imagen']
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
