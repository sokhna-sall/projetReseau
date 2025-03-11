<?php
// Activez l'affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inclure la connexion à la base de données
include '/var/www/html/projetRx/db.php';

// Récupérer l'ID du client à supprimer
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Requête SQL pour supprimer le client
    $sql = "DELETE FROM clients WHERE id = :id";
    $stmt = $conn->prepare($sql);

    if ($stmt->execute(['id' => $id])) {
        echo "Client supprimé avec succès !";
        header('Location: liste_clients.php');
        exit();
    } else {
        echo "Erreur lors de la suppression du client.";
    }
}
?>