<!DOCTYPE html>
<html lang="en">
<head>
    <title>spiritix Guestbook</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="public/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="public/css/application.css" rel="stylesheet" media="all">

    <!--[if lt IE 9]>
    <script src="public/assets/js/html5shiv.js"></script>
    <script src="public/assets/js/respond.min.js"></script>
    <![endif]-->

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="public/js/bootstrap.min.js"></script>
    <script src="public/js/application.js"></script>
</head>
<body>
    <div id="wrapper" class="container">
        <header class="page-header">
            <h1>Welcome to our famous guestbook!</h1>
        </header>
        <nav role="navigation" class="clearfix">
            <ul class="nav nav-pills">
                <li class="active">
                    <a href="?controller=Book&method=overview">
                        <span class="glyphicon glyphicon-align-center"></span> Overview
                    </a>
                </li>
                <li>
                    <a href="?controller=Book&method=add">
                        <span class="glyphicon glyphicon-plus-sign"></span> Add entry
                    </a>
                </li>
            </ul>
        </nav>
        <article class="jumbotron clearfix">
            <?php echo $this->mvc; ?>
        </article>
        <footer class="well well-sm text-center">
            <small>Created 2013 by Matthias Isler</small>
        </footer>
    </div>
</body>
</html>