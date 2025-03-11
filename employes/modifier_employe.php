<?php
// Activez l'affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inclure la connexion à la base de données
include '/var/www/html/projetRx/db.php';

// Récupérer l'ID de l'employé à modifier
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM employes WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['id' => $id]);
    $employe = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Traitement du formulaire de mise à jour
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $poste = $_POST['poste'];
    $date_embauche = $_POST['date_embauche'];
    $salaire = $_POST['salaire'];

    // Requête SQL pour mettre à jour l'employé
    $sql = "UPDATE employes SET nom = :nom, prenom = :prenom, email = :email, poste = :poste, date_embauche = :date_embauche, salaire = :salaire WHERE id = :id";
    $stmt = $conn->prepare($sql);

    if ($stmt->execute([
        'nom' => $nom,
        'prenom' => $prenom,
        'email' => $email,
        'poste' => $poste,
        'date_embauche' => $date_embauche,
        'salaire' => $salaire,
        'id' => $id
    ])) {
        echo "Employé mis à jour avec succès !";
        header('Location: liste_employes.php');
        exit();
    } else {
        echo "Erreur lors de la mise à jour de l'employé.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un employé - ProjetRx</title>
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
        <h1 class="text-center mb-4">Modifier un employé</h1>
        <form action="modifier_employe.php" method="POST" class="card p-4">
            <input type="hidden" name="id" value="<?php echo $employe['id']; ?>">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $employe['nom']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo $employe['prenom']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $employe['email']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="poste" class="form-label">Poste</label>
                <input type="text" class="form-control" id="poste" name="poste" value="<?php echo $employe['poste']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="date_embauche" class="form-label">Date d'embauche</label>
                <input type="date" class="form-control" id="date_embauche" name="date_embauche" value="<?php echo $employe['date_embauche']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="salaire" class="form-label">Salaire</label>
                <input type="number" step="0.01" class="form-control" id="salaire" name="salaire" value="<?php echo $employe['salaire']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>