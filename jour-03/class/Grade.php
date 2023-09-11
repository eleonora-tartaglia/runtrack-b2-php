<!-- JOB 02 : Création de la class Grade -->

<?php

class Grade {
    private $id;
    private $room_id;
    private $name;
    private $year;

    public function __construct(?int $id = null, ?int $room_id = null, ?string $name = null, ?DateTime $year = null) {
        $this->id = $id;
        $this->room_id = $room_id;
        $this->name = $name;
        $this->year = $year;
    }

    public function __toString() {
        return "Grade ID: " . $this->id . "<br>" .
               "Room ID: " . $this->room_id . "<br>" .
               "Name: " . $this->name . "<br>" .
               "Year: " . ($this->year ? $this->year->format('Y-m-d') : 'N/A') . "<br>" .  // Gérer la valeur null ici
               "<br>";
    }

    // Getters
    public function getId(): ?int {
        return $this->id;
    }

    public function getRoomId(): ?int {
        return $this->room_id;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function getYear(): ?DateTime {
        return $this->year;
    }

    // Setters
    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setRoomId(int $room_id): void {
        $this->room_id = $room_id;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function setYear(DateTime $year): void {
        $this->year = $year;
    }  
    
    // Ajout de la méthode getStudents() pour récupérer tous les étudiants associés à une promotion spécifique.
    public function getStudents(): array {
        global $conn;  // Assurez-vous que votre connexion PDO est globale ou injectez-la d'une autre manière.

        $students = []; // Pour stocker les objets étudiants
        
        // Requête pour récupérer tous les étudiants associés à cette promotion
        $query = $conn->prepare("SELECT * FROM student WHERE grade_id = ?");
        $query->execute([$this->id]);

        // Récupération des résultats
        $results = $query->fetchAll(PDO::FETCH_ASSOC);

        // Convertir chaque résultat en une instance de la classe Student et l'ajouter au tableau
        foreach ($results as $row) {
            $birthdate = new DateTime($row['birthdate']);  // Convertir la chaîne de date en objet DateTime
            $students[] = new Student($row['id'], $row['grade_id'], $row['email'], $row['fullname'], $birthdate, $row['gender']);
        }

        return $students;
    }
}    

?>