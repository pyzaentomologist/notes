<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lista notatek</title>
    <link rel="stylesheet" href="../public/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
  </head>
  <body>
    <div class="wrapper">
    <header class="header">
      <h1><span class="far fa-clipboard"></span> Moje notatki</h1>
    </header>
    <div class="container">

      <nav class="nav">
        <ul>
          <li><a href="/">Strona główna</a></li>
          <li><a href="/?action=create">Nowa notatka</a></li>
        </ul>
      </nav>
      <main class="main">
        <?php require_once("templates/pages/$page.php"); ?>
      </main>

    </div>
    <footer class="footer">
      <p>Stopka - projekt notatnika</p>
    </footer>
    </div>
  </body>
</html>
