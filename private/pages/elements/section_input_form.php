<section class="inputForm">        
    <?php
        // wenn button EDIT gedrückt, soll Formularfeld anzeigen
        // 'edit' ist die übergebenen ID aus dem $_GET
        if(!isset($_GET['edit'])){
    ?>
        <div class="mainDiv divForm">
            <form name="formAdd" action="formprocess.php" method="post">
                <h2>Neue Einnahme / Ausgabe hinzufügen</h2>

                <div class="div-groups div-group-cat">
                    <div class="add-group-cat">
                        <label for="cat">Kategorie:</label>
                        <?php
                            $resultCats = $crud->getCats();
                        ?>
                        <select name="cat" id="cat" class="inputField" required="required">
                        <option value="" disabled selected hidden>Wähle Kategorie aus</option>
                            <?php
                                foreach($resultCats as $resultCat){
                                    $cat = $resultCat['cat'];
                            ?>
                            <option value="<?= $cat; ?>"><?= $cat; ?></option>
                            <?php
                                } // endforeach
                            ?>
                        </select>
                    </div>
                    
                    <div class="add-group-cat">
                        <label for="subCat">Unterkategorie:</label>
                        <select name="id_cat" id="subCat" class="inputField">
                        <option value="" disabled selected hidden><- Kategorie wählen!</option>
                        </select>
                    </div>

                    <div class="add-group-cat">
                        <label for="extraInfo" title="Eingabe Optional">Zusaztinfo (Optional):</label>
                        <input type="text" onfocus="this.select();" name="extraInfo" id="extraInfo" class="inputField" maxlength="50" placeholder="z.B. Unternehmen" title="z.B. Name vom Unternehmen oder Vewendungszweck">
                    </div>
                </div>

                <div class="div-groups div-group-date-price-type">
                    <div class="add-group-rest">
                        <label for="date">Datum:</label>
                        <input type="date" name="date" id="date" class="inputField" value="<?= date("Y-m-d");?>" title="Datum des Eintrags (Format: tt-mm-yyyy)" required="required">
                    </div>

                    <div class="add-group-rest">
                        <label for="price">Betrag:</label>
                        <input type="number" onfocus="this.select();" min="0.01" max="10000.00" step="0.01" name="price" id="price" class="inputField" placeholder="0" title="Betrag des Eintrags (max. zwei Nachkommastellen, kein €-Zeichen)" required="required">
                    </div>

                    <div class="add-group-rest-radio">
                        <span>
                            <input type="radio" id="einnahme" class="inputRadio" name="in_out" value="0" title="Typ des Eintrags">
                            <label for="einnahme" class="inputRadioLabelGreen" title="Typ des Eintrags">Einnahme</label>
                        </span>
                        <span>
                            <input type="radio" id="ausgabe" class="inputRadio" name="in_out" value="1" checked="checked" title="Typ des Eintrags">
                            <label for="ausgabe" class="inputRadioLabelRed" title="Typ des Eintrags">Ausgabe</label>
                        </span>
                    </div>
                </div>

                <div class="add-buttons">
                    <input class="btnForm" type="submit" name="submit" value="Hinzufügen">
                    <a href="index.php" class="btnForm">Neu</a>
                </div>
            </form>
        </div>

        <?php /* ANCHOR Update Section ---------- */ ?>
        <?php
            } else {
            $resultsFetchEdit = $crud->getEntry($_GET['edit']);
            $catFromEdit = $resultsFetchEdit['cat'];
            $subCatFromEdit = $resultsFetchEdit['subCat'];
        ?>
        <div class="mainDiv divForm">
            <form method="post" action="formprocess.php">
                <h2>Eintrag bearbeiten</h2>

                <?php /* Inputfelder werden vorausgefüllt - siehe z.B. value: Spaltenname kommt aus der Datenbank*/ ?>
                <div class="div-groups div-group-cat">
                    <div class="add-group-cat">
                        <label for="cat">Kategorie:</label>
                        <?php
                            $resultCats = $crud->getCats();
                        ?>
                        <select name="cat" id="cat" class="inputField" disabled="disabled" title="Auswahl beim bearbeiten nicht verfügbar!">
                            <?php
                                foreach($resultCats as $resultCat){
                                    $cat = $resultCat['cat'];
                            ?>
                            <option <?php if($cat == $resultsFetchEdit['cat']){echo "selected='selected'";} ?> value="<?= $cat; ?>"><?= $cat; ?></option>
                            <?php
                                } // endforeach
                            ?>
                        </select>
                    </div>

                    <div class="add-group-cat">
                        <label for="subCat">Unterkategorie:</label>
                        <?php
                            $resultSubCats = $crud->getSubCats($catFromEdit);
                        ?>
                        <select name="id_cat" id="subCat" class="inputField subCat">
                            <?php
                                foreach($resultSubCats as $resultSubCat){
                                    $subCat = $resultSubCat['subCat'];
                            ?>
                            <option <?php if($resultSubCat['subCat'] == $subCatFromEdit){echo "selected='selected'";} ?> value="<?= $resultSubCat['id_cat']; ?>"><?= $resultSubCat['subCat']; ?></option>
                            <?php
                                } // endforeach
                            ?>
                        </select>
                    </div>

                    <div class="add-group-cat divInfo">
                        <label for="extraInfo" title="Eingabe Optional">Zusaztinfo (Optional):</label>
                        <input type="text" onfocus="this.select();" name="extraInfo" id="extraInfo" value="<?= $resultsFetchEdit['extraInfo']; ?>" class="inputField" placeholder="z.B. Unternehmen" title="z.B. Name vom Unternehmen oder Vewendungszweck">
                    </div>
                </div>

                <div class="div-groups div-group-date-price-type">
                    <div class="add-group-rest">
                        <label for="date">Datum:</label>
                        <input type="date" name="date" id="date" value="<?= $resultsFetchEdit['date']; ?>" class="inputField" title="Datum des Eintrags (Format: tt-mm-yyyy)" required="required">
                    </div>

                    <div class="add-group-rest">
                        <label for="price">Betrag:</label>
                        <input type="number" onfocus="this.select();" min="0.01" max="10000.00" step="0.01" name="price" id="price" value="<?= $resultsFetchEdit['price']; ?>" class="inputField" placeholder="0" title="Betrag des Eintrags (max. zwei Nachkommastellen, kein €-Zeichen)" required="required">
                    </div>

                    <div class="add-group-rest-radio">
                        <span>
                            <input type="radio" id="einnahme" class="inputRadio" name="in_out" value="0" <?php if($resultsFetchEdit['in_out'] == 0){echo "checked='checked'";} ?> title="Typ des Eintrags">
                            <label for="einnahme" class="inputRadioLabelGreen" title="Typ des Eintrags">Einnahme</label>
                        </span>
                        <span>
                            <input type="radio" id="ausgabe" class="inputRadio" name="in_out" value="1" <?php if($resultsFetchEdit['in_out'] == 1){echo "checked='checked'";} ?> title="Typ des Eintrags">
                            <label for="ausgabe" class="inputRadioLabelRed" title="Typ des Eintrags">Ausgabe</label>
                        </span>
                    </div>
                </div>

                <?php /* ID Inputfelder wird versteckt, um zu Wissen was die ID ist
                        und welcher Datensatz bearbeitet wird, unwichtig für Benutzer. */ ?>
                <input type="hidden" name="id_bk" value="<?= $resultsFetchEdit['id_bk']; ?>">

                <div class="add-buttons">
                    <input class="btnForm" type="submit" name="update" value="Ändern">
                    <input class="btnForm" type="reset" name="reset" value="Zurücksetzen">
                    <a class="btnForm" href="index.php">Neu</a>
                </div>
            </form>
        </div>
    <?php
        }
    ?>
</section>