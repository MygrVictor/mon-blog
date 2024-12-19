<?php
require_once '/Applications/MAMP/htdocs/blog/dist/config.php';
function getArticles($bdd) {
    $stmt = $bdd->query('SELECT * FROM articles');
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
$id = ':id';
function getArticle($bdd, $id) {
    $stmt =$bdd->prepare('SELECT * FROM articles WHERE id = :id');
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getComments($bdd, $article_id) {
    
    $sql = "SELECT * FROM comments WHERE article_id = :article_id ORDER BY created_at DESC";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':article_id', $article_id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
