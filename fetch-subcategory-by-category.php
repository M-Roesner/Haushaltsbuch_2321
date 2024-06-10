<?php
    require_once 'private/classes/crud.php';
    $crud = new Crud();

    $cat = $_POST["cat"]; /* Variable kommt aus app.js */
    $datas = $crud->getSubCats($cat);
?>
<?php
    foreach($datas as $data){
?>    
    <option value="<?= $data["id_cat"];?>"><?= $data["subCat"];?></option>
<?php
    }
?>