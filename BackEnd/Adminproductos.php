<?php
/*
    session_start();

    //Verificamos si hay sesion de usuario
    if(isset($_SESSION['admin'])){
        echo 'Hola';
    }else{
        header('Location: registro.php');
    }
*/
include_once 'conexion.php';

if ($_POST) {
    $nombrepro = $_POST['nombre'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $descripcion = $_POST['descripcion'];
    $imagen = $_POST['imagen'];

    $sql_agregar = 'Insert Into productos(nombrepro,precio,stock,descripcion,imagen) values(?,?,?,?,?)';
    $sentencia_agregar = $pdo->prepare($sql_agregar);
    $sentencia_agregar->execute(array($nombrepro, $precio, $stock, $descripcion, $imagen));

    header('location: index.php');
}

if ($_GET) {
    $id = $_GET['id'];
    $sql_unico = 'Select * From Colores Where id=?';
    $gsent_unico = $pdo->prepare($sql_unico);
    $gsent_unico->execute(array($id));
    $resultado_unico = $gsent_unico->fetch();
}
