<?php


// require_once dirname(__DIR__) . '/Entity';
// require_once __DIR__ . '/Etablissement.php';
// require_once __DIR__ . '/Inscription.php';

class Transfert
{
    private int $id;
    private string $etablissement_sortant;
    private string $etablissement_entrant;
    private Inscription $inscription;
    private StatutTransfert $statut;

    public function __construct(
        string $etablissement_sortant,
        string $etablissement_entrant,
        Inscription $inscription,
        StatutTransfert $statut
    ) {
        $this->etablissement_sortant = $etablissement_sortant;
        $this->etablissement_entrant = $etablissement_entrant;
        $this->inscription = $inscription;
        $this->statut = $statut;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getEtablissemententrant(): string
    {
        return $this->etablissement_entrant;
    }

    public function getEtablissementSortant(): string
    {
        return $this->etablissement_sortant;
    }

    public function getInscription(): Inscription
    {
        return $this->inscription;
    }

    public function getStatut(): StatutTransfert
    {
        return $this->statut;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setEtablissemententrant(string $etablissement_entrant): void
    {
        $this->etablissement_entrant = $etablissement_entrant;
    }

    public function setEtablissementSortant(string $etablissement_sortant): void
    {
        $this->etablissement_sortant = $etablissement_sortant;
    }

    public function setStatut(StatutTransfert $statut): void
    {
        $this->statut = $statut;
    }

    public function setInscription(Inscription $inscription): void
    {
        $this->inscription = $inscription;
    }
}
