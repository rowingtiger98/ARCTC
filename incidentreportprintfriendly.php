<?php
    if (isset($_GET['IND_ID'])) {
        $statement = "ID is set";
    } else {
        $statement = "ID is not set";
    }




?>

<html>
    <head>
        <title>Printer Friendly Incident Report</title>
    </head>

    <body>
        <?php echo $statement; ?>
    </body>
</html>