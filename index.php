
<?php ?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <!-- BOOTSTRAP CSS -->
        <link rel="stylesheet" href="./css/bootstrap.min.css"> 
        <!-- OTHERS CSS -->
        <link rel="stylesheet" href="./css/all.css"> 
        <link rel="stylesheet" href="./css/normalize.css"> 
        <link rel="stylesheet" href="./css/style.css">
        <link rel="stylesheet" href="./css/form.css">

        <!-- CSS MIN ONLINE SOURCE -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> 
        <!-- FONT-AWESOME REMOTE LIBRARY -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    </head>
    <body>
        <div class="container">
            <?php
//PHP code to include header code
            include_once './templates/header.php';
            ?>
            <main class="main">
                <?php
                include './frontController.php';
                ?>
            </main>
            <?php
            include_once './templates/footer.php';
            ?>
        </div>
        <!--End of the container-->
        <script type = "module" src = "/src/main.jsx"></script>
        <!--Bootstrap js files-->

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    </body>
</html>




