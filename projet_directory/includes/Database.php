<?php
$host = '127.0.0.1';
$dbname = 'cultivio';
$username = 'root';
$password = '';

// Créer une instance PDO pour la connexion à la base de données
try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>
