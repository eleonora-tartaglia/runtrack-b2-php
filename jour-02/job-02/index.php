<!-- Fonction find_one_student() qui devra retourner un tableau avec toutes les colonnes d’une ligne 
    de la table student en fonction d’un email. -->

<?php

// Informations de connexion à la base de données
$host = "localhost";
$dbname = "lp_official";
$user = "hayley";
$pass = "monarque";
$charset = "utf8mb4";

$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

// Fonction pour trouver un étudiant en fonction de l'email
function find_one_student($email) {
    global $dsn, $user, $pass, $options;

    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
        
        // Utiliser une requête préparée pour protéger contre les injections SQL
        $stmt = $pdo->prepare("SELECT * FROM student WHERE email = ?");
        $stmt->execute([$email]);
        
        // Retourner le résultat sous forme de tableau associatif
        return $stmt->fetch();
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
}

$student = null;

// Vérifier si le formulaire a été soumis et si l'email est défini
if (isset($_GET['input-email-student'])) {
    $student = find_one_student($_GET['input-email-student']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Student</title>
</head>
<body>

<!-- Formulaire pour chercher un étudiant par email -->
<form action="" method="get">
    <input type="text" name="input-email-student" placeholder="Enter student's email">
    <button type="submit">Search</button>
</form>

<!-- Afficher les informations de l'étudiant si trouvé -->
<?php if ($student): ?>
<table border="1">
    <tr>
        <th>ID</th>
        <td><?= $student['id'] ?></td>
    </tr>
    <tr>
        <th>Grade ID</th>
        <td><?= $student['grade_id'] ?></td>
    </tr>
    <tr>
        <th>Email</th>
        <td><?= $student['email'] ?></td>
    </tr>
    <tr>
        <th>Full Name</th>
        <td><?= $student['fullname'] ?></td>
    </tr>
    <tr>
        <th>Birth Date</th>
        <td><?= $student['birthdate'] ?></td>
    </tr>
    <tr>
        <th>Gender</th>
        <td><?= $student['gender'] ?></td>
    </tr>
</table>
<?php elseif (isset($_GET['input-email-student'])): ?>
<p>No student found with this email.</p>
<?php endif; ?>

</body>
</html>