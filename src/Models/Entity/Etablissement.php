<?php




class Etablissement
{
    private int $id;
    private string $nom;

    public function __construct(string $nom)
    {
        $this->nom = $nom;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getAnnee(): string
    {
        return $this->nom;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setnom(string $nom): void
    {
        $this->nom = $nom;
    }

    public static function toEntity(\stdClass $obj): Etablissement
    {
        return new Etablissement(nom: $obj->nometablissement);
    }
}
