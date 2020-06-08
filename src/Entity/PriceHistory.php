<?php

namespace App\Entity;

use App\Repository\PriceHistoryRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PriceHistoryRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class PriceHistory
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     */
    private $bookIdentifier;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAt(): self
    {
        $this->createdAt = new DateTime();

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getBookIdentifier(): ?int
    {
        return $this->bookIdentifier;
    }

    public function setBookIdentifier(int $bookIdentifier): self
    {
        $this->bookIdentifier = $bookIdentifier;

        return $this;
    }
}
