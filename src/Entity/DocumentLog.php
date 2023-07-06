<?php

namespace App\Entity;

use App\Repository\DocumentLogRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: "document_log")]
#[ORM\Entity(repositoryClass: DocumentLogRepository::class)]
#[ORM\HasLifecycleCallbacks]
class DocumentLog
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(name: "orderNumber", length: 255)]
    private ?string $orderNumber = null;

    #[ORM\Column(name: "documentAction", length: 255)]
    private ?string $documentAction = null;

    #[ORM\Column(name: "user", length: 255)]
    private ?string $username = null;

    #[ORM\Column(name: "timestamp", type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $timestamp = null;

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

    public function getDocumentAction(): ?string
    {
        return $this->documentAction;
    }

    public function setDocumentAction(string $documentAction): static
    {
        $this->documentAction = $documentAction;

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

    #[ORM\PrePersist]
    public function setTimestampValue() {
        $this->timestamp = new \DateTime();
    }
}
