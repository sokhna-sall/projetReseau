<?php
// Activez l'affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inclure la connexion à la base de données
include '/var/www/html/projetRx/db.php';

// Récupérer tous les documents avec les informations de l'employé qui les a uploadés
$sql = "SELECT d.*, e.nom, e.prenom FROM documents d JOIN employes e ON d.upload_par = e.id";
$stmt = $conn->query($sql);
$documents = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des documents - ProjetRx</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="../../accueil.php">ProjetRx</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="../employes/liste_employes.php">Employés</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../clients/liste_clients.php">Clients</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="liste_documents.php">Documents</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenu principal -->
    <div class="container mt-5">
        <h1 class="text-center mb-4">Liste des documents</h1>
        <a href="upload.php" class="btn btn-primary mb-3">Uploader un document</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom du fichier</th>
                    <th>Type</th>
                    <th>Taille (octets)</th>
                    <th>Date d'upload</th>
                    <th>Uploadé par</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($documents as $document) : ?>
                    <tr>
                        <td><?php echo $document['id']; ?></td>
                        <td><?php echo $document['nom_fichier']; ?></td>
                        <td><?php echo $document['type_fichier']; ?></td>
                        <td><?php echo $document['taille_fichier']; ?></td>
                        <td><?php echo $document['date_upload']; ?></td>
                        <td><?php echo $document['nom'] . ' ' . $document['prenom']; ?></td>
                        <td>
                            <a href="supprimer_document.php?id=<?php echo $document['id']; ?>" class="btn btn-danger btn-sm">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>