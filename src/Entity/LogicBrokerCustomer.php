<?php

namespace App\Entity;

use App\Repository\LogicBrokerCustomerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: "logicbroker_customer")]
#[ORM\Entity(repositoryClass: LogicBrokerCustomerRepository::class)]
class LogicBrokerCustomer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(name: "sender_company_id", length: 255)]
    private ?string $senderCompanyId = null;

    #[ORM\Column(name: "customer_number", length: 255, nullable: true)]
    private ?string $customerNumber = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCustomerNumber(): ?string
    {
        return $this->customerNumber;
    }

    public function setCustomerNumber(?string $customerNumber): static
    {
        $this->customerNumber = $customerNumber;

        return $this;
    }
}
