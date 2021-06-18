<?php

namespace App\Entity;

use App\Repository\DriverRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DriverRepository::class)
 */
class Driver
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname_driver;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname_driver;

    /**
     * @ORM\ManyToMany(targetEntity=Car::class, inversedBy="drivers")
     */
    private $car;

    public function __construct()
    {
        $this->car = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstnameDriver(): ?string
    {
        return $this->firstname_driver;
    }

    public function setFirstnameDriver(string $firstname_driver): self
    {
        $this->firstname_driver = $firstname_driver;

        return $this;
    }

    public function getLastnameDriver(): ?string
    {
        return $this->lastname_driver;
    }

    public function setLastnameDriver(string $lastname_driver): self
    {
        $this->lastname_driver = $lastname_driver;

        return $this;
    }

    /**
     * @return Collection|Car[]
     */
    public function getCar(): Collection
    {
        return $this->car;
    }

    public function addCar(Car $car): self
    {
        if (!$this->car->contains($car)) {
            $this->car[] = $car;
        }

        return $this;
    }

    public function removeCar(Car $car): self
    {
        $this->car->removeElement($car);

        return $this;
    }

    public function __toString() {
        return $this->getLastnameDriver();
    }
}
