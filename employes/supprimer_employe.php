<?php
// Activez l'affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inclure la connexion à la base de données
include '/var/www/html/projetRx/db.php';

// Récupérer l'ID de l'employé à supprimer
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Requête SQL pour supprimer l'employé
    $sql = "DELETE FROM employes WHERE id = :id";
    $stmt = $conn->prepare($sql);

    if ($stmt->execute(['id' => $id])) {
        echo "Employé supprimé avec succès !";
        header('Location: liste_employes.php');
        exit();
    } else {
        echo "Erreur lors de la suppression de l'employé.";
    }
}
?>