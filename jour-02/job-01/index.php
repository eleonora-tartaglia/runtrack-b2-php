<!-- Fonction find_all_students() qui devra retourner un tableau avec toutes les lignes et toutes les colonnes 
    de la table student sous forme de tableau associatif. -->

<?php

// Définir les informations de connexion à la base de données
$host = "localhost";
$dbname = "lp_official";
$user = "hayley";
$pass = "monarque";
$charset = "utf8mb4";

// Définir la chaîne de connexion PDO (Data Source Name)
$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

// Définir les options PDO pour gérer les erreurs et le mode de récupération
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,      // Activer le mode d'erreur
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,            // Récupérer les résultats sous forme de tableau associatif
    PDO::ATTR_EMULATE_PREPARES   => false,                       // Utiliser des requêtes préparées réelles
];

// Fonction pour récupérer tous les étudiants de la table student
function find_all_students() {
    global $dsn, $user, $pass, $options; // Rendre disponibles les variables globales

    try {
        // Créer une nouvelle connexion PDO
        $pdo = new PDO($dsn, $user, $pass, $options);
        
        // Exécuter la requête SQL
        $stmt = $pdo->query("SELECT * FROM student");
        
        // Récupérer tous les résultats sous forme de tableau associatif
        return $stmt->fetchAll();
    } catch (\PDOException $e) {
        // Si une exception est levée, la propager
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
}

// Appeler la fonction pour obtenir tous les étudiants
$students = find_all_students();

?>

<!-- Structure de base HTML -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students List</title>
</head>
<body>
    <!-- Créer un tableau pour afficher les étudiants -->
    <table border="1">
        <thead>
            <!-- En-têtes du tableau -->
            <tr>
                <th>ID</th>
                <th>Grade ID</th>
                <th>Email</th>
                <th>Full Name</th>
                <th>Birth Date</th>
                <th>Gender</th>
            </tr>
        </thead>
        <tbody>
            <!-- Utiliser une boucle foreach pour parcourir chaque étudiant -->
            <?php foreach ($students as $student): ?>
            <tr>
                <!-- Afficher les détails de l'étudiant dans le tableau -->
                <td><?= $student['id'] ?></td>
                <td><?= $student['grade_id'] ?></td>
                <td><?= $student['email'] ?></td>
                <td><?= $student['fullname'] ?></td>
                <td><?= $student['birthdate'] ?></td>
                <td><?= $student['gender'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
