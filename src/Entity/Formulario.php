<?php

namespace App\Entity;

use App\Repository\FormularioRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: FormularioRepository::class)]
class Formulario
{
    
        #[ORM\Id]
        #[ORM\GeneratedValue]
        #[ORM\Column]
        private ?int $id = null;
    
        #[ORM\Column(length: 30)]
        #[Assert\NotBlank(message: "El nombre es obligatorio.")]
        private ?string $name = null;
    
        #[ORM\Column(length: 30)]
        #[Assert\NotBlank(message: "El apellido paterno es obligatorio.")]
        private ?string $paternalName = null;
    
        #[ORM\Column(length: 30)]
        private ?string $maternalName = null;
    
        #[ORM\Column(length: 40)]
        #[Assert\NotBlank(message: "El domicilio es obligatorio.")]
        private ?string $street = null;
    
        #[ORM\Column(length: 10)]
        #[Assert\NotBlank(message: "El teléfono es obligatorio.")]
        #[Assert\Regex(pattern: "/^\d{10}$/", message: "El teléfono debe tener 10 dígitos.")]
        private ?string $phone = null;
    
        #[ORM\Column(length: 13)]
        #[Assert\NotBlank(message: "El RFC es obligatorio.")]
        #[Assert\Regex(pattern: "/^[A-Z0-9]{13}$/", message: "El RFC debe tener exactamente 13 caracteres.")]
        private ?string $rfc = null;
    
        #[ORM\Column(length: 50)]
        #[Assert\NotBlank(message: "El estado es obligatorio.")]
        private ?string $state = null;
    
        #[ORM\Column(length: 50)]
        private ?string $municipality = null;
    
        #[ORM\Column(length: 5)]
        #[Assert\Regex(pattern: "/^\d{5}$/", message: "El código postal debe contener 5 dígitos.")]
        private ?string $postalCode = null;
    
        #[ORM\Column(length: 100)]
        #[Assert\NotBlank(message: "El nombre de la empresa es obligatorio.")]
        private ?string $companyName = null;
    
        #[ORM\Column(length: 45)]
        #[Assert\NotBlank(message: "El número de nómina es obligatorio.")]
        private ?string $companyNumber = null;
    
        #[ORM\Column(type: "string")]
        #[Assert\NotBlank(message: "Debe subir su INE.")]
        #[Assert\File(mimeTypes: ['application/pdf', 'image/png', 'image/jpeg'], mimeTypesMessage: "")]
        private ?string $imagesINE = null;
    
        #[ORM\Column(type: "string")]
        #[Assert\NotBlank(message: "Debe subir su comprobante de domicilio.")]
        #[Assert\File(mimeTypes: ['application/pdf', 'image/png', 'image/jpeg'], mimeTypesMessage: "")]
        private ?string $imagesStreet = null;
    
        #[ORM\Column(type: "string")]
        #[Assert\NotBlank(message: "Debe subir su recibo de nómina.")]
        #[Assert\File(mimeTypes: ['application/pdf', 'image/png', 'image/jpeg'], mimeTypesMessage: "")]
        private ?string $imagesNomina = null;
    
        #[ORM\Column(type: "decimal", precision: 10, scale: 2)]
        #[Assert\NotBlank(message: "Debe ingresar la cantidad solicitada.")]
        #[Assert\Positive(message: "La cantidad solicitada debe ser positiva.")]
        private ?string $requestedAmount = null;
    
        #[ORM\Column(length: 45)]
        #[Assert\NotBlank(message: "El banco es obligatorio.")]
        private ?string $bank = null;
    
        #[ORM\Column(length: 18)]
        #[Assert\NotBlank(message: "La clave interbancaria es obligatoria.")]
        #[Assert\Regex(pattern: "/^\d{18}$/", message: "La clave interbancaria debe tener 18 dígitos.")]
        private ?string $interbank = null;
    
      
    
    
    public function getId(): ?int { return $this->id; }

    public function getName(): ?string { return $this->name; }
    public function setName(string $name): static { $this->name = $name; return $this; }

    public function getPaternalName(): ?string { return $this->paternalName; }
    public function setPaternalName(string $paternalName): static { $this->paternalName = $paternalName; return $this; }

    public function getMaternalName(): ?string { return $this->maternalName; }
    public function setMaternalName(string $maternalName): static { $this->maternalName = $maternalName; return $this; }

    public function getStreet(): ?string { return $this->street; }
    public function setStreet(string $street): static { $this->street = $street; return $this; }

    public function getPhone(): ?string { return $this->phone; }
    public function setPhone(string $phone): static { $this->phone = $phone; return $this; }

    public function getRfc(): ?string { return $this->rfc; }
    public function setRfc(string $rfc): static { $this->rfc = $rfc; return $this; }

    public function getState(): ?string { return $this->state; }
    public function setState(string $state): static { $this->state = $state; return $this; }

    public function getMunicipality(): ?string { return $this->municipality; }
    public function setMunicipality(string $municipality): static { $this->municipality = $municipality; return $this; }

    public function getPostalCode(): ?string { return $this->postalCode; }
    public function setPostalCode(string $postalCode): static { $this->postalCode = $postalCode; return $this; }

    public function getCompanyName(): ?string { return $this->companyName; }
    public function setCompanyName(string $companyName): static { $this->companyName = $companyName; return $this; }

    public function getCompanyNumber(): ?string { return $this->companyNumber; }
    public function setCompanyNumber(string $companyNumber): static { $this->companyNumber = $companyNumber; return $this; }

    public function getImagesINE(): ?string { return $this->imagesINE; }
    public function setImagesINE(string $imagesINE): static { $this->imagesINE = $imagesINE; return $this; }

    public function getImagesStreet(): ?string { return $this->imagesStreet; }
    public function setImagesStreet(string $imagesStreet): static { $this->imagesStreet = $imagesStreet; return $this; }

    public function getImagesNomina(): ?string { return $this->imagesNomina; }
    public function setImagesNomina(string $imagesNomina): static { $this->imagesNomina = $imagesNomina; return $this; }

    public function getRequestedAmount(): ?string { return $this->requestedAmount; }
    public function setRequestedAmount(string $requestedAmount): static { $this->requestedAmount = $requestedAmount; return $this; }

    public function getBank(): ?string { return $this->bank; }
    public function setBank(string $bank): static { $this->bank = $bank; return $this; }

    public function getInterbank(): ?string { return $this->interbank; }
    public function setInterbank(string $interbank): static { $this->interbank = $interbank; return $this; }
}
