<?php

namespace App\Entity;

use App\Repository\ImgRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImgRepository::class)]
class Img
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\Column(type: 'string', length: 255)]
    private $alt;

    #[ORM\OneToMany(mappedBy: 'img', targetEntity: ImgPrestation::class, orphanRemoval: true)]
    private $imgPrestations;

    public function __construct()
    {
        $this->imgPrestations = new ArrayCollection();
    }

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

    public function getAlt(): ?string
    {
        return $this->alt;
    }

    public function setAlt(string $alt): self
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * @return Collection<int, ImgPrestation>
     */
    public function getImgPrestations(): Collection
    {
        return $this->imgPrestations;
    }

    public function addImgPrestation(ImgPrestation $imgPrestation): self
    {
        if (!$this->imgPrestations->contains($imgPrestation)) {
            $this->imgPrestations[] = $imgPrestation;
            $imgPrestation->setImg($this);
        }

        return $this;
    }

    public function removeImgPrestation(ImgPrestation $imgPrestation): self
    {
        if ($this->imgPrestations->removeElement($imgPrestation)) {
            // set the owning side to null (unless already changed)
            if ($imgPrestation->getImg() === $this) {
                $imgPrestation->setImg(null);
            }
        }

        return $this;
    }
}
