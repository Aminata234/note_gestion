<?php

require_once __DIR__ . '/../Core/Database.php';
require_once __DIR__ . '/../Models/Repository/InscriptionRepository.php';

class EleveController
{


    // public function liste() {

    //     $pdo = Database::getInstance()->getConnexion();
    //     $eleves = $pdo->query("SELECT * FROM eleves")->fetchAll();


    //     require_once __DIR__.'/../Views/liste.html.php';
    // }

    public function liste()
    {
        $pdo = Database::getInstance()->getConnexion();
        $sql = "SELECT e.nomComplet, e.matricule, e.date_naissance, c.nom 
    as classe_nom, et.nom as etablissement, r.prenom 
    as resp_prenom, r.nom as resp_nom, r.numero 
    as resp_numero FROM eleves e 
    JOIN inscriptions i ON i.id_eleve=e.id 
    JOIN classes c ON c.id=i.id_classe 
    JOIN etablissements et ON et.id=c.id_etablissement 
    JOIN responsables r ON r.id=e.id_responsable 
    WHERE i.id_annee=2";
        $eleves = $pdo->query($sql)->fetchAll(PDO::FETCH_OBJ);
        require_once __DIR__ . '/../Views/liste.html.php';
    }
}
