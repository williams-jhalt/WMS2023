<?php

namespace App\Entity;

use App\Repository\ProductDimensionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: "product_dimension")]
#[ORM\Entity(repositoryClass: ProductDimensionRepository::class)]
class ProductDimension
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(name: "barcode", length: 255)]
    private ?string $barcode = null;

    #[ORM\Column(name: "height", nullable: true)]
    private ?float $height = null;

    #[ORM\Column(name: "length", nullable: true)]
    private ?float $length = null;

    #[ORM\Column(name: "width", nullable: true)]
    private ?float $width = null;

    #[ORM\Column(name: "weight", nullable: true)]
    private ?float $weight = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBarcode(): ?string
    {
        return $this->barcode;
    }

    public function setBarcode(string $barcode): static
    {
        $this->barcode = $barcode;

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

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(?float $weight): static
    {
        $this->weight = $weight;

        return $this;
    }
}
