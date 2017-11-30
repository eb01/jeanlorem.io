<?php $currentPage = $_SERVER['REQUEST_URI']; ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title><?= $title ?></title>
        <meta name="description" content=<?= '"' . $description . '"' ?> />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="author" content="Emmanuel Baracand" />
        <?php if($currentPage != "/" && $currentPage != "/story") : ?>
        <meta name="robots" content="noindex, nofollow" />
        <?php endif; ?>
        <?php if($currentPage == "/" || $currentPage == "/story") : ?>
        <meta property="og:site_name" content="Jean Lorem">
        <meta property="og:title" content=<?= '"' . $title . '"' ?> />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="https://jeanlorem.io/" />
        <meta property="og:image" content="https://jeanlorem.io/img/jeanlorem-logo.png" />
        <meta property="twitter:card" content="summary" />
        <meta property="twitter:site" content="@jeanlorem" />
        <meta property="twitter:title" content=<?= '"' . $title . '"' ?> />
        <meta property="twitter:description" content=<?= '"' . $description . '"' ?> />
        <meta property="twitter:image" content="https://jeanlorem.io/img/jeanlorem-logo.png" />
        <meta property="twitter:url" content="https://jeanlorem.io/" />
        <?php endif; ?>
        <link rel="icon" type="image/png" href="img/jeanlorem-favicon.png" />
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link href="https://fonts.googleapis.com/css?family=Anonymous+Pro:400,700" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:700" rel="stylesheet" />
        <link rel="stylesheet" href="css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="css/jssocials.css" />
        <link rel="stylesheet" type="text/css" href="css/jssocials-theme-flat.css" />
        <link rel="stylesheet" href="css/style.css" />
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
         <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <header>
            <nav class="navbar navbar-default" role="navigation">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
                            <span class="sr-only">Afficher le menu</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="/">Jean Lorem</a>
                    </div>
                    <div class="collapse navbar-collapse" id="navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li><a href="/">Générateur</a></li>
                            <li><a href="story">The story</a></li>
                            <?php if(isset($_SESSION['user_ID']) && isset($_SESSION['username'])) : ?>
                            <li class="dropdown">
                                <a href="admin" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="admin">Gestion des blagues</a></li>
                                    <li><a href="add-joke">Ajouter une blague</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="disconnect">Déconnexion <?= "(" . $_SESSION['username'] .")"  ?></a></li>
                                </ul>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
                <!-- /.container -->
            </nav>
            <div class="brand"><a href="/">Jean Lorem</a></div>
            <p><strong>Le générateur de langage fleuri</strong></p>
        </header>
        <main>
            <div class="container">
                <?php include $template.'.phtml' ?>
            </div>
        </main>
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <p>Copyright &copy; Jean Lorem <?= date("Y"); ?></p>
                    </div>
                </div>
            </div>
        </footer>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
        <script src="js/jssocials.min.js"></script>
        <script src="js/jquery-charactercounter.js"></script>
        <script src="js/bootstrap-confirmation.min.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>