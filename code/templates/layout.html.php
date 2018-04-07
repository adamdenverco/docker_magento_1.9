<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="utf-8">
        <title>Docker PHP MySQL Starter</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <style>
            @import url('https://fonts.googleapis.com/css?family=Roboto:400,400i,700,700i');
            body, * {
                font-family: 'Roboto', sans-serif;
                line-height: 1.5em;
            }
            header {
            }
            nav {
                background: #eee;
            }
            main {
                background: #fff;
                padding: 10px;
            }
            footer {
                background: #eee;
            }
            blockquote {
                display: table; width: 90%; margin-bottom: 1em; border-bottom: 1px solid #ccc; padding: 0.5em;
            }
            blockquote p {
                display: table-cell; width: 90%; vertical-align: top;
            }
            blockquote p em {
                color: #999; font-size: 0.9em;
            }
            blockquote form {
                display: table-cell; width: 10%; text-align: right;
            }
        </style>
        <link rel="stylesheet" href="jokes.css">
    </head>

    <body>

        <header class="container">
            <div class="row">
                <div class="col">
                    <h1>Docker PHP MySQL Starter</h1>
                </div>
            </div>
        </header>

        <nav class="container navbar navbar-default">
                <ul class="nav navbar-nav">
                    <li><a href="/">Home</a></li>
                    <li><a href="http://localhost:8080/" target="_blank">phpMyAdmin</a></li>
                </ul>
        </nav>

        <main class="container">
            <div class="row">
                <div class="col">
                    <?php if (isset($error)): ?>
                        <p>
                            <?=$error?>
                    <?php else: ?>
                        <?=$output?>
                    <?php endif; ?>
                </div>
            </div>
        </main>

        <footer class="container">
            <div class="row">
                <div class="col">
                    &copy; Docker PHP MySQL Starter <?=date('Y')?>
                </div>
            </div>
        </footer>
    </body>

</html>
