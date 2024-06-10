<div class="divMsg">
    <?php // Ausgabe der Session-Msg. Überprüft, ob eine Session vorhanden ist.
        if(isset($_SESSION['msg']) && isset($_SESSION['msg-class'])){
    ?>
        <div class="alert alert-<?= $_SESSION['msg-class']; ?>" role="alert">
            <?= $_SESSION['msg']; ?>
        </div>
    <?php // löscht vorhanden Nachrichten
            unset($_SESSION['msg']);
            unset($_SESSION['msg-class']);
        }               
    ?>
</div>