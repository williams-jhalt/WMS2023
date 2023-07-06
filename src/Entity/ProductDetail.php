<?php

namespace App\Entity;

use App\Repository\ProductDetailRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: ProductDetailRepository::class)]
#[ORM\HasLifecycleCallbacks]
class ProductDetail
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $htmlDescription = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $brand = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $category = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 3, nullable: true)]
    private ?string $packageHeight = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 3, nullable: true)]
    private ?string $packageLength = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 3, nullable: true)]
    private ?string $packageWidth = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 3, nullable: true)]
    private ?string $packageWeight = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $dimUnit = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $weightUnit = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $msrp = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $mapPrice = null;

    #[ORM\OneToMany(mappedBy: 'detail', targetEntity: ProductAttribute::class, cascade: ["persist", "remove"])]
    private Collection $attributes;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdOn = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $updatedOn = null;

    public function __construct() {
        $this->attributes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getHtmlDescription(): ?string
    {
        return $this->htmlDescription;
    }

    public function setHtmlDescription(?string $htmlDescription): static
    {
        $this->htmlDescription = $htmlDescription;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(?string $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(?string $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getPackageHeight(): ?string
    {
        return $this->packageHeight;
    }

    public function setPackageHeight(?string $packageHeight): static
    {
        $this->packageHeight = $packageHeight;

        return $this;
    }

    public function getPackageLength(): ?string
    {
        return $this->packageLength;
    }

    public function setPackageLength(?string $packageLength): static
    {
        $this->packageLength = $packageLength;

        return $this;
    }

    public function getPackageWidth(): ?string
    {
        return $this->packageWidth;
    }

    public function setPackageWidth(?string $packageWidth): static
    {
        $this->packageWidth = $packageWidth;

        return $this;
    }

    public function getPackageWeight(): ?string
    {
        return $this->packageWeight;
    }

    public function setPackageWeight(?string $packageWeight): static
    {
        $this->packageWeight = $packageWeight;

        return $this;
    }

    public function getDimUnit(): ?string
    {
        return $this->dimUnit;
    }

    public function setDimUnit(?string $dimUnit): static
    {
        $this->dimUnit = $dimUnit;

        return $this;
    }

    public function getWeightUnit(): ?string
    {
        return $this->weightUnit;
    }

    public function setWeightUnit(?string $weightUnit): static
    {
        $this->weightUnit = $weightUnit;

        return $this;
    }

    public function getMsrp(): ?string
    {
        return $this->msrp;
    }

    public function setMsrp(?string $msrp): static
    {
        $this->msrp = $msrp;

        return $this;
    }

    public function getMapPrice(): ?string
    {
        return $this->mapPrice;
    }

    public function setMapPrice(?string $mapPrice): static
    {
        $this->mapPrice = $mapPrice;

        return $this;
    }

    public function addAttribute(ProductAttribute $attribute) {
        if (!$this->attributes->contains($attribute)) {
            $this->attributes[] = $attribute;
            $attribute->setDetail($this);
        }

        return $this;
    }

    public function removeAttribute(ProductAttribute $attribute) {
        if ($this->attributes->contains($attribute)) {
            $this->attributes->removeElement($attribute);
        }

        return $this;
    }

    public function getAttributes() {
        return $this->attributes;
    }

    public function getCreatedOn(): ?\DateTimeInterface
    {
        return $this->createdOn;
    }

    public function setCreatedOn(\DateTimeInterface $createdOn): static
    {
        $this->createdOn = $createdOn;

        return $this;
    }

    public function getUpdatedOn(): ?\DateTimeInterface
    {
        return $this->updatedOn;
    }

    public function setUpdatedOn(\DateTimeInterface $updatedOn): static
    {
        $this->updatedOn = $updatedOn;

        return $this;
    }

    #[ORM\PrePersist]
    public function setCreatedAtValue() {
        $this->createdOn = new \DateTime();
        $this->updatedOn = new \DateTime();
    }

    #[ORM\PreUpdate]
    public function setUpdateAtValue() {
        $this->updatedOn = new \DateTime();
    }
}
