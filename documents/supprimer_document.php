<?php
// Activez l'affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inclure la connexion à la base de données
include '/var/www/html/projetRx/db.php';

// Récupérer l'ID du document à supprimer
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Requête SQL pour supprimer le document
    $sql = "DELETE FROM documents WHERE id = :id";
    $stmt = $conn->prepare($sql);

    if ($stmt->execute(['id' => $id])) {
        echo "Document supprimé avec succès !";
        header('Location: liste_documents.php');
        exit();
    } else {
        echo "Erreur lors de la suppression du document.";
    }
}
?>