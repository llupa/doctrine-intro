<?php

namespace App\Entity;

use App\Repository\PublisherRepository;
use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PublisherRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Publisher
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToOne(targetEntity=Address::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $address;

    /**
     * @ORM\Column(type="datetime")
     */
    private $lastUpdate;

    public function __construct()
    {
        $this->address = new Address();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function getLastUpdate(): ?DateTimeInterface
    {
        return $this->lastUpdate;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function setLastUpdate(): self
    {
        $this->lastUpdate = new DateTime();

        return $this;
    }
}
