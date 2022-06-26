<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lista notatek</title>
  </head>
  <body>
    <header class="header">
      <h1>Moje notatki</h1>
      <nav class="nav">
        <ul>
          <li><a href="/">Lista notatek</a></li>
          <li><a href="/?action=create">Nowa notatka</a></li>
        </ul>
      </nav>
    </header>
    <main class="main">
     <?php
        include_once("./templates/pages/{$page}.php");
     ?>

    </main>
    <footer class="footer">
      <p>Stopka</p>
    </footer>
  </body>
</html>
