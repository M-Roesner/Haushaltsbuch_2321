<?php
    session_start(); // ein kurzer Speicher,
    // für diese Sitzung wird eröffnet um Nachichten zu speichern und lesen

    require_once 'private/classes/crud.php';
    $crud = new Crud();

    if(isset($_POST['submit'])){
        if( isset($_POST['id_cat']) && !empty($_POST['id_cat']) &&
            isset($_POST['extraInfo']) /*&& !empty($_POST['extraInfo']) */ &&
            isset($_POST['date']) && !empty($_POST['date']) &&
            isset($_POST['price']) && !empty($_POST['price']) &&
            isset($_POST['in_out']) /* && !empty($_POST['in_out']) */
        ){
            $id_cat = $_POST['id_cat'];
            $extraInfo = $_POST['extraInfo'];
            $date = $_POST['date'];
            $price = $_POST['price'];
            $in_out = $_POST['in_out'];
        
            if($crud->creatEntry($id_cat, $extraInfo, $date, $price, $in_out)){
                $_SESSION['msg-class'] = "success"; // nur für den Style notwendig
                $_SESSION['msg'] = "Eintragen war erfolgreich!";
            }else{
                $_SESSION['msg-class'] = "danger";
                $_SESSION['msg'] = "Es ging etwas schief!";
            }
        }else{ // Hinfällig, da die jeweiligen input-Felder ein required="required" bekommen haben!
            if(empty($_POST['id_cat']) || empty($_POST['price'])){
                $err_var = "<br><b>Bitte";
                if(empty($_POST['id_cat'])){
                    $err_var = $err_var . " eine Kategorie auswählen";
                };
                if(empty($_POST['id_cat']) && empty($_POST['price'])){
                    $err_var = $err_var . " und";
                };
                if(empty($_POST['price'])){
                    $err_var = $err_var . " einen Betrag eingeben";
                };
                $err_var = $err_var . "!</b>";
            };
            $_SESSION['msg-class'] = "danger";
            $_SESSION['msg'] = "Eintragen abgebrochen: Daten unvollständig eingegeben $err_var";
        }
        header('location: index.php'); // springt zur index.php zurück
    }

    if(isset($_POST['update'])){
        if( isset($_POST['id_cat']) && !empty($_POST['id_cat']) &&
            isset($_POST['extraInfo']) /*&& !empty($_POST['extraInfo']) */ &&
            isset($_POST['date']) && !empty($_POST['date']) &&
            isset($_POST['price']) && !empty($_POST['price']) &&
            isset($_POST['in_out']) /* && !empty($_POST['in_out']) */ &&
            isset($_POST['id_bk']) && !empty($_POST['id_bk'])
        ){
            $id_cat = $_POST['id_cat'];
            $extraInfo = $_POST['extraInfo'];
            $date = $_POST['date'];
            $price = $_POST['price'];
            $in_out = $_POST['in_out'];
            $id_bk = $_POST['id_bk'];
        
            if($crud->updateEntry($id_bk, $id_cat, $extraInfo, $date, $price, $in_out)){
                $_SESSION['msg-class'] = "success";
                $_SESSION['msg'] = "Änderung war erfolgreich!";
            }else{
                $_SESSION['msg-class'] = "danger";
                $_SESSION['msg'] = "Es ging etwas schief!";
            }
        }else{
            $_SESSION['msg-class'] = "danger";
            $_SESSION['msg'] = "Änderung abgebrochen: Daten unvollständig eingegeben!";
        }
        header('location: index.php');
    }

    if(isset($_GET['delete'])){
        $id_bk = $_GET['delete'];
        
        if($crud->deleteEntry($id_bk)){
            $_SESSION['msg-class'] = "success";
            $_SESSION['msg'] = "Löschen war erfolgreich!";
        }else{
            $_SESSION['msg-class'] = "danger";
            $_SESSION['msg'] = "Es ging etwas schief!";
        }
        //header('location: index.php');
    }
?>