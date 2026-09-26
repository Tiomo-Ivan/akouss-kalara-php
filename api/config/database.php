<?php
// =============================================================================
// RÔLE DE CE FICHIER : établit la connexion à la base de données MySQL via
// PDO (PHP Data Objects). Tous les autres fichiers PHP incluent celui-ci
// pour obtenir l'objet $pdo utilisé pour interroger la base.
// =============================================================================

// Identifiants de connexion — adaptez si votre configuration XAMPP diffère
// (par défaut sous XAMPP : utilisateur "root", mot de passe vide "")
define('DB_HOTE', 'localhost');
define('DB_NOM', 'akouss_kalara');
define('DB_UTILISATEUR', 'root');
define('DB_MOT_DE_PASSE', '');

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOTE . ";dbname=" . DB_NOM . ";charset=utf8mb4",
        DB_UTILISATEUR,
        DB_MOT_DE_PASSE,
        [
            // Fait en sorte que les erreurs SQL lèvent des exceptions PHP
            // plutôt que d'échouer silencieusement — essentiel pour déboguer vite.
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            // Retourne les résultats sous forme de tableaux associatifs (clé = nom de colonne)
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
} catch (PDOException $e) {
    http_response_code(500);
    header('Content-Type: application/json');
    echo json_encode(['erreur' => 'Connexion à la base de données impossible.']);
    exit;
}
