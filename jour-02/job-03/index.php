<!-- Fonction insert_student() qui devra insérer un nouvel étudiant en base de donnée.-->

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

// Fonction pour insérer un nouvel étudiant dans la base de données
function insert_student($email, $fullname, $gender, $birthdate, $grade_id) {
    global $dsn, $user, $pass, $options;

    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
        
        // Utiliser une requête préparée pour protéger contre les injections SQL
        $stmt = $pdo->prepare("INSERT INTO student (email, fullname, gender, birthdate, grade_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$email, $fullname, $gender, $birthdate, $grade_id]);
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
}

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    insert_student($_POST['input-email'], $_POST['input-fullname'], $_POST['input-gender'], $_POST['input-birthdate'], $_POST['input-grade_id']);
    $message = "Student inserted successfully!";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Student</title>
</head>
<body>

<!-- Afficher un message de succès si l'étudiant est inséré -->
<?php if (isset($message)): ?>
<p><?= $message ?></p>
<?php endif; ?>

<!-- Formulaire pour insérer un nouvel étudiant -->
<form action="" method="post">
    <label for="input-email">Email:</label>
    <input type="email" name="input-email" required>

    <label for="input-fullname">Full Name:</label>
    <input type="text" name="input-fullname" required>

    <label for="input-gender">Gender:</label>
    <select name="input-gender">
        <option value="male">Male</option>
        <option value="female">Female</option>
    </select>

    <label for="input-birthdate">Birth Date:</label>
    <input type="date" name="input-birthdate" required>

    <label for="input-grade_id">Grade ID:</label>
    <input type="number" name="input-grade_id" required>

    <button type="submit">Insert</button>
</form>

</body>
</html>