<?php

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CarRepository::class)
 */
class Car
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
    private $model_car;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $brand_car;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $color_car;

    /**
     * @ORM\ManyToOne(targetEntity=Garage::class, inversedBy="cars")
     * @ORM\JoinColumn(nullable=false)
     */
    private $garage;

    /**
     * @ORM\ManyToMany(targetEntity=Driver::class, mappedBy="car")
     */
    private $drivers;

    public function __construct()
    {
        $this->drivers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModelCar(): ?string
    {
        return $this->model_car;
    }

    public function setModelCar(string $model_car): self
    {
        $this->model_car = $model_car;

        return $this;
    }

    public function getBrandCar(): ?string
    {
        return $this->brand_car;
    }

    public function setBrandCar(string $brand_car): self
    {
        $this->brand_car = $brand_car;

        return $this;
    }

    public function getColorCar(): ?string
    {
        return $this->color_car;
    }

    public function setColorCar(string $color_car): self
    {
        $this->color_car = $color_car;

        return $this;
    }

    public function getGarage(): ?Garage
    {
        return $this->garage;
    }

    public function setGarage(?Garage $garage): self
    {
        $this->garage = $garage;

        return $this;
    }

    /**
     * @return Collection|Driver[]
     */
    public function getDrivers(): Collection
    {
        return $this->drivers;
    }

    public function addDriver(Driver $driver): self
    {
        if (!$this->drivers->contains($driver)) {
            $this->drivers[] = $driver;
            $driver->addCar($this);
        }

        return $this;
    }

    public function removeDriver(Driver $driver): self
    {
        if ($this->drivers->removeElement($driver)) {
            $driver->removeCar($this);
        }

        return $this;
    }
}
