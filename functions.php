<?php

function pdo_connect_mysql()
{

    $servername = "localhost";
    $username = "root";
    $password = "";
    try {
        $conn = new PDO("mysql:host=$servername;dbname=gamedb", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
function template_header($title)
{
    echo <<<EOT
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
        <title>$title</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.min.css" integrity="sha512-oc9+XSs1H243/FRN9Rw62Fn8EtxjEYWHXRvjS43YtueEewbS6ObfXcJNyohjHqVKFPoXXUxwc+q1K7Dee6vv9g==" crossorigin="anonymous" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-CuOF+2SnTUfTwSZjCXf01h7uYhfOBuxIhGKPbfEJ3+FqH/s6cIFN9bGr1HmAg4fQ" crossorigin="anonymous">
        <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/cover/">
        <link href="styles.css" rel="stylesheet" type="text/css">
        <link href="styles.css" rel="stylesheet" type="text/css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.min.js" integrity="sha512-8qmis31OQi6hIRgvkht0s6mCOittjMa9GMqtK9hes5iEQBQE/Ca6yGE5FsW36vyipGoWQswBj/QBm2JR086Rkw==" crossorigin="anonymous"></script>
        
	</head>
	<body>
    <nav class="navbar navbar-expand-lg">
  <a class="navbar-brand" href="index.php">GameCenter</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="list.php">All Games<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="list.php?platforms=playstation">Playtation</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="list.php?platforms=xbox">Xbox</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="list.php?platforms=pc">PC</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Genres
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="list.php?genre=platform">Platformer</a>
          <a class="dropdown-item" href="list.php?genre=adventure">Adventure</a>
          <a class="dropdown-item" href="list.php?genre=shooter">First Person Shooter</a>
          <a class="dropdown-item" href="list.php?genre=rpg">Role Playing Game (RPG)</a>
          <a class="dropdown-item" href="list.php?genre=simulator">Simulator</a>
          <a class="dropdown-item" href="list.php?genre=sport">Sport</a>
          <a class="dropdown-item" href="list.php?genre=indie">Indie</a>
        </div>
      </li>
    </ul>
  </div>
</nav>
EOT;
}
function template_footer()
{
    echo <<<EOT
    </body>
    <div class="footer">

      <a href="https://www.amazon.com"><image class ='logo text-center' src = '/senior-project1/images/amazon.png'/></a>

      <a href="https://www.gamespot.com"><image class = 'logo text-center' src = '/senior-project1/images/gamespot-logo.png'/></a>

		<a href="https://www.igdb.com"><image class = 'logo text-center' src = '/senior-project1/images/IGDB.png' /></a>
    
    </div>
</html>
EOT;
} 
