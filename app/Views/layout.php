<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>
            <?= App::getInstance()->title; ?>
        </title> 
        
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=EB+Garamond|Libre+Baskerville|Open+Sans|Roboto" rel="stylesheet">
        <link rel="stylesheet" href="/writer/web/css/form-style.css" type="text/css">
        <link rel="stylesheet" href="/writer/web/css/layout-style.css" type="text/css">
        <link rel="stylesheet" href="/writer/web/css/index-style.css" type="text/css">
        <link rel="stylesheet" href="/writer/web/css/read-style.css" type="text/css">
        <link rel="stylesheet" href="/writer/web/font-awesome/css/font-awesome.min.css">
        
        <script src="/writer/web/js/tinymce/tinymce.min.js"></script>
    </head>
    
    <body>
        <div class="container-fluid">
            <header class="row">
                
                <div class="top-header-bloc">
                    <div class="top-header-links">
                        <span><a href="/writer/web/login">Connexion</a></span>
                        <span><a href="/writer/web/membre">Profil</a></span>
                    </div>
                </div>
                
                <div class="logo-bloc">
                    <img src="/writer/web/img/logo.png" alt="logo">
                </div>
                
                
                <nav class="navbar navbar-default menu-bar" role="navigation">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="logo navbar-brand" href="/writer/web/accueil">
                            <i class="fa fa-home" aria-hidden="true"></i>
                        </a>
                    </div>
                    
                    <div class="collapse navbar-collapse navbar-ex1-collapse">
                        <ul class="nav navbar-nav">
                            <li>
                                <a class="active" href="/writer/web/article/index/1">
                                    <i class="fa fa-book" aria-hidden="true"></i>
                                    Index des écrits
                                </a>
                            </li>
                            <li>
                                <a href="/writer/web/article/ajouter">
                                    <i class="fa fa-pencil-square-o " aria-hidden="true"></i>
                                    Écrire
                                </a>
                            </li>
                            <li>
                                <a href="/writer/web/admin/articles">
                                    <i class="fa fa-list-alt" aria-hidden="true"></i>
                                    Admin articles
                                </a>
                            </li>
                            <li>
                                <a href="/writer/web/admin/categories">
                                    <i class="fa fa-list" aria-hidden="true"></i>
                                    Admin categories
                                </a>
                            </li>
                            <li>
                                <a href="/writer/web/admin/commentaires">
                                    <i class="fa fa-comments" aria-hidden="true"></i>
                                    Admin commentaires
                                </a>
                            </li>
                            <li>
                                <a href="/writer/web/admin/users">
                                    <i class="fa fa-users" aria-hidden="true"></i>
                                    Admin utilisateurs
                                </a>
                            </li>
                        </ul>

                        
                    </div><!-- /.navbar-collapse -->
                </nav>
            </header>
            
            <section class="row content-bloc">
                <?= $content; ?>
            </section>  
                
            <footer class="row footer-bar">
                <div class="col-xs-4">
                    
                </div>
                <div class="col-xs-4 social-network-bloc">
                    <p>Retrouvez moi sur les réseaux sociaux</p>
                    <hr>
                    <a href="/writer/web/accueil">
                        <i class="fa fa-facebook-square fa-4x" aria-hidden="true"></i>
                    </a>
                    <a href="/writer/web/accueil">
                        <i class="fa fa-twitter-square fa-4x" aria-hidden="true"></i>
                    </a>
                    <a href="/writer/web/accueil">
                        <i class="fa fa-instagram fa-4x" aria-hidden="true"></i>
                    </a>
                </div>
                <div class="col-xs-4">
                    
                </div>
            </footer>
            <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="crossorigin="anonymous"></script>
            <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
            <script src="/writer/web/js/reading-script.js"></script>
    </body>
</html>