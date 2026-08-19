<?php



class Eleve
{
    private int $id;
    private string $nomComplet;
    private string $matricule;
    private Responsable $responsable;

    public function __construct(string $nomComplet, string $matricule, Responsable $responsable)
    {
        $this->nomComplet = $nomComplet;
        $this->matricule = $matricule;
        $this->responsable = $responsable;
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function getNomComplet(): string
    {
        return $this->nomComplet;
    }
    public function getMatricule(): string
    {
        return $this->matricule;
    }
    public function getResponsable(): Responsable
    {
        return $this->responsable;
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }
}
