<?php

namespace App\Entity;




use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\AnnonceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


#[ApiResource(


    operations: [
        new Get(name:'read'),
        new GetCollection(name: 'collection'),
        new Post(name:'write'),
        new Put(),
        new Delete()
    ],

    normalizationContext: ['groups' => ['read'], ['collection']],
    denormalizationContext: ['groups' =>['write'], ['collection']],

)]



#[ORM\Entity(repositoryClass: AnnonceRepository::class)]
class Annonce
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['write','read'])]
    private ?string $title = null;

    #[ORM\Column(length: 5000)]
    #[Groups(['write','read'])]
    private ?string $description = null;

    #[ORM\Column(length: 5000)]
    #[Groups(['write'])]
    private ?string $summary = null;

    #[ORM\Column]
    #[Groups(['write','read'])]
    private ?int $wage = null;

    #[ORM\Column(length: 255)]
    #[Groups(['write','read'])]
    private ?string $contrat = null;


    #[ORM\ManyToOne(inversedBy: 'ads')]
    #[Groups(['write','read', 'collection'])]
    private ?Company $company = null;

    #[ORM\Column]
    #[Groups(['write','read'])]
    private ?\DateTimeImmutable $createdAt = null;

    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(string $summary): self
    {
        $this->summary = $summary;

        return $this;
    }

    public function getWage(): ?int
    {
        return $this->wage;
    }

    public function setWage(int $wage): self
    {
        $this->wage = $wage;

        return $this;
    }

    public function getContrat(): ?string
    {
        return $this->contrat;
    }

    public function setContrat(string $contrat): self
    {
        $this->contrat = $contrat;

        return $this;
    }


    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

}
