<?php
    class Database {
        private $host = null;
        private $db_name = null;
        private $username = null;
        private $password = null;
        public $conn;

        public function dbConnection() {
            $this->setupParams();
            $this->conn = null; 
            // sollte eine Verbindung bestehen,
            // wird diese auf NULL gesetzt und wird neu gemacht
        
            try {
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // wenn es Fehler gibt werden diese ausgegeben
            }catch(PDOException $exception){
                echo "Verbindung fehlgeschlagen: " . $exception->getMessage();
            }
                    return $this->conn;
        }

        /* Setzt die Parameter für die Verbindung dbConnection */
        private function setupParams() {
            $config = parse_ini_file("private/config/sql.inc.php");
            // liest das File aus und schreibt es in einem Array, 
            // Pfad ab index.php, nicht ab dieser Datei!!
        
            $this->host = $config['host'];
            $this->db_name = $config['db'];
            $this->username = $config['uid'];
            $this->password = $config['pwd'];
        }
    }
?>