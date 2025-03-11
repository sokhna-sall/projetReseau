<?php
// Activez l'affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inclure la connexion à la base de données
include '/var/www/html/smarttech/db.php';

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom_fichier = $_POST['nom_fichier'];
    $upload_par = $_POST['upload_par'];
    $fichier = $_FILES['fichier'];

    // Vérifiez si le fichier a été uploadé sans erreur
    if ($fichier['error'] == 0) {
        $type_fichier = $fichier['type'];
        $taille_fichier = $fichier['size'];
        $chemin_temporaire = $fichier['tmp_name'];

        // Chemin de destination pour le fichier uploadé
        $chemin_destination = '/var/www/html/smarttech/documents/uploads/' . basename($fichier['name']);

        // Déplacez le fichier vers le dossier de destination
        if (move_uploaded_file($chemin_temporaire, $chemin_destination)) {
            // Requête SQL pour insérer le document dans la base de données
            $sql = "INSERT INTO documents (nom_fichier, type_fichier, taille_fichier, date_upload, upload_par) VALUES (:nom_fichier, :type_fichier, :taille_fichier, NOW(), :upload_par)";
            $stmt = $conn->prepare($sql);

            if ($stmt->execute([
                'nom_fichier' => $nom_fichier,
                'type_fichier' => $type_fichier,
                'taille_fichier' => $taille_fichier,
                'upload_par' => $upload_par
            ])) {
                echo "Document uploadé avec succès !";
                header('Location: list.php');
                exit();
            } else {
                echo "Erreur lors de l'insertion du document dans la base de données.";
            }
        } else {
            echo "Erreur lors du déplacement du fichier.";
        }
    } else {
        echo "Erreur lors de l'upload du fichier.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uploader un document - Smarttech</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/var/www/html/smarttech/index.php">Smarttech</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="../employes/read.php">Employés</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../clients/read.php">Clients</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="list.php">Documents</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenu principal -->
    <div class="container mt-5">
        <h1 class="text-center mb-4">Uploader un document</h1>
        <form action="upload.php" method="POST" enctype="multipart/form-data" class="card p-4">
            <div class="mb-3">
                <label for="nom_fichier" class="form-label">Nom du fichier</label>
                <input type="text" class="form-control" id="nom_fichier" name="nom_fichier" required>
            </div>
            <div class="mb-3">
                <label for="fichier" class="form-label">Fichier</label>
                <input type="file" class="form-control" id="fichier" name="fichier" required>
            </div>
            <div class="mb-3">
                <label for="upload_par" class="form-label">Uploadé par (ID employé)</label>
                <input type="number" class="form-control" id="upload_par" name="upload_par" required>
            </div>
            <button type="submit" class="btn btn-primary">Uploader</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
