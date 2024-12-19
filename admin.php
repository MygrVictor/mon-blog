<?php
session_start();
require_once '/Applications/MAMP/htdocs/blog/dist/config.php';


if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = ($_POST['title']);
    $content = ($_POST['content']);

   
    $stmt = $bdd->prepare('INSERT INTO articles (title, content) VALUES (:title, :content)');
    $stmt->execute([
        'title' => $title,
        'content' => $content
    ]);
    header('Location: acceuil.php');
   
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création d'article</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Vicoblog</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            naviguer
          </button>
          <ul class="dropdown-menu dropdown-menu-dark">
            <li><a class="dropdown-item" href="admin.php">ajouter un article</a></li>
            <li><a class="dropdown-item" href="acceuil.php">Les articles</a></li>
            <li><a class="dropdown-item" href="logout.php">deconnexion</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="container d-flex justify-content-center"></div>
    <h1>Bienvenue sur votre espace administrateur</h1>
    <form action="admin.php" method="POST">
        <label for="title">Titre de l'article:</label>
        <input type="text" name="title" id="title" required>

        <label for="content">Contenu de l'article:</label>
        <textarea name="content" id="content" rows="4" required></textarea>

        <button type="submit">Créer l'article</button>
    </form>
    
    </div>
</body>
</html>