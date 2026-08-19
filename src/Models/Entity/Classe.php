<?php




class Classe
{
    private int $id;
    private string $nom;
    private Etablissement $etablissement;

    public function __construct(string $nom, Etablissement $etablissement)
    {
        $this->nom = $nom;
        $this->etablissement = $etablissement;
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function getNom(): string
    {
        return $this->nom;
    }
    public function getEtablissement(): Etablissement
    {
        return $this->etablissement;
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }
}
