<?php

namespace App\Entity;

use App\Repository\LogicBrokerOrderStatusRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use DateTime;

#[ORM\Table(name: "logicbroker_order_status")]
#[ORM\Entity(repositoryClass: LogicBrokerOrderStatusRepository::class)]
class LogicBrokerOrderStatus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(name: "logicbroker_key", length: 255)]
    private ?string $logicBrokerKey = null;

    #[ORM\Column(name: "link_key", length: 255, nullable: true)]
    private ?string $linkKey = null;

    #[ORM\Column(name: "sender_company_id", length: 255)]
    private ?string $senderCompanyId = null;

    #[ORM\Column(name: "document_date", type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $documentDate = null;

    #[ORM\Column(name: "order_date", length: 255)]
    private ?string $orderDate = null;

    #[ORM\Column(name: "partner_po", length: 255)]
    private ?string $partnerPO = null;

    #[ORM\Column(name: "order_number", length: 255, nullable: true)]
    private ?string $orderNumber = null;

    #[ORM\Column(name: "weborder_number", length: 255)]
    private ?string $weborderNumber = null;

    #[ORM\Column(name: "customer_number", length: 255, nullable: true)]
    private ?string $customerNumber = null;

    #[ORM\Column(name: "status_code")]
    private ?int $statusCode = 100;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogicBrokerKey(): ?string
    {
        return $this->logicBrokerKey;
    }

    public function setLogicBrokerKey(string $logicBrokerKey): static
    {
        $this->logicBrokerKey = $logicBrokerKey;

        return $this;
    }

    public function getLinkKey(): ?string
    {
        return $this->linkKey;
    }

    public function setLinkKey(?string $linkKey): static
    {
        $this->linkKey = $linkKey;

        return $this;
    }

    public function getSenderCompanyId(): ?string
    {
        return $this->senderCompanyId;
    }

    public function setSenderCompanyId(string $senderCompanyId): static
    {
        $this->senderCompanyId = $senderCompanyId;

        return $this;
    }

    public function getDocumentDate(): ?\DateTimeInterface
    {
        return $this->documentDate;
    }

    public function setDocumentDate(\DateTimeInterface $documentDate): static
    {
        $this->documentDate = $documentDate;

        return $this;
    }

    public function getOrderDate(): ?DateTime
    {
        return $this->orderDate;
    }

    public function setOrderDate(DateTime $orderDate): static
    {
        $this->orderDate = $orderDate;

        return $this;
    }

    public function getPartnerPO(): ?string
    {
        return $this->partnerPO;
    }

    public function setPartnerPO(string $partnerPO): static
    {
        $this->partnerPO = $partnerPO;

        return $this;
    }

    public function getOrderNumber(): ?string
    {
        return $this->orderNumber;
    }

    public function setOrderNumber(?string $orderNumber): static
    {
        $this->orderNumber = $orderNumber;

        return $this;
    }

    public function getWeborderNumber(): ?string
    {
        return $this->weborderNumber;
    }

    public function setWeborderNumber(string $weborderNumber): static
    {
        $this->weborderNumber = $weborderNumber;

        return $this;
    }

    public function getCustomerNumber(): ?string
    {
        return $this->customerNumber;
    }

    public function setCustomerNumber(?string $customerNumber): static
    {
        $this->customerNumber = $customerNumber;

        return $this;
    }

    public function getStatusCode(): ?int
    {
        return $this->statusCode;
    }

    public function setStatusCode(int $statusCode): static
    {
        $this->statusCode = $statusCode;

        return $this;
    }
}
