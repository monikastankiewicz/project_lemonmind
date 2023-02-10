<?php

namespace App\Entity;

use App\Repository\TransportRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\BlobType;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; 

/**
 * Transport object
 * 
 * @package Project_lemonmind/App/Entity
 * @author Monika Stankiewicz <moniaastankiewicz@gmailcom>
 */
#[ORM\Entity(repositoryClass: TransportRepository::class)]
class Transport
{
    /**
     * Transport id
     * 
     * @var int|null
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * Place of dispatch
     * 
     * @Assert\Length( 
     *  min = 5, 
     *  max = 255, 
     *  minMessage = "Wprowadź poprawnie adres", 
     *  maxMessage = "Przekroczono dozwoloną ilość znaków" 
     * ) 
     * @var string|null
     */
    #[ORM\Column(length: 255)]
    private ?string $transport_from = null;

    /**
     * Pickup location
     * 
     * @Assert\Length( 
     *  min = 5, 
     *  max = 255, 
     *  minMessage = "Wprowadź poprawnie adres", 
     *  maxMessage = "Przekroczono dozwoloną ilość znaków" 
     * ) 
     * 
     * @var string|null
     */
    #[ORM\Column(length: 255)]
    private ?string $transport_to = null;

    /**
     * Type of aircraft
     * 
     * @var string|null
     */
    #[ORM\Column(length: 255)]
    private ?string $aircraft_type = null;

    /**
     * Shipping documents 
     * 
     * @var Types::BLOB|null
     */
    #[ORM\Column(type: Types::BLOB, nullable: true)]
    private $shipping_documents = null;

    /**
     * Date of shipment
     * 
     * @var \DateTimeInterface|null
     */
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $shipping_date = null;

    /**
     * Cargos assigned to transport
     * 
     * @var Collection
     */
    #[ORM\OneToMany(mappedBy: 'transport', targetEntity: Cargo::class, orphanRemoval: true)]
    private Collection $cargos;
    
    /**
     * @return void
     */
    public function __construct()
    {
        $this->cargos = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getTransportFrom(): ?string
    {
        return $this->transport_from;
    }

    /**
     * @param string $transport_from
     * 
     * @return self
     */
    public function setTransportFrom(string $transport_from): self
    {
        $this->transport_from = $transport_from;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTransportTo(): ?string
    {
        return $this->transport_to;
    }

    /**
     * @param string $transport_to
     * 
     * @return self
     */
    public function setTransportTo(string $transport_to): self
    {
        $this->transport_to = $transport_to;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAircraftType(): ?string
    {
        return $this->aircraft_type;
    }

    /**
     * @param string $aircraft_type
     * 
     * @return self
     */
    public function setAircraftType(string $aircraft_type): self
    {
        $this->aircraft_type = $aircraft_type;

        return $this;
    }

    /**
     * @return BlobType
     */
    public function getShippingDocuments(): BlobType|null 
    {
        return $this->shipping_documents;
    }

    /**
     * @param mixed $shipping_documents
     * 
     * @return self
     */
    public function setShippingDocuments($shipping_documents): self
    {
        $this->shipping_documents = $shipping_documents;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getShippingDate(): ?\DateTimeInterface
    {
        return $this->shipping_date;
    }

    /**
     * @param \DateTimeInterface $shipping_date
     * 
     * @return self
     */
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

    /**
     * @param Cargo $cargo
     * 
     * @return self
     */
    public function addCargo(Cargo $cargo): self
    {
        if (!$this->cargos->contains($cargo)) {
            $this->cargos->add($cargo);
            $cargo->setTransport($this);
        }

        return $this;
    }

    /**
     * @param Cargo $cargo
     * 
     * @return self
     */
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

    public function __toString() {
        return $this->id;
    }
}
