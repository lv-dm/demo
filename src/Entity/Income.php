<?php

namespace App\Entity;

use App\Repository\IncomeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IncomeRepository::class)]
class Income
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $amount = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $income_date = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getIncomeDate(): ?\DateTimeInterface
    {
        return $this->income_date;
    }

    public function setIncomeDate(\DateTimeInterface $income_date): self
    {
        $this->income_date = $income_date;

        return $this;
    }
}
