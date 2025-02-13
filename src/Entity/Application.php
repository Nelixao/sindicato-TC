<?php

namespace App\Entity;

use App\Repository\ApplicationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Document; 

#[ORM\Entity(repositoryClass: ApplicationRepository::class)]
class Application
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'applications')]
    private ?Customer $customer = null;

    #[ORM\ManyToOne(inversedBy: 'applications')]
    private ?User $userAuth = null;

    /**
     * @var Collection<int, document>
     */
    #[ORM\OneToMany(targetEntity: Document::class, mappedBy: 'application')]
    private Collection $documents;

    #[ORM\Column(length: 100)]
    private ?string $requestedAmount = null;

    #[ORM\Column]
    private ?bool $status = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $applicationDate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $resolutionDate = null;

    #[ORM\Column(length: 100)]
    private ?string $bank = null;

    #[ORM\Column(length: 100)]
    private ?string $interbank = null;

    #[ORM\Column(length: 150)]
    private ?string $notes = null;

    public function __construct()
    {
        $this->documents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): static
    {
        $this->customer = $customer;

        return $this;
    }

    public function getUserAuth(): ?User
    {
        return $this->userAuth;
    }

    public function setUserAuth(?User $userAuth): static
    {
        $this->userAuth = $userAuth;

        return $this;
    }

    /**
     * @return Collection<int, document>
     */
    public function getDocuments(): Collection
    {
        return $this->documents;
    }

    public function adddocument(document $document): static
    {
        if (!$this->documents->contains($document)) {
            $this->documents->add($document);
            $document->setApplication($this);
        }

        return $this;
    }

    public function removedocument(document $document): static
    {
        if ($this->documents->removeElement($document)) {
            // set the owning side to null (unless already changed)
            if ($document->getApplication() === $this) {
                $document->setApplication(null);
            }
        }

        return $this;
    }

    public function getRequestedAmount(): ?string
    {
        return $this->requestedAmount;
    }

    public function setRequestedAmount(string $requestedAmount): static
    {
        $this->requestedAmount = $requestedAmount;

        return $this;
    }

    public function isStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getApplicationDate(): ?\DateTimeInterface
    {
        return $this->applicationDate;
    }

    public function setApplicationDate(\DateTimeInterface $applicationDate): static
    {
        $this->applicationDate = $applicationDate;

        return $this;
    }

    public function getResolutionDate(): ?\DateTimeInterface
    {
        return $this->resolutionDate;
    }

    public function setResolutionDate(\DateTimeInterface $resolutionDate): static
    {
        $this->resolutionDate = $resolutionDate;

        return $this;
    }

    public function getBank(): ?string
    {
        return $this->bank;
    }

    public function setBank(string $bank): static
    {
        $this->bank = $bank;

        return $this;
    }

    public function getInterbank(): ?string
    {
        return $this->interbank;
    }

    public function setInterbank(string $interbank): static
    {
        $this->interbank = $interbank;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(string $notes): static
    {
        $this->notes = $notes;

        return $this;
    }
}
