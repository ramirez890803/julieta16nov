<?php
class Conexion {
    private $host = 'localhost';
    private $db = 'bdjulieta';
    private $user = 'root';
    private $password = '';
    private $charset = 'utf8mb4';
    private $pdo;

    public function conectar() {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";
            $this->pdo = new PDO($dsn, $this->user, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->pdo;
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
}
?>