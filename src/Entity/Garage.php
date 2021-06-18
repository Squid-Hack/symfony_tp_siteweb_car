<?php

namespace App\Entity;

use App\Repository\GarageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GarageRepository::class)
 */
class Garage
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
    private $name_garage;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $country_garage;

    /**
     * @ORM\OneToMany(targetEntity=Car::class, mappedBy="garage", orphanRemoval=true)
     */
    private $cars;

    public function __construct()
    {
        $this->cars = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameGarage(): ?string
    {
        return $this->name_garage;
    }

    public function setNameGarage(string $name_garage): self
    {
        $this->name_garage = $name_garage;

        return $this;
    }

    public function getCountryGarage(): ?string
    {
        return $this->country_garage;
    }

    public function setCountryGarage(string $country_garage): self
    {
        $this->country_garage = $country_garage;

        return $this;
    }

    /**
     * @return Collection|Car[]
     */
    public function getCars(): Collection
    {
        return $this->cars;
    }

    public function addCar(Car $car): self
    {
        if (!$this->cars->contains($car)) {
            $this->cars[] = $car;
            $car->setGarage($this);
        }

        return $this;
    }

    public function removeCar(Car $car): self
    {
        if ($this->cars->removeElement($car)) {
            // set the owning side to null (unless already changed)
            if ($car->getGarage() === $this) {
                $car->setGarage(null);
            }
        }

        return $this;
    }

    public function __toString() {
        return $this->getNameGarage();
    }
}

