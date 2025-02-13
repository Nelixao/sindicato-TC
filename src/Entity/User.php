<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Application>
     */
    #[ORM\OneToMany(targetEntity: Application::class, mappedBy: 'userAuth')]
    private Collection $applications;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(length: 50)]
    private ?string $paternalSurname = null;

    #[ORM\Column(length: 50)]
    private ?string $maternalSurname = null;

    #[ORM\Column(length: 45)]
    private ?string $numberPhone = null;

    #[ORM\Column(length: 45)]
    private ?string $rol = null;

    #[ORM\Column(length: 45)]
    private ?string $password = null;

    #[ORM\Column(length: 100)]
    private ?string $email = null;

    public function __construct()
    {
        $this->applications = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Application>
     */
    public function getApplications(): Collection
    {
        return $this->applications;
    }

    public function addApplication(Application $application): static
    {
        if (!$this->applications->contains($application)) {
            $this->applications->add($application);
            $application->setUserAuth($this);
        }

        return $this;
    }

    public function removeApplication(Application $application): static
    {
        if ($this->applications->removeElement($application)) {
            // set the owning side to null (unless already changed)
            if ($application->getUserAuth() === $this) {
                $application->setUserAuth(null);
            }
        }

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPaternalSurname(): ?string
    {
        return $this->paternalSurname;
    }

    public function setPaternalSurname(string $paternalSurname): static
    {
        $this->paternalSurname = $paternalSurname;

        return $this;
    }

    public function getMaternalSurname(): ?string
    {
        return $this->maternalSurname;
    }

    public function setMaternalSurname(string $maternalSurname): static
    {
        $this->maternalSurname = $maternalSurname;

        return $this;
    }

    public function getNumberPhone(): ?string
    {
        return $this->numberPhone;
    }

    public function setNumberPhone(string $numberPhone): static
    {
        $this->numberPhone = $numberPhone;

        return $this;
    }

    public function getRol(): ?string
    {
        return $this->rol;
    }

    public function setRol(string $rol): static
    {
        $this->rol = $rol;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }
}
