<?php
session_start();
require_once '/Applications/MAMP/htdocs/blog/dist/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = ($_POST['username']);
    $password = $_POST['password'];


    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([':username' => $username]);

    $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($utilisateur) {

        if (($password === $utilisateur['password'])) {

            $_SESSION['username'] = $utilisateur['username'];
            header('Location: admin.php');
            
        } else {

            echo "Nom d'utilisateur ou mot de passe incorrect.";
        }
    } else {

        echo "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>
<!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Log</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
 </head>

 <body>
 <div class="container-fluid bg-dark">
    
 <form action="login.php" method="POST">
  <div class="form-group">
    <label for="username">utilisateur</label>
    <input type="text" class="form-control" id="username" aria-describedby="emailHelp" name="username" placeholder="entrez votre nom d'utilisateur">
   
  </div>
  <div class="form-group">
    <label for="password">Mot de passe</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="entrez votre mot de passe ">
  </div>
  
  <button type="submit" class="btn btn-primary mx-auto" >Se connecter</button>
</form>

</div>
</body>
</html>

