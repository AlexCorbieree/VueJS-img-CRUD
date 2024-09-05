<?php

require "DBmanager.php";

try {
    // Crear una instancia de DBmanager
    $cnx = new DBmanager();
    
    // Verificar la conexión
    $conexion = $cnx->getConnection();
    
    if ($conexion) {
        echo "Conexión exitosa a la base de datos.<br>";
        
        // Consultar y obtener los datos de la tabla 'users'
        $query = "SELECT * FROM users";
        $result = $conexion->query($query);
        
        if ($result->num_rows > 0) {
            // Imprimir los datos de la tabla 'users'
            echo "<table border='1'>";
            echo "<tr><th>ID</th><th>Nombre</th><th>Email</th><th>Avatar</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["nombre"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                
                // Construir la URL del avatar
                $avatarUrl = "https://robohash.org/" . $row["avatar"];
                echo "<td><img src='" . $avatarUrl . $row["nombre"] . "' alt='Avatar' width='100'></td>";
                
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No hay datos en la tabla 'users'.";
        }
    } else {
        echo "Error al conectar a la base de datos.";
    }
} catch (Exception $e) {
    echo "Se produjo un error: " . $e->getMessage();
}

?>
