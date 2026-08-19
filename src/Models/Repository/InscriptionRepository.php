<?php


require_once __DIR__.'/../../Core/Database.php';
require_once dirname(__DIR__).'/Entity/Inscription.php';

class InscriptionRepository {

    public static function getAllInscriptionsAndEleves(int $idAnnee): array {
        $sql = "SELECT
            i.id,
            e.nomcomplet, e.matricule, e.date_naissance, e.id as eleve_id,
            c.nom as classe, c.id as classe_id,
            r.nom as nomresponsable, r.prenom as prenomresponsable, r.numero, r.id as responsable_id,
            et.nom as nometablissement, et.id as etablissement_id,
            an.annee
            FROM inscriptions i
            JOIN eleves e ON e.id = i.id_eleve
            JOIN responsables r ON r.id = e.id_responsable
            JOIN classes c ON c.id = i.id_classe
            JOIN etablissements et ON et.id = c.id_etablissement
            JOIN anneescolaires an ON an.id = i.id_annee
            WHERE i.id_annee = :idAnnee";

        $pdo = Database::getInstance()->getConnexion();
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['idAnnee' => $idAnnee]);
        return $stmt->fetchAll(PDO::FETCH_OBJ); 
    }
}