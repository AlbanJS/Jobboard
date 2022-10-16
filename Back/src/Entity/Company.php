<?php

namespace App\Entity;



use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\CompanyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


#[ApiResource(
    operations: [
        new Get(),
        new GetCollection(),
        new Post(),
        new Put(),
        new Delete()

    ],
)]
#[ORM\Entity(repositoryClass: CompanyRepository::class)]
class Company
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]

    private ?string $adress = null;

    #[ORM\OneToMany(mappedBy: 'company', targetEntity: Annonce::class)]
    #[Groups(['company'])]

    private Collection $ads;

    #[ORM\OneToOne(mappedBy: 'companies', cascade: ['persist', 'remove'])]

    private ?User $user = null;

    #[ORM\Column(length: 255)]

    private ?string $name = null;

    public function __construct()
    {
        $this->ads = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(?string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }


    public function getAds(): array
    {
        return $this->ads->getValues();
    }

    public function addAd(Annonce $ad): self
    {
        if (!$this->ads->contains($ad)) {
            $this->ads->add($ad);
            $ad->setCompany($this);
        }

        return $this;
    }

    public function removeAd(Annonce $ad): self
    {
        if ($this->ads->removeElement($ad)) {
            // set the owning side to null (unless already changed)
            if ($ad->getCompany() === $this) {
                $ad->setCompany(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        // unset the owning side of the relation if necessary
        if ($user === null && $this->user !== null) {
            $this->user->setCompanies(null);
        }

        // set the owning side of the relation if necessary
        if ($user !== null && $user->getCompanies() !== $this) {
            $user->setCompanies($this);
        }

        $this->user = $user;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
