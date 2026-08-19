<?php




class Responsable
{
    private int $id;
    private string $nomcomplet;
    private string $telephone;

    public function __construct(string $nomcomplet, string $telephone)
    {
        $this->nomcomplet = $nomcomplet;
        $this->telephone = $telephone;
    }

    public function getId(): int { return $this->id; }
    public function getNomComplet(): string { return $this->nomcomplet; }
    public function getTelephone(): string { return $this->telephone; }

    public function setId(int $id): void { $this->id = $id; }
    public function setNomComplet(string $nomcomplet): void { $this->nomcomplet = $nomcomplet; }
    public function setTelephone(string $telephone): void { $this->telephone = $telephone; }

    public static function toEntity(\stdClass $obj): self
    {
        return new self(
            nomcomplet: $obj->prenomresponsable,
            telephone: $obj->numero
        );
    }
}