<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $itemNumber = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $wholesalePrice = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $releaseDate = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $binLocation = null;

    #[ORM\Column(nullable: true)]
    private ?int $quantityOnHand = null;

    #[ORM\Column(nullable: true)]
    private ?int $quantityCommitted = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdOn = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $updatedOn = null;

    #[ORM\Column]
    private ?bool $deleted = null;

    #[ORM\Column]
    private ?bool $webItem = null;

    #[ORM\Column(length: 255)]
    private ?string $warehouse = null;

    #[ORM\Column(length: 255)]
    private ?string $unitOfMeasure = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $barcode = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    private ?Manufacturer $manufacturer = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    private ?MapPolicy $mapPolicy = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?ProductDetail $detail = null;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: ProductAttachment::class, cascade: ['persist', 'remove'])]
    private Collection $attachments;

    #[ORM\ManyToOne(inversedBy: 'products')]
    private ?ProductType $productType = null;

    public function __construct()
    {
        $this->attachments = new ArrayCollection();
        $this->detail = new ProductDetail();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getItemNumber(): ?string
    {
        return $this->itemNumber;
    }

    public function setItemNumber(string $itemNumber): static
    {
        $this->itemNumber = $itemNumber;

        return $this;
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

    public function getWholesalePrice(): ?string
    {
        return $this->wholesalePrice;
    }

    public function setWholesalePrice(?string $wholesalePrice): static
    {
        $this->wholesalePrice = $wholesalePrice;

        return $this;
    }

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(\DateTimeInterface $releaseDate): static
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    public function getBinLocation(): ?string
    {
        return $this->binLocation;
    }

    public function setBinLocation(?string $binLocation): static
    {
        $this->binLocation = $binLocation;

        return $this;
    }

    public function getQuantityOnHand(): ?int
    {
        return $this->quantityOnHand;
    }

    public function setQuantityOnHand(?int $quantityOnHand): static
    {
        $this->quantityOnHand = $quantityOnHand;

        return $this;
    }

    public function getQuantityCommitted(): ?int
    {
        return $this->quantityCommitted;
    }

    public function setQuantityCommitted(?int $quantityCommitted): static
    {
        $this->quantityCommitted = $quantityCommitted;

        return $this;
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

    public function isDeleted(): ?bool
    {
        return $this->deleted;
    }

    public function setDeleted(bool $deleted): static
    {
        $this->deleted = $deleted;

        return $this;
    }

    public function isWebItem(): ?bool
    {
        return $this->webItem;
    }

    public function setWebItem(bool $webItem): static
    {
        $this->webItem = $webItem;

        return $this;
    }

    public function getWarehouse(): ?string
    {
        return $this->warehouse;
    }

    public function setWarehouse(string $warehouse): static
    {
        $this->warehouse = $warehouse;

        return $this;
    }

    public function getUnitOfMeasure(): ?string
    {
        return $this->unitOfMeasure;
    }

    public function setUnitOfMeasure(string $unitOfMeasure): static
    {
        $this->unitOfMeasure = $unitOfMeasure;

        return $this;
    }

    public function getBarcode(): ?string
    {
        return $this->barcode;
    }

    public function setBarcode(?string $barcode): static
    {
        $this->barcode = $barcode;

        return $this;
    }

    public function getManufacturer(): ?Manufacturer
    {
        return $this->manufacturer;
    }

    public function setManufacturer(?Manufacturer $manufacturer): static
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    public function getMapPolicy(): ?MapPolicy
    {
        return $this->mapPolicy;
    }

    public function setMapPolicy(?MapPolicy $mapPolicy): static
    {
        $this->mapPolicy = $mapPolicy;

        return $this;
    }

    public function getDetail(): ?ProductDetail
    {
        return $this->detail;
    }

    public function setDetail(?ProductDetail $detail): static
    {
        $this->detail = $detail;

        return $this;
    }

    /**
     * @return Collection<int, ProductAttachment>
     */
    public function getAttachments(): Collection
    {
        return $this->attachments;
    }

    public function addAttachment(ProductAttachment $attachment): static
    {
        if (!$this->attachments->contains($attachment)) {
            $this->attachments->add($attachment);
            $attachment->setProduct($this);
        }

        return $this;
    }

    public function removeAttachment(ProductAttachment $attachment): static
    {
        if ($this->attachments->removeElement($attachment)) {
            // set the owning side to null (unless already changed)
            if ($attachment->getProduct() === $this) {
                $attachment->setProduct(null);
            }
        }

        return $this;
    }

    public function setAttachments($attachments) {
        $this->attachments = $attachments;
        return $this;
    }

    public function getProductType(): ?ProductType
    {
        return $this->productType;
    }

    public function setProductType(?ProductType $productType): static
    {
        $this->productType = $productType;

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
