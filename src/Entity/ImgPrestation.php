<?php

namespace App\Entity;

use App\Repository\ImgPrestationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImgPrestationRepository::class)]
class ImgPrestation
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Img::class, inversedBy: 'imgPrestations')]
    #[ORM\JoinColumn(nullable: false)]
    private $img;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Prestation::class, inversedBy: 'imgPrestations')]
    #[ORM\JoinColumn(nullable: false)]
    private $prestation;

    #[ORM\Column(type: 'string', length: 1500)]
    private $description;

    public function getImg(): ?Img
    {
        return $this->img;
    }

    public function setImg(?Img $img): self
    {
        $this->img = $img;

        return $this;
    }

    public function getPrestation(): ?Prestation
    {
        return $this->prestation;
    }

    public function setPrestation(?Prestation $prestation): self
    {
        $this->prestation = $prestation;

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
}
