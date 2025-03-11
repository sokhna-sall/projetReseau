<?php
// Activez l'affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inclure la connexion à la base de données
include '/var/www/html/projetRx/db.php';

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $poste = $_POST['poste'];
    $date_embauche = $_POST['date_embauche'];
    $salaire = $_POST['salaire'];

    // Afficher les données pour vérification (débogage)
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    // Préparer et exécuter la requête SQL
    $sql = "INSERT INTO employes (nom, prenom, email, poste, date_embauche, salaire) VALUES (:nom, :prenom, :email, :poste, :date_embauche, :salaire)";
    $stmt = $conn->prepare($sql);

    // Exécuter la requête
    if ($stmt->execute([
        'nom' => $nom,
        'prenom' => $prenom,
        'email' => $email,
        'poste' => $poste,
        'date_embauche' => $date_embauche,
        'salaire' => $salaire
    ])) {
        echo "Employé ajouté avec succès !";
        // Rediriger vers la liste des employés après l'insertion
        header('Location: liste_employes.php');
        exit(); // Arrêter l'exécution du script après la redirection
    } else {
        echo "Erreur lors de l'ajout de l'employé.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un employé - ProjetRx</title>
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
                        <a class="nav-link" href="liste_employes.php">Employés</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../clients/liste_clients.php">Clients</a>
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
        <h1 class="text-center mb-4">Ajouter un employé</h1>
        <form action="ajouter_employe.php" method="POST" class="card p-4">
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
                <label for="poste" class="form-label">Poste</label>
                <input type="text" class="form-control" id="poste" name="poste" required>
            </div>
            <div class="mb-3">
                <label for="date_embauche" class="form-label">Date d'embauche</label>
                <input type="date" class="form-control" id="date_embauche" name="date_embauche" required>
            </div>
            <div class="mb-3">
                <label for="salaire" class="form-label">Salaire</label>
                <input type="number" step="0.01" class="form-control" id="salaire" name="salaire" required>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>