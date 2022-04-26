<?php

namespace App\Entity;

use App\Repository\ResidencyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResidencyRepository::class)]
class Residency
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'residencyaccessupdate', targetEntity: Appointment::class)]
    private $appointmentResidency;

    public function __construct()
    {
        $this->appointmentResidency = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getAppointment(): ?Appointment
    {
        return $this->appointment;
    }

    public function setAppointment(?Appointment $appointment): self
    {
        $this->appointment = $appointment;

        return $this;
    }

    /**
     * @return Collection<int, Appointment>
     */
    public function getAppointmentResidency(): Collection
    {
        return $this->appointmentResidency;
    }

    public function addAppointmentResidency(Appointment $appointmentResidency): self
    {
        if (!$this->appointmentResidency->contains($appointmentResidency)) {
            $this->appointmentResidency[] = $appointmentResidency;
            $appointmentResidency->setResidencyaccessupdate($this);
        }

        return $this;
    }

    public function removeAppointmentResidency(Appointment $appointmentResidency): self
    {
        if ($this->appointmentResidency->removeElement($appointmentResidency)) {
            // set the owning side to null (unless already changed)
            if ($appointmentResidency->getResidencyaccessupdate() === $this) {
                $appointmentResidency->setResidencyaccessupdate(null);
            }
        }

        return $this;
    }
}
