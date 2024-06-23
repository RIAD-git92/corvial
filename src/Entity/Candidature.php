<?php

namespace App\Entity;

use App\Repository\CandidatureRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: CandidatureRepository::class)]
#[Vich\Uploadable]
class Candidature
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    // Initialisez le statut avec une valeur par défaut claire
    #[ORM\Column(length: 255, options: ["default" => "new"])]
    private string $statut = "new";

    #[ORM\ManyToOne(inversedBy: 'candidatures')]
    private ?OffreEmploi $offreEmploi = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    // Vich uploader fields
    #[Vich\UploadableField(mapping: "candidature_cv", fileNameProperty: "cvName")]
    private ?File $cvFile = null;

    #[ORM\Column(length: 255)]
    private ?string $cvName = null;

    #[Vich\UploadableField(mapping: "candidature_letter", fileNameProperty: "letterName")]
    private ?File $letterFile = null;

    #[ORM\Column(length: 255)]
    private ?string $letterName = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatut(): string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;
        return $this;
    }

    public function getOffreEmploi(): ?OffreEmploi
    {
        return $this->offreEmploi;
    }

    public function setOffreEmploi(?OffreEmploi $offreEmploi): self
    {
        $this->offreEmploi = $offreEmploi;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function setCvFile(?File $cvFile = null): void
    {
        $this->cvFile = $cvFile;
    }

    public function getCvFile(): ?File
    {
        return $this->cvFile;
    }

    public function setCvName(?string $cvName): void
    {
        $this->cvName = $cvName;
    }

    public function getCvName(): ?string
    {
        return $this->cvName;
    }

    public function setLetterFile(?File $letterFile = null): void
    {
        $this->letterFile = $letterFile;
    }

    public function getLetterFile(): ?File
    {
        return $this->letterFile;
    }

    public function setLetterName(?string $letterName): void
    {
        $this->letterName = $letterName;
    }

    public function getLetterName(): ?string
    {
        return $this->letterName;
    }
}
