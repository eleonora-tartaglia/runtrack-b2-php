<!-- La programmation orientée objet (POO) est un concept puissant qui permet de structurer et d'organiser le code de 
    manière modulaire et réutilisable. 
    
    Notions clés de la POO:

        Classe: C'est comme un plan ou un modèle pour créer des objets (instances). 
        Une classe encapsule les données pour l'objet et les méthodes pour manipuler ces données.
        Propriétés (ou attributs): Ce sont les données ou les variables définies dans la classe.
        Méthodes: Ce sont les fonctions définies dans une classe.
        Instance: Un objet individuel créé à partir d'une classe. -->

<!-- JOB 01 - Création de la class Student -->

<?php

class Student {
    // Déclaration des attributs de la classe (également appelés propriétés)
    private $id;
    private $grade_id;
    private $email;
    private $fullname;
    private $birthdate;
    private $gender;
    
    // Le constructeur est une méthode spéciale qui est appelée lorsque l'on crée une nouvelle instance d'une classe
    // Ici  le constructeur a été formaté pour créer des étudiants avec ou sans détails initiaux.
    public function __construct(?int $id = null, ?int $grade_id = null, ?string $email = null, ?string $fullname = null, ?DateTime $birthdate = null, ?string $gender = null) {
        $this->id = $id;
        $this->grade_id = $grade_id;
        $this->email = $email;
        $this->fullname = $fullname;
        $this->birthdate = $birthdate;
        $this->gender = $gender;
    }

    // La méthode __toString() permet d'afficher les détails de chaque instance de l'objet lorsque 
    // vous utilisez echo ou print.
    public function __toString() {
        return "Student ID: " . $this->id . "<br>" .
               "Grade ID: " . $this->grade_id . "<br>" .
               "Email: " . $this->email . "<br>" .
               "Full Name: " . $this->fullname . "<br>" .
               "Birthdate: " . ($this->birthdate ? $this->birthdate->format('Y-m-d') : 'N/A') . "<br>" .
               "Gender: " . $this->gender . "<br>" .
               "<br>";
    }

// La condition ternaire (? :) vérifie si $this->birthdate existe et, si c'est le cas, 
// elle le formate en chaîne de caractères. Sinon, elle retourne 'N/A'.

    // Getters
    public function getId(): ?int {
        return $this->id;
    }

    public function getGradeId(): ?int {
        return $this->grade_id;
    }

    public function getEmail(): ?string {
        return $this->email;
    }

    public function getFullname(): ?string {
        return $this->fullname;
    }

    public function getBirthdate(): ?DateTime {
        return $this->birthdate;
    }

    public function getGender(): ?string {
        return $this->gender;
    }

    // Setters
    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setGradeId(int $grade_id): void {
        $this->grade_id = $grade_id;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function setFullname(string $fullname): void {
        $this->fullname = $fullname;
    }

    public function setBirthdate(DateTime $birthdate): void {
        $this->birthdate = $birthdate;
    }

    public function setGender(string $gender): void {
        $this->gender = $gender;
    }

}

?>