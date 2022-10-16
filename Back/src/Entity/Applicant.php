<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ApplicantRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ApplicantRepository::class)]
class Applicant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(mappedBy: 'applicants', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    public function getId(): ?int
    {
        return $this->id;
    }



    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        // unset the owning side of the relation if necessary
        if ($user === null && $this->user !== null) {
            $this->user->setApplicants(null);
        }

        // set the owning side of the relation if necessary
        if ($user !== null && $user->getApplicants() !== $this) {
            $user->setApplicants($this);
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
