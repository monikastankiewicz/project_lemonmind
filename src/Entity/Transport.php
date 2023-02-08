<?php

namespace App\Entity;

use App\Repository\TransportRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TransportRepository::class)]
class Transport
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $transport_from = null;

    #[ORM\Column(length: 255)]
    private ?string $transport_to = null;

    #[ORM\Column(length: 255)]
    private ?string $aircraft_type = null;

    #[ORM\Column(type: Types::BLOB, nullable: true)]
    private $shipping_documents = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $shipping_date = null;

    #[ORM\OneToMany(mappedBy: 'transport', targetEntity: Cargo::class, orphanRemoval: true)]
    private Collection $cargos;

    public function __construct()
    {
        $this->cargos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTransportFrom(): ?string
    {
        return $this->transport_from;
    }

    public function setTransportFrom(string $transport_from): self
    {
        $this->transport_from = $transport_from;

        return $this;
    }

    public function getTransportTo(): ?string
    {
        return $this->transport_to;
    }

    public function setTransportTo(string $transport_to): self
    {
        $this->transport_to = $transport_to;

        return $this;
    }

    public function getAircraftType(): ?string
    {
        return $this->aircraft_type;
    }

    public function setAircraftType(string $aircraft_type): self
    {
        $this->aircraft_type = $aircraft_type;

        return $this;
    }

    public function getShippingDocuments()
    {
        return $this->shipping_documents;
    }

    public function setShippingDocuments($shipping_documents): self
    {
        $this->shipping_documents = $shipping_documents;

        return $this;
    }

    public function getShippingDate(): ?\DateTimeInterface
    {
        return $this->shipping_date;
    }

    public function setShippingDate(\DateTimeInterface $shipping_date): self
    {
        $this->shipping_date = $shipping_date;

        return $this;
    }

    /**
     * @return Collection<int, Cargo>
     */
    public function getCargos(): Collection
    {
        return $this->cargos;
    }

    public function addCargo(Cargo $cargo): self
    {
        if (!$this->cargos->contains($cargo)) {
            $this->cargos->add($cargo);
            $cargo->setTransport($this);
        }

        return $this;
    }

    public function removeCargo(Cargo $cargo): self
    {
        if ($this->cargos->removeElement($cargo)) {
            // set the owning side to null (unless already changed)
            if ($cargo->getTransport() === $this) {
                $cargo->setTransport(null);
            }
        }

        return $this;
    }
}
