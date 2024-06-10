<header class="header">
            <a href="index.php">
                <img src="public/img/logo_notebook_150px.png" class="logo" alt="public/img/logo_notebook_150px.png" title="Notebook">
            </a>
            <h1>Haushaltsbuch</h1>
            <?php  /* ANCHOR Gesamtbilanz Section ---------- */ ?>
            <div class="mainDiv divBilanz">
                <h2>Gesamtbilanz</h2>
                <?php
                    $sumIncome = $crud->sumIncome();
                    $sumOutgoing = $crud->sumOutgoing();
                ?>
                <table>
                    <tr>
                        <td>
                            <p>Einnahmen:</p>
                        </td>
                        <td>
                            <p id="bilanzIncome" class="bilanzMoney">
                                <?= number_format($sumIncome["sumIncome"], 2, ',', '.') . " €"; ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Ausgaben:</p>
                        </td>
                        <td>
                            <p id="bilanzOutgoing" class="bilanzMoney">
                                <?= number_format($sumOutgoing["sumOutgoing"], 2, ',', '.') . " €"; ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p id="bilanzNameResult">Bilanz:</p>
                        </td>
                        <td>
                            <p id="bilanzResult" class="bilanzMoney">
                                <?= number_format($sumIncome['sumIncome'] - $sumOutgoing['sumOutgoing'], 2, ',', '.') . " €"; ?>
                            </p>
                        </td>
                    </tr>
                </table>
            </div>
        </header>