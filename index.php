<?php require_once './formprocess.php'; ?>
<?php include("./private/pages/elements/head.php"); ?>
<?php
    $subCatFromEdit = "";
?>
<body>
    <div class="site">
        <?php /* ANCHOR Header Section - Logo Titel Gesamtbilanz */
            include("./private/pages/elements/header.php");
        ?>

        <?php /* ANCHOR Massage Section */
            include("./private/pages/elements/section_msg.php");
        ?>

        <?php /* ANCHOR Input Section */
            include("./private/pages/elements/section_input_form.php");
        ?>

        <?php /* ANCHOR Year-Month-Overview Section */
            include("./private/pages/elements/section_overview.php");
        ?>

        <?php /* ANCHOR Footer */
            include("./private/pages/elements/footer.php");
        ?>
    </div>

    <script>
        var subCatFromEdit = '<?=$subCatFromEdit?>';
    </script>
    <script src="private/js/app.js"></script>
</body>
</html>