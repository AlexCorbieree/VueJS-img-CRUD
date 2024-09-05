<?php

require "DBmanager.php";
$cnx = new DBmanager();
$response['success'] = false;

if(isset($_REQUEST["opc"])){
    // list, create, update, delete

    $opc = $_REQUEST["opc"];
    switch($opc) {
        case 'list':
            $res = $cnx->search("users", "1");
            if ($res) {
                $response['success'] = true;
                $response['users']   = $res;
            }
            break;
        case 'create':
            $name        = $_POST['name'];
            $email       = $_POST['email'];
            $image       = $_FILES['image']['name']; 
            $target_dir  = "img/"; 
            $target_file = $target_dir . basename($image); 

            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                $data = "'$name', '$email', '$target_file'";
                $columns = "nombre, email, image";

            
                $res = $cnx->insert("users", $columns, $data);
                if ($res) {
                    $response['success'] = true;
                }
            } else {
                $response['success'] = false;
                $response['message'] = "Error al subir la imagen.";
            }
            break;
        case 'update':
            ///
            $response['success'] = true;
            break;
        case 'delete':
            ///
            $response['success'] = true;
            break;

    }

}

$cnx = null;
die(json_encode($response));







?>
