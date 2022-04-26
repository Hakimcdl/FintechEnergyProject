<?php

namespace App\Entity;

use App\Repository\AppointmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AppointmentRepository::class)]
class Appointment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $firstname;

    #[ORM\Column(type: 'string', length: 255)]
    private $lastname;

    #[ORM\Column(type: 'string', length: 255)]
    private $postalAdress;

    #[ORM\Column(type: 'integer')]
    private $postalCode;

    #[ORM\Column(type: 'integer')]
    private $surface;

    #[ORM\Column(type: 'string', length: 255)]
    private $mail;

    #[ORM\Column(type: 'integer')]
    private $phone;

    #[ORM\Column(type: 'datetime')]
    private $requestDate;

    #[ORM\Column(type: 'date')]
    private $callBackRequest;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $entreprise;

    #[ORM\Column(type: 'string', length: 255)]
    private $note;

    #[ORM\Column(type: 'boolean')]
    private $active;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $company_name;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $siret;

    #[ORM\ManyToMany(targetEntity: Prestation::class, inversedBy: 'appointmentPrestation')]
    private $prestationaccessupdate;

    #[ORM\ManyToOne(targetEntity: Residency::class, inversedBy: 'appointmentResidency')]
    private $residencyaccessupdate;

    public function __construct()
    {
        $this->residency = new ArrayCollection();
        $this->prestationaccessupdate = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getPostalAdress(): ?string
    {
        return $this->postalAdress;
    }

    public function setPostalAdress(string $postalAdress): self
    {
        $this->postalAdress = $postalAdress;

        return $this;
    }

    public function getPostalCode(): ?int
    {
        return $this->postalCode;
    }

    public function setPostalCode(int $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getSurface(): ?int
    {
        return $this->surface;
    }

    public function setSurface(int $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getPhone(): ?int
    {
        return $this->phone;
    }

    public function setPhone(int $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getRequestDate(): ?\DateTimeInterface
    {
        return $this->requestDate;
    }

    public function setRequestDate(\DateTimeInterface $requestDate): self
    {
        $this->requestDate = $requestDate;

        return $this;
    }

    public function getCallBackRequest(): ?\DateTimeInterface
    {
        return $this->callBackRequest;
    }

    public function setCallBackRequest(\DateTimeInterface $callBackRequest): self
    {
        $this->callBackRequest = $callBackRequest;

        return $this;
    }

    public function getEntreprise(): ?bool
    {
        return $this->entreprise;
    }

    public function setEntreprise(bool $entreprise): self
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(string $note): self
    {
        $this->note = $note;

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

    /**
     * @return Collection<int, Residency>
     */
    public function getResidency(): Collection
    {
        return $this->residency;
    }

    public function addResidency(Residency $residency): self
    {
        if (!$this->residency->contains($residency)) {
            $this->residency[] = $residency;
            $residency->setAppointment($this);
        }

        return $this;
    }

    public function removeResidency(Residency $residency): self
    {
        if ($this->residency->removeElement($residency)) {
            // set the owning side to null (unless already changed)
            if ($residency->getAppointment() === $this) {
                $residency->setAppointment(null);
            }
        }

        return $this;
    }

    public function getCompanyName(): ?string
    {
        return $this->company_name;
    }

    public function setCompanyName(string $company_name): self
    {
        $this->company_name = $company_name;

        return $this;
    }

    public function getSiret(): ?int
    {
        return $this->siret;
    }

    public function setSiret(int $siret): self
    {
        $this->siret = $siret;

        return $this;
    }

    /**
     * @return Collection<int, Prestation>
     */
    public function getPrestationaccessupdate(): Collection
    {
        return $this->prestationaccessupdate;
    }

    public function addPrestationaccessupdate(Prestation $prestationaccessupdate): self
    {
        if (!$this->prestationaccessupdate->contains($prestationaccessupdate)) {
            $this->prestationaccessupdate[] = $prestationaccessupdate;
            $prestationaccessupdate->addAppointmentPrestation($this);
        }

        return $this;
    }

    public function removePrestationaccessupdate(Prestation $prestationaccessupdate): self
    {
        if ($this->prestationaccessupdate->removeElement($prestationaccessupdate)) {
            $prestationaccessupdate->removeAppointmentPrestation($this);
        }

        return $this;
    }

    public function getResidencyaccessupdate(): ?Residency
    {
        return $this->residencyaccessupdate;
    }

    public function setResidencyaccessupdate(?Residency $residencyaccessupdate): self
    {
        $this->residencyaccessupdate = $residencyaccessupdate;

        return $this;
    }
}
