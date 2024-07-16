<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../public/style.css">

</head>

<body>



    <header class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="../public/images/logo_innov8hubnobg2.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
                INNOV8HUB
            </a>
            <div><?=$bonjour?></div>
        </div>
        
    </header>



    <div class="container-fluid">
        <main>
            <?= $content ?>
        </main>
    </div>


    <footer class="text-center row">

        <div class="col-4">
            <ul>
                <li><a href="#">Contact</a></li>
                <li><a href="#">Mentions légales</a></li>
            </ul>
        </div>
        <div id="copyright" class="col-4">
            Copyright © 2023 | Innov8Hub
        </div>
        <div id="followfooter" class="col-4">
            <p>Suivez nos actualités</p>
            <p>

                <a href="#"><i class="bi bi-facebook"></i> </a>
                <a href="#"><i class="bi bi-instagram"></i></a>
            </p>
        </div>

    </footer>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>