<?php
    require_once 'database.php';

    class Crud {
        private $conn;

        // Baut die Verbindung auf, speichert es in $db und überträgt diese in die $conn.
        public function __construct(){
            $database = new Database();
            $db = $database->dbConnection();
            $this->conn = $db;
        }

        // ANCHOR reine CRUD-Funktionen
        // einen neuen Datensatz hinzuzufügen
        public function creatEntry($id_cat, $extraInfo, $date, $price, $in_out){
            $sql = "INSERT INTO bookkeeping (id_cat, extraInfo, date, price, in_out) 
                    VALUES (:id_cat, :extraInfo, :date, :price, :in_out);";
            $stmt = $this->conn->prepare($sql);
            $result = $stmt->execute(array( ':id_cat' => $id_cat,
                                            ':extraInfo' => $extraInfo,
                                            ':date' => $date,
                                            ':price' => $price,
                                            ':in_out' => $in_out
            ));
            return $result; // prepare - gibt ein true/false zurück
        }

        // einen bestimmten Datensatz zu erhalten
        public function getEntry($id_bk){
            $sql = "SELECT *
                    FROM bookkeepingview
                    WHERE id_bk=:id_bk";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array(':id_bk' => $id_bk));
            $data = $stmt->fetch();
            return $data;
        }

        // den jeweiligen Datensatz zu ändern
        public function updateEntry($id_bk, $id_cat, $extraInfo, $date, $price, $in_out){
            $sql = "UPDATE bookkeeping
                    SET id_cat=:id_cat, extraInfo=:extraInfo, date=:date, price=:price, in_out=:in_out
                    WHERE id_bk=:id_bk";
            $stmt = $this->conn->prepare($sql);
            $result = $stmt->execute(array( ':id_cat' => $id_cat,
                                            ':extraInfo' => $extraInfo,
                                            ':date' => $date,
                                            ':price' => $price,
                                            ':in_out' => $in_out,
                                            ':id_bk' => $id_bk
            ));
            return $result;
        }

        // den jeweiligen Datensatz zu löschen
        public function deleteEntry($id_bk){
            $sql = "DELETE FROM bookkeeping
                    WHERE id_bk=:id_bk";
            $stmt = $this->conn->prepare($sql);
            $result = $stmt->execute(array(':id_bk' => $id_bk));
            return $result;
        }

        // ANCHOR Formular: input / edit
        public function getCats(){
            $sql = "SELECT DISTINCT cat
                    FROM category";
            $stmt = $this->conn->query($sql);
            $data = $stmt->fetchAll();
            return $data;
        }

        public function getSubCats($cat){
            /* $stmt = $this->conn->prepare("SELECT * 
                                        FROM `category` 
                                        WHERE cat=':cat';"
            );
            $stmt->execute(array(':cat' => $cat));
            $data = $stmt->fetchAll(); */
            $sql = "SELECT * 
                    FROM category 
                    WHERE cat = '$cat'";
            $stmt = $this->conn->query($sql);
            $data = $stmt->fetchAll();
            return $data;
        }

        // ANCHOR Monatsübersichten
        public function getYears(){
            $sql = "SELECT DISTINCT YEAR(date) AS year
                    FROM `bookkeepingview`
                    ORDER BY `year` DESC;";
            $stmt = $this->conn->query($sql);
            $data = $stmt->fetchAll();
            return $data;
        }
        
        public function getMonthsOfYear($year){
            $sql = "SELECT DISTINCT MONTH(date) AS monthNum, 
                        DATE_FORMAT(date, '%M') AS month 
                    FROM `bookkeepingview` 
                    WHERE year(date) = '$year'
                    ORDER BY `monthNum` DESC;";
            $stmt = $this->conn->query($sql);
            $data = $stmt->fetchAll();
            return $data;
        }

        public function getEntriesMonth($year, $monthNum){
            $sql = "SELECT id_bk, cat, subCat, extraInfo,
                        DATE_FORMAT(date, GET_FORMAT(date,'EUR')) AS date, price, in_out 
                    FROM bookkeepingview 
                    WHERE year(date) = '$year' AND MONTH(date) = '$monthNum'
                    ORDER BY date DESC;";
            $stmt = $this->conn->query($sql);
            $data = $stmt->fetchAll();
            return $data;
        }

        // ANCHOR Bilanzen
        // Gesammtbilanz
        public function sumIncome(){
            $sql = "SELECT sum(price) AS sumIncome 
                    FROM bookkeepingview
                    WHERE in_out = '0';";
            $stmt = $this->conn->query($sql);
            $data = $stmt->fetch();
            return $data;
        }

        public function sumOutgoing(){
            $sql = "SELECT sum(price) AS sumOutgoing 
                    FROM bookkeepingview
                    WHERE in_out = '1';";
            $stmt = $this->conn->query($sql);
            $data = $stmt->fetch();
            return $data;
        }

        // jeweilige Monatsbilanz erhalten
        public function sumTotalMonth($year, $monthNum){
            $sql = "SELECT sum(price) AS sumIncomeMonth 
                    FROM bookkeepingview
                    WHERE year(date) = '$year' 
                        AND MONTH(date) = '$monthNum' 
                        AND in_out = '0';";
            $stmt = $this->conn->query($sql);
            $dataIncomeMonth = $stmt->fetch();
            
            $sql = "SELECT sum(price) AS sumOutgoingMonth 
                    FROM bookkeepingview
                    WHERE year(date) = '$year' 
                        AND MONTH(date) = '$monthNum' 
                        AND in_out = '1';";
            $stmt = $this->conn->query($sql);
            $dataOutgoingMonth = $stmt->fetch();

            $data = ($dataIncomeMonth['sumIncomeMonth'] - $dataOutgoingMonth['sumOutgoingMonth']);
            return $data;
        }

        // jeweilige Jahresbilanz erhalten
        public function sumTotalYear($year){
            $sql = "SELECT sum(price) AS sumIncomeYear 
                    FROM bookkeepingview
                    WHERE year(date) = '$year' 
                        AND in_out = '0';";
            $stmt = $this->conn->query($sql);
            $dataIncomeYear = $stmt->fetch();
            
            $sql = "SELECT sum(price) AS sumOutgoingYear 
                    FROM bookkeepingview
                    WHERE year(date) = '$year' 
                        AND in_out = '1';";
            $stmt = $this->conn->query($sql);
            $dataOutgoingYear = $stmt->fetch();

            $data = ($dataIncomeYear['sumIncomeYear'] - $dataOutgoingYear['sumOutgoingYear']);
            return $data;
        }
    }
?>