
<?php
//Start session
session_start();
//Create Usuario object by taking values from $_SESSION['user'] or null if this variables does not exist
$user = ($_SESSION['user']) ? $_SESSION['user'] : null;
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="./css/styles.css"/>
        <link rel="stylesheet" href="./css/form.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Vite + React</title>
    </head>
    <body>
        <main class="main">
            <?php
            include './frontController.php';
            ?>
        </main>
        <script type = "module" src = "/src/main.jsx"></script>
    </body>
</html>




