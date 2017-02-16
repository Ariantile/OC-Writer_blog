<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>
            <?= App::getInstance()->title; ?>
        </title> 
        
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="../web/css/form-style.css" type="text/css">
        <link rel="stylesheet" href="../web/css/layout-style.css" type="text/css">
    </head>
    
    <body>
        <div class="container-fluid">
            <header class="row">
                <nav class="navbar navbar-default menu-bar" role="navigation">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="logo navbar-brand" href="index.php?p=article-index">Writer</a>
                    </div>
                    
                    <div class="collapse navbar-collapse navbar-ex1-collapse">
                        <ul class="nav navbar-nav">
                            <li><a class="active" href="index.php?p=article-index">Liste des articles</a></li>
                            <li><a href="index.php?p=user-login">Login</a></li>
                            <li><a href="index.php?p=admin-article-index">Admin article</a></li>
                            <li><a href="index.php?p=admin-categorie-index">Admin categorie</a></li>
                        </ul>
                        <form class="navbar-form navbar-right" role="search">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Search">
                            </div>
                            <button type="submit" class="btn btn-default">Submit</button>
                        </form>
                    </div><!-- /.navbar-collapse -->
                </nav>
            </header>
            
            <section class="row">
                <?= $content; ?>
            </section>  
                
            <footer class="row footer-bar">
                <p>Footer</p>
            </footer>
            <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="crossorigin="anonymous"></script>
            <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
</html>