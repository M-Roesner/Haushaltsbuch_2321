<section class="mainDiv divOutput">
    <h2>Monatsübersichten</h2>
    <?php
        $resultsYear = $crud->getYears();
        $counterYear = 1;
        foreach($resultsYear AS $resultYear){
            $year = $resultYear['year'];
            $resultTotalYear = $crud->sumTotalYear($year);
    ?>
    <div class="divGenarals divYear">
        <details <?php if($counterYear == 1){echo "open"; $counterYear++;} ?> class="deteilsYear">
            <summary title="Jahr <?= $year ?> ein-/ausklappen">
                <p class="headline year-headline">
                    <span class="span-year">Jahr <?= $year; ?></span>
                    <span class="bilanzYear <?php if($resultTotalYear>=0){echo "bilanzMonthPositive bilanzPositive";}else if($resultTotalYear<0){echo "bilanzMonthNegative bilanzNegative";} ?>"><?php echo number_format($resultTotalYear, 2, ',', '.') . " €"; ?></span>
                </p>
            </summary>
            <?php
                $resutsMonth = $crud->getMonthsOfYear($year);
                $counterMonth = 1;
                foreach($resutsMonth AS $resultMonth){
                    $monthNum = (int) $resultMonth['monthNum'];

                    /* Wandelt $monthNum in $month mit deutscher Sprache um */
                    switch ($monthNum) {
                        case 1: $month = "Januar"; break;
                        case 2: $month = "Februar"; break;
                        case 3: $month = "März"; break;
                        case 4: $month = "April"; break;
                        case 5: $month = "Mai"; break;
                        case 6: $month = "Juni"; break;
                        case 7: $month = "Juli"; break;
                        case 8: $month = "August"; break;
                        case 9: $month = "September"; break;
                        case 10: $month = "Oktober"; break;
                        case 11: $month = "November"; break;
                        case 12: $month = "Dozember"; break;
                    };
                    /* $month = $resultMonth['month']; */

                    $resultsEntriesMonth = $crud->getEntriesMonth($year, $monthNum);
                    $resultTotalMonth = $crud->sumTotalMonth($year, $monthNum);
                    
            ?>
            <div class="divGenarals divMonth">
                <details <?php if($counterMonth == 1){echo "open"; $counterMonth++;} ?> class="deteilsMonth">
                    <summary  title="Monat <?= $month . " " . substr($year, -2); ?> ein-/ausklappen">
                        <p class="headline month-headline">
                            <span class="span-month"><?php echo $month . " " . substr($year, -2); ?></span>
                            <span class="bilanzMonth <?php if($resultTotalMonth>=0){echo "bilanzMonthPositive bilanzPositive";}else if($resultTotalMonth<0){echo "bilanzMonthNegative bilanzNegative";} ?>"><?php echo number_format($resultTotalMonth, 2, ',', '.') . " €"; ?></span>
                        </p>
                    </summary>
                    <?php
                    foreach($resultsEntriesMonth as $resultEntryMonth){
                    ?>
                    <table class="tableMonth">
                        <tr class="tableMonthItem <?php if($resultEntryMonth["in_out"]==1){ echo "liAusgabe";}else { echo "liEinnahme";} ?>">

                            <td class="outputDate">
                                <?= $resultEntryMonth["date"]; ?>
                            </td>
                            <td class="outputSubCat">
                                <?php echo $resultEntryMonth["subCat"] . " (" . $resultEntryMonth["cat"] . ")"; ?>
                            </td>
                            <td class="outputInfo">
                                <?= $resultEntryMonth["extraInfo"]; ?>
                            </td>
                            <td class="outputPrice">
                                <?= number_format($resultEntryMonth["price"], 2, ',', '.') ?> €
                            </td>
                            <td class="outputClear">
                                <?php /* edit - wird erstellt, um es später mit $_GET in UPDATE zu verwenden */ ?>
                                <a href="index.php?edit=<?= $resultEntryMonth['id_bk']; ?>">
                                    <img class="imgEdit" src="public/img/edit_light_16px.png" alt="Eintrag bearbeiten" title="Eintrag bearbeiten">
                                </a>
                                <?php /* delete - wird in formprozess.php bearbeitet über $_GET */ ?>
                                <a href="index.php?delete=<?= $resultEntryMonth['id_bk']; ?>">
                                    <img class="imgBin" src="public/img/bin_light_16px.png" alt="Eintrag löschen" title="Eintrag löschen">
                                </a>
                            </td>
                        </tr>
                    </table>
                    <?php
                        }// endforeach resultsEntriesMonth
                    ?>
                </details>
            </div>
            <?php
                }// endforeach resultsMonth
            ?>
        </details>
    </div>
    <?php
        }// endforeach resultsYear
    ?>
</section>