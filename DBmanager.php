<?php

class DBmanager {
    private $host    = "localhost";
    private $usuario = "root";
    private $clave   = "";
    private $db      = "vuejs";
    private $con; 

    // Constructor con el método correcto
    public function __construct() {
        $this->con = new mysqli($this->host, $this->usuario, $this->clave, $this->db);

        if ($this->con->connect_error) {
            die("Error en la conexión: " . $this->con->connect_error);
        }

        $this->con->set_charset("utf8");
    }

    // Insert a la base de datos
    public function insert($table, $columns, $values) {
        $query = "INSERT INTO $table ($columns) VALUES ($values)";
        $result = $this->con->query($query) or die($this->con->error);
        return $result ? true : false;
    }


    // Delete a la base de datos
    public function del($table, $condicion) {
        $result = $this->con->query("DELETE FROM $table WHERE $condicion") or die($this->con->error);
        return $result ? true : false;
    }

    // Update a la base de datos
    public function update($table, $campos, $condicion) {
        $result = $this->con->query("UPDATE $table SET $campos WHERE $condicion") or die($this->con->error);
        return $result ? true : false;
    }

    // Buscar en la base de datos
    public function search($table, $condicion) {
        $result = $this->con->query("SELECT * FROM $table WHERE $condicion") or die($this->con->error);
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : false;
    }

    // Método para obtener la conexión (opcional)
    public function getConnection() {
        return $this->con;
    }
}

?>
