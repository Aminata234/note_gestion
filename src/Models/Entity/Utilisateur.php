<?php


class Utilisateur
{
    private int $id;
    private string $nomComplet;
    private string $login;
    private string $password;
    private Role $role;

    public function __construct(string $nomComplet, string $login, string $password, Role $role)
    {
        $this->nomComplet = $nomComplet;
        $this->login = $login;
        $this->password = $password;
        $this->role = $role;
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function getNomComplet(): string
    {
        return $this->nomComplet;
    }
    public function getLogin(): string
    {
        return $this->login;
    }
    public function getPassword(): string
    {
        return $this->password;
    }
    public function getRole(): Role
    {
        return $this->role;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function setNomComplet(string $nomComplet): void
    {
        $this->nomComplet = $nomComplet;
    }
    public function setLogin(string $login): void
    {
        $this->login = $login;
    }
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
    public function setRole(Role $role): void
    {
        $this->role = $role;
    }
}
