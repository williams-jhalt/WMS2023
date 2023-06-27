<?php

namespace App\Entity;

use App\Repository\CartonRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: "carton")]
#[ORM\Entity(repositoryClass: CartonRepository::class)]
class Carton
{
    #[ORM\Id]
    #[ORM\Column(name: "ucc", length: 255)]
    private ?string $ucc = null;

    #[ORM\Column(name: "carton_weight", nullable: true)]
    private ?float $weight = null;

    #[ORM\Column(name: "ship_height", nullable: true)]
    private ?float $height = null;

    #[ORM\Column(name: "ship_length", nullable: true)]
    private ?float $length = null;

    #[ORM\Column(name: "ship_width", nullable: true)]
    private ?float $width = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUcc(): ?string
    {
        return $this->ucc;
    }

    public function setUcc(string $ucc): static
    {
        $this->ucc = $ucc;

        return $this;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(?float $weight): static
    {
        $this->weight = $weight;

        return $this;
    }

    public function getHeight(): ?float
    {
        return $this->height;
    }

    public function setHeight(?float $height): static
    {
        $this->height = $height;

        return $this;
    }

    public function getLength(): ?float
    {
        return $this->length;
    }

    public function setLength(?float $length): static
    {
        $this->length = $length;

        return $this;
    }

    public function getWidth(): ?float
    {
        return $this->width;
    }

    public function setWidth(?float $width): static
    {
        $this->width = $width;

        return $this;
    }
}
