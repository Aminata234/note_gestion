<?php



class Inscription
{
    private int $id;
    private Eleve $eleve;
    private Classe $classe;
    private Annescolaire $annescolaire;
    private Utilisateur $utilisateur;
    private StatutInscription $statut;

    public function __construct(Eleve $eleve, Classe $classe, Annescolaire $annescolaire, Utilisateur $utilisateur, StatutInscription $statut = StatutInscription::EN_ATTENTE)
    {
        $this->eleve = $eleve;
        $this->classe = $classe;
        $this->annescolaire = $annescolaire;
        $this->utilisateur = $utilisateur;
        $this->statut = $statut;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getEleve(): Eleve
    {
        return $this->eleve;
    }

    public function getClasse(): Classe
    {
        return $this->classe;
    }

    public function getAnnescoalire(): Annescolaire
    {
        return $this->annescolaire;
    }

    public function getUtilisateur(): Utilisateur
    {
        return $this->utilisateur;
    }

    public function getStatut(): StatutInscription
    {
        return $this->statut;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setEleve(Eleve $eleve): void
    {
        $this->eleve = $eleve;
    }

    public function setClasse(Classe $classe): void
    {
        $this->classe = $classe;
    }

    public function setAnnescolaire(Annescolaire $annescolaire): void
    {
        $this->annescolaire = $annescolaire;
    }

    public function setUtilisateur(Utilisateur $utilisateur): void
    {
        $this->utilisateur = $utilisateur;
    }

    public function setStatut(StatutInscription $statut): void
    {
        $this->statut = $statut;
    }

}