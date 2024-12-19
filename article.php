<?php
require_once '/Applications/MAMP/htdocs/blog/dist/function.php';
require_once '/Applications/MAMP/htdocs/blog/dist/config.php';


if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int) $_GET['id']; 
} else {
    header('location: article.php');
}


$article = getArticle($bdd, $id);


$comments = getComments($bdd, $id); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $author = ($_POST['author']);
    $content = ($_POST['content']);
    $created_at = date('Y-m-d H:i:s'); 
    
   
    $stmt = $bdd->prepare('INSERT INTO comments (article_id, author, content, created_at) VALUES (:article_id, :author, :content, :created_at)');
    $stmt->execute([
        'article_id' => $id,
        'author' => $author,
        'content' => $content,
        'created_at' => $created_at,
    ]);
}  
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($article['title']) ?></title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Vicoblog </a>
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

<h1><?= htmlspecialchars($article['title']) ?></h1>
<p><?= htmlspecialchars($article['content']) ?></p>

<h2>Commentaires</h2>

<?php if (empty($comments)): ?>
    <p>Aucun commentaire pour cet article.</p>
<?php else: ?>
    <ul>
        <?php foreach ($comments as $comment): ?>
            <li>
                <strong><?= htmlspecialchars($comment['author']) ?></strong> 
                le <?= htmlspecialchars($comment['created_at']) ?>
                <p><?= nl2br(htmlspecialchars($comment['content'])) ?></p>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<h3>Laisser un commentaire</h3>
<form action="article.php?id=<?= $id ?>" method="POST">
    <label for="author">Nom :</label>
    <input type="text" name="author" id="author" required><br>

    <label for="content">Commentaire :</label><br>
    <textarea name="content" id="content" rows="4" required></textarea><br>

    <button type="submit">Publier le commentaire</button>
</form>

</body>
</html>
