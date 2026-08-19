<?php



class Annescolaire
{
    private int $id;
    private string $annee;
    private int $estActif;

    public function __construct(string $annee, int $estActif = 0)
    {
        $this->annee = $annee;
        $this->estActif = $estActif;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getAnnee(): string
    {
        return $this->annee;
    }

    public function getEstActif(): int
    {
        return $this->estActif;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setAnnee(string $annee): void
    {
        $this->annee = $annee;
    }

    public function setEstActif(int $estActif): void
    {
        $this->estActif = $estActif;
    }

    public static function toEntity(\stdClass $obj): Annescolaire
    {
        return new Annescolaire(annee: $obj->annee);
    }
}
