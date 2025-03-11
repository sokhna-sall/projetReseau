<?php
// Activez l'affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inclure la connexion à la base de données
include '/var/www/html/projetRx/db.php';

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $entreprise = $_POST['entreprise'];
    $date_inscription = $_POST['date_inscription'];

    // Requête SQL pour ajouter un client
    $sql = "INSERT INTO clients (nom, prenom, email, telephone, entreprise, date_inscription) VALUES (:nom, :prenom, :email, :telephone, :entreprise, :date_inscription)";
    $stmt = $conn->prepare($sql);

    if ($stmt->execute([
        'nom' => $nom,
        'prenom' => $prenom,
        'email' => $email,
        'telephone' => $telephone,
        'entreprise' => $entreprise,
        'date_inscription' => $date_inscription
    ])) {
        echo "Client ajouté avec succès !";
        header('Location: liste_clients.php');
        exit();
    } else {
        echo "Erreur lors de l'ajout du client.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un client - ProjetRx</title>
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
                        <a class="nav-link" href="liste_clients.php">Clients</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../documents/liste_documents.php">Documents</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenu principal -->
    <div class="container mt-5">
        <h1 class="text-center mb-4">Ajouter un client</h1>
        <form action="ajouter_client.php" method="POST" class="card p-4">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="telephone" class="form-label">Téléphone</label>
                <input type="text" class="form-control" id="telephone" name="telephone" required>
            </div>
            <div class="mb-3">
                <label for="entreprise" class="form-label">Entreprise</label>
                <input type="text" class="form-control" id="entreprise" name="entreprise" required>
            </div>
            <div class="mb-3">
                <label for="date_inscription" class="form-label">Date d'inscription</label>
                <input type="date" class="form-control" id="date_inscription" name="date_inscription" required>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>