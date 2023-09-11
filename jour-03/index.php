<?php

require_once 'class/Student.php';
require_once 'class/Floor.php';
require_once 'class/Grade.php';
require_once 'class/Room.php';
require_once 'functions.php';

// Création de deux instances de la classe Student
$student1 = new Student(1, 1, "email@email.com", "Terry Cristinelli", new DateTime("1990-01-18"), "male");  // avec valeurs
$student2 = new Student();                                                                                  // sans valeur

echo $student1;
echo $student2;

// Création de deux instances de la classe Floor
$floor1 = new Floor(1, "Rez-de-chaussée", 0);
$floor2 = new Floor();

echo $floor1;
echo $floor2;

// Création de deux instances de la classe Grade
// Ici nous avons besoin de créer un objet DateTime supplémentaire pour initialiser le champ year de Grade.
$date = new DateTime("2023-01-09");
$grade1 = new Grade(1, 8, "Bachelor 1", $date);
$grade2 = new Grade();

echo $grade1;
echo $grade2;    
// fais buguer le reste, pas compris.. room ne s'affichait pas avec..

// Création de deux instances de la classe Room
$room1 = new Room(1, 1, "RDC Food and Drinks", 90);
$room2 = new Room();

echo $room1;
echo $room2;

// Test des fonctions 
require_once 'functions.php';

// Pour les étudiants
$student = findOneStudent(2);  // Recherchez l'étudiant avec l'ID 2.
if ($student) {
    echo $student;  // Utilise la méthode __toString() de la classe pour afficher l'objet.
} else {
    echo "Student not found.<br>";
}

// Pour les grades
$grade = findOneGrade(4);  // Recherchez le grade avec l'ID 4.
if ($grade) {
    echo $grade;
} else {
    echo "Grade not found.<br>";
}

// Pour les floors
$floor = findOneFloor(2);  // Recherchez l'étage avec l'ID 2.
if ($floor) {
    echo $floor;
} else {
    echo "Floor not found.<br>";
}

// Pour les salles (rooms)
$room = findOneRoom(3);  // Recherchez la salle avec l'ID 3.
if ($room) {
    echo $room;
} else {
    echo "Room not found.<br>";
}

// Pour Récupérer une promotion avec un ID spécifique (2 dans ce cas)
$grade = findOneGrade(2);

if ($grade) {
    echo "Students of Grade: " . $grade->getName() . "<br><br>";  // Afficher le nom de la promotion

    $students = $grade->getStudents(); // Récupérer tous les étudiants associés à cette promotion

    foreach ($students as $student) {
        echo $student; // Afficher chaque étudiant
    }
} else {
    echo "Grade not found.";
}

// Test de récupération des promotions liées à une salle spécifique
$specificRoom = findOneRoom(5);  // Trouver une salle spécifique

if ($specificRoom) {
    echo "Grades for Room: " . $specificRoom->getName() . "<br>";

    // Récupérer toutes les promotions associées à cette salle
    $gradesInRoom = $specificRoom->getGrades();

    foreach ($gradesInRoom as $grade) {
        echo $grade; // Afficher chaque promotion
    }
} else {
    echo "Room not found.<br>";
}

// Test de récupération des salles situées sur un étage spécifique
$specificFloor = findOneFloor(1);  // Trouver un étage spécifique

if ($specificFloor) {
    echo "Rooms on Floor: " . $specificFloor->getName() . "<br>";

    // Récupérer toutes les salles situées sur cet étage
    $roomsOnFloor = $specificFloor->getRooms();

    foreach ($roomsOnFloor as $room) {
        echo $room; // Afficher chaque salle
    }
} else {
    echo "Floor not found.<br>";
}


?>