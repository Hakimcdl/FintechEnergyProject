<?php

namespace App\Entity;

use App\Repository\PrestationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PrestationRepository::class)]
class Prestation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private $title;


    #[ORM\Column(type: 'datetime')]
    private $dateCreation;

    #[ORM\Column(type: 'boolean')]
    private $active;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'prestations')]
    private $user;

    #[ORM\ManyToMany(targetEntity: Appointment::class, mappedBy: 'prestationaccessupdate')]
    private $appointmentPrestation;

    #[ORM\OneToMany(mappedBy: 'prestation', targetEntity: ImgPrestation::class, orphanRemoval: true, cascade: ["persist", "remove"])]
    private $imgPrestations;

    public function __construct()
    {
        $this->imgs = new ArrayCollection();
        $this->appointmentPrestation = new ArrayCollection();
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

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Appointment>
     */
    public function getAppointmentPrestation(): Collection
    {
        return $this->appointmentPrestation;
    }

    public function addAppointmentPrestation(Appointment $appointmentPrestation): self
    {
        if (!$this->appointmentPrestation->contains($appointmentPrestation)) {
            $this->appointmentPrestation[] = $appointmentPrestation;
        }

        return $this;
    }

    public function removeAppointmentPrestation(Appointment $appointmentPrestation): self
    {
        $this->appointmentPrestation->removeElement($appointmentPrestation);

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
            $imgPrestation->setPrestation($this);
        }

        return $this;
    }

    public function removeImgPrestation(ImgPrestation $imgPrestation): self
    {
        if ($this->imgPrestations->removeElement($imgPrestation)) {
            // set the owning side to null (unless already changed)
            if ($imgPrestation->getPrestation() === $this) {
                $imgPrestation->setPrestation(null);
            }
        }

        return $this;
    }
}
