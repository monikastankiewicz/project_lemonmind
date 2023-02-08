<?php

namespace App\Entity;

use App\Repository\CargoRepository;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: CargoRepository::class)]
class Cargo
{
    /**
     * @var int|null
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var string|null
     */
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    // /**
    //  * @var int|null
    //  */
    // #[ORM\Column]
    // private ?int $weight = null;

    /**
     * @var string|null
     */
    #[ORM\Column(length: 255)]
    private ?string $type = null;

    /**
     * Transport to which the cargo is assigned
     * 
     * @var Transport|null
     */
    #[ORM\ManyToOne(inversedBy: 'cargos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Transport $transport = null;

    #[ORM\Column]
    private ?int $weight_kg = null;

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
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * 
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    // /**
    //  * @return int|null
    //  */
    // public function getWeight(): ?int
    // {
    //     return $this->weight;
    // }

    // /**
    //  * @param int $weight
    //  * 
    //  * @return self
    //  */
    // public function setWeight(int $weight): self
    // {
    //     $this->weight = $weight;

    //     return $this;
    // }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * 
     * @return self
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Transport|null
     */
    public function getTransport(): ?Transport
    {
        return $this->transport;
    }

    /**
     * @param Transport|null $transport
     * 
     * @return self
     */
    public function setTransport(?Transport $transport): self
    {
        $this->transport = $transport;

        return $this;
    }

    public function getWeightKg(): ?int
    {
        return $this->weight_kg;
    }

    public function setWeightKg(int $weight_kg): self
    {
        $this->weight_kg = $weight_kg;

        return $this;
    }
}
