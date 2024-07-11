<?php

namespace App\Entity;

use App\Repository\OffreEmploiRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: OffreEmploiRepository::class)]
class OffreEmploi
{
    const CONTRAT_CDI = 'CDI';
    const CONTRAT_CDD = 'CDD';
    const CONTRAT_INTERIM = 'Interim';
    const CONTRAT_STAGE = 'Stage';
    const CONTRAT_ALTERNANCE = 'Alternance';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(type: 'text')]
    private ?string $description = null;

    #[ORM\Column]
    private ?float $salaire = null;

    #[ORM\ManyToOne(inversedBy: 'offres')]
    private ?Entreprise $entreprise = null;

    #[ORM\ManyToMany(targetEntity: Competence::class, inversedBy: 'offreEmplois')]
    #[ORM\JoinTable(name: 'offre_competence')]
    private Collection $competences;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank]
    #[Assert\Choice(choices: [self::CONTRAT_CDI, self::CONTRAT_CDD, self::CONTRAT_INTERIM, self::CONTRAT_STAGE, self::CONTRAT_ALTERNANCE])]
    private ?string $contrat = null;

    #[ORM\OneToMany(mappedBy: 'offreEmploi', targetEntity: Candidature::class, cascade: ['remove'], orphanRemoval: true)]
    private Collection $candidatures;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $date = null;

    public function __construct()
    {
        $this->competences = new ArrayCollection();
        $this->candidatures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getSalaire(): ?float
    {
        return $this->salaire;
    }

    public function setSalaire(float $salaire): self
    {
        $this->salaire = $salaire;
        return $this;
    }

    public function getEntreprise(): ?Entreprise
    {
        return $this->entreprise;
    }

    public function setEntreprise(?Entreprise $entreprise): self
    {
        $this->entreprise = $entreprise;
        return $this;
    }

    /**
     * @return Collection|Competence[]
     */
    public function getCompetences(): Collection
    {
        return $this->competences;
    }

    public function addCompetence(Competence $competence): self
    {
        if (!$this->competences->contains($competence)) {
            $this->competences[] = $competence;
        }
        return $this;
    }

    public function removeCompetence(Competence $competence): self
    {
        $this->competences->removeElement($competence);
        return $this;
    }

    public function getContrat(): ?string
    {
        return $this->contrat;
    }

    public function setContrat(string $contrat): self
    {
        if (!in_array($contrat, [self::CONTRAT_CDI, self::CONTRAT_CDD, self::CONTRAT_INTERIM, self::CONTRAT_STAGE, self::CONTRAT_ALTERNANCE])) {
            throw new \InvalidArgumentException("Invalid contract type");
        }
        $this->contrat = $contrat;
        return $this;
    }

    /**
     * @return Collection|Candidature[]
     */
    public function getCandidatures(): Collection
    {
        return $this->candidatures;
    }

    public function addCandidature(Candidature $candidature): self
    {
        if (!$this->candidatures->contains($candidature)) {
            $this->candidatures[] = $candidature;
            $candidature->setOffreEmploi($this);
        }
        return $this;
    }

    public function removeCandidature(Candidature $candidature): self
    {
        if ($this->candidatures->removeElement($candidature)) {
            // set the owning side to null (unless already changed)
            if ($candidature->getOffreEmploi() === $this) {
                $candidature->setOffreEmploi(null);
            }
        }
        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;
        return $this;
    }

    public function __toString(): string
    {
        return $this->titre ?? '';
    }
}
