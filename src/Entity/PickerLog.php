<?php

namespace App\Entity;

use App\Repository\PickerLogRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: "picker_log")]
#[ORM\Entity(repositoryClass: PickerLogRepository::class)]
#[ORM\HasLifecycleCallbacks]
class PickerLog
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(name: "orderNumber", length: 255)]
    private ?string $orderNumber = null;

    #[ORM\Column(name: "user", length: 255)]
    private ?string $username = null;

    #[ORM\Column(name: "timestamp", type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $timestamp = null;

    #[ORM\Column(name: "pageCount", nullable: true)]
    private ?int $pageCount = 1;

    #[ORM\Column(name: "lineCount", nullable: true)]
    private ?int $lineCount = 1;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderNumber(): ?string
    {
        return $this->orderNumber;
    }

    public function setOrderNumber(string $orderNumber): static
    {
        $this->orderNumber = $orderNumber;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getTimestamp(): ?\DateTimeInterface
    {
        return $this->timestamp;
    }

    public function setTimestamp(\DateTimeInterface $timestamp): static
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    public function getPageCount(): ?int
    {
        return $this->pageCount;
    }

    public function setPageCount(?int $pageCount): static
    {
        $this->pageCount = $pageCount;

        return $this;
    }

    public function getLineCount(): ?int
    {
        return $this->lineCount;
    }

    public function setLineCount(?int $lineCount): static
    {
        $this->lineCount = $lineCount;

        return $this;
    }

    #[ORM\PrePersist]
    public function setTimestampValue() {
        $this->timestamp = new \DateTime();
    }
}
