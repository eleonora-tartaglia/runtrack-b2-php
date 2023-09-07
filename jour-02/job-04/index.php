<!-- Fonction find_all_students_grades() qui devra récupérer les emails, nom complets et nom de promotions des étudiants 
    sous forme de tableau associatif avec la forme [“email” => ..., “fullname” => ..., “grade_name” => ...]. -->

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

// Fonction pour récupérer les étudiants avec leurs promotions
function find_all_students_grades() {
    global $dsn, $user, $pass, $options;

    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
        
        // Requête JOIN pour récupérer les informations des étudiants et leurs promotions
        $stmt = $pdo->prepare("SELECT student.email, student.fullname, grade.name AS grade_name FROM student JOIN grade ON student.grade_id = grade.id");
        $stmt->execute();
        
        return $stmt->fetchAll();
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
}

$students = find_all_students_grades();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students & Grades</title>
</head>
<body>

<table border="1">
    <thead>
        <tr>
            <th>Email</th>
            <th>Full Name</th>
            <th>Grade Name</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($students as $student): ?>
        <tr>
            <td><?= $student['email'] ?></td>
            <td><?= $student['fullname'] ?></td>
            <td><?= $student['grade_name'] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>